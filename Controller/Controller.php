<?php

<<<<<<< HEAD
namespace App\Controller;

require_once __DIR__ . './../vendor/autoload.php';

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class Controller
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function twigIndex()
=======
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/../vendor/autoload.php';

class Controller
{
    public function twigIndex($users)
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $twig = new Environment($loader);

        echo $twig->render('index.html.twig', ['users' => $users]);
    }

    public function twigEdit($user, $gender, $status)
>>>>>>> master
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $twig = new Environment($loader);

<<<<<<< HEAD
        echo $twig->render('login.html.twig');
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function twigResult($answer)
=======
        echo $twig->render('edit.html.twig', [
            'user' => $user,
            'gender' => $gender,
            'status' => $status
            ]);
    }

    public function twigAdd($gender, $status)
>>>>>>> master
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $twig = new Environment($loader);

<<<<<<< HEAD
        echo $twig->render('login.html.twig', [
            'answer' => $answer
=======
        echo $twig->render('add.html.twig', [
            'gender' => $gender,
            'status' => $status
>>>>>>> master
        ]);
    }
}
