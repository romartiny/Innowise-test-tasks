<?php

namespace App\Controller;

require_once __DIR__ . './../vendor/autoload.php'; //?

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller
{
    public function twigIndex()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $twig = new Environment($loader);

        echo $twig->render('login.html.twig');
    }

    public function twigResult($answer)
    {
    $loader = new FilesystemLoader(__DIR__ . '/../View');
    $twig = new Environment($loader);

    echo $twig->render('login.html.twig', [
        'answer' => $answer
    ]);
}
}
