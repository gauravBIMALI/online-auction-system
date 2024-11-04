<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>About Us</title>
     <link rel="stylesheet" href="../Style.css">
     <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/abouts/about-2/assets/css/about-2.css">
     <link rel="stylesheet" href="Header_style.css">
</head>

<body>
     <?php
      include 'Nav.php';
      require_once "check_login.php";
      ?>


     <section class="py-3 py-md-5">
          <div class="container">
               <div class="row gy-3 gy-md-4 gy-lg-0 align-items-lg-center">
                    <div class="col-12 col-lg-6">
                         <img class="img-fluid rounded" loading="lazy" src="../Project_photo/logo.png" alt="About 2">
                    </div>
                    <div class="col-12 col-lg-6">
    <div class="row justify-content-xl-center">
        <div class="col-12 col-xl-10">
            <h2 class="mb-3">Why Choose Our Auction System?</h2>
            <p class="lead fs-5 mb-3 mb-xl-5">With years of experience and deep industry knowledge, we have a proven track record of success and are constantly pushing ourselves to stay ahead of the curve.</p>
            <div class="d-flex align-items-center mb-3">
                <div class="me-3 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                </div>
                <div>
                    <p class="fs-6 m-0">Our auction system is user-friendly and efficient.</p>
                </div>
            </div>
            <div class="d-flex align-items-center mb-3">
                <div class="me-3 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                </div>
                <div>
                    <p class="fs-6 m-0">We ensure secure and transparent transactions.</p>
                </div>
            </div>
            <div class="d-flex align-items-center mb-4 mb-xl-5">
                <div class="me-3 text-primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg>
                </div>
                <div>
                    <p class="fs-6 m-0">Join us to find unique items and great deals.</p>
                </div>
            </div>
           
        </div>
    </div>
</div>

          </div>
     </section>
     <?php include 'footer.php';?>
</body>

</html>