<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\BaseModel;

class UserController extends BaseModel
{
    public $id;
    public $name;
    public $email;
    public $gender;
    public $status;

    private $_userModel;

    public function __construct(User $userModel)
    {
        $this->name = $_POST['name'];
        $this->email = $_POST['email'];
        $this->gender = $_POST['gender'];
        $this->status = $_POST['status'];

        $this->_userModel = $userModel;
    }

}

//
//$user = new UserController();
//$user->store("SELECT * FROM users");