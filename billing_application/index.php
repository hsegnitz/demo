<?php

require_once 'vendor/autoload.php';

$action = $_GET['action'] ?? 'home';

switch ($action) {
    case 'clients':
        include 'clients.php';
        break;
    case 'invoices':
        include 'invoices.php';
        break;
    case 'details':
        include 'details.php';
        break;
    case 'home':
    default:
        include 'home.php';
}
