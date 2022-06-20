<?php

namespace App;

require_once __DIR__ . '/Controller/UserController.php';

use App\Controller\UserController;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

$controller = new UserController();
try {
    $controller->init();
} catch (LoaderError|RuntimeError|SyntaxError $e) {
}