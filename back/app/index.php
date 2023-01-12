<?php
header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Headers: Authorization, Content-type');
header('Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS, HEAD');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    die;
}

require_once "vendor/autoload.php";

switch ($_SERVER["REQUEST_URI"]) {

    case "/":
        break;

    case "/register":
        $method = new \App\Controller\UserController();
        $method->register();
        break;

    case "/login":
        $method = new \App\Controller\UserController();
        $method->login();
        break;
    
    case "/logout":
        $method = new \App\Controller\UserController();
        $method->logout();
        break;

    case "/create-collocation":
        $method = new \App\Controller\CollocationController();
        $method->createCollocation();
        break;

    case "/delete-collocation":
        $method = new \App\Controller\CollocationController();
        $method->deleteCollocation();
        break;
    
    case "/show-collocation":
        $method = new \App\Controller\CollocationController();
        $method->showCollocation();
        break;
    
    case "/create-depense":
        $method = new \App\Controller\DepenseController();
        $method->createDepense();
        break;

    case "/edit-depense":
        $method = new \App\Controller\DepenseController();
        $method->editDepense();
        break;


    case "/delete-depense":
        $method = new \App\Controller\DepenseController();
        $method->deleteDepense();
        break;


    default:
        echo "Cette page n'existe pas ...";
}
