<?php

namespace App;

use PDO;
use Exception;

class Database
{
    private $login;
    private $password;
    private $host;
    private $db_name;
    private $pdo;

    public function __construct($login = "root", $password = "", $host = "localhost", $db_name = "site_greg")
    {
        $this->login = $login;
        $this->password = $password;
        $this->host = $host;
        $this->db_name = $db_name;
        $this->setPDO();
    }
     
    private function setPDO()
    {
        try {
            $pdo = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name .';charset=utf8', $this->login, $this->password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            echo 'Exception reçue : ',  $e->getMessage(), "\n";
        }
        $this->pdo = $pdo;
    }

    public function request($request, $values = '', $type = '')
    {
        try{
            $request = $this->pdo->prepare($request);
            $request->execute($values);
        } catch (Exception $e) {
            die('Erreur Fatale: ' . $e->getMessage());
        }
        if ($type === 'fetchAll') {
            return $request->fetchAll(PDO::FETCH_ASSOC);
        } elseif ($type === 'fetch') {
            return $request->fetch();
        } else {
            return $request;
        }
    }
}