<?php

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require_once __DIR__ . '/../Model/UserModel.php';
require_once __DIR__ . '/Controller.php';

class UserController extends Controller
{
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
        $this->getUserData();
        $this->twigIndex($this->table);
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
