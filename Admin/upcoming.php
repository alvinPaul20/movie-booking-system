<?php

include("../config.php")
?>

<?php error_reporting(0);
if(isset($_GET['editid'])){
   
   $editid = $_GET['editid'];
   $sql = "SELECT movie.*, category.category_name FROM movie INNER JOIN category ON category.id = movie.category_id WHERE movie.id = '$editid'";
   $result = mysqli_query($link,$sql);
   $edit_data = mysqli_fetch_array($result);
   
   
}
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
<body >
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
                        <a href="admin.php" class="nav-link align-middle px-0">
                        <i class="fa-solid fa-house"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#submenu1" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                        <i class="fa-solid fa-film"></i> <span class="ms-1 d-none d-sm-inline">Movies</span> </a>
                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">
                            <li class="w-100">
                                <a href="theater.php" class="nav-link px-0"><i class="fa-solid fa-video"></i> <span class="d-none d-sm-inline">Theaters</span>  </a>
                            </li>
                            <li  id="active">
                                <a href="#" class="nav-link px-0"><i class="fa-solid fa-ticket"></i> <span class="d-none d-sm-inline">Upcoming</span></a>
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
                        <li><a class="dropdown-item" href="../Controllers/logout.php">Sign out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        



 <!-- movies table here -->
 
 <div class="row  d-flex flex-column justify-content-even content">
 
 <div class="page-title mb-2 p-3">
        <h1> Manage Upcoming Movies</h1>
        </div>
 <!-- modal for adding movies -->
        <div>
            <button class="btn btn-primary add-shows-btn mt-2" data-bs-toggle="modal" data-bs-target="#add-shows">Add Movies</button>
        </div>
<div class="modal fade" id="add-shows" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
     <div class="modal-content  main-wrapper p-5 upcoming-modal  overflow-hidden">
        <h2 class="mb-4">Add Upcoming Movies</h2>
        <hr>
            <form action="upcoming.php" method="post" enctype="multipart/form-data" class="d-flex flex-wrap justify-content-between ">
                <div class="form-inputs mb-4 col-lg-3 ">
                    <select name="category_id" id="" class="form-select category_id">
                        <option value="">Select category</option>
                        <?php
                            $sql = "SELECT * FROM  `category` ";
                            $result = mysqli_query($link,$sql);
                            if(mysqli_num_rows($result) > 0 ){
                                while($data = mysqli_fetch_array($result)){
                                    ?><option value="<?=$data['id']?>"><?=$data['category_name']?></option><?php                      
                                }
                            }else{
                                ?> 
                            <option value=""> No category found</option> 
                            <?php
                            }
                            
                        ?>
                    </select>

            </div>
            <div class="form-inputs mb-3 col-lg-3  ">
            <input class="form-control" type="text" placeholder="Enter Title" name="title">
            </div>
            <div class="form-inputs mb-3 col-lg-5">
            <input class="form-control " type="text" placeholder="Enter description" name="description">
            </div>
            <div class="form-inputs mb-3 col-lg-3">
            <input class="form-control" type="text" placeholder="Enter duration" name="duration">
            </div>
            <div class="form-inputs mb-3 col-lg-3">
            <input class="form-control" type="text" placeholder="Enter the director name" name="director">
            </div>
            <div class="form-inputs mb-3 col-lg-5">
            <input class="form-control" type="date" placeholder="Enter the release date" name="release_date">
            </div>
            <div class="form-inputs mb-3 col-lg-3">
            <label for="">Insert image poster:</label>
            <input class="form-control" type="file" name="image_poster">
            </div>
            <div class="form-inputs mb-3 col-lg-3">
            <label for="">Insert image banner:</label>
            <input class="form-control" type="file" name="image_banner">
            </div>
            <div class="form-inputs mb-3 col-lg-5">
                <label for="">Insert trailer video:</label>
            <input class="form-control" type="file" name="trailer">
            </div>
            <div class="form-inputs mb-3 col-lg-2">
            <input class="btn btn-primary" type="submit"  name="add" value="Add">
            </div>
       </form>
      

                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        
                </div>
            </div>
        </div>
    </div>        
        <div class="col-lg-6 table-wrapper col-sm-4 w-75 overflow-auto mt-4">
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
                               
                                <a href="upcoming.php?editid=<?=$data['id'] ?>" class="btn btn-primary">Edit</a>
                                <a href="upcoming.php?deleteid=<?= $data['id'] ?>" class="btn btn-danger">Delete</a>
                                    
                                </td>
                            </tr>
                            <?php
                                    }
                                }
                            ?>
                    </table>
                 </div>
          
                
                <!-- modal for editing upcoming shows -->
                
