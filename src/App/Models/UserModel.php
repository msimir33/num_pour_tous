<?php

namespace App\Models;

use Library\Core\AbstractModel;

class UserModel extends AbstractModel
{

    public function create(array $data): ?int
    {
        $userId = $this->db->execute('INSERT INTO users (user_name, user_email, user_password) VALUES (:user_name, :user_email, :user_password)', [
            'user_name' => $data['user_name'],
            'user_email' => $data['user_email'],
            'user_password' => $data['user_password']
        ]);
        
        if ($userId === false) {
            return null;
        }
        
        return $userId;
    }
    
    public function findByUserName(string $user_name): ?array
    {
        $user = $this->db->getResults(
            'SELECT user_id, user_name, user_email, user_password, user_creation_date 
            FROM users
            WHERE user_name = :user_name', [
                'user_name' => $user_name    
            ]
        );
        
        if (empty($user)) {
            return null;
        }
        
        return $user[0];
    }
}