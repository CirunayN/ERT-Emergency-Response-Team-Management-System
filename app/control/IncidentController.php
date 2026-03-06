\<?php

require_once __DIR__ . '/../model/Incident.php';

class IncidentController {

    public function index(){

        if(!isset($_SESSION['user'])){
            header("Location:index.php?action=login");
            exit;
        }

        $incidents=Incident::all();

        require "../app/view/incident_form.php";
    }

    public function store(){

        $data=[

            'reporter'=>$_POST['reporter'],
            'contact'=>$_POST['contact'],
            'location'=>$_POST['location'],
            'type'=>$_POST['type'],
            'danger'=>$_POST['danger'],
            'description'=>$_POST['description'],
            'datetime'=>date("Y-m-d H:i:s")

        ];

        Incident::create($data);

        header("Location:index.php?action=incident");
    }

    public function delete(){

        $id=$_GET['id'];

        Incident::delete($id);

        header("Location:index.php?action=incident");
    }
}