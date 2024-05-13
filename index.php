<?php
include('config.php')
?>

<?php
if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== TRUE) {
  header("Location: ./login.php");
  exit; 
}
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
            <a class="nav-link mx-lg-3" href="show.php">Showing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-lg-3" href="movies.php">Movies</a>
          </li>
          <li class="nav-item">
          <a class="nav-link mx-lg-3 " href="coming.php">Coming Soon</a>
          </li>
          <li class="nav-item">
            <a class="nav-link mx-lg-3" href="contact.php">Contact</a>
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

<!-- user modal history -->
<div class="modal fade" id="userModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog  d-flex justify-content-center">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">History Purchase</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <table class="table overflow-auto table-striped table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Movie</th>
              <th>Time</th>
              <th>Tickets</th>
              <th>Book Date</th>
              <th>Barcode</th>
            </tr>
          </thead>
       
          <?php
                              $user = $_SESSION['id'];
                              $sql = "SELECT b.*, m.title 
                                      FROM bookings b 
                                      INNER JOIN movie m ON b.movie_id = m.id
                                      WHERE b.customer_id = '$user'";
                              $result = mysqli_query($link, $sql);
                              
                              if (mysqli_num_rows($result) > 0) {
                                  while ($data = mysqli_fetch_array($result)) {
                                      ?>
                                      <tr>
                                          <td><?= $data['id'] ?></td>
                                          <td><?= $data['title'] ?></td>
                                          <td><?= $data['show_time'] ?></td>
                                          <td><?= $data['tickets'] ?></td>
                                          <td><?= $data['booking_date'] ?></td>
                                          <td>
                                              <a href="index.php?barcodeid=<?= $data['id'] ?>" class="btn btn-primary">view</a>
                                          </td>
                                      </tr>
                                      <?php
                                         }
                                     }
                                 
                                 ?>

          </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>      
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="modalBarcode" aria-hidden="true" aria-labelledby="ModalBarcode" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Barcode</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex justify-content-center">
        <!-- value of barcode = user_id, booking_id, movie_id -->
          
     
        <svg class="barcode" id="barcode"
          jsbarcode-format="upc"
          jsbarcode-textmargin="0"
          jsbarcode-fontoptions="bold">
        </svg>
       
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#userModal" data-bs-toggle="modal">Back to History</button>
      </div>
    </div>
  </div>
</div>

<main class=" container-fluid p-0">
<section class="container-fluid p-0">
<div id="carousel-id" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <?php
    $theater_no = [1, 2, 3, 4]; // Array containing theater numbers
    $firstTheaterWithMovies = false; // Flag to track if the first theater with movies is found
    
    foreach ($theater_no as $theater) {
        $active = ''; // Initialize active class
        
        // Check if this theater has movies scheduled
        $sql = "SELECT * FROM `movie` WHERE `theater_no` ='$theater'";
        $result = mysqli_query($link, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            // If this is the first theater with movies, mark it as active
            if (!$firstTheaterWithMovies) {
                $active = 'active';
                $firstTheaterWithMovies = true; // Set flag to true once the first theater with movies is found
            }
            
            while ($data = mysqli_fetch_array($result)) {
    ?>
    <div class="carousel-item <?= $active ?>" data-bs-interval="2000">
      <img src="Admin/uploads/<?= $data['image_banner'] ?>" class="d-block" alt="...">
      <div class="carousel-caption  d-none d-md-flex">
        <h1 class="mb-3"><?=$data['title']?></h1>
        <p class="text-wrap text-start w-50"><?=$data['description']?>.</p>
         <p><i class="fa-regular fa-clock"></i> <?=$data['duration']?> </p>
          <div class="d-flex align-items-center mt-3">
            
          <a href="show.php" class="btn  btn-outline-info me-3 fw-bold">Buy</a>
          <a href="movies.php?theaterid=<?=$data['theater_no'] ?>" class="btn btn-outline-info me-3 fw-bold">Info</a>
          <a href="index.php?trailer=<?=$data['id'] ?>" class="btn  btn-outline-danger me-3"><i class="fa-solid fa-play"></i></a>
           <a href="index.php?trailer=<?=$data['id'] ?>" class='text-decoration-none text-white fw-bold'>Watch Trailer</a>
          
          </div>
         
        
      </div>
    </div>
    <?php
            }
        }
    }
    ?>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carousel-id" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carousel-id" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

