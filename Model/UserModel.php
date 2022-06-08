<?php

require_once __DIR__ . '/../Config/Config.php';

class UserModel extends Config
{
    public $id;
    public string $name;
    public string $email;
    public string $gender;
    public string $status;
    public array $result;
    public Config $contoken;

    public function __construct()
    {
        $this->contoken = new Config();
    }

    public function getSingleId(int $id)
    {
        $this->id = $id;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->contoken::BASICURL . "/$this->id?access-token=" . $this->contoken::TOKEN,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array('Accept: application/json', 'Content-Type: application/json'),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function updateData()
    {
        $this->id = $_POST['id'];

        $curl = $this->getKeys();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->contoken::BASICURL . "/$this->id?access-token=" . $this->contoken::TOKEN,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => json_encode($this->result),
            CURLOPT_HTTPHEADER => array('Accept: application/json', 'Content-Type: application/json'),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function getData()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->contoken::BASICURL . "?access-token=" . $this->contoken::TOKEN,
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

    public function addUser()
    {
        $curl = $this->getKeys();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->contoken::BASICURL . "?access-token=" . $this->contoken::TOKEN,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($this->result),
            CURLOPT_HTTPHEADER => array('Accept: application/json', 'Content-Type: application/json'),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    public function deleteUser(int $id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->contoken::BASICURL . "/$id?access-token=" . $this->contoken::TOKEN,
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
        return $response;
    }

    public function getKeys()
    {
        $this->name = $_POST['name'];
        $this->email = $_POST['email'];
        $this->gender = $_POST['gender'];
        $this->status = $_POST['status'];
        $this->result = [
            "name" => "$this->name",
            "email" => "$this->email",
            "gender" => "$this->gender",
            "status" => "$this->status"
        ];
        return curl_init();
    }
}
