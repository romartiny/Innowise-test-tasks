<?php

namespace App\UserModel;

require_once __DIR__ . '/../Config/DatabaseConfig.php';
require_once __DIR__ . '/../Config/Config.php';

use App\Config\Config as Config;
use App\DatabaseConfig\DatabaseConfig;
use Exception;

class UserModel
{
    public Config $config;
    public DatabaseConfig $connect;

    public function __construct()
    {
        $this->config = new Config();
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

    public function uploadFile($fileTmpName, $fileDestination)
    {
        move_uploaded_file($fileTmpName, $fileDestination);
    }

    /**
     * @throws Exception
     */
    public function createUploadDir($dirname)
    {
        if (!mkdir($dirname, 0777) && !is_dir($dirname)) {
            throw new Exception(sprintf('Directory "%s" was not created', $dirname));
        }
    }

    /**
     * @throws Exception
     */
    public function createLogDir($dirname)
    {
        if (!mkdir($dirname, 0777) && !is_dir($dirname)) {
            throw new Exception(sprintf('Directory "%s" was not created', $dirname));
        }
    }

    public function uploadLog($logFileName, $logName, $logTime, $logSize, $logCode)
    {
        $logFile = fopen($logFileName, "a");
        $log = "| $logTime | $logName | $logSize | $logCode\n";
        fwrite($logFile, $log);
    }

    public function openImage($uploadPath, $fileName)
    {
        return fopen(__DIR__ . "/../" . $uploadPath . $fileName, 'rb');
    }
}
