<?php

namespace App\UserModel;

require_once __DIR__ . '/../Config/DatabaseConfig.php';

use App\DatabaseConfig\DatabaseConfig;

class UserModel
{
    public Config $config;

    public function __construct()
    {
        $this->connect = new DatabaseConfig();
    }

    public function uploadFile($fileTmpName, $fileDestination)
    {
        try {
            $query = 'INSERT INTO users (email, first_name, last_name, password) VALUES (?,?,?,?)';
            $this->connect->prepare($query)->execute(array($email, $firstName, $lastName, $password));
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }

}
