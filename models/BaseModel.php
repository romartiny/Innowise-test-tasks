<?php

namespace App\Models;

use App\Config\DatabaseConfig;
//use App\Controllers\UserController;

class BaseModel extends DatabaseConfig
{

    public function __construct()
    {
        parent::__construct();
    }

//    public function fetch($sql): array|false
//    {
//        $stmt = $this->con->query($sql);
//        return $stmt->fetch();
//    }

    public function getAllData()
    {
        $result = $this->con->query("SELECT * FROM users");
        $data = [];
        while ($row = $result->fetch(PDO::FETCH__ASSOC)) {
            $data[] = $row;
        }
        $this->closeDatabaseConnection();
        return $data;
    }

    public function addData()
    {
        $stmt = $this->con->prepare("INSERT INTO users(name, email, gender, status) VALUES(':name',':email',':gender',':status')");
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':status', $this->status);
        $stmt->execute();
        $this->closeDatabaseConnection();
    }

    public function updateData($id)
    {
        $stmt = $this->con->prepare("UPDATE users SET name = :name, email = :email, gender = :gender, status = :status WHERE id = :id");
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':gender', $this->gender);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':id', $this->$id);
        $stmt->execute();
        $this->closeDatabaseConnection();
    }

    public function deleteData($id)
    {
        $stmt = $this->con->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $this->$id);
        $stmt->execute();
        $this->closeDatabaseConnection();
    }
}
