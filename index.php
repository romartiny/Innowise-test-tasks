<?php

namespace App;

require_once __DIR__ . '/Controller/UserController.php';

use App\UserController\UserController;

$controller = new UserController();
$controller->init();