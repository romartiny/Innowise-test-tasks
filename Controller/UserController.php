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
    public bool $fileCode;
    public string $fileExif;
    public string $fileType;
    public string $session;
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
     * @throws RuntimeError
     * @throws SyntaxError
     * @throws LoaderError
     */
    public function sessionCheck()
    {
        if (!isset($_SESSION['login'])) {
            $_SESSION['login'] = 0;
        }
        if (!empty($_SESSION['email']) && $_SESSION['login'] === 1) {
            $extends = $this->getExtension();
            $dataFiles = $this->getFileList();
            $this->twigFile($dataFiles, $extends);
        } else {
            $this->twigIndex();
        }
    }

    public function attemptsInit()
    {
        $this->model->checkAttemptTime();
        if (!isset($_SESSION['attempt'])) {
            $_SESSION['attempt'] = 0;
            $_SESSION['attempt_again'] = 1;
        }
        if ($_SESSION['attempt_again'] < time() && $_SESSION['attempt'] === 3) {
            $_SESSION['attempt'] = 0;
            $this->model->checkAttemptTime();
        } else {
            $_SESSION['attempt_again'] = time() + (15 * 60);
            if (!isset($_SESSION['email'])) {
                $_SESSION['email'] = 'undefined';
            }
            $dateFile = date("dmY");
            $logFileName = $this->config::LOG_PATH . "upload_$dateFile.log";
            $this->model->addIpAttempt($this->getIpAddress(), $_SESSION['email']);
            $this->model->uploadIpLog($logFileName, $this->getIpAddress(),
                $_SESSION['email'], date('Y-m-d H:i:s'), date('Y-m-d H:i:s', time() + 15 * 60));
        }
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     * @throws Exception
     */
    public function index()
    {
        $this->sessionStart();
        $this->checkLogDir();
        $this->sessionCheck();
        $this->attemptsInit();
    }

    public function showRegister()
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
        return $this->email === $this->confEmail && $this->password === $this->confPassword;
    }

    public function checkPassword(): bool
    {
        $regex = '/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%&]).*$/';
        if (preg_match($regex, $this->password)) {
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
        $this->model->addUser($this->email, $this->firstName, $this->lastName, $this->password);
    }

    public function initSession()
    {
        $_SESSION['firstName'] = $this->firstName;
        $_SESSION['lastName'] = $this->lastName;
        $_SESSION['email'] = $this->email;
        $_SESSION['confEmail'] = $this->confEmail;
    }

    public function getIpAddress()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    public function ipAttempts()
    {
        return $this->model->checkCountIpAttempts($this->getIpAddress());
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     * @throws Exception
     */
    public function registerExecute()
    {
        $this->sessionStart();
        $this->getRegisterData();
        $this->initSession();
        if ($this->isSame() === true) {
            if (strlen($this->password) >= 6) {
                if ($this->checkPassword() === true) {
                    if ($this->model->checkUser($this->email, md5($this->password)) > 0) {
                        $answer = 'This email already use';
                        $this->twigRegisterResult($answer, $_SESSION['firstName'], $_SESSION['lastName'],
                            $_SESSION['email'], $_SESSION['confEmail']);
                    } else {
                        $this->cryptPassword();
                        $this->addUser();
                        $_SESSION['login'] = 1;
                        $this->addFile();
                    }
                } else {
                    $answer = 'Your password doesnt take special symbol';
                    $this->twigRegisterResult($answer, $_SESSION['firstName'], $_SESSION['lastName'],
                        $_SESSION['email'], $_SESSION['confEmail']);
                }
            } else {
                $answer = 'Your less than 6 symbols';
                $this->twigRegisterResult($answer, $_SESSION['firstName'], $_SESSION['lastName'],
                    $_SESSION['email'], $_SESSION['confEmail']);
            }
        } else {
            $answer = 'Your passwords is not the same';
            $this->twigRegisterResult($answer, $_SESSION['firstName'], $_SESSION['lastName'], $_SESSION['email'],
                $_SESSION['confEmail']);
        }
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
    public function loginExecute()
    {
        $this->sessionStart();
        $this->getLoginData();
        $this->attemptsInit();
        $this->setCookie();
        $_SESSION['email'] = $this->email;
        if ($_SESSION['attempt'] === 3) { //
            if ($this->model->checkCountIpAttempts($this->ipAttempts()) > 0) {
                $result = 'Your ip was banned for 15 minutes. Be inactive this time.';
                $this->twigLoginResult($result, $_SESSION['email']);
            }
        } else {
            if ($this->model->checkUser($this->email, md5($this->password)) > 0) {
                $_SESSION['login'] = 1;
                $this->addFile();
            } else {
                $_SESSION['login'] = 0;
                $_SESSION['attempt'] += 1;
                $result = "Account not found or password was wrong";
                $this->twigLoginResult($result, $_SESSION['email']);
            }
        }
    }

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
        if (!empty($this->fileName)) {
            $this->twigFileResult($this->fileName, $this->fileSize, $this->fileExif,
                $this->getFileList(), $this->getExtension());
        } else {
            $this->twigFile($this->getFileList(), $this->getExtension());
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

    public function checkFreeSpace(): bool
    {
        $freeSpace = disk_free_space(__DIR__ . "/../");
        if ($this->fileSize > $freeSpace) {
            return false;
        } else {
            return true;
        }
    }

    public function convertSize(): string
    {
        if ($this->fileSize == 0) {
            $convertNum = 0;
        } else {
            $base = log($this->fileSize, 1024);
            $suffixes = ['', 'kb', 'mb', 'gb', 'tb'];
            $convertNum = round(pow(1024, $base - floor($base)), 1) . ' ' . $suffixes[floor($base)];
        }

        return $convertNum;
    }

    public function getExifData()
    {
        $uploadPath = $this->config::UPLOAD_PATH;
        $fileName = $this->randomFileName;
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $exifProp = $this->config::EXTENSION;
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
        $this->checkFreeSpace();
        $dateFile = date("dmY");
        $logName = $this->randomFileName;
        $logTime = date("d-m-Y h:i:sa");
        $logSize = $this->convertSize();
        $logFileName = $this->config::LOG_PATH . "upload_$dateFile.log";
        if (!$this->fileCode === false && $logSize > 0) {
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
        if (in_array($fileActualExt, $this->config::EXTENSION)) {
            if ($this->fileError === 0) {
                $this->fileCode = true;
                $this->model->uploadFile($this->fileTmpName, $fileDestination);
            }
        } else {
            $this->fileCode = false;
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
        $this->checkFreeSpace();
        $this->uploadData();
        $this->getExifData();
        $this->addLog();
        $this->addFile();
    }

    public function sessionStart()
    {
        session_start();
        $this->session = true;
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function logout()
    {
        session_start();
        session_destroy();
        $this->session = false;
        $this->index();
    }

    public function setCookie()
    {
        $cookieEmail = $this->email;
        $secondsInDay = 86400;
        setcookie($cookieEmail, time() + ($secondsInDay * 7), "/");
    }
}
