<?php

namespace App;

use App\Controller\UserController as UserController;

require_once __DIR__ . '/Controller/UserController.php';

$controller = new UserController();
$controller->init();