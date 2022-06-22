<?php

namespace App\Models;

use Library\Core\AbstractModel;

class UserModel extends AbstractModel
{
    /**
     * Crée un utilisateur en base de données
     * 
     * @param array $data Les données de l'utilisateur à insérer
     * @return ?int L'id de l'utilisateur créé ou null
     */
    public function create(array $data): ?int
    {
        $userId = $this->db->execute('INSERT INTO users (user_firstname, user_lastname, user_email, user_password) VALUES (:user_firstname, :user_lastname, :user_email, :user_password)', [
            'user_firstname' => $data['user_firstname'],
            'user_lastname' => $data['user_lastname'],
            'user_email' => $data['user_email'],
            'user_password' => $data['user_password']
        ]);
        
        if ($userId === false) {
            return null;
        }
        
        return $userId;
    }
    
    public function findByUserLastName(string $user_lastname): ?array
    {
        $user = $this->db->getResults(
            'SELECT user_id, user_firstname, user_lastname, user_email, user_password, user_creation_date 
            FROM users
            WHERE user_lastname = :user_lastname', [
                'user_lastname' => $user_lastname    
            ]
        );
        
        if (empty($user)) {
            return null;
        }
        
        return $user[0];
    }
}