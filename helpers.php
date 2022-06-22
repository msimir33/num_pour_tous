<?php

use Library\Session\Flashbag;
use Library\Auth\Authentifier;

function url(string $path): string
{
    return $_SERVER['SCRIPT_NAME'] . $path;
}

function dd(...$vars): void
{
    var_dump(...$vars);
    exit();
}

function flash(): Flashbag
{
    return new Flashbag();
}

function auth(): Authentifier
{
    return new Authentifier();
}