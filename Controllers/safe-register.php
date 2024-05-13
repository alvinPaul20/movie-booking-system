<?php
$username_err = $email_err = $password_err = "";
$username = $email = $password = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = validate_input($_POST["username"]);
    $email = validate_input($_POST["email"]);
    $password = validate_input($_POST["password"]);
    $account_type = "user"; 

    
    if (empty($username)) {
        $username_err = "error";
        echo "<script>alert('Please enter username');</script>";
    } elseif (!ctype_alnum(str_replace(["@", "-", "_"], "", $username))) {
        echo "<script>alert('Username can only contain letters, numbers and symbols like '@', '_', or '-'.');</script>";
        $username_err = "error";
    } elseif (is_already_registered("username", $username)) {
        echo "<script>alert('This username is already registered');</script>";
        $username_err = "error";
    }

   
    if (empty($email)) {
        echo "<script>alert('Please enter your email address');</script>";
        $email_err = "error";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Enter valid email');</script>";
        $email_err = "error";
    } elseif (is_already_registered("email", $email)) {
        echo "<script>alert('This email is already registered');</script>";
        $email_err = "error";
    }

 
    if (empty($password)) {
        echo "<script>alert('Enter password');</script>";
        $password_err = "error";
    } elseif (strlen($password) < 8) {
        echo "<script>alert('Password must contain atleast 8 characters');</script>";
        $password_err = "error";
    }

    if (empty($username_err) && empty($email_err) && empty($password_err)) {
        $param_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users(username, email, password, account_type) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($link, $sql);
        mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $param_password, $account_type); // 's' for string
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Registration completed successfully. Login to continue.'); window.location.href='./login.php';</script>";
            exit;
        } else {
            echo "<script>alert('Oops! Something went wrong. Please try again later.');</script>";
        }
        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
}

function validate_input($data) {
    return trim($data);
}

function is_already_registered($field, $value) {
    global $link;
    $sql = "SELECT id FROM users WHERE $field = ?";
    $stmt = mysqli_prepare($link, $sql);
    mysqli_stmt_bind_param($stmt, "s", $value);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    $count = mysqli_stmt_num_rows($stmt);
    mysqli_stmt_close($stmt);
    return $count > 0;
}
?>
