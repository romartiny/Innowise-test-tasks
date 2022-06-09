<?php

require_once __DIR__ . '/../Config/Config.php';
require_once __DIR__ . '/../Controller/UserController.php';

class UserModel
{
    public Config $config;

    public function __construct()
    {
        $this->config = new Config();
    }

    public function uploadFile($fileTmpName, $fileDestination)
    {
        move_uploaded_file($fileTmpName, $fileDestination);
    }

    public function createUploadDir($dirname)
    {
        mkdir($dirname, 0777);
    }

    public function createLogDir($dirname)
    {
        mkdir($dirname, 0777);
    }

    public function uploadLog($logFileName, $logName, $logTime, $logSize, $logMeta)
    {
        $logFile = fopen($logFileName, "a");
        $log = "| $logTime | $logName | $logSize | $logMeta\n";
        fwrite($logFile, $log);
    }

    public function openImage($uploadPath, $fileName)
    {
        return fopen(__DIR__ . "/../" . $uploadPath . $fileName, 'rb');
    }
}
