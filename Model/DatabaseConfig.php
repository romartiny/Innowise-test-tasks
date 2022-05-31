<?php

class DatabaseConfig {
    public $host = 'localhost';
    public $hostname = 'root';
    public $hostpass = 'root';
    public $dbname = 'usermove';
    protected $conn = null;

    public function connection()
    {
        try {
            $this->conn = new \PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4;", $this->hostname, $this->hostpass);
        } catch(\PDOException $exception) {
            echo "Connection failed: " . $exception->getMessage();
        }
        return $this->conn;
    }
}