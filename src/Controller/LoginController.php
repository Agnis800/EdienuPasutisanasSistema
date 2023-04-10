<?php

namespace App\Controller;

use App\SQLiteConnection;
use Symfony\Component\HttpFoundation\Request;


class LoginController { /* start of logincontroller

    /**
     * @var PDO
     */
    private $connection;

    public function __construct() {
        $conn = new SQLiteConnection();
        $this->connection = $conn->connect();
    }

    public function loginAction(Request $request) { /* start of loginaction */

        session_start();

        if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){ /* this one doesn't cause the syntax error */
            header("location: home.php");
            exit;
        }

        /* require_once "Config.php"; */

        $username = $password = "";
        $username_err = $password_err = $login_err = "";

        if($_SERVER["REQUEST_METHOD"] == "POST"){ /* start of validation (POST) */

            if(empty(trim($_POST["username"]))){
                $username_err = "Please enter username.";
            } else{
                $username = trim($_POST["username"]);
            }

            if(empty(trim($_POST["password"]))){
                $password_err = "Please enter your password.";
            } else{
                $password = trim($_POST["password"]);
            }

            if(empty($username_err) && empty($password_err)){ /* start of credental validation */
                $sql = "SELECT UserID, Username, Password FROM users WHERE Username = :Username";

            $stmt = $this->connection->prepare($sql);
            $stmt->execute([trim($_POST["username"])]);
                
            $result = $stmt->fetchColumn();

            if($stmt->execute()){ /* start of verification if */ /* !!!start of questenable part!!! */
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){ /* start of rowCount */
                    if($row = $stmt->fetch()){ /* start of login check */
                        $id = $row["id"];
                        $username = $row["id"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){ /* start of password verification */
                            session_start();

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to home page
                            header("location: home.php");
                        } else{
                            $login_err = "Invalid username or password.";
                        }
                       /* end of password verification */
                    } /* end of rowCount */ else{
                        $login_err = "Invalid username or password";
                    }
                } /* end of verification if */
                  else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                unset($stmt);
            } /* !!!end of questenable part!!! */
            } /* end of credental validation */

            unset($pdo);
        return render_template($request, 'login.php');
        } /* end of of validation (POST) */
    } /* end of loginaction */
} /* end of logincontroller */