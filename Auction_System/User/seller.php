<?php
session_start();
require_once "config.php";
include 'Nav.php';

$seller_id = $_SESSION['id'];
$email = isset($_SESSION['email']) ? $_SESSION['email'] : ''; // Get email from session or set default
$name = $image = $initial_bid = $details = $start_date = $end_date = $category = "";
$name_err = $initial_bid_err = $email_err = $details_err = $start_date_err = $end_date_err = $category_err = "";
$submit_message = ""; // Variable to store the submit message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate item name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter the item name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate initial bid
    if (empty(trim($_POST["initial_bid"]))) {
        $initial_bid_err = "Please enter the initial bid.";
    } elseif (!is_numeric($_POST["initial_bid"])) {
        $initial_bid_err = "Please enter a valid bid amount.";
    } else {
        $initial_bid = trim($_POST["initial_bid"]);
    }

    // Validate details
    if (empty(trim($_POST["details"]))) {
        $details_err = "Please enter the item details.";
    } else {
        $details = trim($_POST["details"]);
    }

    // Validate start date
    if (empty($_POST["start_date"])) {
        $start_date_err = "Please enter the start date.";
    } else {
        $start_date = $_POST["start_date"];
    }

    // Validate end date
    if (empty($_POST["end_date"])) {
        $end_date_err = "Please enter the end date.";
    } elseif ($_POST["end_date"] < $_POST["start_date"]) {
        $end_date_err = "End date cannot be before start date.";
    } else {
        $end_date = $_POST["end_date"];
    }

    // Validate category
    if (empty($_POST["category"])) {
        $category_err = "Please select a category.";
    } else {
        $category = $_POST["category"];
    }

    // Handle image upload
    if (!empty($_FILES["image"]["name"])) {
        $target_dir = "../Upload/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = $target_file;
        } else {
            $submit_message = "Sorry, there was an error uploading your file.";
        }
    }

    if (empty($name_err) && empty($initial_bid_err) && empty($details_err) && empty($start_date_err) && empty($end_date_err) && empty($category_err)) {
        $sql = "INSERT INTO auction_items (seller_id, name, image, initial_bid, email, details, start_date, end_date, category) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "issdsssss", $param_seller_id, $param_name, $param_image, $param_initial_bid, $param_email, $param_details, $param_start_date, $param_end_date, $param_category);

            $param_seller_id = $seller_id;
            $param_name = $name;
            $param_image = $image;
            $param_initial_bid = $initial_bid;
            $param_email = $email;
            $param_details = $details;
            $param_start_date = $start_date;
            $param_end_date = $end_date;
            $param_category = $category;

            if (mysqli_stmt_execute($stmt)) {
                $submit_message = "Item submitted for approval.";
            } else {
                $submit_message = "Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }
    }

    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sell Item</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../Style.css">
    <style>
        .image-container img {
            height: 650px;
            width: 500px;
            border-radius: 20px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
            border: 5px solid greenyellow;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .image-container img:hover {
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.25);
            transform: translateY(-5px);
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Sell Item</h2>
        <form action="seller.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Item Name</label>
                        <input type="text" name="name" class="form-control" id="name" required value="<?php echo htmlspecialchars($name); ?>">
                        <span class="text-danger"><?php echo $name_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="initial_bid" class="form-label">Initial Bid</label>
                        <input  type="number" name="initial_bid" required class="form-control" id="initial_bid" value="<?php echo htmlspecialchars($initial_bid); ?>">
                        <span class="text-danger"><?php echo $initial_bid_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email"   class="form-control" id="email" value="<?php echo htmlspecialchars($email); ?>" readonly>
                        <span class="text-danger"><?php echo $email_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="details" class="form-label">Details</label>
                        <textarea name="details" required class="form-control" id="details"><?php echo htmlspecialchars($details); ?></textarea>
                        <span class="text-danger"><?php echo $details_err; ?></span>
                    </div>

                    
                </div>
                 <div class="col-md-6">
                    <div class="mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" name="start_date" required class="form-control" id="start_date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo htmlspecialchars($start_date); ?>">
                        <span class="text-danger"><?php echo $start_date_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" name="end_date" required class="form-control" id="end_date" min="<?php echo date('Y-m-d'); ?>" value="<?php echo htmlspecialchars($end_date); ?>">
                        <span class="text-danger"><?php echo $end_date_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select name="category" class="form-control" id="category">
                            <option value="">Select a category</option>
                            <option value="Electronics" <?php echo ($category == "Electronics") ? 'selected' : ''; ?>>Electronics</option>
                            <option value="Clothing" <?php echo ($category == "Clothing") ? 'selected' : ''; ?>>Clothing</option>
                            <option value="Kitchen Items" <?php echo ($category == "Kitchen Items") ? 'selected' : ''; ?>>Kitchen Items</option>
                            <option value="Furniture" <?php echo ($category == "Furniture") ? 'selected' : ''; ?>>Furniture</option>
                            <option value="Others" <?php echo ($category == "Others") ? 'selected' : ''; ?>>Others</option>
                        </select>
                        <span class="text-danger"><?php echo $category_err; ?></span>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="mb-3">
                        <span class="text-success"><?php echo $submit_message; ?></span>
                    </div>

                </div> 
            </div>
        </form>
    </div>
    <br>
    <?php include 'footer.php'; ?>
</body>

</html>
