<?php

namespace App\Controller;

use App\UserModel\UserModel as UserModel;
use App\Config\Config as Config;
use App\Controller\Controller as Controller;

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../Model/UserModel.php';
require_once __DIR__ . '/../Config/Config.php';

class UserController extends Controller
{
    public string $firstName;
    public string $lastName;
    public string $email;
    public string $confEmail;
    public string $password;
    public string $confPassword;
    public $file;
    public string $fileName;
    public string $randomFileName;
    public string $fileTmpName;
    public float $fileSize;
    public int $fileError;
    public int $fileCode;
    public string $fileExif;
    public string $fileType;
    public UserModel $model;
    public Config $config;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->config = new Config();
    }
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function init(): void
    {
        if (!isset($_POST['action'])) {
            $this->index();
        } else {
            $action = $_POST['action'];
    public function init(): void
    {
        if (!isset($_REQUEST['action'])) {
            $this->index();
        } else {
            $action = $_REQUEST['action'];
<<<<<<< HEAD
>>>>>>> master
=======
>>>>>>> master
            $this->$action();
        }
    }

<<<<<<< HEAD
<<<<<<< HEAD
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function index()
    {
        $this->twigIndex();
    }

    public function getData()
    public function getFileList()
    {
        return array_diff(scandir($this->config::UPLOAD_PATH), array('.', '..'));
    }

    public function index()
    {
        $this->checkUploadDir();
        $extends = $this->getExtension();
        $dataFiles = $this->getFileList();
        if (!empty($this->fileName)) {
            $fileName = $this->fileName;
            $fileSize = $this->fileSize;
            $fileExif = $this->fileExif;
            $this->twigResult($fileName, $fileSize, $fileExif, $dataFiles, $extends);
        } else {
            $this->twigIndex($dataFiles, $extends);
        }
    }

    public function getData()
    {
        $this->file = $_FILES['file'];
        $this->fileName = $_FILES['file']['name'];
        $this->fileTmpName = $_FILES['file']['tmp_name'];
        $this->fileSize = $_FILES['file']['size'];
        $this->fileError = $_FILES['file']['error'];
        $this->fileType = $_FILES['file']['type'];
    }

    public function getExtension()
    {
        $currentExt = $this->config::EXTENSION;
        return implode(', .', $currentExt);
    }

    public function checkUploadDir()
    {
        $dirname = $this->config::UPLOAD_PATH;
        $filename = __DIR__ . '/../' . $dirname;

        if (!file_exists($filename)) {
            $this->model->createUploadDir($dirname);
        }
    }
    public function index()
    public function checkLogDir()
    {
        $dirname = $this->config::LOG_PATH;
        $filename = __DIR__ . '/../' . $dirname;

        if (!file_exists($filename)) {
            $this->model->createLogDir($dirname);
        }
    }

    public function isFreeSpace()
    {
        $freeSpace = disk_free_space(__DIR__ . "/../");
        if ($this->fileSize > $freeSpace) {
            $this->fileCode = 0;
        } else {
            $this->fileCode = 1;
        }
    }

    public function convertSize(): string
    {
        if ($this->fileSize == 0) {
            $convertNum = 0;
        } else {
            $base = log($this->fileSize, 1024);
            $suffixes = ['', 'kb', 'mb', 'gb', 'tb'];
            $convertNum = round(pow(1024, $base - floor($base)), 1) .' '. $suffixes[floor($base)];
        }

        return $convertNum;
    }

    public function getExifData()
    {
        $uploadPath = $this->config::UPLOAD_PATH;
        $fileName = $this->randomFileName;
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $exifProp = ['jpg', 'png', 'jpg', 'jpeg'];
        if (in_array($fileActualExt, $exifProp)) {
            $fp = $this->model->openImage($uploadPath, $fileName);
            if (!$fp) {
                $exif = exif_read_data($fp);
                if (!$exif) {
                    exit;
                }
            } else {
                $exif = exif_read_data($fp);
                $exifData = json_encode($exif);
                $exifFix = preg_replace('/[\"\'\{\}]/', '', $exifData);
                $this->fileExif = str_replace(',', ' ', $exifFix);
            }
        } else {
            $this->fileExif = 'No exif data';
        }

        return $this->fileExif;
    }

    public function addLog()
    {
        $this->isFreeSpace();
        $dateFile = date("dmY");
        $logName = $this->randomFileName;
        $logTime = date("d-m-Y h:i:sa");
        $logSize = $this->convertSize();
        $logFileName = $this->config::LOG_PATH . "upload_$dateFile.log";
        if ($this->fileCode === 1 && $logSize > 0) {
            $logCode = 'Upload successful';
        } else {
            $logCode = 'Not upload';
        }
        $this->model->uploadLog($logFileName, $logName, $logTime, $logSize, $logCode);
    }

    public function uploadData()
    {
        $fileExt = explode('.', $this->fileName);
        $fileActualExt = strtolower(end($fileExt));
        $this->randomFileName = uniqid('', true) . '.' . $fileActualExt;
        $fileDestination = $this->config::UPLOAD_PATH . $this->randomFileName;
        if(in_array($fileActualExt, $this->config::EXTENSION)) {
            if ($this->fileError === 0) {
                $this->fileCode = 1;
                $this->model->uploadFile($this->fileTmpName, $fileDestination);
            }
        } else {
            $this->fileCode = 0;
        }
    }

    public function add()
    {
        $this->getData();
        $this->checkUploadDir();
        $this->checkLogDir();
        $this->isFreeSpace();
        $this->uploadData();
        $this->getExifData();
        $this->addLog();
        $this->index();
    }
}
