<?php

namespace App\Models;

use DateTime;
use Library\Core\AbstractModel;

class PostModel extends AbstractModel
{
    public int $post_id;
    public string $post_title;
    public string $post_content;
    public DateTime $post_creation_date;
    public int $reserved_post;

    /*FONCTION PERMETTANT DE RECUPERER TOUS LES CHAMPS DE LA TABLE POSTS (ANNONCES)*/

    public function findAll(): array
    {
        return $this->db->getResults(
            'SELECT post_id, post_title, post_content, post_creation_date, reserved_post
            FROM posts
            ORDER BY post_creation_date'
        );
    }

    /*FONCTION PERMETTANT DE RECUPERER TOUS LES CHAMPS DE LA TABLE POSTS PAR SON ID*/

    public function findByPostId(int $post_id): ?array
    {
        $results = $this->db->getResults(
            'SELECT post_id, post_title, post_content, post_creation_date, reserved_post
            FROM posts
            WHERE post_id = :post_id',
            [
                'post_id' => $post_id
            ]
        );

        if (empty($results)) {
            return null;
        }

        return $results[0];
    }

    /*FONCTION PERMETTANT D'ATTRIBUER UNE ANNONCE A UN UTILISATEUR*/

    public function update_post(int $user_id, int $post_id): ?int
    {

        return $this->db->execute('UPDATE posts SET reserved_post = :reserved_post WHERE post_id = :post_id', [
            'reserved_post' => $user_id,
            'post_id' => $post_id
        ]);
    }
}
