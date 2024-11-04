<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
   
    <link rel="stylesheet" href="../Style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin: 20px;
        }
        .card-header {
            background-color: red;
            color: black;
            font-weight: bold;
        }
        .list-group-item {
            background-color: #ffffff;
            border: none;
            border-bottom: 1px solid #e9ecef;
        }
        .list-group-item:last-child {
            border-bottom: none;
        }
        .btn-see-items {
            margin-top: 10px;
        }
    </style>
</head>
<body>
<?php
require_once "check.php";
include 'Admin_Nav.php';
require_once "../User/Config.php";   // Including your database connection

$sql_items = "SELECT COUNT(*) as total_items FROM auction_items";
$result_items = mysqli_query($link, $sql_items);
$total_items = mysqli_fetch_assoc($result_items)['total_items'];

$sql_users = "SELECT COUNT(*) as total_users FROM user";
$result_users = mysqli_query($link, $sql_users);
$total_users = mysqli_fetch_assoc($result_users)['total_users'];

$sql_bids = "SELECT COUNT(*) as total_bids FROM bids";
$result_bids = mysqli_query($link, $sql_bids);
$total_bids = mysqli_fetch_assoc($result_bids)['total_bids'];

// Close the database connection
mysqli_close($link);
?>

<div class="container mt-5">
    <h2>Admin Dashboard</h2>
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Auction Items</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $total_items; ?></h5>
                    <a href="see_item.php" class="btn btn-light btn-see-items">See Items</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $total_users; ?></h5>
                    <a href="manage_users.php" class="btn btn-light btn-see-items">See Users</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Total Bids</div>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $total_bids; ?></h5>
                    <a href="total_bids.php" class="btn btn-light btn-see-items">See Bids</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Admin Tasks</h3>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <li class="list-group-item">Review and approve new auction items.</li>
                    <li class="list-group-item">Monitor ongoing auctions and bids.</li>
                    <li class="list-group-item">Manage user accounts and handle user issues.</li>
                    <li class="list-group-item">Generate reports on auction activity and performance.</li>
                    <li class="list-group-item">Ensure the system is secure and running smoothly.</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include 'Admin_footer.php'; ?>
</body>
</html>
