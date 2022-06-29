<?php

namespace App\Controller;

require_once __DIR__ . './../vendor/autoload.php'; //?

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class Controller
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function twigResult($fileName, $fileSize, $fileExif, $dataFiles, $extends)
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $twig = new Environment($loader);


        echo $twig->render('login.html.twig');
    }

    /**
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function twigResult($answer)
        echo $twig->render('index.html.twig', [
            'name' => $fileName,
            'size' => $fileSize,
            'exif' => $fileExif,
            'data' => $dataFiles,
            'extends' => $extends
            ]);
    }

    public function twigIndex($dataFiles, $extends)
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $twig = new Environment($loader);


        echo $twig->render('login.html.twig', [
            'answer' => $answer
        echo $twig->render('index.html.twig', [
            'data' => $dataFiles,
            'extends' => $extends
        ]);
    }
}
