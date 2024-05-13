<?php

include("../config.php")
?>
<?php
    // Default time
    
        $default_time = "8:30";

        // Get the selected time from the URL or use the default time if not set
        $selected_time = isset($_GET['time']) ? $_GET['time'] : $default_time;
    
        // Fetch seat details based on the selected time
        $sql = "SELECT seat_no FROM `seat_detail` WHERE show_time = '$selected_time' && theater_no = '3'";
        $result = mysqli_query($link, $sql);
      
        
        if ($result) {
            $seat_details = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $seat_no = str_replace(' ', '', $row['seat_no']);
                $seat_details[] = $seat_no;
            }
        } else {
            // Query failed, set seat_details to an empty array
            $seat_details = array(); 
        }
        
        // Fetch details from seat_detail table (this part is unchanged)
        $sql1 = "SELECT * FROM `seat_detail` WHERE theater_no = 3";
        $result1 = mysqli_query($link, $sql1);
        $details = mysqli_fetch_array($result1);
        error_reporting(0);


?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Ticket System</title>
    <link rel="stylesheet" type="text/css" href="../CSS/admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../Fontawsome/css/all.css" >
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="icon" href="../CSS/images/logo-top.svg" type="image/svg+xml">
</head>
<body class="bg-cinema">
<header>
<div class="container-fluid main">
    <div class="row nav-row flex-nowrap">
        <div class="col-auto wrapper col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex wrapper flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="admin.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto  text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline text-white fw-bolder">Admin Page</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="admin.php" class="nav-link align-middle px-0 ">
                        <i class="fa-solid fa-house"></i> <span class="ms-1 d-none d-sm-inline" >Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="fa-solid fa-film"></i> <span class="ms-1 d-none d-sm-inline">Movies</span> </a>
                        <ul class="collapse nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="theater.php" class="nav-link px-0"><i class="fa-solid fa-video"></i> <span class="d-none d-sm-inline">Theaters</span>  </a>
                            </li>
                            <li>
                                <a href="upcoming.php" class="nav-link px-0"><i class="fa-solid fa-ticket"></i> <span class="d-none d-sm-inline">Upcoming</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="categories.php" class="nav-link px-0 align-middle">
                        <i class="fa-solid fa-list"></i> <span class="ms-1 d-none d-sm-inline">Categories</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="users.php" class="nav-link align-middle px-0 " >
                        <i class="fa-solid fa-user-tie"></i></i> <span class="ms-1 d-none d-sm-inline" >Users</span>
                        </a>
                    </li>
                    <li>
                        <a href="#submenu3" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="fa-regular fa-clipboard"></i> <span class="ms-1 d-none d-sm-inline">Bookings</span> </a>
                            <ul class="collapse show nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="theater_1.php" class="nav-link px-0"  > <span class="d-none d-sm-inline">Theater</span> 1</a>
                            </li>
                            <li>
                                <a href="theater_2.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Theater</span> 2</a>
                            </li>
                            <li>
                                <a href="theater_3.php" class="nav-link px-0" id="active"> <span class="d-none d-sm-inline">Theater</span> 3</a>
                            </li>
                            <li>
                                <a href="theater_4.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Theater</span> 4</a>
                            </li>
                        </ul>
                    </li>
                    
                    
                </ul>
                <hr>
                <div class="dropdown pb-4">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-regular fa-user me-2"></i>
                        <span class="d-none d-sm-inline mx-1">Admin</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                        <li><a class="dropdown-item" href="#">New project...</a></li>
                        <li><a class="dropdown-item" href="#">Settings</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" id="logoutButton">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        
<!-- content here -->
<div class="row d-flex flex-column justify-content-even ">
                     <h1 class="text-white">Theater Time: <?php echo $selected_time ?></h1>
                <div class="col-10 p-5 d-flex justify-content-center align-items-center  ">
                    <button class=" btn btn-primary me-3"><a class="text-white text-decoration-none" href="theater_3.php?time=8:30">8:30</a></button>
                    <button class=" btn btn-primary me-3"><a class="text-white text-decoration-none" href="theater_3.php?time=12:30">12:30</a></button>
                    <button class=" btn btn-primary me-3"><a class="text-white text-decoration-none" href="theater_3.php?time=15:30">15:30</a></button>
                    <button class=" btn btn-primary me-3"><a class="text-white text-decoration-none" href="theater_3.php?time=19:30">19:30</a></button>
                </div>

                
           
            <div class="col-6 overflow-auto justify-content-center align-self-center d-flex flex-column" id="seatMap">

            </div>
</div>
    </div>
</div>


<script src="../Bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../Script/admin.js"></script>
<script>
    
    document.addEventListener('DOMContentLoaded', function() {
        const seatMap = document.getElementById('seatMap');
        const seatDetails = <?php echo json_encode($seat_details); ?>; // PHP data to JavaScript

        let numSeatsSelected = 0;
        let selectedSeats = [];

        // Function to generate seat map
        function generateSeatMap(rows, cols) {
            for (let i = 0; i < rows; i++) {
                const rowDiv = document.createElement('div');
                rowDiv.className = 'row justify-content-center'; // Bootstrap class to center the row
                for (let j = 0; j < cols; j++) {
                    const colDiv = document.createElement('div');
                    colDiv.className = 'col-2 text-center'; // Bootstrap class to center the column content
                    const seat = document.createElement('div');
                    const seatName = String.fromCharCode(65 + i) + (j + 1);
                    seat.className = `seat ${seatName}`; // Add seatName as a class
                    seat.textContent = seatName;

                    // Check if seat is occupied and add 'occupied' class
                    if (seatDetails.includes(seatName)) { // Check against seatDetails array
                        seat.classList.add('occupied');
                        seat.classList.add('disabled');
                    } else {
                        seat.addEventListener('click', () => {
                            if (!seat.classList.contains('occupied') && !seat.classList.contains('disabled')) {
                                if (seat.classList.contains('selected')) {
                                    seat.classList.remove('selected');
                                    numSeatsSelected--;
                                    const index = selectedSeats.indexOf(seatName);
                                    if (index !== -1) {
                                        selectedSeats.splice(index, 1);
                                    }
                                } else {
                                    seat.classList.add('selected');
                                    numSeatsSelected++;
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

        // Generate seat map with 10 rows and 6 columns
        generateSeatMap(10, 6);
    });
</script>
</body>
</html>

