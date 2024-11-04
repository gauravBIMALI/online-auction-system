<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $phone = $email = $password = $role = $iAgree = "";
$name_err = $phone_err = $email_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate phone number
    if (empty(trim($_POST["phone"]))) {
        $phone_err = "Please enter your phone number.";
    } else {
        $phone = trim($_POST["phone"]);
    }

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 3) {
        $password_err = "Password must have at least 3 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate terms and conditions
    if (!isset($_POST["iAgree"])) {
        $iAgree_err = "You must agree to the terms and conditions.";
    } else {
        $iAgree = 1;
    }

    // Set default role
    $role = 'user';

    // Check input errors before inserting in database
    if (empty($name_err) && empty($phone_err) && empty($email_err) && empty($password_err) && empty($iAgree_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO user (name, Phone, Email, Password, role, agreed_to_terms) VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssi", $param_name, $param_phone, $param_email, $param_password, $param_role, $param_iAgree);

            // Set parameters
            $param_name = $name;
            $param_phone = $phone;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_role = $role;
            $param_iAgree = $iAgree;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Set session variable to display success message
                $_SESSION['registration_success'] = true;

                // Redirect to reg.php
                header("location: reg.php");
                exit;
            } else {
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>
