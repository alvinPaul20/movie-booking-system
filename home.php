<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Ticket System</title>
    <link rel="stylesheet" type="text/css" href="./CSS/home.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Fontawsome/css/all.css" >
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
</head>
<body style="background-color:black;" >
<header class="fixed-top">
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand me-auto" href="#">
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
            <a class="nav-link active-page mx-lg-3" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-lg-3" href="#">Movies</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-lg-3" href="#">Discounts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-lg-3" href="#">Blog</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-lg-3" href="#">Contact</a>
          </li>
         
         
        </ul>
      
      </div>
    </div>
    <a href="" class="login-button  fs-6 fw-bold">Sign In</a>
     <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation ">
      <span class="navbar-toggler-icon"></span>
    </button>
  </div>
</nav>
</header>

    
<main class=" container-fluid p-0">
<section class="container-fluid p-0">
<div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active " data-bs-interval="2000">
      <img src="CSS/images/banner4.jpg" class="d-block" alt="...">
    </div>
    <div class="carousel-item " data-bs-interval="2000">
      <img src="CSS/images/banner1.jpg " class="d-block" alt="...">
    </div>
    <div class="carousel-item " data-bs-interval="2000">
      <img src="CSS/images/banner3.jpg" class="d-block" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</section>    

<div class="container-fluid  d-flex flex-column justify-content-center container-shows">
<div class="header-shows pt-4">
    <div class="title-header-shows d-flex text-white  flex-wrap-reverse">
          <h2 class="flex-grow-1 fs-1 fw-bold text-capitalize text-wrap">Book your tickets now!</h2>
          <button class="shows-link-btn">Now Showing</button>
          <button class="shows-link-btn">Coming Soon</button>
          <button class="shows-link-btn last">Exclusive</button>
    </div>
    <div class="date-container">
        <p class="date fs-7 text-warning"></p>
    </div>
  </div>
        <div class="row justify-content-center ">
            <div class="col-xl-3 col-lg-4 col-sm-6 d-flex row-box justify-content-center" >
              <div class="image-wrapper d-flex flex-column justify-content-center w-100" >
                <a href="#">
                <img src="CSS/images/movie-1.png" class="img-fluid" alt="">
                <div class="card-body d-flex pt-4">
                <h5 class="movie-title text-wrap me-auto fw-bold ">Sonic the Hedgehog 2</h5><span class="date">2022</span>
                </div>
                <div class="sub-title d-flex mt-3">
                    <span class="box-1 me-auto border border-2 px-1 fw-bold">HD</span>
                    <span class="movie-hours me-2 text-white"><i class="fa-regular fa-clock"></i> 122 min</span>
                    <span class="ratings text-white"><i class="fa-solid fa-star"></i> 8.5</span>
                </div>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6 d-flex row-box  justify-content-center" >
              <div class="image-wrapper d-flex flex-column justify-content-center w-100 " >
                <a href="#">
                <img src="CSS/images/movie-3.png" class="img-fluid" alt="">
                <div class="card-body d-flex pt-4">
                <h5 class="movie-title text-wrap me-auto fw-bold ">The Adam Project</h5><span class="date">2022</span>
                </div>
                <div class="sub-title d-flex mt-3">
                    <span class="box-1 me-auto border border-2 px-1 fw-bold">HD</span>
                    <span class="movie-hours me-2 text-white"><i class="fa-regular fa-clock"></i> 122 min</span>
                    <span class="ratings text-white"><i class="fa-solid fa-star"></i> 8.5</span>
                </div>
                </a>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6 d-flex row-box  justify-content-center" >
              <div class="image-wrapper  d-flex flex-column justify-content-center w-100 " >
               <a href="#">
               <img src="CSS/images/movie-5.png" class="img-fluid" alt="">
                <div class="card-body d-flex pt-4">
                <h5 class="movie-title text-wrap me-auto fw-bold ">The Batman</h5><span class="date">2022</span>
                </div>
                <div class="sub-title d-flex mt-3">
                    <span class="box-1 me-auto border border-2 px-1 fw-bold">HD</span>
                    <span class="movie-hours me-2 text-white"><i class="fa-regular fa-clock"></i> 122 min</span>
                    <span class="ratings text-white"><i class="fa-solid fa-star"></i> 8.5</span>
                </div>
               </a>
              </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-sm-6 d-flex row-box  justify-content-center " >
              <div class="image-wrapper  d-flex flex-column justify-content-center w-100 ">
                  <a href="#">
                  <img src="CSS/images/movie-6.png" class="img-fluid" alt="">
                <div class="card-body d-flex pt-4">
                <h5 class="movie-title text-wrap me-auto fw-bold ">Uncharted</h5><span class="date">2022</span>
                </div>
                <div class="sub-title d-flex mt-3">
                    <span class="box-1 me-auto border border-2 px-1 fw-bold">HD</span>
                    <span class="movie-hours me-2 text-white"><i class="fa-regular fa-clock"></i> 122 min</span>
                    <span class="ratings text-white"><i class="fa-solid fa-star"></i> 8.5</span>
                </div>
                  </a>
              </div>
            </div>
        </div>
       </div>

</main>
<script src="Bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="Script/script.js"></script>
</body>
</html>