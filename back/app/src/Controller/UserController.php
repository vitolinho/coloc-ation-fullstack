<?php

namespace App\Controller;

use App\Factory\PDOFactory;
use App\Manager\UserManager;
use App\Entity\User;
use App\Services\JWTHelper;

class UserController extends AbstractController
{
    public function register()
    {
        var_dump('caca');die;
        $username = $_POST['username'];

        $UserManager = new UserManager(new PDOFactory());
        $user = $UserManager->getUserByUsername($username);
        if (!isset($user)) {
            $user = new User($_POST);
            $user = $UserManager->insertUser($user);
            $jwt = JWTHelper::buildJWT($user);
            $user->setToken($jwt);
            $UserManager->updateUser($user);
            $this->renderJSON([
                "token" => $jwt
            ]);
            http_response_code(200);
            die();
        }
        echo json_encode(['error' => 'Utilisateur ou mot de passe invalide']);
        die();
    }

    public function login()
    {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $UserManager = new UserManager(new PDOFactory());
        $user = $UserManager->getUserByUsername($username);

        if ($user && $user->verifyPassword($password)) {
            $jwt = JWTHelper::buildJWT($user);
            $user->setToken($jwt);
            $UserManager->updateUser($user);
            $this->renderJSON([
                "token" => $jwt
            ]);
            http_response_code(200);
            die();
        }
        $this->register();
    }

    public function logout()
    {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            unset($_SESSION["user"]);
            http_response_code(200);
        }
        exit();
    }

}