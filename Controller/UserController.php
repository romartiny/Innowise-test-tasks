<?php

namespace App\Controller;

use App\UserModel\UserModel as UserModel;
use App\Controller\Controller as Controller;

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../Model/UserModel.php';

class UserController extends Controller
{
    public string $email;
    public string $password;
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
        $this->twigIndex();
    }

    public function getData()
    {
        $this->email = $_POST['email'];
        $this->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    }

    public function login()
    {
        $this->getData();
        $email = $this->email;
        $password = $this->password;
        $answer = $this->model->isCorrect($email, $password);
//        if ($answer === 1) {
//            $answer = 'Login Done';
//        } else {
//            $answer = 'Login is incorrect.';
//        }
        $this->twigResult($answer);
    }
}
