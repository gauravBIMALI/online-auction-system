<?php
// Include the check_login file
require_once "check_login.php";
include 'Nav.php';
// Include config file
require_once "config.php";

// Fetch user data
$user_id = $_SESSION["id"]; // Assuming you store user ID in the session after login

// Prepare a select statement
$sql = "SELECT name, Phone, Email, Password FROM user WHERE ID = ?";

if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "i", $param_id);
    
    // Set parameters
    $param_id = $user_id;
    
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        mysqli_stmt_store_result($stmt);
        
        // Check if user exists, if yes then fetch the data
        if(mysqli_stmt_num_rows($stmt) == 1){
            // Bind result variables
            mysqli_stmt_bind_result($stmt, $name, $phone, $email, $password);
            if(mysqli_stmt_fetch($stmt)){
                // Use the fetched data here
            }
        } else{
            // User doesn't exist, redirect to login page
            header("location: login.php");
            exit;
        }
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Close connection
mysqli_close($link);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="../Style.css">
    <style>
        .profile-container {
    max-width: 600px;
    margin: 50px auto;
    padding: 20px;
    background-color: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    font-weight: bold;
}

.profile-header {
    text-align: center;
    margin-bottom: 30px;
}

.profile-info {
    display: flex;
    justify-content: space-between; /* Changed from space-around */
    align-items: center;
    margin-bottom: 25px;
}

.profile-info span {
    font-size: 1.25em;
    flex-grow: 1;
    padding-right: 10px; /* Reduced padding for closer spacing */
}

.edit-btn {
    font-size: 0.9em;
    margin-left: 10px;
    padding: 5px 10px;
}

    </style>
</head>
<body>
    <div class="container profile-container">
        <div class="profile-header">
            <h2>User Profile</h2>
        </div>
        <div class="profile-info">
            <span>Name: <?php echo htmlspecialchars($name); ?></span>
            <a href="edit_profile.php?field=name" class="btn btn-secondary edit-btn">Edit</a>
        </div>
        <div class="profile-info">
            <span>Phone: <?php echo htmlspecialchars($phone); ?></span>
            <a href="edit_profile.php?field=phone" class="btn btn-secondary edit-btn">Edit</a>
        </div>
        <div class="profile-info">
            <span>Email: <?php echo htmlspecialchars($email); ?></span>
            <a href="edit_profile.php?field=email" class="btn btn-secondary edit-btn">Edit</a>
        </div>
        <div class="profile-info">
            <span>Password: ********</span>
            <a href="edit_profile.php?field=password" class="btn btn-secondary edit-btn">Edit</a>
        </div>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
