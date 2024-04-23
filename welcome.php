<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Ticket System</title>
    <link rel="stylesheet" type="text/css" href="./CSS/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Fontawsome/css/all.css" >
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
</head>
<body style="background-color: #001232;">
<nav class="navbar navbar-expand-lg fixed-top ">
  <div class="container">
    <a class="navbar-brand me-auto" href="#">
        <img src="CSS/images/logo.svg" alt="Logo">
    </a>
    
    <div class="offcanvas offcanvas-end bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Logo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active-page mx-lg-2" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-lg-2" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-lg-2" href="#">Services</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-lg-2" href="#">Portfolio</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-lg-2" href="#">Contact</a>
          </li>
         
         
        </ul>
      
      </div>
    </div>
    <a href="" class="login-button">Login</a>
     <button class="navbar-toggler pe-0 custom-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation ">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>

<section class="hero-section">
    <div class="container d-flex align-items-center justify-content-center fs-1 flex-column text-white">
        <h1>Discounted price on your first purchase!</h1>
        <h2>Book your tickets now!</h2>
        
    </div>
</section>


<div class="main-container d-flex">

        <div class="img-container">
            <img src="CSS/images/kong.jpg" alt="" class="login-image">
        </div>

        <div class="form-container p-4 d-flex flex-column">
            <div class="fs-4 fw-bold font-monospace text-white mb-3">
               <img src="CSS/images/logo.svg" alt="" >
            </div>
            <div class="fs-5 fw-normal font-monospace text-white my-3">
                Create your account
            </div>
            <div class="forms-email fs-6 fw-light my-3 text-white">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Email Address</label>
                         <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" required>
                    </div>
                      <div class="mb-3">
                         <label for="inputPassword5" class="form-label">Password</label>
                          <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" required>   
                     </div>
                
                <div class="reset-pass d-flex justify-content-between ">
                <div class="form-check ">
                          <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                                                </div>
                    <a href="reset.php"  class="text-decoration-none text-white d-flex justify-content-end mb-3">Forgot password?</a></div>
                <button type="submit" class="btn btn-danger  w-100">Submit</button>
            </div>
            </form>
            
            <div class="login">
                <a href="login.php" class="text-decoration-none text-white d-flex justify-content-center">Already have a account?</a>
            </div>
        </div>

    </div>

    
    <script src="Bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="Script/script.js"></script>
</body>
</html>