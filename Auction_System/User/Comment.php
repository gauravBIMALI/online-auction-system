<?php
session_start();
require_once "config.php";


if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate input
    if (empty(trim($_POST["comment"]))) {
        echo "Please enter a comment.";
        exit;
    } else {
        $comment = trim($_POST["comment"]);
    }


    $item_id = $_POST["item_id"];
    $user_id = $_SESSION["id"];
    $sql = "INSERT INTO comments (item_id, user_id, comment) VALUES (?, ?, ?)";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "iis", $param_item_id, $param_user_id, $param_comment);
        $param_item_id = $item_id;
        $param_user_id = $user_id;
        $param_comment = $comment;

        if (mysqli_stmt_execute($stmt)) {

            header("location: item_details.php?id=" . $item_id);
            exit;
        } else {
            echo "Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);
}
// Close connection
mysqli_close($link);
?>