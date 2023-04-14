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

        if($request->getMethod() == "POST"){ /* start of validation (POST) */
            if(empty(trim($request->get('username')))){
                $username_err = "Please enter username.";
            } else{
                $username = trim($request->get('username'));
            }

            if(empty(trim($_POST["password"]))){
                $password_err = "Please enter your password.";
            } else{
                $password = trim($_POST["password"]);
            }

            if(empty($username_err) && empty($password_err)){ /* start of credental validation */
                $sql = "SELECT `UserID`, `Username`, `Password` FROM `USER` WHERE `Username` = :Username";

                $stmt = $this->connection->prepare($sql);
                $stmt->execute([$username]);
                $row = $stmt->fetch(\PDO::FETCH_ASSOC);

                if(! empty($row)) { /* start of rowCount */
                        $id = $row["UserID"];
                        $username = $row["Username"];
                        $hashed_password = $row["Password"];
                        if(password_verify($password, $hashed_password)) { /* start of password verification */

                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to home page
                            header("location: /");
                        } else{
                            $login_err = "Invalid username or password.";
                        }
                       /* end of password verification */
                } /* end of verification if */
                  else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                unset($stmt);
            } /* end of credental validation */

            unset($pdo);
            return render_template($request, 'login.php');
        } /* end of of validation (POST) */

        return render_template($request, 'login.php'); // this fixed "Call to a member function send() on null" error

    } /* end of loginaction */
} /* end of logincontroller */