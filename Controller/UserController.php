<?php

include_once __DIR__ . '/../Model/UserModel.php';
include_once __DIR__ . '/../index.php';

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
        $controller = new UserController(); //idk how to resolve
        if (!isset($_REQUEST['action'])) {
            $controller->index();
        } else {
            $action = $_REQUEST['action'];
            $controller->$action();
        }
    }

    public function index(): void
    {
        $this->getUserData();
        require_once __DIR__ . '/../View/Index.php';
    }

    public function create(): void
    {
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

    public function add(): void
    {
        $this->model->name = $_POST['name']; //$_POST -> logic in controller
        $this->model->email = $_POST['email'];
        $this->model->gender = $_POST['gender'];
        $this->model->status = $_POST['status'];
        $this->model->addUser($this->model);

        header("Location: index.php");
        exit();
    }

    public function editor(): void
    {
        $this->model->id = $_POST['id']; //$_POST -> logic in controller
        $this->model->name = $_POST['name'];
        $this->model->email = $_POST['email'];
        $this->model->gender = $_POST['gender'];
        $this->model->status = $_POST['status'];
        $this->model->updateData($this->model);

        header("Location: index.php");
        exit();
    }

    public function delete(): void
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