<?php

namespace App\Config;

class DatabaseConfig {
    private $host = "localhost";
    private $namo = "root";
    private $password = "root";
    private $db = "usermove";
    protected $con = null;

    public function __construct()
    {
        try {
        $this->con = new \PDO("mysql:host=$this->host;dbname=$this->db", $this->namo, $this->password);
        } catch(\PDOException $exception) {
            echo "Connection failed: " . $exception->getMessage();
        }
        return $this->con;
    }

    public function closeDatabaseConnection()
    {
        $this->con = null;
    }
}
