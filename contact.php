<?php
include('config.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Ticket System</title>
    <link rel="stylesheet" type="text/css" href="./CSS/home.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Fontawsome/css/all.css" >
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <link rel="icon" href="CSS/images/logo-top.svg" type="image/svg+xml">
</head>
<body style="background-color:black;" >
<header>
<nav class="navbar navbar-expand-lg  bg-dark fixed-top">
<div class="container">
    <a class="navbar-brand me-auto" href="index.php">
   
        <img src="CSS/images/logo.svg" alt="Logo">
    
    </a>
    
    <div class="offcanvas offcanvas-end bg-dark" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Logo</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link  mx-lg-3" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link  mx-lg-3" href="show.php">Showing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-lg-3" href="movies.php">Movies</a>
          </li>
          <li class="nav-item">
          <a class="nav-link mx-lg-3" href="coming.php">Coming Soon</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-lg-3 active-page" href="contact.php">Contact</a>
          </li>
         
         
        </ul>
      
      </div>
    </div>
      
    <?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === TRUE) {
    echo '
    <div class="dropdown">
        <i class="fa-regular fa-user p-2 fw-bold account me-2 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"></i>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Hi! '.$_SESSION['username'].'</a></li>
            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#userModal">History</a></li>
            <li><a class="dropdown-item" href="#">Settings</a></li>
        </ul>
    </div>
    <a class="login-button fs-6 fw-bold" id="logoutButton" href="#">Logout</a>';
} else {
    echo '<a class="login-button fs-6 fw-bold" href="login.php">Sign In</a>';
}
?>
<button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation ">
    <span class="navbar-toggler-icon"></span>
</button>
  </div>
</nav>
</header>

<div class="container-fluid upcoming">
    <div class="row d-flex mt-5 ">
      <h6 class="text-info text-center fs-5 mt-5">Contact Us</h6>
    <h1 class="text-center text-white">GET IN TOUCH</h1>
    <p class="text-center text-white">We’d love to talk about how we can work together. Send us a message below and we’ll respond as soon as possible.</p>
      <div class="col-6 p-5 ">
       
        <form action="" class="d-flex flex-column align-items-end">
         <div class="form-wrapper mb-3 w-75">
         <label for="">Name</label>
        <input class="form-control" type="text" id="">
         </div>

         <div class="form-wrapper mb-3 w-75">
         <label for="">Email</label>
        <input class="form-control" type="text" id="">
         </div>

         <div class="form-wrapper mb-3 w-75 ">
         <label for="">Subject</label>
        <input class="form-control" type="text" id="">
         </div>

         <div class="form-wrapper mb-3 w-75">
         <label for="exampleFormControlTextarea1" class="form-label">Message</label>
         <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    
         </div>

        <button class="btn btn-secondary w-75" >Submit</button>
        </form>
      </div>
      <div class="col-6 d-flex justify-content-start align-items-center flex-column mt-5">
      <div><img src="CSS/images/logo.svg" alt="Logo"></div>
      <div class="d-flex mt-5">
      <div class="box-contact text-center me-2"><i class="fa-solid fa-square-phone"></i><br> +123456789</div>
      <div class="box-contact text-center"><i class="fa-regular fa-envelope"></i><br>filmlane@gmail.com</div>
      </div>
      </div>
    </div>
</div>

<article class="d-flex justify-content-center align-items-center flex-wrap">
  <div class="article-title col-md-5 col-sm-6 ">
    <h5>Subscribe to Filmlane</h5>
    <h2>To get inclusive benifits</h2>
  </div>
  <div class="article-email col-md-5 col-sm-6">
      <div class="d-flex flex-row email-wrapper">
      <input type="text" class="w-75" placeholder="Enter your email">
      <button class="w-25">Get Started</button>
      </div>
  </div>
</article>
<footer>
    <div class="container-fluid">
      <div class="row d-flex flex-row ">
        <div class="col-lg-12 d-flex my-4 flex-wrap  align-items-center">
          <div class="flex-fill"><a href="index.php" ><img src="CSS/images/logo.svg" alt="Logo"></a></div>
       <div class="footer-item my-4 d-flex">
                <a class="footer-link top pe-4 "href="#">Home</a>
                <a class="footer-link top pe-4" href="#">Showing</a>         
                <a class="footer-link top pe-4" href="#">Movies</a>        
                <a class="footer-link top pe-4" href="#">Blog</a>
                <a class="footer-link top pe-4" href="#">Contact</a> 
       </div>
            
        </div>
        <hr>
        <div class="col-lg-12 d-flex align-items-center flex-wrap">
          <div class="footer-item  flex-fill d-flex my-4">
          <a class="footer-link pe-3 "  href="#">FAQ</a>
          <a class="footer-link pe-3 "  href="#">HELP CENTER</a>
          <a class="footer-link pe-3 "  href="#">TERMS OF USE</a>
          <a class="footer-link pe-3 "  href="#">PRIVACY</a>
          </div>
          <div class="footer-icons d-flex align-self-center d-flex flex-row flex-wrap">
          <a class="footer-icon pe-4 "href="#"><i class="fa-brands fa-facebook"></i></a>
          <a class="footer-icon pe-4 "href="#"><i class="fa-brands fa-instagram"></i></a>
          <a class="footer-icon pe-4 "href="#"><i class="fa-brands fa-pinterest-p"></i></a>
          <a class="footer-icon pe-4 "href="#"><i class="fa-brands fa-twitter"></i></a>
          </div>
        </div>
      </div>
    </div>
</footer>
<div class="bottom-footer d-flex  bg-dark p-3 flex-wrap align-items-center">
        <span class="text-white fw-light flex-fill d-flex text-wrap"><p class='text-wrap me-2'>@2024 Group 3 CC105. </p> All Rights Reserved</span>
        <img src="CSS/images/footer-bottom-img.png" alt="">
</div>
<script src="Bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="Script/script.js"></script>
<script src="Script/JsBarcode.all.min.js"></script>

</body>
</html>
