<?php
require_once "app/model/data.php";

class FormControl {

    public function handleRequest() {

        $incidents = [];
        $error = "";
        $success = "";
        $prefillLocation = "";

        if (isset($_GET["location"])) {
            $prefillLocation = $_GET["location"];
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $reporter = trim($_POST["reporter"]);
            $contact = trim($_POST["contact"]);
            $location = trim($_POST["location"]);
            $type = $_POST["type"];
            $severity = $_POST["severity"];
            $description = trim($_POST["description"]);

            $incidentModel = new Data();

            $validation = $incidentModel->validate(
                $reporter,
                $contact,
                $location,
                $type,
                $severity,
                $description
            );

            if ($validation !== true) {
                $error = $validation;
            } else {
                $incidents[] = $incidentModel->create(
                    $reporter,
                    $contact,
                    $location,
                    $type,
                    $severity,
                    $description
                );

                $success = "Incident successfully reported!";
            }
        }

        require __DIR__ . "/../views/form.php";
    }
}