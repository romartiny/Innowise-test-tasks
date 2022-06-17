<?php

namespace App\Controller;

use App\UserModel\UserModel as UserModel;
use App\Controller\Controller as Controller;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

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

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function init(): void
    {
        if (!isset($_REQUEST['action'])) {
            $this->index();
        } else {
            $action = $_REQUEST['action'];
            $this->$action();
        }
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function index()
    {
        $this->twigIndex();
    }

    public function getData()
    {
        $this->email = $_POST['email'];
        $this->password = $_POST['password'];
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function login()
    {
        $this->getData();
        $email = $this->email;
        $password = $this->password;
        $answer = $this->model->isCorrect($email, $password);
        if (!empty($answer)) {
            $answer = 'Welcome back, ' . $answer;
        } else {
            $answer = 'Login is incorrect.';
        }
        $this->twigResult($answer);
    }
}
