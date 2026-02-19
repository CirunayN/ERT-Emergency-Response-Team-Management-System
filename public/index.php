<?php
session_start();

require_once "../app/control/IncidentController.php";

$controller = new IncidentController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $controller->store();
} else {
    $controller->index();
}
