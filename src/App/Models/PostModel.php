<?php

namespace App\Models;

use Library\Core\AbstractModel;

class PostModel extends AbstractModel
{
    public function findAll(): array
    {
        return $this->db->getResults(
            'SELECT post_id, post_title, post_content, post_creation_date
            FROM posts
            ORDER BY post_creation_date'
        );
    }

    public function find(int $id): ?array
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

    public function getUserId(int $id): ?int
    {
        $results = $this->db->getResults(
            'SELECT user_id
            FROM users
            WHERE user_id = :user_id',
            [
                'user_id' => $id
            ]
        );

        if (empty($results)) {
            return null;
        }

        return $results[0]['user_id'];
    }

    public function create(array $data): ?int
    {
        $userId = $this->getUserId(auth()->isAuthenticated());
        $result = $this->db->execute(
            'INSERT INTO posts (post_title, post_content, post_creation_date) VALUES (:post_title, :post_content, :post_creation_date)', [
                'post_title' => $data['post_title'],
                'post_content' => $data['post_content'],
                'post_creation_date' => $data['post_creation_date'],
                'user_id' => $userId
            ]
        );
        die($result);

        if ($result === false) {
            return null;
        }

        return (int)$result;
    }
}