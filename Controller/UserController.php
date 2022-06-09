<?php

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../Model/UserModel.php';
require_once __DIR__ . '/../Config/Config.php';

class UserController extends Controller
{
    public $file;
    public string $fileName;
    public string $randomFileName;
    public string $fileTmpName;
    public float $fileSize;
    public int $fileError;
    public string $fileType;
    public UserModel $model;
    public Config $config;

    public function __construct()
    {
        $this->model = new UserModel();
        $this->config = new Config();
    }

    public function init(): void
    {
        if (!isset($_REQUEST['action'])) {
            $this->index();
        } else {
            $action = $_REQUEST['action'];
            $this->$action();
        }
    }

    public function index()
    {
        $this->twigIndex();
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

    public function checkUploadDir()
    {
        $dirname = $this->config::UPLOAD_PATH;
        $filename = __DIR__ . '/../' . $dirname;

        if (!file_exists($filename)) {
            $this->model->createUploadDir($dirname);
        }
    }

    public function checkLogDir()
    {
        $dirname = $this->config::LOG_PATH;
        $filename = __DIR__ . '/../' . $dirname;

        if (!file_exists($filename)) {
            $this->model->createLogDir($dirname);
        }
    }

    public function convertSize(): string
    {
        $base = log($this->fileSize, 1024);
        $suffixes = ['', 'kb', 'mb', 'gb', 'tb'];

        return round(pow(1024, $base - floor($base)), 1) .' '. $suffixes[floor($base)];
    }

    public function getExifData()
    {
        $uploadPath = $this->config::UPLOAD_PATH;
        $fileName = $this->randomFileName;
        $fp = $this->model->openImage($uploadPath, $fileName);
        if (!$fp) {
            $exif = exif_read_data($fp);
            if (!$exif) {
                exit;
            }
        } else {
            $exif = exif_read_data($fp);
        }
        $exifData = json_encode($exif);
        return preg_replace('/[\"\'\{\}]/', '', $exifData);
    }

    public function addLog()
    {
        $dateFile = date("d") . date("m") . date("Y");
        $logName = $this->randomFileName;
        $logTime = date("d-m-Y h:i:sa");
        $logSize = $this->convertSize();
        $logMeta = $this->getExifData();
        $logFileName = $this->config::LOG_PATH . "upload_$dateFile.log";
        $this->model->uploadLog($logFileName, $logName, $logTime, $logSize, $logMeta);
    }

    public function uploadData()
    {
        $fileExt = explode('.', $this->fileName);
        $fileActualExt = strtolower(end($fileExt));
        if(in_array($fileActualExt, $this->config::EXTENSION)) {
            if ($this->fileError === 0) {
                $this->randomFileName = uniqid('', true) . '.' . $fileActualExt;
                $fileDestination = $this->config::UPLOAD_PATH . $this->randomFileName;
                $this->model->uploadFile($this->fileTmpName, $fileDestination);
            }
        }
    }

    public function add()
    {
        $this->getData();
        $this->checkUploadDir();
        $this->checkLogDir();
        $this->uploadData();
        $this->addLog();
        $this->index();
    }
}
