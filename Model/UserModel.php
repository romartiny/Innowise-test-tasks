<?php

namespace App\UserModel;

use App\Config\Config;

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
        if (!mkdir($dirname, 0777) && !is_dir($dirname)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $dirname));
        }
    }

    public function createLogDir($dirname)
    {
        if (!mkdir($dirname, 0777) && !is_dir($dirname)) {
            throw new \RuntimeException(sprintf('Directory "%s" was not created', $dirname));
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
