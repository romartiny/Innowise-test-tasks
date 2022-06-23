<?php

namespace App\Controller;

use App\Config\Config as Config;
use App\UserModel\UserModel as UserModel;
use App\Controller\Controller as Controller;
use Exception;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

require_once __DIR__ . '/Controller.php';
require_once __DIR__ . '/../Model/UserModel.php';

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
        if (!isset($_REQUEST['action'])) {
            $this->index();
        } else {
            $action = $_REQUEST['action'];
            $this->$action();
        }
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function index()
    {
        $this->twigIndex();
    }

    public function registerForm()
    {
        $this->twigRegister();
    }

    public function getRegisterData()
    {
        $this->firstName = $_POST['first-name'];
        $this->lastName = $_POST['last-name'];
        $this->email = $_POST['email'];
        $this->confEmail = $_POST['conf-email'];
        $this->password = $_POST['password'];
        $this->confPassword = $_POST['conf-password'];
    }

    public function isSame(): bool
    {
        if ($this->email === $this->confEmail && $this->password === $this->confPassword) {
            return true;
        } else {
            return false;
        }
    }

    public function checkPassword(): bool
    {
        $regex = '/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%&]).*$/';
        if (strlen($this->password) >= 6 && preg_match($regex, $this->password)) {
            return true;
        }

        return false;
    }

    public function cryptPassword(): string
    {
        return $this->password = md5($this->password);
    }

    public function addUser()
    {
        $email = $this->email;
        $firstName = $this->firstName;
        $lastName = $this->lastName;
        $password = $this->password;
        $this->model->addUser($email, $firstName, $lastName, $password);
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function register()
    {
        $this->sessionStart();
        $this->getRegisterData();
        $_SESSION['firstName'] = $this->firstName;
        $_SESSION['lastName'] = $this->lastName;
        $_SESSION['email'] = $this->email;
        $_SESSION['confEmail'] = $this->confEmail;
        $firstNameSession = $_SESSION['firstName'];
        $lastNameSession = $_SESSION['lastName'];
        $emailSession = $_SESSION['email'];
        $confEmailSession = $_SESSION['confEmail'];
        if ($this->isSame() === true) {
            if ($this->checkPassword() === true) {
                $this->cryptPassword();
                $this->addUser();
                $answer = 'Created Successfully';
            } else {
                $answer = 'Your password dont fit the rules';
            }
        } else {
            $answer = 'Your passwords is not the same';
        }
        $this->twigRegisterResult($answer, $firstNameSession, $lastNameSession, $emailSession, $confEmailSession);
    }

    public function getLoginData()
    {
        $this->email = $_POST['email'];
        $this->password = $_POST['password'];
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     * @throws Exception
     */
    public function login()
    {
        $this->sessionStart();
        $this->getLoginData();
        $_SESSION['email'] = $this->email;
        $emailSession = $_SESSION['email'];
        $email = $this->email;
        $password = md5($this->password);
        if ($this->model->checkUser($email, $password) > 0) {
            $this->addFile();
        } else {
            $result = "Account not found or password was wrong";
            $this->twigLoginResult($result, $emailSession);
        }
    }

    //FILES

    public function getFileList()
    {
        return array_diff(scandir($this->config::UPLOAD_PATH), array('.', '..'));
    }

    /**
     * @throws Exception
     */
    public function addFile()
    {
        $this->checkUploadDir();
        $extends = $this->getExtension();
        $dataFiles = $this->getFileList();
        if (!empty($this->fileName)) {
            $fileName = $this->fileName;
            $fileSize = $this->fileSize;
            $fileExif = $this->fileExif;
            $this->twigFileResult($fileName, $fileSize, $fileExif, $dataFiles, $extends);
        } else {
            $this->twigFile($dataFiles, $extends);
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

    public function getExtension(): string
    {
        $currentExt = $this->config::EXTENSION;
        return implode(', .', $currentExt);
    }

    /**
     * @throws Exception
     */
    public function checkUploadDir()
    {
        $dirname = $this->config::UPLOAD_PATH;
        $filename = __DIR__ . '/../' . $dirname;

        if (!file_exists($filename)) {
            $this->model->createUploadDir($dirname);
        }
    }

    /**
     * @throws Exception
     */
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

    /**
     * @throws Exception
     */
    public function add()
    {
        $this->getData();
        $this->checkUploadDir();
        $this->checkLogDir();
        $this->isFreeSpace();
        $this->uploadData();
        $this->getExifData();
        $this->addLog();
        $this->addFile();
    }

    public function sessionStart()
    {
        session_start();
    }
}
