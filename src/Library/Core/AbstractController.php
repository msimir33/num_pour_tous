<?php

namespace Library\Core;

class AbstractController
{

    /*MODELE ABSTRAIT DU CONTROLLER*/

    public function display(string $template, array $data = [], string $layout = 'layout'): void
    {
        
        /*TRANSFORMATION DES CLES DU TABLEAU $data EN VARIABLE*/
        extract($data);
        
        /*INTEGRATION DU NOM DE LA VUE A AFFICHER*/
        require "src/App/Views/$layout.phtml";

    }
    
    /*MODELE DE REDIRECTION DES ROUTES*/

    public function redirect(string $path): void
    {
        header('Location: ' . url($path));
        exit();
    }
}