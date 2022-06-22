<?php

namespace App\Controllers;

use Library\Core\AbstractController;

class HomeController extends AbstractController
{
    public function index(): void
    {
        $this->display('homepage');
    }
}