<?php

return [
    '/' => [
        'App\Controllers\HomeController',
        'index'
    ],
    '/events' => [
        'App\Controllers\EventController',
        'index'
    ],
    '/events/show' => [
        'App\Controllers\EventController',
        'show'
    ],
    '/events/create' => [
        'App\Controllers\EventController',
        'create'
    ],
    '/events/store' => [
        'App\Controllers\EventController',
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