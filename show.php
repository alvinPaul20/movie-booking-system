<?php
include('config.php')
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Ticket System</title>
    <link rel="stylesheet" type="text/css" href="./CSS/show.css?v=<?php echo time(); ?>">
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
            <a class="nav-link active-page mx-lg-3" href="show.php">Showing</a>
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
                                              <a href="show.php?barcodeid=<?= $data['id'] ?>" class="btn btn-primary">view</a>
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
<?php error_reporting(0);
$barcode = $_GET['barcodeid'];
$sql = "SELECT * FROM bookings WHERE id ='$barcode' ";
$result = mysqli_query($link,$sql);
$data = mysqli_fetch_array($result);

?>
<input type="hidden" id="barcodeData" value="<?= htmlspecialchars(json_encode($data)) ?>">

  

<div class="container-fluid show-time m-0">
<div class="mt-5">
    <h1 class="text-white text-center">Now Showing!</h1>
   </div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg  d-flex justify-content-center align-intems-center">
            <div class="show-box col-6 mt-5">
                 <table class="table table-striped-columns table-borderless table-dark ">
                    <thead >
                        <tr>
                            <th class="w-50 text-center"></th>
                            <th></th>
                            <th></th>
                            <th></th> 
                            <th></th>
                            
                        </tr>
                    </thead>
                    
                    <?php 
                        $sql = "SELECT *
                        FROM theater
                        INNER JOIN movie ON movie.id = theater.movie
                        ORDER BY theater.theater_no ASC
                        ";
                        $result = mysqli_query($link,$sql);
                        if(mysqli_num_rows($result) >0){
                            while ($data = mysqli_fetch_array($result)){
                              $time = ['8:30','12:30','15:30','19:30']
                ?>
                    <tr class="col-6 ">
                            <td class="fs-5 p-3 text-center text-warning"><span class="text-white fw-lighter fs-6">Theater <?=$data['theater_no']?> </span><br><?=$data['title']?></td>
                            <td class="p-4"> <a href="seat.php?movieid=<?= $data['id'] ?>&time=8:30" class="fa-stack fa-2x"><i class="fa-solid fa-ticket-simple fa-stack-1x" >
                                        
                            </i><span class="fa-stack-1x text-icon">8:30</span></a> </td>
                            <td class="p-4"><a href="seat.php?movieid=<?= $data['id'] ?>&time=12:30" class="fa-stack fa-2x"><i class="fa-solid fa-ticket-simple  fa-stack-1x" >

                            </i><span class="fa-stack-1x text-icon">12:30</span></a></td>
                            <td class="p-4"><a href="seat.php?movieid=<?= $data['id'] ?>&time=15:30"  class="fa-stack fa-2x"><i class="fa-solid fa-ticket-simple  fa-stack-1x" >

                            </i><span class="fa-stack-1x text-icon">15:30</span></a> </td>
                            <td class="p-4"> <a href="seat.php?movieid=<?= $data['id'] ?>&time=19:30" class="fa-stack fa-2x"><i class="fa-solid fa-ticket-simple  fa-stack-1x" >

                            </i> <span class="fa-stack-1x text-icon">19:30</span></a> </td>

                             
                    </tr>
                    <?php
                         }
                        }
                    ?>
                 </table>
                
            </div>
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
<script>
  
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