<?php

namespace App\Controllers;

use Library\Core\AbstractController;
use App\Models\UserModel;

class UserController extends AbstractController
{
    public function register(): void
    {
        if (auth()->isAuthenticated()) {
            $this->redirect('/');
        }
        
        $this->display('users/register');
    }
    
    public function store(): void
    {
        if (auth()->isAuthenticated()) {
            $this->redirect('/');    
        }
        
        $model = new UserModel();
        $user = $model->findByUsername($_POST['user_name']);
        
        $errors = $this->validForm($_POST);
        
        if (! empty($user)) {
            $errors['user_name'] = "Cet utilisateur existe déjà";
        }
        
        if (count($errors) > 0) {
            $_SESSION['error'] = $errors;
            $this->redirect('/register');
        }
        
        $model->create([
            'user_name' => $_POST['user_name'],
            'user_email' => $_POST['user_email'],
            'user_password' => password_hash($_POST['user_password'], PASSWORD_ARGON2ID)
        ]);
        
        $this->redirect('/');
    }
    
    private function validForm(array $data): array
    {
        $errors = [];
        
        if (empty($data['user_name'])) {
            $errors['user_name'] = "Le nom utilisateur ne doit pas être vide";    
        }
        
        if (strlen($data['user_password']) < 6) {
            $errors['user_password'] = "Le mot de passe doit faire au-moins 6 caractères";
        }
        
        return $errors;
    }
    
    public function login(): void
    {
        if (auth()->isAuthenticated()) {
            $this->redirect('/');    
        }
        
        $this->display('users/login');
    }
    
    public function auth(): void
    {
        if (auth()->isAuthenticated()) {
            $this->redirect('/');    
        }
        
        $model = new UserModel();
        $user = $model->findByUserName($_POST['user_name']);
        
        if ($user === null) {
            $_SESSION['error'] = [
                'user_name' => 'Les identifiants sont incorrects'   
            ];
            
            $this->redirect('/login');
        }
        
        if (! password_verify($_POST['user_password'], $user['user_password'])) {
            $_SESSION['error'] = [
                'user_name' => 'Les identifiants sont incorrects'   
            ];
            
            $this->redirect('/login');
        }
        
        auth()->login($user['id']);
        
        $this->redirect('/');
    }
    
    public function logout(): void
    {
        auth()->logout();
        $this->redirect('/');
    }
}