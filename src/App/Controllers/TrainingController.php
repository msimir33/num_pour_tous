<?php

namespace App\Controllers;

use Library\Core\AbstractController;
use Library\Http\NotFoundException;
use App\Models\TrainingModel;

class TrainingController extends AbstractController
{
    public function index(): void
    {
        $model = new TrainingModel();
        $trainings = $model->findAll();
        
        $this->display('trainings/index', [
            'trainings' => $trainings    
        ]);
    }
    
    public function show(): void
    {
        $id = $_GET['id'];
        $model = new TrainingModel();
        $training = $model->find($id);
        
        if ($training === null) {
            throw new NotFoundException("La session de formation n'existe pas");
        }
        
        $this->display('trainings/show', [
            'training' => $training  
        ]);
    }
    
    public function create(): void
    {
        $this->display('trainings/create');
    }
    
    public function store(): void
    {
        $model = new TrainingModel();
        
        $id = $model->create([
            'training_title' => $_POST['training_title'],
            'training_content' => $_POST['training_content'],
            'training_startdate' => $_POST['training_startdate']
        ]);
        
        $this->redirect('/trainings');
    }
}