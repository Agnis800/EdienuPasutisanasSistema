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

        $Username = $FirstName = $LastName = $Email = $PhoneNumber = $Password = $ConfirmPassword = "";
        $Username_err = $FirstName_err = $LastName_err = $Email_err = $PhoneNumber_err = $Password_err = $ConfirmPassword_err = "";

        if($_SERVER["REQUEST_METHOD"] == "POST") {

            // Validate username
            if(empty(trim($_POST["username"]))) {
                $Username_err = "Please enter a username.";
            } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["username"]))){
                $Username_err = "Username can only contain letters, numbers, and underscores.";
            } else {
                $sql = "SELECT Username FROM USER WHERE Username = ?"; //! may not work on sql due to syntax
                $stmt = $this->connection->prepare($sql);
                $stmt->execute([trim($_POST["username"])]);
                
                $result = $stmt->fetchAll();
                if (! empty($result)) {
                    $Username_err = 'Username is already taken';
                }

            }

            // Validate first name
            if(empty(trim($_POST["first_name"]))){
                $FirstName_err = "Please enter a first name.";
            } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["first_name"]))){
                $FirstName_err = "First name can only containt letters, numbers, and underscores.";
            } else{
                    $FirstName = trim($_POST["first_name"]);
            }
            
            // Validate last name
            if(empty(trim($_POST["last_name"]))){
                $LastName_err = "Please enter a last name.";
            } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["last_name"]))){
                $LastName_err = "Last name can only contain letters, numbers, and underscores.";
            } else{
                    $LastName = trim($_POST["last_name"]);
            }
            
            // Validate e-mail
            if(empty(trim($_POST["e_mail"]))){
                $Email_err = "Please enter a e-mail.";
            } else{
                    $Email = trim($_POST["e_mail"]);
            }

            // Validate phone number
            if(empty(trim($_POST["phone_number"]))){
                $PhoneNumber_err = "Please enter a phone number.";
            } else{
                    $PhoneNumber = trim($_POST["phone_number"]);
            }
            
            // Validate password
            if(empty(trim($_POST["password"]))){
                $Password_err = "Please enter a password.";
            } elseif(strlen(trim($_POST["password"])) < 6){
                $Password_err = "Password must have atleast 6 characters.";
            } else{
                    $Password = trim($_POST["password"]);
            }
            
            // Check password match
            if(empty(trim($_POST["confirm_password"]))){
                $ConfirmPassword_err = "Please confirm password.";
            } else{
                $ConfirmPassword = trim($_POST["confirm_password"]);
                if(empty($Password_err) && ($Password != $ConfirmPassword)){
                    $ConfirmPassword_err = "Password did not match.";
                }
            }

            // TODO
            // dazi lauki ir tuksi, apskatit kas notiek validacijas kodaa
            // dump($username, $first_name, $last_name, $e_mail, $phone_number, $password); die;


            if(empty($Username_err) && empty($FirstName_err) && empty($LastName_err) && empty($Email_err) && empty($PhoneNumber_err) && empty($Password_err) && empty($ConfirmPassword_err)) {
                $sql = "INSERT INTO USER (`Username`, `FirstName`, `LastName`, `Email`, `PhoneNumber`, `Password`) VALUES (?, ?, ?, ?, ?, ?)";

                $enctyptedPassword = password_hash($Password, PASSWORD_DEFAULT);
                if($stmt = $this->connection->prepare($sql)) {
                    $result = $stmt->execute([
                        $Username,
                        $FirstName,
                        $LastName,
                        $Email,
                        $PhoneNumber,
                        $enctyptedPassword,
                    ]);
                }
                
                if($result){
                    // Redirect to login page
                    header("location: login");
                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

            }
                

        }
        // Using PDO api, we close db connection like this
        $this->connection = null;

        return render_template($request, 'register.php');
    }

}