<?php

require_once __DIR__ . '/../model/User.php';

class AuthController {

    public function signup(){

        $error="";

        if($_SERVER["REQUEST_METHOD"]=="POST"){

            $username=trim($_POST["username"]);
            $email=trim($_POST["email"]);
            $password=$_POST["password"];
            $confirm=$_POST["confirm"];

            if(empty($username)||empty($email)||empty($password)){

                $error="All fields required.";

            }elseif($password!=$confirm){

                $error="Passwords do not match.";

            }else{

                $hash=password_hash($password,PASSWORD_DEFAULT);

                User::create($username,$email,$hash);

                header("Location: index.php?action=login");
                exit;
            }
        }

        require "../app/view/auth/signup.php";
    }

    public function login(){

        $error="";

        if($_SERVER["REQUEST_METHOD"]=="POST"){

            $email=$_POST["email"];
            $password=$_POST["password"];

            $user=User::findByEmail($email);

            if($user && password_verify($password,$user["password"])){

                $_SESSION["user"]=$user;

                setcookie("remember_user",$user["username"],time()+604800,"/");

                header("Location:index.php?action=dashboard");
                exit;
            }

            $error="Invalid login.";
        }

        require "../app/view/auth/login.php";
    }

    public function dashboard(){

        if(!isset($_SESSION["user"])){

            header("Location:index.php?action=login");
            exit;
        }

        require "../app/view/dashboard.php";
    }

    public function logout(){

        session_destroy();

        header("Location:index.php?action=login");
    }
}