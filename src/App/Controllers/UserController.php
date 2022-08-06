<?php

namespace App\Controllers;

use Library\Core\AbstractController;
use App\Models\UserModel;
use App\Models\PostModel;
use App\Models\TrainingModel;

class UserController extends AbstractController
{
    /*FONCTION PERMETTANT DE REDIRIGER L'UTILSATEUR VERS LA PAGE D'ACCUEIL UNE FOIS L'INSCRIPTION VALIDEE*/

    public function register(): void
    {
        if (auth()->isAuthenticated()) {
            $this->redirect('/');
        }

        $this->display('users/register');
    }

    /*FONCTION PERMETTANT :
    -> D'AFFICHER UNE ERREUR LORSQUE L'UTILISATEUR RENTRE UN EMAIL QUI EXISTE DEJA EN BDD PENDANT L'INSCRIPTION
    -> D'ATTRIBUER LES INFRMATIONS D'INSCRIPTION AUX CHAMPS DE LA TABLE USERS*/

    public function store(): void
    {
        if (auth()->isAuthenticated()) {
            $this->redirect('/');
        }

        $model = new UserModel();
        $user = $model->findByUserEmail($_POST['user_email']);

        $errors = $this->validForm($_POST);

        if (!empty($user)) {
            $errors['user_email'] = "Cet utilisateur existe déjà";
        }

        if (count($errors) > 0) {
            $_SESSION['error'] = $errors;
            $this->redirect('/register');
        }

        $model->create([
            'user_name' => $_POST['user_name'],
            'user_email' => $_POST['user_email'],
            'user_address' => $_POST['user_address'],
            'user_income' => $_POST['user_income'],
            'user_password' => (password_hash($_POST['user_password'], PASSWORD_ARGON2ID))
        ]);

        $this->redirect('/');
    }

    /*FONCTION PERMETTANT DE VERIFIER ET VALIDER LE FORMULAIRE D'INSCRIPTION*/

    private function validForm(array $data): array
    {
        $errors = [];

        if (empty($data['user_email'])) {
            $errors['user_email'] = "Le nom d'utilisateur ne doit pas être vide";
        }

        if (strlen($data['user_password']) < 6) {
            $errors['user_password'] = "Le mot de passe doit faire au moins 6 caractères";
        }

        return $errors;
    }

    /*FONCTION PERMETTANT D'AFFICHER LA PAGE D'AUTHENTIFICATION*/

    public function login(): void
    {
        if (auth()->isAuthenticated()) {
            $this->redirect('/');
        }

        $this->display('users/login');
    }

    /* FONCTION PERMETTANT DE GERER LES ERREURS D'AUTHENTIFICATION*/

    public function auth(): void
    {
        if (auth()->isAuthenticated()) {
            $this->redirect('/');
        }

        $model = new UserModel();
        $user = $model->findByUserEmail($_POST['user_email']);

        if ($user === null) {
            $_SESSION['error'] = [
                'user_email' => 'Les identifiants sont incorrects'
            ];

            $this->redirect('/login');
        }

        if (!password_verify($_POST['user_password'], $user['user_password'])) {
            $_SESSION['error'] = [
                'user_email' => 'Les identifiants sont incorrects'
            ];

            $this->redirect('/login');
        }

        auth()->login($user['user_id']);

        $this->redirect('/');
    }

    /*FONCTION PERMETTANT DE VALIDER LA DECONNEXION DE L'UTILISATEUR*/

    public function logout(): void
    {
        auth()->logout();
        $this->redirect('/');
    }

    public function myaccount(): void
    {
        $postManager = new PostModel();
        $trainingManager = new TrainingModel();
        $this->display('users/myaccount',[
            'posts' => $postManager->findAll(),
            'trainings' => $trainingManager->findAll()
        ]);
    }
}
