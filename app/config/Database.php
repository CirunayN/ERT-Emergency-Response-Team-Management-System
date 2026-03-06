<?php

class Database {

    private $host="localhost";
    private $db="ert_system";
    private $user="root";
    private $pass="ncirunay9856";

    public function connect(){

        try{

            $pdo = new PDO(
                "mysql:host=$this->host;dbname=$this->db",
                $this->user,
                $this->pass
            );

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $pdo;

        }catch(PDOException $e){

            die("DB Error: ".$e->getMessage());

        }
    }
}