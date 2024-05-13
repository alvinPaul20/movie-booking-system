<?php

include("../config.php")
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
<body style="background-color:#f3f4f8;">
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
                        <a href="#" class="nav-link align-middle px-0 " id="active">
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
                            <ul class="collapse nav flex-column ms-1" id="submenu3" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="theater_1.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Theater</span> 1</a>
                            </li>
                            <li>
                                <a href="theater_2.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Theater</span> 2</a>
                            </li>
                            <li>
                                <a href="theater_3.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Theater</span> 3</a>
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

       <div class="row d-flex flex-column justify-content-even content">
        <div class="page-title  mb-2 ">
        <h1 class="text-center w-75">Movie Booking System</h1>
        </div>
        <div class="header-admin  w-75 p-3">
            <h2>Dashboard</h2>
           
        </div>
        <hr style='border-top:2px dashed black;'>
        <div class="col-lg-10 w-75 mt-5 d-flex box-container flex-wrap justify-content-start align-self-center ">
            <div class="box-admin col-3">
                <div class="icon-space  bg-success">
                <i class="fa-solid fa-dollar-sign"></i>
                </div>
                <div class="box-details flex-fill ">
                <p class="text-title fw-bold">
                    Revenue
                </p>
                    <hr>
                    <?php
                         $sql = "SELECT SUM(price) AS total_amount FROM bookings";
                         $result = mysqli_query($link, $sql);
                         $data = mysqli_fetch_array($result);
                         if($data['total_amount'] == 0){
                            echo '<p class="fw-normal">data not avalable</p>';
                        } else {
                            echo '<p class="fw-bolder">' . $data['total_amount'] . '</p>';
                        }
                    ?>
                
            </div> 
            </div>
            <div class="box-admin col-3">
            <div class="icon-space  bg-info">
            <i class="fa-regular fa-rectangle-list"></i>
            </div>
            <div class="box-details flex-fill ">
                <p class="text-title fw-bold">
                    Daily Bookings
                </p>
                    <hr>
                    <?php 
                        $sql = "SELECT COUNT(*) FROM `bookings`";
                        $result = mysqli_query($link, $sql);
                        $data = mysqli_fetch_array($result);
                                                    
                        if($data[0] == 0){
                            echo '<p class="fw-normal">No bookings!</p>';
                        } else {
                            echo '<p class="fw-bolder">' . $data[0] . '</p>';
                        }
                ?>
            
            </div> 
            </div>
            <div class="box-admin col-3">
            <div class="icon-space bg-warning">
            <i class="fa-solid fa-users-between-lines"></i>
                </div>      
                <div class="box-details flex-fill">
                <p class="text-title fw-bold">
                    Total Users
                </p>
                    <hr>

                    <?php 
                        $sql = "SELECT COUNT(*) FROM `users` WHERE account_type ='user'";
                        $result = mysqli_query($link, $sql);
                        $data = mysqli_fetch_array($result);
                                                    
                        if($data[0] == 0){
                            echo '<p class="fw-normal">No bookings!</p>';
                        } else {
                            echo '<p class="fw-bolder">' . $data[0] . '</p>';
                        }
                ?>
            
            </div> 
            </div>
            <div class="box-admin col-3">
            <div class="icon-space bg-dark">
            <i class="fa-solid fa-ticket"></i>
                </div>
                <div class="box-details flex-fill">
                <p class="text-title fw-bold">
                    Upcoming Shows
                </p>
                    <hr>
                    <?php 
                        $sql = "SELECT COUNT(*) FROM `movie` WHERE theater_no = '0'";
                        $result = mysqli_query($link, $sql);
                        $data = mysqli_fetch_array($result);
                                                    
                        if($data[0] == 0){
                            echo '<p class="fw-normal">No bookings!</p>';
                        } else {
                            echo '<p class="fw-bolder">' . $data[0] . '</p>';
                        }
                ?>
            </div> 
            </div>
            <div class="box-admin col-3">
            <div class="icon-space bg-danger">
            <i class="fa-regular fa-eye"></i>
            </div>
            <div class="box-details flex-fill">
            <p class="text-title fw-bold">
                    Total Visits
                </p>
                    <hr>
                <p class="fw-bolder">23,2321</p>
            </div>      
            </div>
            <div class="box-admin col-3">
            <div class="icon-space bg-primary ">
            <i class="fa-solid fa-user-tie"></i>
                </div>
                <div class="box-details flex-fill">
                <p class="text-title fw-bold">
                    Total Admins
                </p>
                    <hr>
                    <?php 
                        $sql = "SELECT COUNT(*) FROM `users` WHERE account_type ='admin'";
                        $result = mysqli_query($link, $sql);
                        $data = mysqli_fetch_array($result);
                                                    
                        if($data[0] == 0){
                            echo '<p class="fw-normal">No bookings!</p>';
                        } else {
                            echo '<p class="fw-bolder">' . $data[0] . '</p>';
                        }
                ?>
                </div>
            </div>
         </div>

   
    </div>
</div>


<script src="../Bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../Script/admin.js"></script>
<script >
document.addEventListener('DOMContentLoaded', function() {
  var logoutButton = document.getElementById('logoutButton');
  logoutButton.addEventListener('click', function() {
      
      var confirmLogout = confirm('Are you sure you want to log out?');
      
      if (confirmLogout) {
        
          window.location.href = '../Controllers/logout.php';
      } else {
          
          return;
      }
  });
});

    
</script>
</body>
</html>

