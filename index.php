<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/Controller/UserController.php';
require_once __DIR__ . '/vendor/autoload.php';

$controller = new UserController();
$controller->init();
$controller->getUserData();
