<?php
// app/controller/IncidentController.php
require_once __DIR__ . '/../model/Incident.php';

class IncidentController
{
    // Show the form and current incidents
    public function index(): void
    {
        $incidents = Incident::all();
        $error = $_SESSION['flash_error'] ?? '';
        $success = $_SESSION['flash_success'] ?? '';
        // clear flash messages
        unset($_SESSION['flash_error'], $_SESSION['flash_success']);

        // variables that the view expects:
        require __DIR__ . '/../view/incident_form.php';
    }

    // Handle form submission
    public function store(): void
    {
        // collect input safely (basic)
        $reporter = trim($_POST['reporter'] ?? '');
        $contact  = trim($_POST['contact'] ?? '');
        $location = trim($_POST['location'] ?? '');
        $type     = $_POST['type'] ?? '';
        $danger   = $_POST['danger'] ?? '';
        $description = trim($_POST['description'] ?? '');
        $datetime = date('Y-m-d H:i:s');

        // validation
        if ($reporter === '' || $contact === '' || $location === '' || $type === '' || $danger === '' || $description === '') {
            $_SESSION['flash_error'] = 'All fields are required!';
            // store old inputs so view can re-populate if you want
            $_SESSION['old'] = compact('reporter','contact','location','type','danger','description');
            header('Location: index.php');
            exit;
        }

        if (!is_numeric($contact) || strlen($contact) != 11) {
            $_SESSION['flash_error'] = 'Contact number must be exactly 11 digits!';
            $_SESSION['old'] = compact('reporter','contact','location','type','danger','description');
            header('Location: index.php');
            exit;
        }

        if (strlen($description) < 10) {
            $_SESSION['flash_error'] = 'Description must be at least 10 characters!';
            $_SESSION['old'] = compact('reporter','contact','location','type','danger','description');
            header('Location: index.php');
            exit;
        }

        // Passed validation -> save via Model
        Incident::create([
            'reporter' => $reporter,
            'contact' => $contact,
            'location' => $location,
            'type' => $type,
            'danger' => $danger,
            'datetime' => $datetime,
            'description' => $description
        ]);

        // success flash and redirect (PRG)
        $_SESSION['flash_success'] = 'Incident successfully reported!';
        // clear old inputs
        unset($_SESSION['old']);
        header('Location: index.php');
        exit;
    }
}
