<?php

require_once __DIR__ . '/../config/Database.php';

class Incident {

    public static function all(){

        $db=(new Database())->connect();

        $stmt=$db->prepare("SELECT * FROM incidents ORDER BY datetime DESC");

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create($data){

        $db=(new Database())->connect();

        $stmt=$db->prepare("
        INSERT INTO incidents
        (reporter,contact,location,type,danger,description,datetime)
        VALUES(?,?,?,?,?,?,?)
        ");

        $stmt->execute([
            $data['reporter'],
            $data['contact'],
            $data['location'],
            $data['type'],
            $data['danger'],
            $data['description'],
            $data['datetime']
        ]);
    }

    public static function delete($id){

        $db=(new Database())->connect();

        $stmt=$db->prepare("DELETE FROM incidents WHERE id=?");

        $stmt->execute([$id]);
    }
}