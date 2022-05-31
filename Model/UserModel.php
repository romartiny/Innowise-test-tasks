<?php

require_once __DIR__ . '/../Model/DatabaseConfig.php';

class UserModel extends DatabaseConfig {
    public $connect;
    public $id;
    public $name;
    public $email;
    public $gender;
    public $status;

    public function __construct()
    {
        $this->connect = DatabaseConfig::connection();
    }

    public function getSingleId($id)
    {
        try {
            $query = "SELECT * FROM users WHERE id=?";
            $stmt = $this->connect->prepare($query);
            $stmt->execute(array($id));
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function updateData($data)
    {
        try {
            $query = "UPDATE users SET name = ?, email = ?, gender = ?, status = ? WHERE id=?";
            $this->connect->prepare($query)->execute(array($data->name, $data->email, $data->gender, $data->status, $data->id));
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function getData()
    {
        try {
            $query = "SELECT * FROM users";
            $stmt = $this->connect->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function addUser(UserModel $data)
    {
        try {
            $query = "INSERT into users (name, email, gender, status) VALUES (?,?,?,?)";
            $this->connect->prepare($query)->execute(array($data->name, $data->email, $data->gender, $data->status));
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function deleteUser($id)
    {
        try {
            $query = "DELETE FROM users WHERE id=?";
            $stmt = $this->connect->prepare($query);
            $stmt->execute(array($id));
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }

}