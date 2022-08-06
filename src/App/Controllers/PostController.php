<?php

namespace App\Controllers;

use Library\Core\AbstractController;
use App\Models\PostModel;

class PostController extends AbstractController

{
    /*AFFICHAGE DE LA PAGE DES ANNONCES EN PASSANT PAR LE FICHIER routes.php*/

    public function index(): void
    {
        $model = new PostModel();
        $posts = $model->findAll();

        /*EXECUTION DE LA FONCTION PERMETTANT D'ATTRIBUER UNE ANNONCE A UN UTILISATEUR*/
        
        if (isset($_POST['reserve-post-btn'])) {
            $model->update_post($_SESSION['user_id'], $_POST['post_id']);
            $this->redirect('/myaccount');
        }

        $this->display('posts/index', [
            'posts' => $posts
        ]);
    }
}
