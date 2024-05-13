<?php

include("../config.php")
?>

<?php 
if(isset($_GET['editid'])){
  
   $editid = $_GET['editid'];
   $sql = "SELECT * FROM `users` WHERE id= '$editid'";
   $result = mysqli_query($link,$sql);
   $edit_data = mysqli_fetch_array($result);  
  
    echo print_r($edit_data);
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
                        <a href="categories.php" class="nav-link px-0 align-middle" >
                        <i class="fa-solid fa-list"></i> <span class="ms-1 d-none d-sm-inline">Categories</span></a>
                    </li>
                    <li class="nav-item">
                        <a href="users.php" class="nav-link align-middle px-0 " id="active">
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
    <!-- content -->

    <div class="container-fluid">
<div class="row justify-content-even mb-5 content">
        <div class="page-title mb-2 p-3">
        <h1> Manage Users</h1>
        </div>
          
<div class="col-md-6 col-sm-4 form-container w-100">
<div>
            <button class="btn btn-primary add-users-btn mt-2" data-bs-toggle="modal" data-bs-target="#add-users">Add Users</button>
        </div>

        <div class="modal fade" id="add-users" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable users-modal">
     <div class="modal-content p-2 overflow-hidden">
        <h3 class="mb-1">Edit Users</h3>
        <hr>
                    <form action="users.php" method="post" class="d-flex flex-column justify-content-center align-items-center">                 
                      
                            <div >
                                <input type="hidden" class="form-control" name="user_id" >
                            </div>
                        <div class="col-6">
                                <label for="exampleFormControlInput1" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username"  >
                        </div>
                        <div class="col-6">
                                <label for="exampleFormControlInput1" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email"  >
                        </div>
                       
                        
                        <div class="col-6">
                                <label for="" class="form-label"> Password</label>
                             <input type="password" class="form-control" name="password" >
                        </div>
                        
                        <div class="col-6 mb-2">
                            <label for="" class="form-label">Select account type</label>
                        <select class="form-select "  name="account_type">
                                <option selected value='0'>--Select Account-- </option>
                                 <option value="user" <?php if($edit_data['account_type']=="user") echo 'selected="selected"'; ?>>User</option>
                                  <option value="admin" <?php if($edit_data['account_type']=="admin") echo 'selected="selected"'; ?>>Admin</option>
                                 </select>
                        </div>
     
                <div class="modal-footer">
                         <div class="form-inputs">                          
                         <input class="btn btn-primary me-3" type="submit"  name="add" value="Add Account">
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </form>
                </div>
            </div>
        </div>
    </div>       
        
  <div class="modal fade" id="edit-users" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable users-modal">
     <div class="modal-content p-2 overflow-hidden">
        <h3 class="mb-1">Edit Users</h3>
        <hr>
                    <form action="users.php" method="post" class="d-flex flex-column justify-content-center align-items-center">                 
                      
                            <div >
                                <input type="hidden" class="form-control" name="user_id" value="<?=$edit_data['id']?>" >
                            </div>
                        <div class="col-6">
                                <label for="exampleFormControlInput1" class="form-label">Username</label>
                                <input type="text" class="form-control" name="username" value="<?=$edit_data['username']?>" >
                        </div>
                        <div class="col-6">
                                <label for="exampleFormControlInput1" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" value="<?=$edit_data['email']?>" >
                        </div>
                       
                        
                        <div class="col-6">
                                <label for="" class="form-label"> Password</label>
                             <input type="password" class="form-control" name="password" value="<?=$edit_data['password']?>" readonly>
                        </div>
                        
                        <div class="col-6">
                            <label for="" class="form-label">Select account type</label>
                        <select class="form-select "  name="account_type">
                                <option selected value='0'>--Select Account-- </option>
                                 <option value="user" <?php if($edit_data['account_type']=="user") echo 'selected="selected"'; ?>>User</option>
                                  <option value="admin" <?php if($edit_data['account_type']=="admin") echo 'selected="selected"'; ?>>Admin</option>
                                 </select>
                        </div>
     
                <div class="modal-footer">
                         <div class="form-inputs">
                           
                             <input class="btn btn-info" type="submit"  name="update" value="Update">
                        </div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </form>
                </div>
            </div>
        </div>
    </div>        
                   
            
                
            </div>
            <div class="col-md-6 table-wrapper col-sm-4 w-75 overflow-auto mt-4">
                <table class="table overflow-auto table-striped table-bordered movieTable">
                <tr>
                    <th>ID</th>
                    <th>username</th>
                    <th>email</th>
                    <th>account_type</th>
                    <th>action</th>
                </tr>
                <?php
                
                                $sql = "SELECT * FROM `users`";
                                $result = mysqli_query($link,$sql);
                                if(mysqli_num_rows($result) > 0){
                                    while($data = mysqli_fetch_array($result)){
                                       
                                        ?>
                                        <tr>
                                            <td><?= $data['id']?></td>
                                            <td><?= $data['username']?></td>
                                            <td><?= $data['email']?></td>
                                            <td><?= $data['account_type']?></td>
                                            <td>

                                                <a href="users.php?editid=<?=$data['id'] ?>" class="btn btn-primary">Edit</a>
                                                <a href="users.php?deleteid=<?=$data['id'] ?>" class="btn btn-danger">Delete</a>
                                            
                                    
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
    var modal = document.getElementById('edit-users');
    var modalBootstrap = new bootstrap.Modal(modal);
    modalBootstrap.show();
}
</script>
          
 </body>
</html>

<?php
if(isset($_POST['add'])){
    $name = $_POST['username'];
    $email = $_POST['email'];
    $role  = $_POST['account_type'];
    $password = $_POST['password'];
    $safe_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO `users` (username,email,account_type,password) VALUES ('$name','$email','$role','$safe_password') ";

    if(mysqli_query($link,$sql)){
        echo "<script>alert('Account successfully added!');</script>";
        echo "<script> window.location.href='users.php'; </script>";
    }else{
        echo "<script>alert('failed to add account');</script>";
    }
}

if(isset($_POST['update'])){
    $id    = $_POST['user_id'];
    $name  = $_POST['username'];
    $email = $_POST['email'];
    $role  = $_POST['account_type'];

    $sql = "UPDATE `users` SET `username` = '$name', `email` = '$email', `account_type` = '$role' WHERE id = '$id'";
    if(mysqli_query($link,$sql)){
        echo "<script>alert('User updated!');</script>";
        echo "<script> window.location.href='users.php'; </script>";
    }else{
        echo "<script>alert('failed to edit user');</script>";
    }
}

if(isset($_GET['deleteid'])){
    $deleteid = $_GET['deleteid'];
    $sql = "DELETE FROM `users` WHERE id ='$deleteid'";
  
 
    if(mysqli_query($link,$sql)){
     echo "<script>alert('Account deleted!');</script>";
     echo "<script> window.location.href='users.php'; </script>";
 }else{
     echo "<script>alert('failed to delete category');</script>";
 }   
 }
?>