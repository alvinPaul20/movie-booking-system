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
<body class='showing-bg'>
    
<div class="container-fluid main">
    <div class="row nav-row flex-nowrap">
        <div class="col-auto wrapper col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <div class="d-flex wrapper flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
                <a href="admin.php" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto  text-decoration-none">
                    <span class="fs-5 d-none d-sm-inline text-white fw-bolder">Admin Page</span>
                </a>
                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li class="nav-item">
                        <a href="admin.php" class="nav-link align-middle px-0 " >
                        <i class="fa-solid fa-house"></i> <span class="ms-1 d-none d-sm-inline" >Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="fa-solid fa-film"></i> <span class="ms-1 d-none d-sm-inline">Movies</span> </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="#" id="active" class="nav-link px-0"><i class="fa-solid fa-video"></i> <span class="d-none d-sm-inline">Theaters</span>  </a>
                            </li>
                            <li>
                                <a href="upcoming.php" class="nav-link px-0"><i class="fa-solid fa-ticket"></i> <span class="d-none d-sm-inline">Upcoming</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="categories.php" class="nav-link px-0 align-middle" >
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
                        <li><a class="dropdown-item" href="../Controllers/logout.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>


    <div class="row content-row d-flex flex-column justify-content-center align-items-start ms-5 ">
    <div >
    <h1 class="text-white">Now Showing!</h1>
    </div>
    <hr>
    <div class="col-9">
        <div id="carouselExampleCaptions" class="carousel slide">
            <div class="carousel-indicators">
                <?php
                // Modify indicators based on available data
                $theaters = [1, 2, 3, 4];
                foreach ($theaters as $key => $theater) {
                    echo '<button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="' . $key . '"';
                    if ($key == 0) {
                        echo ' class="active"';
                    }
                    echo ' aria-label="Slide ' . ($key + 1) . '"></button>';
                }
                ?>
            </div>
            <div class="carousel-inner">
                <?php
                foreach ($theaters as $key => $theater) {
                    $sql = "SELECT * FROM `movie` WHERE `theater_no` = $theater";
                    $result = mysqli_query($link, $sql);
                    $data = mysqli_fetch_array($result);
                    ?>
                    <div class="carousel-item <?php if ($key == 0) echo 'active'; ?>">
                        <?php
                        if (!$data || empty($data['image_banner'])) {
                            echo '<img src="../CSS/images/error-shows.jpg" class="d-block w-100" alt="No Image">';
                            echo '<div class="carousel-caption d-flex flex-column justify-content-start">';
                            echo '<h1 class="mb-5">No shows on this theater</h1>';
                            echo '<div class="my-5">Click this button to replace this empty theater <br><button class="btn btn-primary "><a href="theater.php?replaceid=' . $theater . '" class="text-decoration-none text-white">Replace</a></button></div>';
                        } else {
                            echo '<img src="uploads/' . $data['image_banner'] . '" class="d-block w-100" alt="...">';
                            echo '<div class="carousel-caption d-flex flex-column justify-content-start align-items-start">';
                            echo '<div class="mb-3"><button class="btn btn-outline-primary"><a href="theater.php?replaceid=' . $theater . '" class="text-decoration-none text-white">Replace</a></button> <button class="btn btn-outline-danger"><a href="theater.php?deleteid=' . $theater . '" class="text-decoration-none text-white">Remove</a></button></div>';
                            echo '<h1 class="mb-5">Theater ' . ($theater) . ' Movie</h1>';
                            echo '<span>Title:</span>';
                            echo '<h3 class="mb-4">' . $data['title'] . '</h3>';
                            echo '<p class="text-start mb-4">' . $data['description'] . '</p>';
                            echo '<p class="text-start ">Duration: ' . $data['duration'] . '<br> Release Date: ' . $data['release_date'] . '</p>';
                        }
                        ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

    </div>
</div>
<div class="modal fade" id="replace-show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
     <div class="modal-content  main-wrapper p-5 theater-modal  overflow-hidden">
        
        <div class="modal-header d-flex justify-content-between">
            
        <h2 class="">Replace Movie Theater <?php echo $_GET['replaceid'] ?> </h2>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> 
                </div>
        <div class="col-lg-8 table-wrapper col-sm-4 w-100 overflow-auto mt-4">
                 <table class="table overflow-auto table-striped table-bordered movieTable">
                       <thead>
                       <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Relaease Date</th>
                            <th>Poster</th>
                            <th>Action</th>
                        </tr>
                       </thead>
                       
                        <?php
                                $sql = "SELECT movie.*, category.category_name
                                FROM movie
                                inner join category on category.id = movie.category_id
                                WHERE theater_no = 0";
                                $result = mysqli_query($link,$sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($data = mysqli_fetch_array($result)){
                                        
                                        ?>
                            <tr>
                                <td><?=$data['id']?></td>
                                <td><?=$data['title']?></td>
                                <td><?=$data['category_name']?></td>
                                <td><?=$data['release_date']?></td>                              
                                <td><img src="uploads/<?=$data['image_poster']?>" height="50" width="50" alt=""></td>
                                <td> 
                                <a href="theater.php?title=<?=$data['title']?>&replacemovie=<?=$_GET['replaceid']?>" class="btn btn-outline-dark">Select</a>
                                    
                                </td>
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
    
    <!-- modal confirmation for replacing theater movie -->
    <form action="" method="post">
<div class="modal fade" id="confirm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
    
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
                <h5>Are you sure you want to replace this theater to: </h5>
                <h4> <br><?php echo $_GET['title'] ?></h4>
              
      </div>
      <div class="modal-footer">
       
        <input class="btn btn-info" type="submit"  name="replace" value="Yes" data-bs-dismiss="modal">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>
</form>

    <script>
window.addEventListener('DOMContentLoaded', (event) => {
    const urlParams = new URLSearchParams(window.location.search);
    const editId = urlParams.get('replaceid');
    
    if (editId) {
        // If editid parameter is present in the URL, open the modal
        openRepalceShow();
    }
});

function openRepalceShow() {
    var modal = document.getElementById('replace-show');
    var modalBootstrap = new bootstrap.Modal(modal);
    modalBootstrap.show();
}

window.addEventListener('DOMContentLoaded', (event) => {
    const urlParams = new URLSearchParams(window.location.search);
    const movie_title = urlParams.get('title');
    
    if (movie_title) { 
        Confirm();
    }
});

function Confirm() {
    var confirm = document.getElementById('confirm');
    var modalBootstrap = new bootstrap.Modal(confirm);
    modalBootstrap.show();
}
</script>
    <script src="../Bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../Script/admin.js"></script>
 </body>
</html>

<?php
    if(isset($_POST['replace'])) {
        $theater_no = $_GET['replacemovie'];
        $movie = $_GET['title'];
        
        $sql = "UPDATE `movie` SET theater_no = '0' WHERE theater_no = '$theater_no'";
        $update = mysqli_query($link, $sql);

        if ($update) {
            $replace = "UPDATE `movie` SET theater_no = '$theater_no' WHERE title = '$movie'";
            $replace_data = mysqli_query($link, $replace);
            
            if ($replace_data) {
               echo "<script>alert('Replaced Successfully')</script>";
                echo"<script>window.location.href='theater.php'</script>";
            } else {
                // Second query failed
                echo "<script>alert('Operation Failed')</script>";
            }
        } else {
            // First query failed
            echo "<script>alert('Operation Failed')</script>";
        }
    }


    if(isset($_GET['deleteid'])){
        $theater_no = $_GET['deleteid'];
        $sql = "UPDATE `movie` SET theater_no = '0' WHERE theater_no = '$theater_no'";

        if(mysqli_query($link,$sql)){
            echo "<script>alert('Remove Successfully')</script>";
            echo"<script>window.location.href='theater.php'</script>";
        }else {
            
            echo "<script>alert('Operation Failed')</script>";
        }
    }
?>
