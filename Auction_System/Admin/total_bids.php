<?php
require_once "check.php";  
require_once "../User/Config.php";  
include 'Admin_Nav.php';


$sql = "
    SELECT bid_id, user_id, item_id, bid_amount, created_at 
    FROM bids
";
$result = mysqli_query($link, $sql);


if (!$result) {
    echo "Error: " . mysqli_error($link);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Total Bids</title>
    
</head>
<body>
<div class="container mt-5">
    <h2>Total Bids</h2>
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-primary">
                <tr>
                    <th>Bid ID</th>
                    <!-- <th>User ID</th> -->
                    <th>Item ID</th>
                    <th>Bid Amount</th>
                    <th>Bid Time</th>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['bid_id']); ?></td>
                           
                            <td><?php echo htmlspecialchars($row['item_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['bid_amount']); ?></td>
                            <td><?php echo htmlspecialchars($row['created_at']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No bids found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
// Close the database connection
mysqli_close($link);
?>
<?php include 'Admin_footer.php'; ?>
</body>
</html>