<div class="modal fade" id="edit-shows" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
     <div class="modal-content  main-wrapper p-5 upcoming-modal  overflow-hidden">
        <h2 class="mb-4">Edit Upcoming Movies</h2>
        <hr>
            <form action="upcoming.php" method="post" enctype="multipart/form-data" class="d-flex flex-wrap justify-content-between ">
                <div class="form-inputs mb-4 col-lg-3 ">
                    <select name="category_id" id="" class="form-select category_id">
                    <option selected value="<?php echo $edit_data['category_name']?>"><?php echo $edit_data['category_name']?></option>

                    
                    <?php
                            $sql = "SELECT * FROM  `category` ";
                            $result = mysqli_query($link,$sql);
                            if(mysqli_num_rows($result) > 0 ){
                                while($data = mysqli_fetch_array($result)){
                                    ?><option value="<?=$data['id']?>"><?=$data['category_name']?></option><?php                      
                                }
                            }else{
                                ?> 
                            <option value=""> No category found</option> 
                            <?php
                            }
                            
                        ?>
                        
                    </select>

            </div>

                            <div >
                                <input type="hidden" class="form-control" name="id" value="<?=$edit_data['id']?>" >
                            </div>
            <div class="form-inputs mb-3 col-lg-3  ">
            <input class="form-control" type="text" placeholder="Enter Title" name="title" value="<?=$edit_data['title']?>"> 
            </div>
            <div class="form-inputs mb-3 col-lg-5">
            <input class="form-control " type="text" placeholder="Enter description" name="description" value="<?=$edit_data['description']?>">
            </div>
            <div class="form-inputs mb-3 col-lg-3">
            <input class="form-control" type="text" placeholder="Enter duration" name="duration" value="<?=$edit_data['duration']?>">
            </div>
            <div class="form-inputs mb-3 col-lg-3">
            <input class="form-control" type="text" placeholder="Enter the director name" name="director" value="<?=$edit_data['title']?>">
            </div>
            <div class="form-inputs mb-3 col-lg-5">
            <input class="form-control" type="date" placeholder="Enter the release date" name="release_date"  value="<?=$edit_data['release_date']?>">
            </div>
            <div class="form-inputs mb-3 col-lg-3">
            <label for="">Insert image poster:</label>
            <input class="form-control" type="file" name="image_poster"  value="<?=$edit_data['image_poster']?>">
            </div>
            <div class="form-inputs mb-3 col-lg-3">
            <label for="">Insert image banner:</label>
            <input class="form-control" type="file" name="image_banner"  value="<?=$edit_data['image_banner']?>">
            </div>
            <div class="form-inputs mb-3 col-lg-5">
                <label for="">Insert trailer video:</label>
            <input class="form-control" type="file" name="trailer"  value="<?=$edit_data['trailer']?>">
            </div>
            <div class="form-inputs mb-3 col-lg-2">
            <input class="btn btn-primary" type="submit"  name="edit" value="Edit">
            </div>
       </form>
      

                <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        
                </div>
            </div>
        </div>
    </div>  
                          
         </div>
    </div>
</div>


<script src="../Bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="../Script/admin.js"></script>
<script>
window.addEventListener('DOMContentLoaded', (event) => {
    const urlParams = new URLSearchParams(window.location.search);
    const editId = urlParams.get('editid');
    
    if (editId) {
        // If editid parameter is present in the URL, open the modal
        openEditModal();
    }
});

function openEditModal() {
    var modal = document.getElementById('edit-shows');
    var modalBootstrap = new bootstrap.Modal(modal);
    modalBootstrap.show();
}
</script>
          

</body>
</html>
<?php
// Initialize the session if needed
// session_start();

