<?php

class DatabaseConfig {
    public string $host = 'localhost';
    public string $hostname = 'root';
    public string $hostpass = 'root';
    public string $dbname = 'usermove';
    protected $conn = null;

    public function connection(): PDO
    {
        try {
            $this->conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4;", $this->hostname, $this->hostpass);
        } catch(PDOException $exception) {
            echo "Connection failed: " . $exception->getMessage();
        }
        return $this->conn;
    }
}