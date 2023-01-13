<?php

namespace App\Controller;

use App\Factory\PDOFactory;
use App\Manager\DepenseManager;
use App\Entity\Depense;

class DepenseController extends AbstractController {

    public function createDepense()
    {
        $apiInput = json_decode(file_get_contents("php://input"), true);
        
        $montant = $apiInput['montant'];
        $description = $apiInput['description'];
        $preuve = $_FILES['preuve'];
        $userId = $apiInput['id'];
        $collocationId = $apiInput['collocationId'];

        move_uploaded_file($_FILES['preuve']['tmp_name'], dirname(__DIR__, 2) . '/uploads/' . $_FILES['preuve']['name']);
        $datetime = new \DateTime();

        $newDepense = (new Depense())
                ->setMontant($montant)
                ->setDescription($description)
                ->setPreuve('/uploads/' . $_FILES['preuve']['name'])
                ->setUserId($userId)
                ->setCollocationId($collocationId)
                ->setDatetime($datetime);
        
        $manager = new CollocationManager(new PDOFactory());
        $manager->insertDepense($newDepense);
        
        $this->renderJSON([
            "message" => "Dépense crée avec succès.",
            "dépense" => $newDepense
        ]);
    }


    public function editDepense()
    {
        $apiInput = json_decode(file_get_contents("php://input"), true);
        $id = $apiInput['id'];
        $montant = $apiInput['montant'];
        $description = $apiInput['description'];
        $preuve = $apiInput['preuve'];
        $userId = $apiInput['userId'];
        $collocationId = $apiInput['collocationId'];
        $datetime = new \DateTime();

        $newDepense = (new Depense())
                ->setMontant($montant)
                ->setDescription($description)
                ->setPreuve($preuve)
                ->setUserId($userId)
                ->setCollocationId($collocationId)
                ->setDatetime($datetime);
        
        $manager = new CollocationManager(new PDOFactory());
        $manager->updateDepense($newDepense);

        $this->renderJSON([
            "message" => "Dépense modifiée avec succès.",
            "dépense" => $newDepense
        ]);
    }

    public function deleteDepense()
    {
        $apiInput = json_decode(file_get_contents("php://input"), true);
        $id = $apiInput['id'];
        $manager = new DepenseManager(new PDOFactory());
        $manager->deleteDepense($id);
        $this->renderJSON([
            "message" => "Dépense supprimée avec succès."
        ]);
    }

    public function showDepense()
    {
        $manager = new DepenseManager(new PDOFactory());
        $depenses = $manager->getAllDepense();
        $this->renderJSON([
            "message" => "Vous pouvez comtemplé vos dépenses."
        ]);
    }
}