<?php

include_once __DIR__ . '/../Model/UserModel.php';

class UserController
{
    public $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function index()
    {
        include_once __DIR__ . '/../View/Index.php';
    }

    public function newUser()
    {
        $user = new UserModel();
        if(isset($_REQUEST['id'])) {
            $user = $this->model->getSingleId($_REQUEST['id']);
        }

        include_once __DIR__ . '/../View/Add.php';
    }

    public function add()
    {
        $user = new UserModel();
        $user->id = $_POST['id'];
        $user->name = $_POST['name'];
        $user->email = $_POST['email'];
        $user->gender = $_POST['gender'];
        $user->status = $_POST['status'];

        if($user->id > 0) {
            $this->model->updateData($user);
        } else {
            $this->model->addUser($user);
        }

        header("Location: index.php");
    }

    public function delete()
    {
        $this->model->deleteUser($_REQUEST['id']);

        header("Location: index.php");
    }
}