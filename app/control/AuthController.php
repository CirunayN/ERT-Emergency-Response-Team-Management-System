<?php

class AuthController {

    private $userFile = "../app/model/users.json";

    private function loadUsers() {
        if (!file_exists($this->userFile)) {
            file_put_contents($this->userFile, json_encode([]));
        }
        return json_decode(file_get_contents($this->userFile), true);
    }

    private function saveUsers($users) {
        file_put_contents($this->userFile, json_encode($users, JSON_PRETTY_PRINT));
    }

    public function signup() {

        $error = "";
        $success = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $username = trim($_POST["username"]);
            $email = trim($_POST["email"]);
            $password = $_POST["password"];
            $confirm = $_POST["confirm"];

            // 🔥 VALIDATIONS
            if (empty($username) || empty($email) || empty($password)) {
                $error = "All fields are required.";
            } elseif (strlen($username) < 4) {
                $error = "Username must be at least 4 characters.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email format.";
            } elseif ($password !== $confirm) {
                $error = "Passwords do not match.";
            } else {

                $users = $this->loadUsers();

                foreach ($users as $user) {
                    if ($user["email"] === $email) {
                        $error = "Email already exists.";
                        break;
                    }
                }

                if (!$error) {
                    $users[] = [
                        "username" => $username,
                        "email" => $email,
                        "password" => password_hash($password, PASSWORD_DEFAULT)
                    ];

                    $this->saveUsers($users);
                    $success = "Account created successfully!";
                }
            }
        }

        require "../app/view/auth/signup.php";
    }

    public function login() {

        $error = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = $_POST["email"];
            $password = $_POST["password"];

            $users = $this->loadUsers();

            foreach ($users as $user) {
                if ($user["email"] === $email && password_verify($password, $user["password"])) {

                    $_SESSION["user"] = $user;

                    // COOKIE
                    setcookie("remember_user", $user["username"], time() + (86400 * 7), "/");

                    header("Location: index.php?action=dashboard");
                    exit;
                }
            }

            $error = "Invalid email or password.";
        }

        require "../app/view/auth/login.php";
    }

    public function dashboard() {

        if (!isset($_SESSION["user"])) {
            header("Location: index.php?action=login");
            exit;
        }

        require "../app/view/dashboard.php";
    }

    public function logout() {

        session_destroy();
        setcookie("remember_user", "", time() - 3600, "/");

        header("Location: index.php?action=login");
        exit;
    }
}