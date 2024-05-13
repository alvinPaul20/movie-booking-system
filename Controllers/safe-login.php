<?php

$user_login_err = $user_password_err = $login_err = "";
$user_login = $user_password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user_login = trim($_POST["email"] ?? '');
  $user_password = trim($_POST["password"] ?? '');

  if (empty($user_login_err) && empty($user_password_err)) {
    $sql = "SELECT id, username, password, account_type FROM users WHERE username = ? OR email = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
      mysqli_stmt_bind_param($stmt, "ss", $param_user_login, $param_user_login);
      $param_user_login = $user_login;

      if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) == 1) {
          mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password, $account_type);

          if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($user_password, $hashed_password)) {
              $_SESSION["id"] = $id;
              $_SESSION["username"] = $username;
              $_SESSION["account_type"] = $account_type; // Store account type in session
              $_SESSION["loggedin"] = TRUE;

              // Redirect based on account type
              if ($account_type === "admin") {
                header("Location: Admin/admin.php");
                exit;
              } else {
                header("Location: ./index.php");                
                exit;
              }
            } else {
                echo "<script>alert('The email or password you entered is incorrect.');</script>";
            }
          }
        } else {
            echo "<script>alert('Invalid username or password.');</script>";
         
        }
      } else {
        echo "<script>alert('Oops! Something went wrong. Please try again later.');</script>";
        header("Location: ./login.php");
        exit;
      }

      mysqli_stmt_close($stmt);
    }
  }

  mysqli_close($link);
}
