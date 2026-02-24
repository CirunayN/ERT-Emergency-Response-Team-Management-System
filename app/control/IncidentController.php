<?php
require_once __DIR__ . '/../model/Incident.php';

class IncidentController
{
    public function index(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $incidents = Incident::all();
        $error = $_SESSION['flash_error'] ?? '';
        $success = $_SESSION['flash_success'] ?? '';

        unset($_SESSION['flash_error'], $_SESSION['flash_success']);

        require __DIR__ . '/../view/incident_form.php';
    }

    public function store(): void
    {
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?action=login');
            exit;
        }

        $reporter = trim($_POST['reporter'] ?? '');
        $contact  = trim($_POST['contact'] ?? '');
        $location = trim($_POST['location'] ?? '');
        $type     = $_POST['type'] ?? '';
        $danger   = $_POST['danger'] ?? '';
        $description = trim($_POST['description'] ?? '');
        $datetime = date('Y-m-d H:i:s');

        if ($reporter === '' || $contact === '' || $location === '' || $type === '' || $danger === '' || $description === '') {
            $_SESSION['flash_error'] = 'All fields are required!';
            $_SESSION['old'] = compact('reporter','contact','location','type','danger','description');
            header('Location: index.php?action=incident');
            exit;
        }

        if (!is_numeric($contact) || strlen($contact) != 11) {
            $_SESSION['flash_error'] = 'Contact number must be exactly 11 digits!';
            $_SESSION['old'] = compact('reporter','contact','location','type','danger','description');
            header('Location: index.php?action=incident');
            exit;
        }

        if (strlen($description) < 10) {
            $_SESSION['flash_error'] = 'Description must be at least 10 characters!';
            $_SESSION['old'] = compact('reporter','contact','location','type','danger','description');
            header('Location: index.php?action=incident');
            exit;
        }

        Incident::create([
            'reporter' => $reporter,
            'contact' => $contact,
            'location' => $location,
            'type' => $type,
            'danger' => $danger,
            'datetime' => $datetime,
            'description' => $description
        ]);

        $_SESSION['flash_success'] = 'Incident successfully reported!';
        unset($_SESSION['old']);

        header('Location: index.php?action=incident');
        exit;
    }
}