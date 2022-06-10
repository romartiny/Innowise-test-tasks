<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/../vendor/autoload.php';

class Controller
{
    public function twigResult($fileName, $fileSize, $fileExif)
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $twig = new Environment($loader);

        echo $twig->render('index.html.twig', [
            'name' => $fileName,
            'size' => $fileSize,
            'exif' => $fileExif
            ]);
    }

    public function twigIndex()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../View');
        $twig = new Environment($loader);

        echo $twig->render('index.html.twig');
    }
}
