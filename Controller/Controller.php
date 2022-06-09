<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/../vendor/autoload.php';

class Controller
{
    public function twigIndex()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $twig = new Environment($loader);

        echo $twig->render('index.html.twig');
    }
}
