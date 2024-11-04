<?php
// Start session management

require_once "check_login.php";
include 'Nav.php';

if (isset($_SESSION['show_congrats']) && $_SESSION['show_congrats'] === true) {
    echo "<div class='welcome-message'>Congratulations on your successful auction bid!</div>";

    $_SESSION['show_congrats'] = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction System</title>
    <link rel="stylesheet" href="../Style.css">
    <link rel="stylesheet" href="Header_style.css">
    <style>
        /* Add the CSS styles here */
        .abc, .def {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
            font-family: Arial, sans-serif;
            width: 100%;
        }
        .abc h2, .def h2 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }
        .abc ul, .def ul {
            list-style-type: none;
            padding-left: 0;
        }
        .abc ul li, .def ul li {
            margin-bottom: 10px;
        }
        .abc ul ul, .def ul ul {
            margin-top: 10px;
            padding-left: 20px;
        }
        .abc ul ul li, .def ul ul li {
            margin-bottom: 5px;
        }
        .abc ul ul li:before, .def ul ul li:before {
            content: "\2022";
            color: #007bff;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }
        .abc li, .def li {
            font-size: 16px;
            line-height: 1.5;
        }
        .content-column {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            align-items: flex-start;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }
        .space {
            padding-left: 50px;
            padding-right: 50px;
        }
        /* Style for welcome message */
        .welcome-message {
            font-size: 20px;
            font-weight: bold;
            color: #007bff;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="main-content">
        <div class="image-section">
            <img src="../Project_photo/pqr.jpeg" alt="Auction Item" class="display-image">
        </div>

        <!-- Text Section -->
        <div class="text-section">
            <h1>Welcome to <b>Online Auction</b></h1>
            <hr><br>
            Discover a new way to experience buying and selling with our dynamic auction system. Whether you're looking
            to find unique items or want to sell your treasures to the highest bidder, our platform offers a seamless
            and exciting auction experience. Enjoy real-time bidding, transparent processes, and competitive pricing.
            Join us and be part of a vibrant community where every bid counts!
        </div>
    </div>
    <div class="space">
        <div class="abc">
            <h2>Bidding and Payment Obligations</h2>
            <ul>
                <li><strong>1 Placing a Bid:</strong> When you place a bid on an item, you are entering into a legally binding contract to purchase the item if you win the auction.</li>
                <li><strong>2 Winning an Auction:</strong> If you are the highest bidder at the end of the auction, you are obligated to complete the purchase of the item at the final bid price.</li>
                <li><strong>3 Payment Failure:</strong> Failure to pay for an item after winning an auction is a violation of agreement. You agree that <strong>Auction System</strong> reserves the right to take any necessary legal action, including legal proceedings or penalties.</li>
                <li><strong>4 Non-Payment Consequences:</strong> In the event of non-payment, <strong>Auction System</strong> reserves the right to:
                    <ul>
                        <li>Suspend or terminate your account.</li>
                        <li>Impose a penalty fee of <strong>5000$ or more</strong> to cover administrative costs.</li>
                        <li>Seek reimbursement for any losses incurred due to your non-compliance.</li>
                    </ul>
                </li>
            </ul>
        </div>
        <div class="def">
            <h2>Auction Rules</h2>
            <ul>
                <li><strong>1 Auction Duration:</strong> Each auction will run for a specified duration. Bids placed after the auction ends will not be considered.</li>
                <li><strong>2 Bid Retractions:</strong> Once a bid is placed, it cannot be retracted. Be sure of your decision before submitting a bid.</li>
                <li><strong>3 Reserve Price:</strong> Some items may have a reserve price. If the final bid does not meet the reserve price, the item will not be sold.</li>
            </ul>
        </div>
    </div> <br>
    <?php include 'footer.php'; ?>
</body>
</html>
