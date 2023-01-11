<?php

namespace App\Controller;

use Datetime;
use App\Factory\PDOFactory;
use App\Manager\CollocationManager;
use App\Entity\Collocation;

class CollocationController extends AbstractController
{
    public function createCollocation()
    {
        session_start();
        $id = $_SESSION['id'];

        $nom = $_POST['nom'];
        $adresse = $_POST['adresse'];
        $datetime = new \DateTime();

        $newCollocation = (new Collocation())
                ->setNom($nom)
                ->setAdresse($adresse)
                ->setDatetime($datetime);
        
        $manager = new CollocationManager(new PDOFactory());
        $manager->insertCollocation($newCollocation);
        // COMMENT RENVOYER JWT OU JSON ??
    }

    public function deleteCollocation()
    {
        $id = (int)$_POST['collocationId'];
        $manager = new CollocationManager(new PDOFactory());
        $manager->deleteCollocationById($id);
    }

    public function showCollocation()
    {
        $manager = new CollocationManager(new PDOFactory());
        $collocations = $manager->getAllCollocation();
        var_dump($collocations);die;
        return $collocations;
    }
}