<?php

namespace App\Models;

use DateTime;
use Library\Core\AbstractModel;

class TrainingModel extends AbstractModel
{
    public int $training_id;
    public string $training_type;
    public string $training_title;
    public string $training_content;
    public DateTime $training_startdate;
    public int $reserved_training;

    /*FONCTION PERMETTANT DE RECUPERER TOUS LES CHAMPS DE LA TABLE TRAININGS (FORMATIONS)*/

    public function findAll(): array
    {
        return $this->db->getResults(
            'SELECT training_id, training_type, training_title, training_content, training_startdate, reserved_training
            FROM trainings
            ORDER BY training_startdate'
        );
    }

    /*FONCTION PERMETTANT DE RECUPERER TOUS LES CHAMPS DE LA TABLE TRAININGS PAR SON ID*/

    public function findByTrainingId(int $training_id): ?array
    {
        $results = $this->db->getResults(
            'SELECT training_id, training_type, training_title, training_content, training_startdate, reserved_training
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

    /*FONCTION PERMETTANT D'ATTRIBUER UNE ANNONCE A UN UTILISATEUR*/

    public function update_training(int $user_id, int $training_id): ?int
    {

        return $this->db->execute('UPDATE trainings SET reserved_training = :reserved_training WHERE training_id = :training_id', [
            'reserved_training' => $user_id,
            'training_id' => $training_id
        ]);
    }
}
