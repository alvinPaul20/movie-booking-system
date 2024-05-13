<?php

include("../config.php")
?>

<?php error_reporting(0);
if(isset($_GET['editid'])){
   
    $editid = $_GET['editid'];
   $sql = "SELECT * FROM `category` WHERE id= '$editid'";
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
<body>



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
                        <a href="categories.php" class="nav-link px-0 align-middle" id="active">
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
        
<!-- content here -->
        <div class="row  d-flex flex-column justify-content-even content">
        <div class="page-title mb-2 p-3">
        <h1> Manage Categories</h1>
        </div>
            <div class="col-md-10 col-sm-4 justify-content-center d-flex category-wrapper">
            <h5 class="me-5 mt-3">Add category name:</h5>
                <form action="categories.php" method="post" class="d-flex flex-row mt-3">
                    
                    <div class="form-inputs mb-4">
                        <input class="form-control" type="hidden" value="<?=$edit_data['id']?>"  name="category_id">
                    </div>
                    <div class="form-inputs mb-4 me-5">
                        <input class="form-control" type="text"  name="category_name" value="<?=$edit_data['category_name']?>" placeholder="Enter Category Name: ">
                    </div>
                    <div class="form-inputs">
                        <input class="btn btn-primary" type="submit"  name="add" value="Add">
                        <input class="btn btn-info" type="submit"  name="update" value="Update">
                    </div>
                    
                </form>




            </div>
            <div class="col-lg-10 justify-content-center d-flex table-wrapper col-sm-4  overflow-auto ">
                    <table class="table overflow-auto table-striped w-50 table-bordered movieTable">
                        <thead>
                        <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                         

                            <?php
                                $sql = "SELECT * FROM `category`";
                                $result = mysqli_query($link,$sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($data = mysqli_fetch_array($result)){
                                        
                                        ?>
                                        <tr>
                                            <td><?= $data['id']?></td>
                                            <td><?= $data['category_name']?></td>
                                            <td>
                                                <a href="categories.php?editid=<?=$data['id'] ?>" class="btn btn-primary">Edit</a>
                                                <a href="categories.php?deleteid=<?=$data['id'] ?>" class="btn btn-danger">Delete</a>
                                    
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }else{
                                    echo 'No record found';
                                }
                                
                            ?>
                    </table>
                    
            </div>

        </div>


<!-- footer -->
        </div>
    
    </div>
    
    
    <script src="../Bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../Script/admin.js"></script>
 </body>
</html>
    

<?php
if(isset($_POST['add'])){
    $name = $_POST['category_name'];
    $sql = "INSERT INTO `category` (category_name) VALUES ('$name') ";

    if(mysqli_query($link,$sql)){
        echo "<script>alert('category added!');</script>";
        echo "<script> window.location.href='categories.php'; </script>";
    }else{
        echo "<script>alert('failed to add category');</script>";
    }
}

if(isset($_POST['update'])){
    $id = $_POST['category_id'];
    $name = $_POST['category_name'];

    $sql = "UPDATE `category` SET `category_name` = '$name' WHERE id = '$id'";

    if(mysqli_query($link,$sql)){
        echo "<script>alert('category updated!');</script>";
        echo "<script> window.location.href='categories.php'; </script>";
    }else{
        echo "<script>alert('failed to update category');</script>";
    }
}

if(isset($_GET['deleteid'])){
   $deleteid = $_GET['deleteid'];
   $sql = "DELETE FROM `category` WHERE id ='$deleteid'";
 

   if(mysqli_query($link,$sql)){
    echo "<script>alert('category deleted!');</script>";
    echo "<script> window.location.href='categories.php'; </script>";
}else{
    echo "<script>alert('failed to delete category');</script>";
}   
}
?>