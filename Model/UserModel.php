<?php

require_once __DIR__ . '/../Config/Config.php';

class UserModel extends Config
{
    public $id;
    public string $name;
    public string $email;
    public string $gender;
    public string $status;
    public $contoken;

    public function __construct()
    {
        $this->contoken = new Config();
    }

    public function getSingleId($id)
    {

    }

    public function updateData(): void
    {
        $this->id = $_POST['id'];
        $this->name = $_POST['name'];
        $this->email = $_POST['email'];
        $this->gender = $_POST['gender'];
        $this->status = $_POST['status'];

    }

    public function getData()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://gorest.co.in/public/v2/users?access-token=$this->token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array('Content-Type: application/json')
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function addUser(): void
    {
        $this->name = $_POST['name'];
        $this->email = $_POST['email'];
        $this->gender = $_POST['gender'];
        $this->status = $_POST['status'];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://gorest.co.in/public/v2/users',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>'{"name":"Tenaooo Ramakrishna", "gender":"male", "email":"tenali.ramakrishna+03@15ce.com", "status":"active"}',
            CURLOPT_HTTPHEADER => array('Content-Type: application/json')
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }

    public function deleteUser($id): void
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://gorest.co.in/public/v2/users/$id?access-token=$this->token",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array('Content-Type: application/json')
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        echo $response;
    }

}