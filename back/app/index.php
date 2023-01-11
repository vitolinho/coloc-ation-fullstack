<?php

require_once "vendor/autoload.php";

switch ($_SERVER["REQUEST_URI"]) {

    case "/":
        break;

    case "/home":
        $method = new \App\Controller\CollocationController();
        $method->showCollocation();
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
    
    case "/edit-collocation":
        $method = new \App\Controller\CollocationController();
        $method->editCollocation();
        break;
    
    case "/show-collocation":
        $method = new \App\Controller\CollocationController();
        $method->showCollocation();
        break;
    
    case "/ajout-depense":
        $method = new \App\Controller\DepenseController();
        $method->ajtDepense();
        break;


    case "/suprime-depense":
        $method = new \App\Controller\DepenseController();
        $method->suprDepense();
        break;

     case "/modifier-depense":
        $method = new \App\Controller\DepenseController();
        $method->modifDepense();
        break;

    case "/recaputiler-depense":
        $method = new \App\Controller\DepenseController();
        $method->recapDepense();
        break;

    default:
        echo "Cette page n'existe pas ...";
}
