<?php

include_once __DIR__ . '/../Model/UserModel.php';
include_once __DIR__ . '/../index.php';

class UserController
{
    public UserModel $model;
    public $table;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function init(): void
    {
        if (!isset($_REQUEST['action'])) {
            $this->index();
        } else {
            $action = $_REQUEST['action'];
            $this->$action();
        }
    }

    public function index(): void
    {
        $this->getUserData();
        require_once __DIR__ . '/../View/index.php';
    }

    public function create(): void
    {
        require_once __DIR__ . '/../View/add.php';
    }

    public function edit(): void
    {
        if (isset($_REQUEST['id'])) {
            $user = $this->model->getSingleId($_REQUEST['id']);
        }
//
        require_once __DIR__ . '/../View/edit.php';
    }

    public function add(): void
    {
        $this->model->addUser();

        header("Location: index.php");
        exit();
    }

    public function editor(): void
    {
        $this->model->updateData($_POST);

        header("Location: index.php");
        exit();
    }

    public function delete(): void
    {
        $this->model->deleteUser($_REQUEST['id']);

        header("Location: index.php");
        exit();
    }

    public function getUserData()
    {
        $this->table = json_decode($this->model->getData());
        return $this->table;
    }
}