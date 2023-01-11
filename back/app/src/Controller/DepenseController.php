<?php

namespace App\Controller;

use App\Factory\PDOFactory;
use App\Manager\DepenseManager;
use App\Entity\Depense;

class DepenseController extends AbstractController {

    public function createDepense()
    {
        session_start();
        $id = $_SESSION['id'];

        $montant = $_POST['montant'];
        $description = $_POST['description'];
        $preuve = $_FILES;
        move_uploaded_file($_FILES['preuve']['tmp_name'], dirname(__DIR__, 2) . '/uploads/' . $_FILES['preuve']['name']);
        $datetime = new \DateTime();

        $newDepense = (new Depense())
                ->setMontant($montant)
                ->setDescription($description)
                ->setPreuve($preuve)
                ->setDatetime($datetime);
        
        $manager = new CollocationManager(new PDOFactory());
        $manager->insertDepense($newDepense);
        #Ajouter colocationId et userId et les set
    }


    public function modifDepense()
    {
        session_start();
        $id = $_SESSION['id'];

        $montant = $_POST['montant'];
        $description = $_POST['description'];
        $preuve = $_POST['preuve'];
        $datetime = new \DateTime();

        $newDepense = (new Depense())
                ->setMontant($montant)
                ->setDescription($description)
                ->setPreuve($preuve)
                ->setDatetime($datetime);
        
        $manager = new CollocationManager(new PDOFactory());
        $manager->updateDepense($newDepense);
    } #colocationId et userId

    public function suprDepense()
    {
        $id = (int)$_POST['depenseId'];
        $manager = new DepenseManager(new PDOFactory());
        $manager->deleteDepense($id);
    }
}