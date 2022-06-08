<?php

require_once __DIR__ . '/../Model/UserModel.php';
require_once __DIR__ . '/Controller.php';

class UserController extends Controller
{
    public string $name;
    public string $email;
    public string $gender;
    public string $status;
    public array $result;
    public UserModel $model;
    public array $table;

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

    public function index()
    {
        $userData = $this->getUserData();
        $this->twigIndex($userData);
    }

    public function create(): void
    {
        require_once __DIR__ . '/../View/add.html.twig';
    }

    public function edit(): void
    {
        $user = $this->model->getSingleId($_REQUEST['id']);
        $user = json_decode($user);
        $this->twigEdit($user);
    }

    public function add(): void
    {
        $result = $this->getParam();
        $this->model->addUser($result);

        header("Location: index.php");
        exit();
    }

    public function editor(): void
    {
        $userId = $_POST['id'];
        $result = $this->getParam();
        $this->model->updateData($userId, $result);

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

    public function getParam(): array
    {
        $this->name = $_POST['name'];
        $this->email = $_POST['email'];
        $this->gender = $_POST['gender'];
        $this->status = $_POST['status'];
        $this->result = [
            "name" => "$this->name",
            "email" => "$this->email",
            "gender" => "$this->gender",
            "status" => "$this->status"
        ];

        return $this->result;
    }
}
