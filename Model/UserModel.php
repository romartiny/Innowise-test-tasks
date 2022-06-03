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

    public function updateData(): void
    {
        $this->id = $_POST['id'];
        $this->name = $_POST['name'];
        $this->email = $_POST['email'];
        $this->gender = $_POST['gender'];
        $this->status = $_POST['status'];
        try {
            $query = "UPDATE users SET name = ?, email = ?, gender = ?, status = ? WHERE id=?";
            $this->connect->prepare($query)->execute(array($this->name, $this->email, $this->gender, $this->status, $this->id));
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

    public function addUser(): void
    {
        $this->name = $_POST['name'];
        $this->email = $_POST['email'];
        $this->gender = $_POST['gender'];
        $this->status = $_POST['status'];
        try {
            $query = "INSERT into users (name, email, gender, status) VALUES (?,?,?,?)";
            $this->connect->prepare($query)->execute(array($this->name, $this->email, $this->gender, $this->status));
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