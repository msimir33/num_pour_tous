<?php

namespace App\Models;

use DateTime;
use Library\Core\AbstractModel;

class PostModel extends AbstractModel
{
    private int $post_id;
    private string $post_title;
    private string $post_content;
    private DateTime $post_creation_date;

    public function findAll(): array
    {
        return $this->db->getResults(
            'SELECT post_id, post_title, post_content, post_creation_date, reserved_user_id
            FROM posts
            ORDER BY post_creation_date'
        );
    }

    public function findByPostId(int $post_id): ?array
    {
        $results = $this->db->getResults(
            'SELECT post_id, post_title, post_content, post_creation_date
            FROM posts
            WHERE post_id = :post_id', [
                'post_id' => $post_id
            ]
        );

        if (empty($results)) {
            return null;
        }

        return $results[0];
    }

    public function getuser_id(int $user_id): ?int
    {
        $results = $this->db->getResults(
            'SELECT user_id
            FROM users
            WHERE user_id = :user_id',
            [
                'user_id' => $user_id
            ]
        );

        if (empty($results)) {
            return null;
        }

        return $results[0]['user_id'];
    }

    public function update_post(int $user_id, int $post_id): ?int {

        return $this->db->execute('UPDATE posts SET reserved_user_id = :reserved_user_id WHERE post_id = :post_id', [
            'reserved_user_id'=> $user_id,
            'post_id' => $post_id
        ]);
    }
    
}