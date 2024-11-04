<?php
// bids.php

// Check if the bid is being placed
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection
    require_once "db_connection.php"; 

    $item_id = $_POST['item_id'];
    $user_id = $_SESSION['user_id']; 
    $bid_amount = $_POST['bid_amount'];

    $sql_current_bid = "SELECT current_bid FROM auction_items WHERE A_id = ?";
    if ($stmt_current = mysqli_prepare($link, $sql_current_bid)) {
        mysqli_stmt_bind_param($stmt_current, "i", $item_id);
        mysqli_stmt_execute($stmt_current);
        mysqli_stmt_bind_result($stmt_current, $current_bid);
        mysqli_stmt_fetch($stmt_current);
        mysqli_stmt_close($stmt_current);
    }


    if ($bid_amount > $current_bid) {
        $sql_insert = "INSERT INTO bids (user_id, item_id, bid_amount) VALUES (?, ?, ?)";
        if ($stmt_insert = mysqli_prepare($link, $sql_insert)) {
            mysqli_stmt_bind_param($stmt_insert, "iid", $user_id, $item_id, $bid_amount);
            if (mysqli_stmt_execute($stmt_insert)) {
               
                $sql_update = "UPDATE auction_items SET current_bid = ? WHERE A_id = ?";
                if ($stmt_update = mysqli_prepare($link, $sql_update)) {
                    mysqli_stmt_bind_param($stmt_update, "di", $bid_amount, $item_id);
                    mysqli_stmt_execute($stmt_update);
                    mysqli_stmt_close($stmt_update);
                }

                // Notify users who have previously bid on the item
                $sql_notify = "SELECT DISTINCT u.Email FROM bids b JOIN user u ON b.user_id = u.ID WHERE b.item_id = ?";
                if ($stmt_notify = mysqli_prepare($link, $sql_notify)) {
                    mysqli_stmt_bind_param($stmt_notify, "i", $item_id);
                    if (mysqli_stmt_execute($stmt_notify)) {
                        $result_notify = mysqli_stmt_get_result($stmt_notify);
                        while ($user = mysqli_fetch_array($result_notify, MYSQLI_ASSOC)) {
                            $user_email = $user['Email'];
                            // Send notification (e.g., email or in-app notification)
                            // mail($user_email, "New Bid Placed", "A new bid of $$bid_amount has been placed on the item you're interested in!");
                        }
                    }
                    mysqli_stmt_close($stmt_notify);
                }

                echo "Bid placed successfully!";
            }
            mysqli_stmt_close($stmt_insert);
        }
    } else {
        // If the bid amount is less than or equal to the current bid
        echo "Your bid must be higher than the current bid!";
    }
}
?>
