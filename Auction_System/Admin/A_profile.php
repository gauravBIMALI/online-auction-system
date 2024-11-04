<?php
session_start();
require_once "../User/Config.php"; // Use the existing config.php for database connection

// Check if the user is logged in and retrieve the user ID from the session
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['id']; // Retrieve the user ID from the session

// Fetch the user data from the database
$sql = "SELECT * FROM user WHERE ID = ?";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_bind_param($stmt, "i", $user_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "User not found!";
    exit();
}

// If form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Update the user's profile data
    $name = $_POST['name'];
    $phone = $_POST['Phone'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];

    // Hash the password if it's being updated
    if (!empty($password)) {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $update_sql = "UPDATE user SET name = ?, Phone = ?, Email = ?, Password = ? WHERE ID = ?";
        $stmt = mysqli_prepare($link, $update_sql);
        mysqli_stmt_bind_param($stmt, "ssssi", $name, $phone, $email, $password, $user_id);
    } else {
        $update_sql = "UPDATE user SET name = ?, Phone = ?, Email = ? WHERE ID = ?";
        $stmt = mysqli_prepare($link, $update_sql);
        mysqli_stmt_bind_param($stmt, "sssi", $name, $phone, $email, $user_id);
    }

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['update_success'] = true; // Set session variable for success
        header("Location: A_profile.php");
        exit();
    } else {
        echo "Error updating profile: " . mysqli_error($link);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="path_to_bootstrap.css">
    <style>
     
        .success-message {
            margin-top: 10px;
            display: flex;
            align-items: center;
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            padding: 10px;
            border-radius: 5px;
            color: #155724;
        }
        .success-message img {
            width: 30px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <?php include 'Admin_Nav.php'; ?> 
    <div class="container mt-4">
        <br>
        <h2>Edit Profile</h2>
        
        <!-- Display success message if profile was updated -->
        <?php if (isset($_SESSION['update_success'])): ?>
            <div class="success-message">
                
                <span>Profile updated successfully!</span>
            </div>
            <?php unset($_SESSION['update_success']); // Unset the success flag ?>
        <?php endif; ?>

        <form method="POST" action="A_profile.php">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="Phone" class="form-label">Phone</label>
                <input type="text" class="form-control" id="Phone" name="Phone" value="<?php echo htmlspecialchars($user['Phone']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="Email" class="form-label">Email</label>
                <input type="email" class="form-control" id="Email" name="Email" value="<?php echo htmlspecialchars($user['Email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="Password" class="form-label">New Password (Leave blank if not changing)</label>
                <input type="password" class="form-control" id="Password" name="Password">
            </div>
            <button type="submit" class="btn btn-primary">Update Profile</button>
        </form>
    </div>
    
    <script src="path_to_bootstrap.js"></script>
    <br><?php include 'Admin_footer.php'; ?>
</body>
</html>
