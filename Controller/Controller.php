<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/UserController.php';
require_once __DIR__ . '/../vendor/autoload.php';

class Controller
{
    public function twigIndex($users)
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $twig = new Environment($loader);

        echo $twig->render('index.html.twig', ['users' => $users]);
    }

    public function twigEdit($user)
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $twig = new Environment($loader);

        echo $twig->render('edit.html.twig', ['user' => $user]);
    }
}