if(isset($_POST['add'])){
    // Sanitize and validate input data
    $category_id  = $_POST['category_id'];
    $title        = $_POST['title'];
    $description  = $_POST['description'];
    $duration     = $_POST['duration'];
    $director     = $_POST['director'];
    $release_date = $_POST['release_date'];

    // File upload handling
    $trailer          = $_FILES['trailer']['name'];
    $tmp_trailer      = $_FILES['trailer']['tmp_name'];

    $image_poster     = $_FILES['image_poster']['name'];
    $tmp_image_poster = $_FILES['image_poster']['tmp_name'];

    $image_banner     = $_FILES['image_banner']['name'];
    $tmp_image_banner = $_FILES['image_banner']['tmp_name'];

    // Move uploaded files to the desired directory
    move_uploaded_file($tmp_trailer, "uploads/$trailer");
    move_uploaded_file($tmp_image_poster, "uploads/$image_poster");
    move_uploaded_file($tmp_image_banner, "uploads/$image_banner");

    // SQL query with prepared statement
    $sql = "INSERT INTO `movie`(`title`, `description`, `image_poster`, `release_date`, `director`, `trailer`, `image_banner`, `duration`, `category_id`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    // Prepare the SQL statement
    $stmt = mysqli_prepare($link, $sql);
    if ($stmt) {
        // Bind parameters to the prepared statement
        mysqli_stmt_bind_param($stmt, "ssssssssi", $title, $description, $image_poster, $release_date, $director, $trailer, $image_banner, $duration, $category_id);

        // Execute the statement
        if(mysqli_stmt_execute($stmt)){
            echo "<script>alert('Movie added to Upcoming Shows!');</script>";
            echo "<script> window.location.href='upcoming.php'; </script>";
        } else {
            echo "<script>alert('Failed to add movie: " . mysqli_error($link) . "');</script>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle SQL error
        echo "<script>alert('Failed to prepare SQL statement: " . mysqli_error($link) . "');</script>";
    }
}
if(isset($_POST['edit'])){
    $id           = $_POST['id'];
    $category_id  = $_POST['category_id'];
    $title        = mysqli_real_escape_string($link, $_POST['title']);
    $description  = mysqli_real_escape_string($link, $_POST['description']);
    $duration     = $_POST['duration'];
    $director     = $_POST['director'];
    $release_date = $_POST['release_date'];
    
    // Initialize SQL query
    $sql = "UPDATE `movie` SET `title`='$title', `description`='$description', `duration`='$duration', `director`='$director', `release_date`='$release_date', `category_id`='$category_id'";
    
    // Check if trailer file is uploaded
    if (!empty($_FILES['trailer']['name'])) {
        $trailer         = $_FILES['trailer']['name'];
        $tmp_trailer     = $_FILES['trailer']['tmp_name'];
        move_uploaded_file($tmp_trailer, "uploads/$trailer");
        $sql .= ", `trailer`='$trailer'";
    }
    
    // Check if image poster file is uploaded
    if (!empty($_FILES['image_poster']['name'])) {
        $image_poster         = $_FILES['image_poster']['name'];
        $tmp_image_poster     = $_FILES['image_poster']['tmp_name'];
        move_uploaded_file($tmp_image_poster, "uploads/$image_poster");
        $sql .= ", `image_poster`='$image_poster'";
    }
    
    // Check if image banner file is uploaded
    if (!empty($_FILES['image_banner']['name'])) {
        $image_banner         = $_FILES['image_banner']['name'];
        $tmp_image_banner     = $_FILES['image_banner']['tmp_name'];
        move_uploaded_file($tmp_image_banner, "uploads/$image_banner");
        $sql .= ", `image_banner`='$image_banner'";
    }
    
    // Add WHERE clause
    $sql .= " WHERE `id`='$id'"; // Adjust the condition according to your needs
    
    // Execute the SQL query
    echo "<pre>" . $sql . "</pre>"; // Print SQL query for debugging
    if(mysqli_query($link,$sql)){
        echo "<script>alert('Movie updated!');</script>";
        echo "<script>window.location.href='upcoming.php';</script>";
    }else{
        echo "<script>alert('Failed to update movie: " . mysqli_error($link) . "');</script>"; // Print SQL error if any
    }
}


if(isset($_GET['deleteid'])){
    $deleteid = $_GET['deleteid'];
    $sql = "DELETE FROM `movie` WHERE id ='$deleteid'";
  
 
    if(mysqli_query($link,$sql)){
     echo "<script>alert('Movie deleted!');</script>";
     echo "<script> window.location.href='upcoming.php'; </script>";
 }else{
     echo "<script>alert('failed to delete movie');</script>";
 }   
 }
?>
