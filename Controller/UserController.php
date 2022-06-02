<?php

use JetBrains\PhpStorm\NoReturn;

include_once __DIR__ . '/../Model/UserModel.php';

class UserController
{
    public UserModel $model;
    public array $table;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function init(): void
    {
        $controller = new UserController();
        if (!isset($_REQUEST['action'])) {
            $controller->index();
        } else {
            $action = $_REQUEST['action'];
            $controller->$action();
        }
        $this->getUserData();
    }

    public function index(): void
    {
        $this->getUserData();
        require_once __DIR__ . '/../View/Index.php';
    }

    public function create(): void
    {
        $user = new UserModel();

        require_once __DIR__ . '/../View/add.php';
    }

    public function edit(): void
    {
        $user = new UserModel();
        if (isset($_REQUEST['id'])) {
            $user = $this->model->getSingleId($_REQUEST['id']);
        }
//
        require_once __DIR__ . '/../View/edit.php';
    }

    #[NoReturn] public function add(): void
    {
        $this->model->name = $_POST['name'];
        $this->model->email = $_POST['email'];
        $this->model->gender = $_POST['gender'];
        $this->model->status = $_POST['status'];
        $this->model->addUser($this->model);

        header("Location: index.php");
        exit();
    }

    #[NoReturn] public function editor(): void
    {
        $this->model->id = $_POST['id'];
        $this->model->name = $_POST['name'];
        $this->model->email = $_POST['email'];
        $this->model->gender = $_POST['gender'];
        $this->model->status = $_POST['status'];
        $this->model->updateData($this->model);

        header("Location: index.php");
        exit();
    }

    #[NoReturn] public function delete(): void
    {
        $this->model->deleteUser($_REQUEST['id']);

        header("Location: index.php");
        exit();
    }

    public function getUserData() : array
    {
        $this->table = $this->model->getData();
        return $this->table;
    }
}