<?php

require_once __DIR__ . '/../Config/DatabaseConfig.php';

class UserModel
{
    public $id;
    public string $name;
    public string $email;
    public string $gender;
    public string $status;
    public DatabaseConfig $connect;

    public function __construct()
    {
        return $this->connect = new DatabaseConfig();
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

    public function updateData($data): void
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

    public function addUser(UserModel $data): void
    {
        try {
            $query = "INSERT into users (name, email, gender, status) VALUES (?,?,?,?)";
            $this->connect->prepare($query)->execute(array($data->name, $data->email, $data->gender, $data->status));
        } catch (Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function deleteUser(int $id): void
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