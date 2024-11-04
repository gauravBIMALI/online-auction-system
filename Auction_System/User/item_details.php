<?php
session_start();
require_once "config.php";
include 'Nav.php';



// Initialize variables
$current_bid = 0;
$current_user_id = $_SESSION['user_id'] ?? null;

// Fetch item details from the database based on the item ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $item_id = $_GET['id'];
    $sql = "SELECT * FROM auction_items WHERE A_id = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        $param_id = $item_id;
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if (mysqli_num_rows($result) == 1) {
                $item = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Fetch the current highest bid for the item
                $sql_bid = "SELECT MAX(bid_amount) AS current_bid FROM bids WHERE item_id = ?";
                if ($stmt_bid = mysqli_prepare($link, $sql_bid)) {
                    mysqli_stmt_bind_param($stmt_bid, "i", $param_item_id);
                    $param_item_id = $item['A_id'];
                    if (mysqli_stmt_execute($stmt_bid)) {
                        $result_bid = mysqli_stmt_get_result($stmt_bid);
                        $bid = mysqli_fetch_array($result_bid, MYSQLI_ASSOC);
                        $current_bid = $bid['current_bid'] ? $bid['current_bid'] : $item['initial_bid'];
                    }
                    mysqli_stmt_close($stmt_bid);
                }
            } else {
                echo "No records found.";
                exit();
            }
        } else {
            echo "Error executing query.";
            exit();
        }
        mysqli_stmt_close($stmt);
    }
} else {
    echo "Invalid item ID.";
    exit();
}

// Handle bid submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bid_amount']) && isset($_POST['item_id'])) {
    $bid_amount = $_POST['bid_amount'];
    $item_id = $_POST['item_id'];

    // Validate bid amount
    $sql_check_bid = "SELECT MAX(bid_amount) AS current_bid FROM bids WHERE item_id = ?";
    if ($stmt_check_bid = mysqli_prepare($link, $sql_check_bid)) {
        mysqli_stmt_bind_param($stmt_check_bid, "i", $param_item_id);
        $param_item_id = $item_id;
        if (mysqli_stmt_execute($stmt_check_bid)) {
            $result_check_bid = mysqli_stmt_get_result($stmt_check_bid);
            $current_bid_check = mysqli_fetch_array($result_check_bid, MYSQLI_ASSOC)['current_bid'] ?? $item['initial_bid'];

            if ($bid_amount > $current_bid_check) {
                // Place the bid
                $sql_insert_bid = "INSERT INTO bids (user_id, item_id, bid_amount, created_at) VALUES (?, ?, ?, NOW())";
                if ($stmt_insert_bid = mysqli_prepare($link, $sql_insert_bid)) {
                    mysqli_stmt_bind_param($stmt_insert_bid, "iid", $_SESSION['user_id'], $item_id, $bid_amount);
                    if (mysqli_stmt_execute($stmt_insert_bid)) {
                        notifyUsers($link, $item_id, $bid_amount);
                        header("Location: item_details.php?id=" . $item_id);
                        exit();
                    } else {
                        echo "Error placing bid.";
                    }
                    mysqli_stmt_close($stmt_insert_bid);
                }
            } else {
                echo "Your bid must be higher than the current bid!";
            }
        }
        mysqli_stmt_close($stmt_check_bid);
    }
}
// Function to notify both owner and other bidders
function notifyUsers($link, $item_id, $bid_amount) {
    // Fetch the owner and item name of the item
    $ownerQuery = "SELECT seller_id, name FROM auction_items WHERE A_id = ?";
    if ($stmt_owner = mysqli_prepare($link, $ownerQuery)) {
        mysqli_stmt_bind_param($stmt_owner, "i", $item_id);
        if (mysqli_stmt_execute($stmt_owner)) {
            $ownerResult = mysqli_stmt_get_result($stmt_owner);
            if ($ownerRow = mysqli_fetch_array($ownerResult, MYSQLI_ASSOC)) {
                $owner_id = $ownerRow['seller_id'];
                $item_name = $ownerRow['name'];
                $ownerMessage = "New bid placed on your item: " . $item_name . " for Rs. " . $bid_amount;
                insertNotification($link, $owner_id, $item_id, $ownerMessage);
            }
        }
        mysqli_stmt_close($stmt_owner);
    }

    $biddersQuery = "SELECT DISTINCT user_id FROM bids WHERE item_id = ? AND user_id != ?";
    if ($stmt_bidders = mysqli_prepare($link, $biddersQuery)) {
        mysqli_stmt_bind_param($stmt_bidders, "ii", $item_id, $_SESSION['user_id']);
        if (mysqli_stmt_execute($stmt_bidders)) {
            $biddersResult = mysqli_stmt_get_result($stmt_bidders);

            if (mysqli_num_rows($biddersResult) > 0) {
                while ($bidder = mysqli_fetch_array($biddersResult, MYSQLI_ASSOC)) {
                    $bidder_id = $bidder['user_id'];
                    $bidderMessage = "Another user has placed a higher bid on the item: " . $item_name;
                    insertNotification($link, $bidder_id, $item_id, $bidderMessage);
                    
                    
                    echo "Notification sent to user ID: " . $bidder_id . " with message: " . $bidderMessage . "<br>";
                }
            } else {
                // Debugging: No previous bidders
                echo "No previous bidders to notify.<br>";
            }
        } else {
            // Debugging: Query execution failed
            echo "Error executing bidders query.<br>";
        }
        mysqli_stmt_close($stmt_bidders);
    }
}

