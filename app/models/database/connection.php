<?php

class Connection{

    private $host;
    private $dbUser;
    private $dbName;
    private $dbPassword;

    private function __construct()
    {
        $this->host         = "localhost";
        $this->dbUser       = "root";
        $this->dbName       = "curso_php";
        $this->dbPassword   = "RcVsD7mxfIUNCP4c";
    }

    static public function connect(){
        $connection = new self();
        try{
            $link = new PDO("mysql:host=$connection->host;dbname=$connection->dbName",$connection->dbUser,$connection->dbPassword);
            $link->exec("set names utf8");
        }catch(Exception $e){
            exit("Error".$e->getMessage());
        }
        return $link;
    }
}