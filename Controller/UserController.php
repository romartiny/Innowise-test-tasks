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
    public array $table;
    public UserModel $model;

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
        $gender = $this->getGenderList();
        $status = $this->getStatusList();
        $this->twigAdd($gender, $status);
    }

    public function edit(): void
    {
        $gender = $this->getGenderList();
        $status = $this->getStatusList();
        $user = $this->model->getSingleId($_REQUEST['id']);
        $user = json_decode($user);


        $this->twigEdit($user, $gender, $status);
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

    public function getGenderList(): array
    {
        return [
            'Male' => 'male',
            'Female' => 'female'
        ];
    }

    public function getStatusList(): array
    {
        return [
            'Active' => 'active',
            'Inactive' => 'inactive'
        ];
    }
}