// Function to insert notifications
function insertNotification($link, $user_id, $item_id, $message) {
    $sql_notify = "INSERT INTO notifications (user_id, item_id, message) VALUES (?, ?, ?)";
    if ($stmt_notify = mysqli_prepare($link, $sql_notify)) {
        mysqli_stmt_bind_param($stmt_notify, "iis", $user_id, $item_id, $message);
        if (mysqli_stmt_execute($stmt_notify)) {
            // Debugging: Output confirmation of notification insertion
            echo "Notification inserted for user ID: " . $user_id . "<br>";
        } else {
            // Debugging: Failed to insert notification
            echo "Failed to insert notification for user ID: " . $user_id . "<br>";
        }
        mysqli_stmt_close($stmt_notify);
    }
}


$current_date = date('Y-m-d H:i:s');
if ($current_date >= $item['end_date']) {
    // Auction has ended, fetch the highest bidder
    $sql_highest_bid = "SELECT user_id, bid_amount FROM bids WHERE item_id = ? ORDER BY bid_amount DESC LIMIT 1";
    if ($stmt_highest = mysqli_prepare($link, $sql_highest_bid)) {
        mysqli_stmt_bind_param($stmt_highest, "i", $param_item_id);
        $param_item_id = $item_id;
        if (mysqli_stmt_execute($stmt_highest)) {
            $result_highest = mysqli_stmt_get_result($stmt_highest);
            if ($row_highest = mysqli_fetch_assoc($result_highest)) {
                $winner_user_id = $row_highest['user_id'];
                $winner_bid = $row_highest['bid_amount'];

                // Get winner's name from the `user` table
                $sql_winner = "SELECT name FROM user WHERE ID = ?";
                if ($stmt_winner = mysqli_prepare($link, $sql_winner)) {
                    mysqli_stmt_bind_param($stmt_winner, "i", $param_winner_id);
                    $param_winner_id = $winner_user_id;
                    if (mysqli_stmt_execute($stmt_winner)) {
                        $result_winner = mysqli_stmt_get_result($stmt_winner);
                        if ($row_winner = mysqli_fetch_assoc($result_winner)) {
                            $winner_name = htmlspecialchars($row_winner['name']);

                            // Display winner message on the page
                            echo "<div class='alert alert-success'>Congratulations " . $winner_name . "! You have won the auction with a bid of Rs: " . $winner_bid . "</div>";
                        }
                    }
                    mysqli_stmt_close($stmt_winner);
                }
            }
        }
        mysqli_stmt_close($stmt_highest);
    }
} else {
    echo "<div class='alert alert-info'>The auction is still ongoing.</div>";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Item Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Style.css">
    <style>
        .container {
            padding-top: 20px;
        }

        .item-image {
            width: 80%;
            height: 450px;
            object-fit: cover;
            border-radius: 10px;
            border: 2px solid #ddd;
            margin-bottom: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
        }

        .bid-section {
            margin-top: 20px;
        }

        .bid-section input {
            width: 100px;
            margin-right: 10px;
            display: inline-block;
        }

        .comment-section {
            margin-top: 40px;
        }

        .comment-box {
            width: 70%;
            min-height: 100px;
            margin-bottom: 10px;
        }

        .gap-navbar {
            padding-top: 70px;
        }

        .comment {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .comment .author {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .comment .timestamp {
            font-size: 0.9em;
            color: #666;
            margin-bottom: 10px;
        }

        .comment .comment-text {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container gap-navbar">
        <div class="row">
            <div class="col-md-6">
                <img src="<?php echo htmlspecialchars($item['image']); ?>"
                    alt="<?php echo htmlspecialchars($item['name']); ?>" class="item-image">
            </div>
            <div class="col-md-6">
                <br>
                <h2>Name: <?php echo htmlspecialchars($item['name']); ?></h2><br>
                <p><b>Details:</b> <?php echo htmlspecialchars($item['details']); ?></p><br>
                <p><b>Starting Date:</b><?php echo htmlspecialchars($item['start_date']); ?></p>
                <p><b>Ending Date:</b><?php echo htmlspecialchars($item['end_date']); ?></p>
                <p><b>Starting Bid:</b> Rs: <?php echo htmlspecialchars($item['initial_bid']); ?></p>
                <p><b>Current Bid:</b> Rs: <?php echo htmlspecialchars($current_bid); ?></p>

                <div class="bid-section">
                    <form action="" method="post">
                        <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item['A_id']); ?>">
                        <input type="number" name="bid_amount" class="form-control d-inline" placeholder="Bid Amount"
                            min="<?php echo htmlspecialchars($current_bid + 1); ?>" required>
                        <button type="submit" class="btn btn-success">Place Bid</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row comment-section">
            <div class="col-md-12">
                <h4>Comment Section</h4>
                <form action="comment.php" method="post">
                    <input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item['A_id']); ?>">
                    <textarea name="comment" class="form-control comment-box" placeholder="Leave a comment..."
                        required></textarea>
                    <button type="submit" class="btn btn-primary">Submit Comment</button>
                </form>
                <br>
                <div id="comments">
                    <?php
                    $sql_comments = "SELECT c.comment, c.created_at, u.name FROM comments c JOIN user u ON c.user_id = u.ID WHERE c.item_id = ? ORDER BY c.created_at DESC";
                    if ($stmt_comments = mysqli_prepare($link, $sql_comments)) {
                        mysqli_stmt_bind_param($stmt_comments, "i", $param_item_id);
                        $param_item_id = $item['A_id'];
                        if (mysqli_stmt_execute($stmt_comments)) {
                            $result_comments = mysqli_stmt_get_result($stmt_comments);
                            while ($comment = mysqli_fetch_array($result_comments, MYSQLI_ASSOC)) {
                                echo "<div class='comment'><strong>" . htmlspecialchars($comment['name']) . ":</strong> " . htmlspecialchars($comment['comment']) . "<br><small>" . htmlspecialchars($comment['created_at']) . "</small></div>";
                            }
                        } else {
                            echo "Error fetching comments.";
                        }
                        mysqli_stmt_close($stmt_comments);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <br>
    <?php include 'footer.php'; ?>
</body>

</html>

<?php
mysqli_close($link);
?>