</section>


<!-- modal for carousel video trailer -->
<?php
                              if(isset($_GET['trailer'])){
                                $trailer = $_GET['trailer'];

                                $sql = "SELECT * FROM movie WHERE id ='$trailer'";
                                $result = mysqli_query($link, $sql);

                                $trailer_link = mysqli_fetch_array($result);
                                

                              }
                            ?>

<div class="modal fade align-content-center" id="movie-trailer" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog d-flex justify-content-center">
    <div class="modal-content modal-show">
      <div class="modal-body d-flex justify-content-center">
        <iframe id="show-id" width="750" height="400" src="Admin/uploads/<?=$trailer_link['trailer']?>" allowfullscreen></iframe>
      </div>
    </div>
  </div>
</div>

<?php error_reporting(0);
$barcode = $_GET['barcodeid'];
$sql = "SELECT * FROM bookings WHERE id ='$barcode' ";
$result = mysqli_query($link,$sql);
$data = mysqli_fetch_array($result);

?>
<input type="hidden" id="barcodeData" value="<?= htmlspecialchars(json_encode($data)) ?>">

  


<div class="container-fluid  d-flex flex-column justify-content-center container-shows">
<div class="header-shows pt-4">
    <div class="title-header-shows d-flex text-white  flex-wrap-reverse">
          <h2 class="flex-grow-1 fs-1 fw-bold text-capitalize text-wrap">Book your tickets now!</h2>
          <div class="d-flex flex-sm-nowrap">
          <button class="shows-link-btn">Now Showing</button>
          <button class="shows-link-btn">Coming Soon</button>
          <button class="shows-link-btn last">Exclusive</button>
          </div>
    </div>
    <div class="date-container">
        <p class="date fs-7 text-warning"></p>
    </div>
  </div>
        <div class="row justify-content-center ">
          <?php  
                $sql = "SELECT * FROM `movie` WHERE theater_no > '0'";
                $result = mysqli_query($link, $sql);
                if (mysqli_num_rows($result) > 0) {
                  while ($data = mysqli_fetch_array($result)) {

          ?>
            <div class="col-xl-3 col-lg-4 col-sm-6 d-flex row-box justify-content-center" >
              <div class="image-wrapper d-flex flex-column justify-content-center w-100" >
                <a href="movies.php?theaterid=<?=$data['theater_no'] ?>">
                <img src="Admin/uploads/<?= $data['image_poster'] ?>" class="img-fluid" alt="">
                <div class="card-body d-flex pt-4">
                <h5 class="movie-title text-wrap me-auto fw-bold "><?=$data['title']?></h5><span class="date">2024</span>
                </div>
                <div class="sub-title d-flex mt-3">
                    <span class="box-1 me-auto border border-2 px-1 fw-bold">HD</span>
                    <span class="movie-hours me-2 text-white"><i class="fa-regular fa-clock"></i><?=$data['duration']?></span>
                    <span class="ratings text-white"><i class="fa-solid fa-star"></i> 8.5</span>
                </div>
                </a>
              </div>
            </div>

            <?php }}?>
          
        </div>
       </div>

    <div class="container-fluid discount-section d-flex ">
      <div class="row p-4 d-flex justify-content-evenly">
      <div class="col-lg-5 col-md-6 div-box1 bg-white d-flex flex-column justify-content-center align-items-center">
              <img src="CSS/images/discount-img.png" alt="discount-image" class="img-fluid">
              <div class="pt-3">
              <h2 class="fw-light text-start fw-lighter">20% Off</h2>
              <h2 class="fw-bold">Buy your tickets now!</h2>
              </div>
          </div>

   <div class="col-lg-5 col-md-6 div-box2 d-flex text-start flex-column text-capitalize text-white ">
              <div class="details ">
                   <div class="d-flex mb-3">
                        <div id="line">--------</div>
                        <span class="ms-2">Monthly Discounts</span>
                   </div>
                   <h1 class="text-capitalize mb-4">Register yourself now for more discount prices!</h1>
                   <p class="fw-light fw-light ">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet facere neque eos iusto mollitia obcaecati ullam minus voluptatum! Accusantium, et! Alias impedit vel minima voluptatem veritatis aspernatur fugit, nesciunt praesentium!
                   </p>
              </div>
              <div class="sub-details mt-3">
                  <div class="d-flex">
                          <div class="icon-monitor rounded-circle">
                          <i class="fa-solid fa-tv"></i>
                          </div>
                     <div class="ms-4 fw-light">
                        <h4 class="fw-bold ">Refundable Tickets</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque sit numquam cumque.</p>
                      </div>
                                         
                  </div>
                  <hr>
                  <div class="d-flex mt-4">
                  <div class="icon-monitor rounded-circle">
                  <i class="fa-solid fa-ticket"></i>
                          </div>
                     <div class="ms-4 fw-light">
                        <h4 class="fw-bold ">Earn Coupons!</h4>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque sit numquam cumque.</p>
                      </div>
                                         

                  </div>
              </div>
        </div>

     
      </div>
    </div>

    <div class="container-fluid upcoming text-white d-flex flex-column justify-content-center">
        
        <h1 class="text-center ">Upcoming Shows!</h1>
        <h5 class="text-warning text-center mb-5">This 2024</h5>
        <div class="row justify-content-center ">
        <?php  
                $sql = "SELECT * FROM `movie` WHERE theater_no = '0' ORDER BY id LIMIT 8";
                $result = mysqli_query($link, $sql);
                if (mysqli_num_rows($result) > 0) {
                  while ($data = mysqli_fetch_array($result)) {

          ?>
            <div class="col-xl-3 col-lg-4 col-sm-6 d-flex row-box justify-content-center mb-4" >
              <div class="image-wrapper d-flex flex-column justify-content-center w-100" >
              <a href="coming.php?movieid=<?=$data['id']?>">
                <img src="Admin/uploads/<?= $data['image_poster'] ?>" class="img-fluid" alt="">
                <div class="card-body d-flex pt-4">
                <h5 class="movie-title text-wrap me-auto fw-bold "><?=$data['title']?></h5><span class="date">2024</span>
                </div>
                <div class="sub-title d-flex mt-3">
                    <span class="box-1 me-auto border border-2 px-1 fw-bold">HD</span>
                    <span class="movie-hours me-2 text-white"><i class="fa-regular fa-clock"></i><?=$data['duration']?></span>
                    <span class="ratings text-white"><i class="fa-solid fa-star"></i> 8.5</span>
                </div>
                </a>
              </div>
            </div>
            <?php }}?>
           
            </div>
        </div>
    </div>
