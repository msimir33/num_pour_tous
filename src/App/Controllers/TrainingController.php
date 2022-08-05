<?php

namespace App\Controllers;

use Library\Core\AbstractController;
use App\Models\TrainingModel;
/*use Library\Http\NotFoundException;*/

class TrainingController extends AbstractController
{
    public function index(): void
    {
        $model = new TrainingModel();
        $trainings = $model->findAll();

        if (isset($_POST['training-btn'])) {
            $model->update_training($_SESSION['user_id'], $_POST['training_id']);
            $this->redirect('/myaccount');
        }
        
        $this->display('trainings/index', [
            'trainings' => $trainings    
        ]);
    }
    
}