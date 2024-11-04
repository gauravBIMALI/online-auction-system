<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Manage User</title>
     <style>
body {
    font-family: Arial, sans-serif;
    margin: 20px;
    border-radius: 15px;
}

.user-table {
    width: 85%;
    border-collapse: collapse;
    box-shadow: 0px 0px 15px rgba(0.6, 0.1, 0, 0.2);
    
}

.user-table th, .user-table td {
    
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd;
    text-align: center;
}

.user-table th {

    background-color: #f2f2f2;
}

.user-table tr:hover {
    cursor: pointer;
    background-color: #f1f1f1;
}

.delete-link {
    color: red;
    text-decoration: none;
}

.delete-link:hover {
    text-decoration: underline;
    cursor: pointer;
}

</style>

</head>
<body>
<?php include 'Admin_Nav.php'; ?>
<br><br> 
<?php

require_once "../User/Config.php";

$sql = "SELECT ID, name, Phone, Email FROM user WHERE role != 'admin'";
$result = mysqli_query($link, $sql);

if(mysqli_num_rows($result) > 0){
    echo "<h2>User List:</h2>";
    echo "<table class='user-table'>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Action</th>
            </tr>";
    
    // Fetch and display each user's information
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>
                <td>" . htmlspecialchars($row['ID']) . "</td>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['Phone']) . "</td>
                <td>" . htmlspecialchars($row['Email']) . "</td>
                <td><a href='#?id=" . htmlspecialchars($row['ID']) . "' onclick='return confirm(\"Are you sure you want to delete this user?\");' class='delete-link'>Delete</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<p>No users found.</p>";
}

// Close the database connection
mysqli_close($link);
?>

<br> <br> 
<?php include 'Admin_footer.php'; ?>
</body>
</html>