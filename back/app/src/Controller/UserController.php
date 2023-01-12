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
            $user = new User($_POST);
            $user = $UserManager->insertUser($user);
            $jwt = JWTHelper::buildJWT($user);
            $user->setToken($jwt);
            $UserManager->updateUser($user);
            $this->renderJSON([
                "message" => "Vous avez bien crée votre compte.",
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
        $apiInput = json_decode(file_get_contents("php://input"), true);

        $username = $apiInput['username'];
        $password = $apiInput['password'];

        $UserManager = new UserManager(new PDOFactory());
        $user = $UserManager->getUserByUsername($username);

        // if (!$user || !$user->verifyPassword($password)) {
        //     $this->register();
        //     exit;
        // }

        if ($user && $user->verifyPassword($password)) {
            $jwt = JWTHelper::buildJWT($user);
            $user->setToken($jwt);
            $UserManager->updateUser($user);
            $this->renderJSON([
                "message" => "Vous êtes connecté(e).",
                "token" => $jwt
            ]);
            http_response_code(200);
            die();
        }
        $newUser = $this->createUserIfNotExists($username, $password);
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