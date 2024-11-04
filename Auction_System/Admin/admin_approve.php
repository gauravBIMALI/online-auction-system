<?php
require_once "../User/config.php";
require_once "check.php";

$query = "SELECT * FROM auction_items WHERE approved = 0";
$result = mysqli_query($link, $query);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $item_id = $_POST['item_id'];
    $action = $_POST['action'];
    $feedback = $_POST['feedback'];

    $check_approval = "SELECT approved FROM auction_items WHERE A_id = ?";
    if ($check_stmt = mysqli_prepare($link, $check_approval)) {
        mysqli_stmt_bind_param($check_stmt, "i", $item_id);
        mysqli_stmt_execute($check_stmt);
        mysqli_stmt_bind_result($check_stmt, $is_approved);
        mysqli_stmt_fetch($check_stmt);
        mysqli_stmt_close($check_stmt);

        if ($is_approved == 0) {
            if ($action == 'approve') {
                $sql = "UPDATE auction_items SET approved = 1, feedback = ? WHERE A_id = ?";
                $message = "Your item has been approved.";
            } elseif ($action == 'reject') {
                $sql = "UPDATE auction_items SET approved = 0, feedback = ? WHERE A_id = ?";
                $message = "Your item has been rejected.";
            }

            if ($stmt = mysqli_prepare($link, $sql)) {
                mysqli_stmt_bind_param($stmt, "si", $feedback, $item_id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);

                // Fetch seller_id for the item
                $result_seller = mysqli_query($link, "SELECT seller_id FROM auction_items WHERE A_id = $item_id");
                $row_seller = mysqli_fetch_assoc($result_seller);
                $seller_id = $row_seller['seller_id'];

                // Insert notification
                $notif_sql = "INSERT INTO notifications (user_id, item_id, message, feedback) VALUES (?, ?, ?, ?)";
                if ($notif_stmt = mysqli_prepare($link, $notif_sql)) {
                    mysqli_stmt_bind_param($notif_stmt, "iiss", $seller_id, $item_id, $message, $feedback);
                    mysqli_stmt_execute($notif_stmt);
                    mysqli_stmt_close($notif_stmt);
                }

                $_SESSION['message'] = $message;
                header("Location: admin_approve.php");  // Refresh the page after the operation
                exit();
            }
        } else {
            $_SESSION['message'] = "This item has already been approved or rejected.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Approval</title>
   
    <style>
        
        .table td, .table th {
            vertical-align: middle;
        }
        .feedback-area, .details-area {
            width: 50%; 
    height: 50px; 
            resize: none;
        }
        .action-buttons {
            display: flex;
            justify-content: space-between;
        }
        .action-buttons button {
            width: 48%; /* Ensure the buttons fit in the same row and are spaced evenly */
        }
        textarea {
            resize: none;
        }
    </style>
</head>
<body>
<?php include 'Admin_Nav.php'; ?>
<div class="container mt-5">
    <h2>Pending Approvals</h2>
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php endif; ?>

    <?php if (mysqli_num_rows($result) > 0): // Check if there are any items ?>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">Item Name</th>
                <th scope="col">Image</th>
                <th scope="col">Initial Bid</th>
                <th scope="col" style="width: 20%;">Details</th>
                <th scope="col">Seller Email</th>
                <th scope="col">Start Date</th>
                <th scope="col">End Date</th>
                <th scope="col" style="width: 20%;">Feedback</th>
                <!-- <th scope="col">Actions</th> -->
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><img src="../Upload/<?php echo htmlspecialchars(basename($row['image'])); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="img-thumbnail" style="max-width: 100px;"></td>
                <td><?php echo htmlspecialchars($row['initial_bid']); ?></td>
                <td>
                    <textarea rows="6" cols="4" class="form-control details-area mb-2" readonly><?php echo htmlspecialchars($row['details']); ?></textarea>
                </td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                <td><?php echo htmlspecialchars($row['end_date']); ?></td>
                <td>
                    <form action="admin_approve.php" method="post">
                        <input type="hidden" name="item_id" value="<?php echo $row['A_id']; ?>">
                        <textarea rows="6" cols="4" name="feedback"  class="form-control feedback-area mb-2" placeholder="Enter feedback here..." required ></textarea>
                        <div class="action-buttons">
                            <button type="submit" name="action" value="approve" class="btn btn-success btn-sm">Approve</button>
                            <button type="submit" name="action" value="reject" class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    
    <?php else: ?>
        <p>No items pending approval at the moment.</p>
    <?php endif; ?>
</div><br> <br>
<?php include 'Admin_footer.php'; ?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
