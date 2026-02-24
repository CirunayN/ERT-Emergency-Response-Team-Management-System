<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "../app/control/AuthController.php";
require_once "../app/control/IncidentController.php";

$action = $_GET['action'] ?? 'login';

switch ($action) {

    case 'signup':
        (new AuthController())->signup();
        break;

    case 'login':
        (new AuthController())->login();
        break;

    case 'dashboard':
        (new AuthController())->dashboard();
        break;

    case 'logout':
        (new AuthController())->logout();
        break;

    case 'incident':
        $controller = new IncidentController();
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $controller->store();
        } else {
            $controller->index();
        }
        break;

    default:
        (new AuthController())->login();
}