<?php

require_once __DIR__ . '/../Config/Config.php';

class UserModel
{
    public $id;
    public Config $connection;

    public function __construct()
    {
        $this->connection = new Config();
    }

    public function getSingleId(int $id)
    {
        $this->id = $id;

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->connection::BASIC_URL . "/$this->id?access-token=" . $this->connection::TOKEN,
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

    public function updateData(int $userId, array $result)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->connection::BASIC_URL . "/$userId?access-token=" . $this->connection::TOKEN,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => json_encode($result),
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
            CURLOPT_URL => $this->connection::BASIC_URL . "?access-token=" . $this->connection::TOKEN,
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

    public function addUser(array $result)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $this->connection::BASIC_URL . "?access-token=" . $this->connection::TOKEN,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($result),
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
            CURLOPT_URL => $this->connection::BASIC_URL . "/$id?access-token=" . $this->connection::TOKEN,
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
}
