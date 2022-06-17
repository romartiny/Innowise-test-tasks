<?php

namespace App\UserModel;

require_once __DIR__ . '/../Config/Credentials.php';

use App\Credentials\Credentials;

class UserModel
{
    public Credentials $database;

    public function __construct()
    {
        $this->database = new Credentials();
    }
    public function isCorrect($email, $password): ?string
    {
        $conf = $this->database->getDatabase();
        foreach ($conf as $key => $value) {
            if ($key === $email && password_verify($password, $value['password'])) {
                return $value['name'];
    }
}
        return null;
    }
}
