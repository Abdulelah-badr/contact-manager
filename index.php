<?php
session_start();

require 'config.php';
require 'models/Database.php';
require 'models/Contact.php';
require 'models/User.php';
require 'controllers/Controller.php';
require 'controllers/ContactController.php';
require 'controllers/AuthController.php';

if (!isset($_SESSION['token'])) {
    $_SESSION['token'] = md5(uniqid(rand(), true));
}

function checkToken()
{
    if (!isset($_POST['token']) || $_POST['token'] != $_SESSION['token']) {
        die("Invalid request");
    }
}

$action = isset($_GET['action']) ? $_GET['action'] : 'list';

switch ($action) {
    case 'list':
        $controller = new ContactController();
        $controller->index();
        break;
    case 'add':
        $controller = new ContactController();
        $controller->add();
        break;
    case 'edit':
        $controller = new ContactController();
        $controller->edit();
        break;
    case 'delete':
        $controller = new ContactController();
        $controller->delete();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    default:
        http_response_code(404);
        include 'views/header.php';
        include 'views/404.php';
        include 'views/footer.php';
}
