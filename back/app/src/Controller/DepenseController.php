<?php

namespace App\Controller;

use App\Factory\PDOFactory;
use App\Manager\DepenseManager;
use App\Entity\Depense;

class DepenseController extends AbstractController {

    public function ajtDepense()
    {
        echo 'Je suis la fonction ajtDepense !!!';
    }

    public function suprDepense()
    {
        echo 'Je suis la fonction suprDepense !!!';
    }

    public function modifDepense()
    {
        echo 'Je suis la fonction modifier une depense !!!';
    }

    public function recapDepense()
    {
        echo 'Je suis la fonction récapitulatif de toutes les depenses !!!';
    }
}