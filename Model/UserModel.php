<?php

namespace App\UserModel;

require_once __DIR__ . '/../Config/DatabaseConfig.php';

use App\DatabaseConfig\DatabaseConfig;

class UserModel
{
    public DatabaseConfig $connect;

    public function __construct()
    {
        $this->connect = new DatabaseConfig();
    }

    public function addUser($email, $firstName, $lastName, $password): void
    {
        try {
            $query = 'INSERT INTO users (email, first_name, last_name, password) VALUES (?,?,?,?)';
            $this->connect->prepare($query)->execute(array($email, $firstName, $lastName, $password));
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function checkUser($email, $password)
    {
        try {
            $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $res = $this->connect->prepare($query);
            $res->execute();
            $count = $res->rowCount();
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
        return $count;
    }

}
