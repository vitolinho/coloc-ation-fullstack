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
        $apiInput = json_decode(file_get_contents("php://input"), true);

        $nom = $apiInput['nom'];
        $adresse = $apiInput['adresse'];
        $datetime = new \DateTime();

        $newCollocation = (new Collocation())
                ->setNom($nom)
                ->setAdresse($adresse)
                ->setDatetime($datetime);
        
        $manager = new CollocationManager(new PDOFactory());
        $manager->insertCollocation($newCollocation);

        $this->renderJSON([
            "message" => "Collocation crée avec succès.",
            "collocation" => $newCollocation
        ]);
    }

    public function deleteCollocation()
    {
        $api = json_decode(file_get_contents("php://input"), true);
        $id = (int)$api['id'];
        $manager = new CollocationManager(new PDOFactory());
        $manager->deleteCollocationById($id);
        $this->renderJSON([
            "message" => "Collocation supprimée avec succés."
        ]);
    }

    public function showCollocation()
    {
        $manager = new CollocationManager(new PDOFactory());
        $collocations = $manager->getAllCollocation();
        $this->renderJSON([
            "message" => "Vous pouvez comtemplé votre collocation."
        ]);
    }
}