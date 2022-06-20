<?php

namespace App\DatabaseConfig;

class DatabaseConfig
{
    public string $host = 'localhost';
    public string $hostname = 'root';
    public string $hostpass = 'root';
    public string $dbname = 'usermove';
    protected ?\PDO $conn = null;

    public function __construct()
    {
        try {
            $this->conn = new \PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4;", $this->hostname, $this->hostpass);
        } catch(\PDOException $exception) {
            echo "Connection failed: " . $exception->getMessage();
        }
        return $this->conn;
    }

    public function prepare($query)
    {
        return $this->conn->prepare($query);
    }
}