</main>
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
<script> 
window.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const show = urlParams.get('trailer');

    if (show) {
        // If trailer parameter is present in the URL, open the modal
        openEditModal();
    }
    
});

function openEditModal() {
    var modal = document.getElementById('movie-trailer');
    var modalBootstrap = new bootstrap.Modal(modal);

    if (!modal.classList.contains('show')) {
        modalBootstrap.show();

        var carousel = document.getElementById('carousel-id');

        // Pause carousel when modal is displayed
        carousel.removeAttribute('data-bs-ride');

        // Stop video when modal is closed
        modal.addEventListener('hidden.bs.modal', function() {
            var video = document.getElementById('show-id');
            video.src = ''; // Stop the video
            carousel.setAttribute('data-bs-ride', 'carousel'); // Add back the attribute
            $(carousel).carousel(); // Start carousel after modal is closed
        });
    }
    else {
        var carousel = document.getElementById('carousel-id');

        // Pause carousel when modal is displayed
        carousel.removeAttribute('data-bs-ride');
    }
}

window.addEventListener('DOMContentLoaded', (event) => {
    const urlParams = new URLSearchParams(window.location.search);
    const editId = urlParams.get('barcodeid');
     
    if (editId) {
        const barcodeElement = document.getElementById('barcode');
        const barcodeDataInput = document.getElementById('barcodeData');
        const barcodeData = JSON.parse(barcodeDataInput.value);

        if (barcodeData) {
            JsBarcode(barcodeElement, barcodeData.customer_id + barcodeData.id + barcodeData.movie_id + barcodeData.price);
        }
        
        openBarcodeModal(); // Call the modal opening function once
    }
});

function openBarcodeModal() {
    var modal = document.getElementById('modalBarcode');
    var modalBootstrap = new bootstrap.Modal(modal);
   
    modalBootstrap.show();
}


</script>

</body>
</html>
