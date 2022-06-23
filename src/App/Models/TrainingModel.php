<?php

namespace App\Models;

use Library\Core\AbstractModel;

class TrainingModel extends AbstractModel
{
    public function findAll(): array
    {
        return $this->db->getResults(
            'SELECT training_id, training_title, training_content, training_startdate 
            FROM trainings
            ORDER BY training_startdate'
        );
    }
    
    public function find(int $id): ?array
    {
        $results = $this->db->getResults(
            'SELECT training_id, training_title, training_content, training_startdate 
            FROM trainings
            WHERE training_id = :training_id', [
                'training_id' => $training_id    
            ]   
        );
        
        if (empty($results)) {
            return null;
        }
        
        return $results[0];
    }
    
    public function create(array $data): ?int
    {
        $result = $this->db->execute(
            'INSERT INTO trainings (training_title, training_content, training_startdate) VALUES (:training_title, :training_content, :training_startdate)', [
                'training_title' => $data['training_title'],
                'training_content' => $data['training_content'],
                'training_startdate' => $data['training_startdate']
            ]
        );
        
        if ($result === false) {
            return null;
        }
        
        return (int)$result;
    }
}