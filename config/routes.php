<?php

return [
    '/' => [
        'App\Controllers\HomeController',
        'index'
    ],
    '/posts' => [
        'App\Controllers\PostController',
        'index'
    ],
    '/posts/show' => [
        'App\Controllers\PostController',
        'show'
    ],
    '/posts/create' => [
        'App\Controllers\PostController',
        'create'
    ],
    '/posts/store' => [
        'App\Controllers\PostController',
        'store'
    ],
    '/register' => [
        'App\Controllers\UserController',
        'register'
    ],
    '/login' => [
        'App\Controllers\UserController',
        'login'
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