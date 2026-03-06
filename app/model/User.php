<?php

require_once __DIR__ . '/../config/Database.php';

class User {

    public static function create($username,$email,$password){

        $db=(new Database())->connect();

        $stmt=$db->prepare("
            INSERT INTO users(username,email,password)
            VALUES(?,?,?)
        ");

        $stmt->execute([$username,$email,$password]);
    }

    public static function findByEmail($email){

        $db=(new Database())->connect();

        $stmt=$db->prepare("SELECT * FROM users WHERE email=?");

        $stmt->execute([$email]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}