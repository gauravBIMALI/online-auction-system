<?php
// Initialize the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register Page</title>
  <link href="../style.css" rel="stylesheet" />
 
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
      background-color: rgba(255, 255, 255, 0.8);
    }

    .form-control {
      border-radius: 10px;
      margin-bottom: 5px; /* Decreased from the default margin-bottom */
    }

    .btn {
      border-radius: 10px;
    }
  </style>
</head>

<body>
  <div class="container">
    <!-- Registration Form -->
    <section class="py-3 py-md-5 py-xl-8">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="mb-1 text-danger">
              <h2 class="display-5 fw-bold text-center">Sign up</h2>
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-12 col-lg-10 col-xl-8">
          <div class="row gy-5 justify-content-center">
            <div class="col-12 col-lg-5">

              <!-- Display success message if registration was successful -->
              <?php
              if (isset($_SESSION['registration_success']) && $_SESSION['registration_success'] == true) {
                  echo '<div class="alert alert-success text-center" role="alert">
                          Registration successful! You can now <a href="login.php" class="alert-link">log in</a>.
                        </div>';
                  // Unset the session variable after displaying the message
                  unset($_SESSION['registration_success']);
              }
              ?>

              <form action="register.php" method="post">
                <div class="row gy-3 overflow-hidden">
                <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="text" class="form-control border-0" name="name" id="name"
                        placeholder="Name" required />
                      <label for="phone" class="form-label">Name</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="number" class="form-control border-0" name="phone" id="phone"
                        placeholder="Phone Number" required />
                      <label for="phone" class="form-label">Phone Number</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="email" class="form-control border-0" name="email" id="email"
                        placeholder="Email" required />
                      <label for="email" class="form-label">Email</label>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-floating mb-3">
                      <input type="password" class="form-control border-0" name="password" id="password"
                        placeholder="Password" required />
                      <label for="password" class="form-label">Password</label>
                    </div>
                  </div>
                  <div class="col-12">
                  <div class="col-12">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="1" name="iAgree" id="iAgree" required />
        <label class="form-check-label text-secondary" for="iAgree">
            I agree to the
            <a href="License.html" class="link-primary text-decoration-none">Terms and Conditions</a>
        </label>
    </div>
</div>

                  </div>
                  <div class="col-12">
                    <div class="d-grid">
                      <button class="btn btn-lg btn-dark fs-6" type="submit">
                        Sign up
                      </button>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="mb-1 text-danger">
                      <p class="text-center m-0 text-white">Already have an account? <a href="login.php"
                          class="text-white">Sign in</a></p>
                    </div>
                  </div>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
  </div>
  </section>
  
</body>

</html>
