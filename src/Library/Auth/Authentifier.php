<?php

namespace Library\Auth;

class Authentifier
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    
/*FONCTION PERMETTANT D'AUTHENTIFIER L'UTILISATEUR*/

    public function login(int $id): void
    {
        $_SESSION['user_id'] = $id;
    }
    
/*FONCTION PERMETTANT DE DECONNECTER L'UTILISATEUR*/

    public function logout(): void
    {
        unset($_SESSION['user_id']);
        session_destroy();
    }
    

    /*FONCTION PERMETTANT DE RECUPERER L'ID DE L'UTILISATEUR CONNECTE*/
    
    public function isAuthenticated(): bool
    {
        return isset($_SESSION['user_id']);
    }
}