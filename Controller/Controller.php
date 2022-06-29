<?php

namespace App\Controller;

require_once __DIR__ . './../vendor/autoload.php';

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Loader\FilesystemLoader;

class Controller
{
    public function twigHead()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $twig = new Environment($loader);

        echo $twig->render('login.html.twig');
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function twigIndex()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $twig = new Environment($loader);

        echo $twig->render('login.html.twig');
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function twigLoginResult($result, $sessionEmail)
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $twig = new Environment($loader);

        echo $twig->render('login.html.twig', [
            'result' => $result,
            'emailSession' => $sessionEmail
        ]);
    }

    //REGISTER

    public function twigRegister()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $twig = new Environment($loader);

        echo $twig->render('register.html.twig');
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function twigRegisterResult($answer, $firstNameSession, $lastNameSession, $emailSession, $confEmailSession)
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $twig = new Environment($loader);

        echo $twig->render('register.html.twig', [
            'answer' => $answer,
            'firstName' => $firstNameSession,
            'lastName' => $lastNameSession,
            'email' => $emailSession,
            'confEmail' => $confEmailSession
        ]);
    }

    //DATA

    public function twigFileResult($fileName, $fileSize, $fileExif, $dataFiles, $extends)
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $twig = new Environment($loader);

        echo $twig->render('upload.html.twig', [
            'name' => $fileName,
            'size' => $fileSize,
            'exif' => $fileExif,
            'data' => $dataFiles,
            'extends' => $extends
        ]);
    }

    public function twigFile($dataFiles, $extends)
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $twig = new Environment($loader);

        echo $twig->render('upload.html.twig', [
            'data' => $dataFiles,
            'extends' => $extends
        ]);
    }
}
