<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Auction System</title>
     <link rel="stylesheet" href="../Style.css">
    
     <style>
          .navbar-container {
               display: flex;
               align-items: center;
               justify-content: space-between;

          }

          .navbar-brand img {
               width: 60px;
               height: 60px;
          }

          .navbar-menu {
               display: flex;
               gap: 10px;
          }
     </style>
</head>

<body>
     <!-- Navigation Bar -->
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">
               <a class="navbar-brand" href="#">
                    <img src="../Project_photo/logo.png" alt="Logo"> <!-- Increased size of the logo -->

               </a>
               <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
               </button>
               <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                         <li class="nav-item">
                         <a class="nav-link" href="Home.php">Home</a>
                         </li>
                         <li class="nav-item">
                         <a class="nav-link" href="admin_approve.php">Review Items</a>
                         </li>

                         <li class="nav-item">
                         <a class="nav-link" href="manage_users.php">Manage Users</a>
                         </li>
                         <li class="nav-item">
                         <a class="nav-link" href="A_profile.php">Profile</a>
                         </li>

                    </ul>
                    <ul class="navbar-nav ms-auto">
                         <li class="nav-item">
                              <a class="nav-link" id="logout" href="A_logout.php">Logout</a>
                         </li>
                    </ul>

               </div>
          </div>
     </nav>

     <br><br><br>

     <!-- Highlight Current Page -->
     <script>
          document.addEventListener("DOMContentLoaded", function () {
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

     <!-- Bootstrap 5.3 JS -->
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>