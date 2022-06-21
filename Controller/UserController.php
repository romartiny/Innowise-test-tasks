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
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $confEmail;
    public string $password;
    public string $confPassword;

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

    public function registerForm()
    {
        $this->twigRegister();
    }

    public function getRegisterData()
    {
        $this->firstName = $_POST['first-name'];
        $this->lastName = $_POST['last-name'];
        $this->email = $_POST['email'];
        $this->confEmail = $_POST['conf-email'];
        $this->password = $_POST['password'];
        $this->confPassword = $_POST['conf-password'];
    }

    public function isSame(): bool
    {
        if ($this->email === $this->confEmail && $this->password === $this->confPassword) {
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword(): bool
    {
        $regex = '/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%&]).*$/';
        if (strlen($this->password) >= 6 && preg_match($regex, $this->password)) {
            return true;
        }

        return false;
    }

    public function cryptPassword(): string
    {
        return $this->password = md5($this->password);
    }

    public function addUser()
    {
        $email = $this->email;
        $firstName = $this->firstName;
        $lastName = $this->lastName;
        $password = $this->password;
        $this->model->addUser($email, $firstName, $lastName, $password);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function register()
    {
        $this->getRegisterData();
        if ($this->isSame() === true) {
            if ($this->checkPassword() === true) {
                $this->cryptPassword();
                $this->addUser();
                $answer = 'Created Successfully';
            } else {
                $answer = 'Your password dont fit the rules';
            }
        } else {
            $answer = 'Your passwords is not the same';
        }
        $this->twigResult($answer);
    }

    public function getLoginData()
    {
        $this->email = $_POST['email'];
        $this->password = $_POST['password'];
    }

    public function login()
    {
        $this->getLoginData();
        $email = $this->email;
        $password = $this->password;
        $res = $this->model->checkUser($email, $password);
        print_r($res);
        if ($res > 0) {
            echo $email;
            echo $password;
            echo 'fsasfa';
            print_r($this->model->checkUser($email, $password));
        } else {
            echo $email;
            echo $password;
            echo count([$this->model->checkUser($email, $password)]);
        }
    }
}
