<?php
require_once "./config.php";
include('Controllers/safe-register.php')
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Ticket System</title>
    <link rel="stylesheet" type="text/css" href="./CSS/login.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Fontawsome/css/all.css" >
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <link rel="icon" href="CSS/images/logo-top.svg" type="image/svg+xml">
</head>
<body>
<svg version="1.1" xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100%" height="100%" viewBox="0 0 1600 900" preserveAspectRatio="xMidYMax slice">
    <defs>
        <linearGradient id="bg">
            <stop offset="0%" style="stop-color:rgba(74,21,169, 0.06)"></stop>
            <stop offset="50%" style="stop-color:rgba(61,39,184, 0.6)"></stop>
            <stop offset="100%" style="stop-color:rgba(22,74,203, 0.2)"></stop>
        </linearGradient>
        <path id="wave" fill="url(#bg)" d="M-363.852,502.589c0,0,236.988-41.997,505.475,0
s371.981,38.998,575.971,0s293.985-39.278,505.474,5.859s493.475,48.368,716.963-4.995v560.106H-363.852V502.589z" />
    </defs>
    <g>
        <use xlink:href='#wave' opacity=".3">
            <animateTransform
      attributeName="transform"
      attributeType="XML"
      type="translate"
      dur="10s"
      calcMode="spline"
      values="270 230; -334 180; 270 230"
      keyTimes="0; .5; 1"
      keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
      repeatCount="indefinite" />
        </use>
        <use xlink:href='#wave' opacity=".6">
            <animateTransform
      attributeName="transform"
      attributeType="XML"
      type="translate"
      dur="8s"
      calcMode="spline"
      values="-270 230;243 220;-270 230"
      keyTimes="0; .6; 1"
      keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
      repeatCount="indefinite" />
        </use>
        <use xlink:href='#wave' opacty=".9">
            <animateTransform
      attributeName="transform"
      attributeType="XML"
      type="translate"
      dur="6s"
      calcMode="spline"
      values="0 230;-140 200;0 230"
      keyTimes="0; .4; 1"
      keySplines="0.42, 0, 0.58, 1.0;0.42, 0, 0.58, 1.0"
      repeatCount="indefinite" />
        </use>
    </g>
</svg>


<div class="main-container d-flex">
        <div class="row d-flex w-100">
            <div class="col-lg-6 img-container">
                <img src="CSS/images/kong.jpg" alt="" class="login-image">
            </div>

            <div class="col-lg-6  form-container d-flex flex-column mt-2">
                <div class="fs-4 fw-bold font-monospace text-white mb-3">
                <a href="home.php"><img src="CSS/images/logo.svg" alt=""></a>
                </div>
                <div class="fs-5 fw-normal font-monospace text-white my-1">
                    Create your account
                </div>
                <div class="forms-email fs-6 fw-light my-1 text-white">
                    <form action="" method="post" role="form" >
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Username</label>
                            <input type="text" class="form-control"placeholder="Username" name="username" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email Address</label>
                            <input type="email" class="form-control" name="email" placeholder="name@example.com" required>
                        </div>
                        <div class="mb-3">
                            <label for="inputPassword5" class="form-label" name="password">Password</label>
                            <input type="password" id="inputPassword5" class="form-control" name="password" aria-describedby="passwordHelpBlock" required>
                            
                        </div>

                        <div class="reset-pass d-flex justify-content-between">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                            </div>
                            <a href="reset.php" class="text-decoration-none text-white d-flex justify-content-end mb-3">Forgot password?</a>
                        </div>
                        <button type="submit" class="btn btn-danger w-100" name="register">Submit</button>
                    </form>
                </div>

                <div class="login">
                    <a href="login.php" class="text-decoration-none text-white d-flex justify-content-center">Already have a account?</a>
                </div>
            </div>
        </div>
    </div>


    <script src="Bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>

