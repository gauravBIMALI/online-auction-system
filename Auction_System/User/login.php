<?php
// Initialize the session
session_start();

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Validate email
  if (empty(trim($_POST["email"]))) {
    $email_err = "Please enter your email.";
  } else {
    $email = trim($_POST["email"]);
  }

  // Validate password
  if (empty(trim($_POST["password"]))) {
    $password_err = "Please enter your password.";
  } else {
    $password = trim($_POST["password"]);
  }


  if (empty($email_err) && empty($password_err)) {
    
    $sql = "SELECT id, name, email, password FROM user WHERE email = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
     
      mysqli_stmt_bind_param($stmt, "s", $param_email);

      // Set parameters
      $param_email = $email;

     
      if (mysqli_stmt_execute($stmt)) {
        // Store result
        mysqli_stmt_store_result($stmt);

        
        if (mysqli_stmt_num_rows($stmt) == 1) {
          
          mysqli_stmt_bind_result($stmt, $id, $name, $email, $hashed_password);
          if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($password, $hashed_password)) {

              session_start();


              $_SESSION["loggedin"] = true;
              $_SESSION["id"] = $id;
              $_SESSION["email"] = $email;
              $_SESSION["name"] = $name;

              // Redirect user to home page
              header("location:Home.php");
              exit;
            } else {
             
              $_SESSION['login_error'] = true;
              header("location: login.php");
              exit;
            }
          }
        } else {
         
          $_SESSION['login_error'] = true;
          header("location: login.php");
          exit;
        }
      } else {
        echo "Oops! Something went wrong. Please try again later.";
      }

      
      mysqli_stmt_close($stmt);
    }
  }

  // Close connection
  mysqli_close($link);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>User-Login Page</title>
  <link href="../style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <style>
    body {
      font-family: sans-serif;
      font-size: large;
      font-weight: bold;
      background-image: url('../Project_photo/auction_login.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      margin: 0;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>
</head>

<body>
  <div class="container">
    <section class="py-3 py-md-5 py-xl-8">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="mb-5">
              <h2 class="display-5 fw-bold text-center text-white">Sign in</h2>
              <p class="text-center m-0 text-white">Don't have an account? <a href="reg.php" class="text-white">Sign
                  up</a></p>
            </div>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-12 col-lg-10 col-xl-8">
            <div class="row gy-5 justify-content-center">
              <div class="col-12 col-lg-5">

                <!-- Display error message if login is unsuccessful -->
                <?php
                // session_start();
                if (isset($_SESSION['login_error']) && $_SESSION['login_error'] == true) {
                  echo '<div class="alert alert-danger text-center" role="alert">
                            Invalid email or password. Please try again.
                          </div>';
                  // Unset the session variable after displaying the message
                  unset($_SESSION['login_error']);
                }
                ?>

                <form action="login.php" method="post">
                  <div class="row gy-3 overflow-hidden">
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input type="email" class="form-control border-0 border-bottom rounded-3" name="email"
                          id="email" placeholder="name@example.com" required>
                        <label for="email" class="form-label">Email</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-floating mb-3">
                        <input type="password" class="form-control border-0 border-bottom rounded-3" name="password"
                          id="password" value="" placeholder="Password" required>
                        <label for="password" class="form-label">Password</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="d-grid">
                        <button class="btn btn-primary btn-lg" type="submit">Log in</button>
                      </div>
                    </div>
                  </div>
                </form>
              </div>
<!--
              <div class="col-12 col-lg-2 d-flex align-items-center justify-content-center gap-3 flex-lg-column">
                <div class="bg-dark h-100 d-none d-lg-block" style="width: 1px; --bs-bg-opacity: .1;"></div>
                <div class="bg-dark w-100 d-lg-none" style="height: 1px; --bs-bg-opacity: .1;"></div>
                <div>or</div>
                <div class="bg-dark h-100 d-none d-lg-block" style="width: 1px; --bs-bg-opacity: .1;"></div>
                <div class="bg-dark w-100 d-lg-none" style="height: 1px; --bs-bg-opacity: .1;"></div>
              </div>
               
              <div class="col-12 col-lg-5 d-flex align-items-center">
                <div class="d-flex gap-3 flex-column w-100 ">
                  <a href="#!" class="btn btn-lg btn-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-google" viewBox="0 0 16 16">
                      <path
                        d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
                    </svg>
                    <span class="ms-2 fs-6">Sign in with Google</span>
                  </a>
                </div> -->

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script src="https://accounts.google.com/gsi/client" async defer></script>

</body>

</html>