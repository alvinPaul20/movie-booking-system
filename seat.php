<?php
include('config.php');

if(isset($_GET['movieid'])){
    $movieid = $_GET['movieid'];
    $sql = "SELECT * FROM `movie` WHERE id = '$movieid'";
    $result = mysqli_query($link, $sql);
    while($movie = mysqli_fetch_array($result)) {
        $_SESSION['movie_title'] = $movie['title'];
        $_SESSION['movie_id'] = $movie['id'];
        $_SESSION['theater_no'] = $movie['theater_no'];
    }
}

// Handle seat booking
if(isset($_POST['booking'])){
    // Retrieve form data
    $customer_id = $_SESSION['id'];
    $movie_id = $_SESSION['movie_id'];
    $tickets = $_POST['tickets'];
    $price = $_POST['price'];
    $time = $_POST['movie_time'];
    $date = $_POST['booking_date'];
    $theater_no = $_SESSION['theater_no'];
    $seats = explode(',', $_POST['seat_details']);

    mysqli_begin_transaction($link);

  
    $seatInsertSuccess = true;
    foreach ($seats as $seat) {
        $sql = "INSERT INTO seat_detail (customer_id, movie_id, seat_no, theater_no, show_time) VALUES ('$customer_id', '$movie_id', '$seat', '$theater_no', '$time')";
        if(!mysqli_query($link, $sql)) {
            $seatInsertSuccess = false;
            break; 
        }
    }

    
    if($seatInsertSuccess) {
        $sql = "INSERT INTO bookings (customer_id, movie_id, tickets, booking_date, price, show_time) 
                VALUES ('$customer_id', '$movie_id', '$tickets', '$date', '$price', '$time')";
        if(mysqli_query($link, $sql)) {
            mysqli_commit($link); 
            echo "<script>alert('You have booked your ticket!');</script>";
            echo "<script>window.location.href='index.php';</script>";
        } else {
            mysqli_rollback($link); 
            echo "<script>alert('Failed to buy!');</script>";
        }
    } else {
        mysqli_rollback($link);
        echo "<script>alert('Failed to reserve seats!');</script>";
    }

    
}


if (isset($_GET['time'])) {
    $time_selected = $_GET['time'];
    
    $sql = "SELECT seat_no FROM `seat_detail` WHERE show_time = '$time_selected' AND movie_id = '{$_SESSION['movie_id']}'";
    $result = mysqli_query($link, $sql);
    $seat_details = array();
    while ($row = mysqli_fetch_assoc($result)) {
        
        $seat_no = str_replace(' ', '', $row['seat_no']);
        $seat_details[] = $seat_no;     
    }
} else {
    $seat_details = array(); 
}

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
    <link rel="stylesheet" type="text/css" href="./CSS/seat.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="Fontawsome/css/all.css" >
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <link rel="icon" href="CSS/images/logo-top.svg" type="image/svg+xml">
</head>
<body style="background-color:black;" >
<header>
<nav class="navbar navbar-expand-lg bg-dark fixed-top">
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
            <a class="nav-link active-page mx-lg-3" aria-current="page" href="index.php">Home</a>
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
    <a class="login-button fs-6 fw-bold" id="logoutButton" href="">Logout</a>';
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
<div class="main-head text-white text-center">
<h2 >Cinema Seat Booking</h2>
<p>Select your seats:</p>
</div>
<div class="container-fluid d-flex justify-content-around my-5">
<div id="seatMap" class="col-6 " >
<div class="movie-screen mb-5">
            <img src='CSS/images/screen.png' alt='screen' />
        </div>
   
</div>
<div class="col-4 h-75 p-3  bg-dark rounded d-flex flex-column justify-content-center align-items-center" id="t-wrapper">
        <h4 class="text-white">You are booking for: <br> <?php echo isset($_SESSION['movie_title']) ? $_SESSION['movie_title'] : ''; ?></h4>
<form action="seat.php" class="w-75 mt-5" method="POST">
    <div class="d-flex">
        <span class="w-50">
        <label for="">Name: </label>
    <input type="text" class="form-control  mb-2"  name="name" value="<?php echo isset($_SESSION['username']) ? $_SESSION['username'] : ''; ?>" readonly>
        </span>

        <span class="flex-fill">
        <label for="">Change Movie</label>
        <?php
$sql = "SELECT * FROM `movie` WHERE theater_no > 0";
$result = mysqli_query($link, $sql);

