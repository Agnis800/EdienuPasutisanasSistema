<?php
require_once "databaseconfig.php";

$username = $first_name = $last_name = $e_mail = $phone_number = $password = $confirm_password = "";
$username_err = $first_name_err = $last_name_err = $e_mail_err = $phone_number_err = $password_err = $confirm_password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
        $username_err = "Username can only containt letters, numbers, and underscores.";
    } else{
        $sql = "SELECT UserID FROM user WHERE Username = ?"; //! may not work on sql due to syntax

    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "s", $param_username);

        $param_username = trim($_POST["username"]);

        if(mysqli_stmt_execute($stmt)){
            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) == 1){
                $username_err = "This username is already taken.";
            } else{
                $username = trim($_POST["username"]);
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        mysqli_stmt_close($stmt);
    }
    }

   // Validate first name
   if(empty(trim($_POST["first_name"]))){
      $first_name_err = "Please enter a first name.";
   } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["first_name"]))){
    $first_name_err = "First name can only containt letters, numbers, and underscores.";
   } else{
          $first_name = trim($_POST["first_name"]);
   }

   if(empty(trim($_POST["last_name"]))){
    $last_name_err = "Please enter a last name.";
   } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["last_name"]))){
    $last_name_err = "Last name can only contain letters, numbers, and underscores.";
   } else{
        $last_name = trim($_POST["last_name"]);
   }

   if(empty(trim($_POST["e_mail"]))){
    $e_mail_err = "Please enter a e-mail.";
   } else{
        $e_mail = trim($_POST["e_mail"]);
   }

   if(empty(trim($_POST["password"]))){
    $password_err = "Please enter a password.";
   } elseif(strlen(trim($_POST["password"])) < 6){
      $password_err = "Password must have atleast 6 characters.";
   } else{
          $password = trim($_POST["password"]);
   }

   if(empty(trim($_POST["confirm_password"]))){
    $confirm_password_err = "Please confirm password.";
   } else{
     $confirm_password = trim($_POST["confirm_password"]);
     if(empty($password_err) && ($password != $confirm_password)){
        $confirm_password_err = "Password did not match.";
     }
   }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="assets/css/register.css"/>
</head>
<body>
    <header>
        <div class="title">
            <h2>AV FOOD</h2>
        </div>
        <div class="pages">
          <a href="/">Catalogue</a>
          <a href="">Your account</a>
          <a href="/contactform">Contact us</a>
        </div>
        <button class="button"><a href="/cart">Your cart</a></button>
        <button class="button"><a href="/login">Login</a></button>
        <button class="button"><a href='/register'>Register</a></button>
    </header>
    <hr>
    <form action="action_page.php">
        <div class="container">
            <h1>Register</h1>

            <label for="username"><b>Username</b></label>
            <input type="text" name="username" id="username" required>

            <label for="first_name"><b>First name</b></label>
            <input type="text" name="first_name" id="first_name" required>

            <label for="last_name"><b>Last name</b></label>
            <input type="text" name="last_name" id="last_name" required>

            <label for="e_mail"><b>E-mail</b></label>
            <input type="text" name="e_mail" id="e_mail" required>

            <label for="phone_number"><b>Phone number</b></label>
            <input type="text" name="phone_number" id="phone_number" required>

            <label for="password"><b>Password</b></label>
            <input type="password" name="password" id="password" required>

            <label for="confirm_password"><b>Confirm password</b></label>
            <input type="password" name="confirm_password" id="confirm_passowrd" required>
        </div>

        <button type="submit" class="registerbtn">Register</button>
        <div class="container signin">
            <p>Already have an account? <a href="/login">Log in</a>.</p>
        </div>
    </form>
</body>
</html>