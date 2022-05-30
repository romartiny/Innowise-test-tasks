<?php
include_once __DIR__ . '/Controller/UserController.php';
include_once __DIR__ . '/Config/Config.php';
$controller = new UserController();

if(!isset($_REQUEST['action'])) {
    $controller->index();
} else {
    $action = $_REQUEST['action'];
    call_user_func(array($controller, $action));
}