<?php

namespace App\Controller;

use App\SQLiteConnection;
use Symfony\Component\HttpFoundation\Request;


class RegisterController {

    /**
     * @var PDO
     */
    private $connection;

    public function __construct() {
        $conn = new SQLiteConnection();
        $this->connection = $conn->connect();
    }

    public function RegisterAction(Request $request) {

        $version = $this->connection->query('SELECT SQLITE_VERSION()');




        $username = $first_name = $last_name = $e_mail = $phone_number = $password = $confirm_password = "";
        $username_err = $first_name_err = $last_name_err = $e_mail_err = $phone_number_err = $password_err = $confirm_password_err = "";

        if($_SERVER["REQUEST_METHOD"] == "POST") {
            
            // Validate username
            if(empty(trim($_POST["username"]))){
                $username_err = "Please enter a username.";
            } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
                $username_err = "Username can only contain letters, numbers, and underscores.";
            } else{
                $sql = "SELECT UserID FROM user WHERE Username = ?"; //! may not work on sql due to syntax

            if($stmt = $this->connection->prepare($sql)) {

                $param_username = trim($_POST["username"]);
                $stmt->execute([$param_username]);
                
                dump($stmt->fetchAll()); die;

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
        
        // Validate last name
        if(empty(trim($_POST["last_name"]))){
            $last_name_err = "Please enter a last name.";
        } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["last_name"]))){
            $last_name_err = "Last name can only contain letters, numbers, and underscores.";
        } else{
                $last_name = trim($_POST["last_name"]);
        }
        
        // Validate e-mail
        if(empty(trim($_POST["e_mail"]))){
            $e_mail_err = "Please enter a e-mail.";
        } else{
                $e_mail = trim($_POST["e_mail"]);
        }
        
        // Validate password
        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter a password.";
        } elseif(strlen(trim($_POST["password"])) < 6){
            $password_err = "Password must have atleast 6 characters.";
        } else{
                $password = trim($_POST["password"]);
        }
        
        // Check password match
        if(empty(trim($_POST["confirm_password"]))){
            $confirm_password_err = "Please confirm password.";
        } else{
            $confirm_password = trim($_POST["confirm_password"]);
            if(empty($password_err) && ($password != $confirm_password)){
                $confirm_password_err = "Password did not match.";
            }
        }

        if(empty($username_err) && empty($first_name_err) && empty($last_name_err) && empty($e_mail_err) && empty($phone_number_err) && empty($password_err) && empty($confirm_password_err)) {
            $sql = "INSERT INTO user (username, first_name, last_name, e_mail, phone_number, password) VALUES (?, ?)";

            if($stmt = $this->connection->prepare($sql)) {
                mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

                $param_username = $username;
                $param_password = password_hash($password, PASSWORD_DEFAULT);
            }
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            mysqli_stmt_close($stmt);
        }

        }

        return render_template($request, 'register.php');
    }

}