if(mysqli_num_rows($result) > 0) {
    ?>
    <select name="movie_selected" id="movie_selected" class="form-select">
        <?php
        while($data = mysqli_fetch_array($result)) {
            $selected = ($_GET['movieid'] == $data['id']) ? 'selected="selected"' : '';
            echo '<option value="' . $data['title'] . '" data-movieid="' . $data['id'] . '" ' . $selected . '>' . $data['title'] . '</option>';
        }
        ?>  
    </select>
    <?php
}
?>
    </span>

    </div>

    <label for="">Seat Details</label>
    <input type="text"  class="form-control  mb-2" id="nameInput" name="seat_details" required>

    <label for="">Ticket number:</label>
    <input type="text"  class="form-control  mb-2"  id="numSeatsInput"  name="tickets" required>

    <label for="">Price</label>
    <input type="text"  id="totalCostInput" class="form-control  mb-2" name="price" required readonly>

   
    <div class="d-flex justify-content-between">
    <span class="flex-fill">
    <label for="">Time</label>
    <select name="movie_time" class="form-select mb-3" id="movie_time">
    <option value="8:30" <?php if($_GET['time']=="8:30") echo 'selected="selected"'; ?>>8:30</option>
    <option value="12:30" <?php if($_GET['time']=="12:30") echo 'selected="selected"'; ?>>12:30</option>
    <option value="15:30" <?php if($_GET['time']=="15:30") echo 'selected="selected"'; ?>>15:30</option>
    <option value="19:30" <?php if($_GET['time']=="19:30") echo 'selected="selected"'; ?>>19:30</option>
    </select>
    </span>
   <span>
   <label for="">Date</label>
    <input type="date"  class="form-control mb-3" name="booking_date" required>
   </span>
    </div>
    
    
    <input type="submit" class="btn btn-primary" name="booking" value="Book now!">
</form>
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
<script>
    
     document.addEventListener('DOMContentLoaded', function() {
    const time = document.getElementById('movie_time');

   
    time.addEventListener('change', function() {
        const selectedTime = time.value;
        const movieId = <?php echo $_GET['movieid']; ?>;
        window.location.href = `seat.php?movieid=${movieId}&time=${selectedTime}`;
    });
});    

document.addEventListener('DOMContentLoaded', function() {
    const movieSelect = document.getElementById('movie_selected');

 
    movieSelect.addEventListener('change', function() {
        const selectedMovie = movieSelect.value;
        const movieId = movieSelect.options[movieSelect.selectedIndex].getAttribute('data-movieid');
        const selectedTime = document.getElementById('movie_time').value;

        
        window.location.href = `seat.php?movieid=${movieId}&time=${selectedTime}&title=${selectedMovie}`;
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const seatMap = document.getElementById('seatMap');
    const nameInput = document.getElementById('nameInput');
    const numSeatsInput = document.getElementById('numSeatsInput');
    const totalCostInput = document.getElementById('totalCostInput');
    const occupiedSeats = <?php echo json_encode($seat_details); ?>; 
    
    let numSeatsSelected = 0;
    let totalCost = 0;
    let selectedSeats = [];

    
    function generateSeatMap(rows, cols) {
        for (let i = 0; i < rows; i++) {
            const rowDiv = document.createElement('div');
            rowDiv.className = 'row justify-content-center'; 
            for (let j = 0; j < cols; j++) {
                const colDiv = document.createElement('div');
                colDiv.className = 'col-2 text-center'; 
                const seat = document.createElement('div');
                const seatName = String.fromCharCode(65 + i) + (j + 1);
                seat.className = `seat ${seatName}`; 
                seat.textContent = seatName;
                
                if (occupiedSeats.includes(seatName)) {
                    seat.classList.add('occupied');
                    seat.classList.add('disabled');
                } else {
                    seat.addEventListener('click', () => {
                        if (!seat.classList.contains('occupied') && !seat.classList.contains('disabled')) {
                            if (seat.classList.contains('selected')) {
                                seat.classList.remove('selected');
                                numSeatsSelected--;
                                totalCost -= 350; 
                                const index = selectedSeats.indexOf(seatName);
                                if (index !== -1) {
                                    selectedSeats.splice(index, 1);
                                }
                            } else {
                                seat.classList.add('selected');
                                numSeatsSelected++;
                                totalCost += 350; 
                                selectedSeats.push(seatName);
                            }
                            updateInputs();
                        }
                    });
                }
                colDiv.appendChild(seat);
                rowDiv.appendChild(colDiv);
            }
            seatMap.appendChild(rowDiv);
        }
    }

  
    function updateInputs() {
        numSeatsInput.value = numSeatsSelected;
        totalCostInput.value = totalCost;
        nameInput.value = selectedSeats.join(', ');
    }

   
    generateSeatMap(10, 6);
});

</script>
<script src="Script/script.js"></script>
<script src="Bootstrap/js/bootstrap.bundle.min.js"></script>
   
</body>
</html>




