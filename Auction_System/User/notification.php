<?php
session_start();
require_once "config.php";
include 'Nav.php';

$seller_id = $_SESSION['id'];


$delete_sql = "DELETE FROM notifications WHERE created_at < NOW() - INTERVAL 24 HOUR";
mysqli_query($link, $delete_sql);


$sql = "SELECT * FROM notifications WHERE user_id = ? ORDER BY created_at DESC";
if ($stmt = mysqli_prepare($link, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $param_user_id);
    $param_user_id = $seller_id;

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $notifications = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_stmt_close($stmt);
}

mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifications</title>
    <link rel="stylesheet" href="../Style.css">
</head>
<body>
<div class="container mt-5">
    <h2>Your Notifications</h2>
    <?php if (empty($notifications)): ?>
        <div class="alert alert-info">No notifications yet.</div>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($notifications as $notification): ?>
                <li class="list-group-item">
                    <strong><?php echo htmlspecialchars($notification['message']); ?></strong>
                    <br>
                    <?php if (!empty($notification['feedback'])): ?>
                        <em>Feedback: <?php echo htmlspecialchars($notification['feedback']); ?></em>
                        <br>
                    <?php endif; ?>
                    <span class="text-muted"><?php echo htmlspecialchars($notification['created_at']); ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div><br>
<?php include 'footer.php'; ?>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
