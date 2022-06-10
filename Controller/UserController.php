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
    public int $fileCode;
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
                $resultExif = preg_replace('/[\"\'\{\}]/', '', $exifData);
            }
        } else {
            $resultExif = 'No exif data';
        }

        return $resultExif;
    }

    public function isExecutable()
    {
        $path = realpath($this->fileName);
        $file = __DIR__ . '/../' . $this->config::UPLOAD_PATH . $this->fileName;
        if (is_executable($file)) {
            $exCode = 1;
        } else {
            $exCode = 0;
        }
//        echo realpath($_FILES["file"]["tmp_name"]);
        echo $exCode;
        return $path;
    }

    public function addLog()
    {
        $dateFile = date("d") . date("m") . date("Y");
        $logName = $this->randomFileName;
        $logTime = date("d-m-Y h:i:sa");
        $logSize = $this->convertSize();
        $logFileName = $this->config::LOG_PATH . "upload_$dateFile.log";
        if ($this->fileCode === 1) {
            $logCode = 'Upload successful';
            $this->model->uploadGoodLog($logFileName, $logName, $logTime, $logSize, $logCode);
        } else {
            $logCode = 'Not upload';
            $this->model->uploadBadLog($logFileName, $logName, $logTime, $logSize, $logCode);
        }
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
//        $this->isExecutable();
        $this->checkUploadDir();
        $this->checkLogDir();
        $this->uploadData();
        $this->addLog();
        $this->index();
    }
}
