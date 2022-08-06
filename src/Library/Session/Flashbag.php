<?php

namespace Library\Session;

class Flashbag
{

/*FONCTION PERMETTANT DE RECUPERER LES ERREURS ET D'AFFICHER UN MESSAGE CORRESPONDANT*/

    public function get(string $field): ?string
    {
        if (! isset($_SESSION['error'][$field])) {
            return null;
        }
        
        $message = $_SESSION['error'][$field];
        unset($_SESSION['error'][$field]);
        
        return $message;
    }
    
    public function has(string $field): bool
    {
        return isset($_SESSION['error'][$field]);
    }
}