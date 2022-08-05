<?php

namespace App\Controllers;

use Library\Core\AbstractController;
use App\Models\PostModel;
/*use Library\Http\NotFoundException;*/

class PostController extends AbstractController
{
    public function index(): void
    {
        $model = new PostModel();
        $posts = $model->findAll();

        if (isset($_POST['post-btn'])) {
            $model->update_post($_SESSION['user_id'], $_POST['post_id']);
            $this->redirect('/myaccount');
        }

        $this->display('posts/index', [
            'posts' => $posts
        ]);
    }

}