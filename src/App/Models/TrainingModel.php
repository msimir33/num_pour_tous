<?php

namespace App\Models;

use DateTime;
use Library\Core\AbstractModel;

class TrainingModel extends AbstractModel
{
    private int $training_id;
    private string $training_type;
    private string $training_title;
    private string $training_content;
    private DateTime $training_startdate;

    public function findAll(): array
    {
        return $this->db->getResults(
            'SELECT training_id, training_type, training_title, training_content, training_startdate 
            FROM trainings
            ORDER BY training_startdate'
        );
    }
    
    public function findByTrainingId(int $training_id): ?array
    {
        $results = $this->db->getResults(
            'SELECT training_id, training_type, training_title, training_content, training_startdate 
            FROM trainings
            WHERE training_id = :training_id', 
            [
                'training_id' => $training_id   
            ]   
        );
        
        if (empty($results)) {
            return null;
        }
        
        return $results[0];
    }
    
    public function update_training(int $user_id, int $training_id): ?int {

        return $this->db->execute('UPDATE trainings SET reserved_user_id2 = :reserved_user_id2 WHERE training_id = :training_id', [
            'reserved_user_id2'=> $user_id,
            'training_id' => $training_id
        ]);
    }
    
}