<?php

use Library\Http\NotFoundException;

try {
    /* Point d'entrée de l'application */
    
    // Démarrage de la session
    session_start();
    
    // Chargement des fonctions utilitaires
    require 'helpers.php';
    
    // Autoloader
    // Fonction appelée lorsque l'on essaie d'instancier une classe
    spl_autoload_register(function ($className) {
        // On change le sens des \ en /
        $fileName = str_replace('\\', '/', $className);
        
        // On inclut le fichier
        require "src/$fileName.php";
    });
    
    // Mise en place d'un routeur
    $route = $_SERVER['PATH_INFO'] ?? '/';
    
    // Récupération des routes de l'application
    $routes = require 'config/routes.php';
    
    if (isset($routes[$route])) {
        list($controllerName, $method) = $routes[$route];
        
        // Instanciation magique du contrôleur
        $controller = new $controllerName();
        $controller->$method();
    } else {
        throw new NotFoundException("La route n'existe pas");
    }
} catch (Exception $e) {
    if ($e instanceof NotFoundException) {
        // Page 404
        header("HTTP/1.1 404 Not Found");
        require 'src/App/Views/404.phtml';
    } else {
        // http_response_code(500);
    }
    
    // Gestion de l'erreur
    // Enregistrement dans un fichier de log : écriture dans un fichier log l'heure de l'erreur
    file_put_contents('logs/application.log', date('d/m/Y H:i:s') . " : " . $e->getMessage() . "\n", FILE_APPEND);
    exit();
}