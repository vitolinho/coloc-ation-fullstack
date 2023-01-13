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
        $apiInput = json_decode(file_get_contents("php://input"), true);

        $username = $apiInput['username'];
        $UserManager = new UserManager(new PDOFactory());

        $user = $UserManager->getUserByUsername($username);
        if (!isset($user)) {
            $apiInput['password'] = password_hash($apiInput['password'], PASSWORD_DEFAULT);
            $user = new User($apiInput);
            $userId = $UserManager->insertUser($user);
            $this->renderJSON([
                "message" => "Vous avez bien crée votre compte."
            ]);
            http_response_code(200);
            die();
        }
        echo json_encode(["message" => "Il existe déjà un compte avec les mêmes identifiants et mots de passes."]);
        die();
    }

    public function login()
    {
        $apiInput = json_decode(file_get_contents("php://input"), true);

        $username = $apiInput['username'];
        $password = $apiInput['password'];

        $UserManager = new UserManager(new PDOFactory());
        $user = $UserManager->getUserByUsername($username);

        if ($user && $user->verifyPassword($password)) {
            $jwt = JWTHelper::buildJWT($user);
            $user->setToken($jwt);
            $UserManager->updateUser($user->getId(), $jwt);
            $this->renderJSON([
                "login" => true,
                "token" => $jwt
            ]);
            http_response_code(200);
            die();
        }
        $this->register();
    }

    public function logout()
    {
        $apiInput = json_decode(file_get_contents("php://input"), true);

        if($apiInput["REQUEST_METHOD"] === "POST") {
            unset($apiInput["user"]);
            http_response_code(200);
        }
        exit();
        
        $this->renderJSON([
            "message" => "Vous êtes déconnecté(e)."
        ]);
    }

}