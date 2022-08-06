<?php

namespace App\Controllers;

use Library\Core\AbstractController;

class HomeController extends AbstractController
{
    /*AFFICHAGE DE LA PAGE D'ACCUEIL EN PASSANT PAR LE FICHIER routes.php*/

    public function index(): void
    {
        $this->display('homepage');
    }
}
