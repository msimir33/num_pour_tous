<?php

namespace App\Controllers;

use Library\Core\AbstractController;
use App\Models\TrainingModel;

class TrainingController extends AbstractController
{
    /*AFFICHAGE DE LA PAGE DES FORMATIONS EN PASSANT PAR LE FICHIER routes.php*/

    public function index(): void
    {
        $model = new TrainingModel();
        $trainings = $model->findAll();

        /*EXECUTION DE LA FONCTION PERMETTANT D'ATTRIBUER UNE FORMATION A UN UTILISATEUR*/

        if (isset($_POST['reserve-training-btn'])) {
            $model->update_training($_SESSION['user_id'], $_POST['training_id']);
            $this->redirect('/myaccount');
        }

        $this->display('trainings/index', [
            'trainings' => $trainings
        ]);
    }
}
