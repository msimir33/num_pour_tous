<?php


/*ROUTES ET ARBORESCENCE*/

return [
    '/' => [
        'App\Controllers\HomeController',
        'index'
    ],
    '/posts' => [
        'App\Controllers\PostController',
        'index'
    ],
    '/trainings' => [
        'App\Controllers\TrainingController',
        'index'
    ],
    '/register' => [
        'App\Controllers\UserController',
        'register'
    ],
    '/login' => [
        'App\Controllers\UserController',
        'login'
    ],
    '/myaccount' => [
        'App\Controllers\UserController',
        'myaccount'
    ],
    '/users/store' => [
        'App\Controllers\UserController',
        'store'
    ],
    '/users/auth' => [
        'App\Controllers\UserController',
        'auth'
    ],
    '/logout' => [
        'App\Controllers\UserController',
        'logout'
    ]
];