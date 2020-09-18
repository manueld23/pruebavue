<?php

class db {
    private $dbHost = 'localhost';
    private $dbUser = 'root';
    private $dbPass = '';
    private $dbName = 'ejercicio';

    public function connectionDB(){
    $mysqlConnect = "mysql:host=$this->dbHost;dbname=$this->dbName";
    $dbConnect = new PDO($mysqlConnect, $this->dbUser, $this->dbPass);
    $dbConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbConnect;
    }
}