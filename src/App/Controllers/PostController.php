<?php

namespace App\Controllers;

use Library\Core\AbstractController;
use Library\Http\NotFoundException;
use App\Models\PostModel;

class PostController extends AbstractController
{
    public function index(): void
    {
        $model = new PostModel();
        $posts = $model->findAll();

        $this->display('posts/index', [
            'posts' => $posts
        ]);
    }

    public function show(): void
    {
        $id = $_GET['id'];
        $model = new PostModel();
        $post = $model->find($id);

        if ($post === null) {
            throw new NotFoundException("L'annonce n'existe pas");
        }

        $this->display('posts/show', [
            'post' => $post
        ]);
    }

    public function create(): void
    {
        $this->display('posts/create');
    }

    public function store(): void
    {
        if (!auth()->isAuthenticated()) {
            $this->redirect('/login');
        }
        $model = new PostModel();
        $model->create([
            'post_title' => $_POST['post_title'],
            'post_content' => $_POST['post_content'],
            'post_creation_date' => $_POST['post_creation_date'],
        ]);

        $this->redirect('/posts');
    }
}