<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction System</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../Style.css">
    <link rel="stylesheet" href="Header_style.css">
    <link rel="stylesheet" href="Header_style.css">
</head>

<body>


    <!-- Footer -->
    <footer class="footer">
        <div class="footer-container container">
            <div class="footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="Contact.php">Contact Us</a>
                <a href="#">About Us</a>
                <!-- <a class="nav-link"  href="About.php">About Us</a>
                <a class="nav-link" href="Contact.php">Contact Us</a> -->
            </div>
            <p>&copy; 2024 Auction System. All rights reserved.</p>
           <p>Gaurav Bimali and Anish Pokhrel</p>
        </div>
    </footer>

    <script>document.addEventListener("DOMContentLoaded", function() {
    const currentPage = window.location.pathname.split("/").pop();
    const navLinks = document.querySelectorAll(".nav-link");

    navLinks.forEach(link => {
        if (link.getAttribute("href") === currentPage) {
            link.classList.add("active");
        } else {
            link.classList.remove("active");
        }
    });
});
</script>
</body>

</html>
