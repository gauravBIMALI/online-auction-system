<?php
// Include the check_login file
require_once "check_login.php";
include 'Nav.php';

// Include config file
require_once "config.php";

// Fetch the field to be edited from the URL
$field = $_GET['field'];
$user_id = $_SESSION["id"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_value = trim($_POST['new_value']);

    if ($field == "password") {
        $new_value = password_hash($new_value, PASSWORD_DEFAULT);
    }

    $sql = "UPDATE user SET $field = ? WHERE ID = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "si", $new_value, $user_id);

        if (mysqli_stmt_execute($stmt)) {
            header("location: profile.php");
            exit;
        } else {
            echo "Something went wrong. Please try again later.";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
</head>

<body>
    <br>
    <br>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2>Edit <?php echo ucfirst($field); ?></h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?field=$field"; ?>" method="post">
                    <div class="form-group">
                        <label>New <?php echo ucfirst($field); ?></label>
                        <input type="<?php echo $field == 'password' ? 'password' : 'text'; ?>" name="new_value"
                            class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">
                    </div>
                    <a href="profile.php" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div><br>
    <br>
    <?php include 'footer.php';?>
</body>

</html>