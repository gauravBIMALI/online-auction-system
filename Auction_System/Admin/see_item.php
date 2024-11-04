<?php
require_once "../User/Config.php";   // Including your database connection

// Handle delete action
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $delete_sql = "DELETE FROM auction_items WHERE A_id = $delete_id";
    if (mysqli_query($link, $delete_sql)) {
        echo "<script>alert('Item deleted successfully.'); window.location.href='see_item.php';</script>";
    } else {
        echo "Error deleting item: " . mysqli_error($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Auction Items</title>
   
    <style>
        body {
            background-color: #f8f9fa;
        }
        h2 {
            color: #343a40;
            text-align: center;
            margin-bottom: 30px;
        }
        table {
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            table-layout: auto; /* Ensures columns adjust to content */
            width: 60%; /* Full width of container */
        }
        thead {
            background-color: #007bff;
            color: #ffffff;
        }
        th, td {
            padding: 12px 15px;
            margin-left: 10px;
            text-align: center;
            white-space: nowrap; /* Prevents text wrapping */
        }
        th {
            font-weight: bold;
        }
        td {
            vertical-align: middle;
        }
        /* Adjust specific column widths */
        th:nth-child(1), td:nth-child(1) {
            width: 5%; /* Seller ID */
        }
        th:nth-child(2), td:nth-child(2) {
            width: 10%; /* Image */
        }
        th:nth-child(3), td:nth-child(3) {
            width: 10%; /* Item Name */
        }
        th:nth-child(4), td:nth-child(4) {
            width: 10%; /* Initial Bid */
        }
        th:nth-child(5), td:nth-child(5) {
            width: 10%; /* Action */
        }
        img {
            border-radius: 15%;
            border: 1px solid #dee2e6;
            width: 25px;
            height: 25px;
        }
        .btn-danger {
            background-color: #dc3545;
            border: none;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
        .container {
            margin-top: 50px;
        }
        .table-bordered {
            border: 1px solid #dee2e6;
        }
    </style>
</head>
<body>
<?php include 'Admin_Nav.php'; ?>
<div class="container mt-5">
    <h2>Auction Items</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Seller ID</th>
                <th>Photo</th>
                <th>Item Name</th>
                <th>Initial Bid</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        // Query to get all auction items
        $sql_items = "SELECT seller_id, image, name, initial_bid, A_id FROM auction_items";
        $result_items = mysqli_query($link, $sql_items);

        // Fetch and display each item
        while ($item = mysqli_fetch_assoc($result_items)) {
            echo "<tr>";
            echo "<td>" . $item['seller_id'] . "</td>";
            echo "<td><img src='" . $item['image'] . "' alt='Item Image' style='width: 80px; height: 80px;'></td>";
            echo "<td>" . $item['name'] . "</td>";
            echo "<td>Rs:" . number_format($item['initial_bid'], 2) . "</td>";
            echo "<td>
                    <a href='see_item.php?delete_id=" . $item['A_id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this item?\");'>Delete</a>
                  </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<?php mysqli_close($link); ?>
<?php include 'Admin_footer.php'; ?>
</body>
</html>
