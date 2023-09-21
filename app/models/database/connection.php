<?php

require_once 'info-dbase.php';
// InfoDbase class contains data base information

class Connection extends InfoDbase{

    private $host;
    private $dbUser;
    private $dbName;
    private $dbPassword;

    private function __construct()
    {
        parent::__construct();
        $this->host         = $this->infoDB['host']; 
        $this->dbUser       = $this->infoDB['dbuser'];
        $this->dbName       = $this->infoDB['dbname'];
        $this->dbPassword   = $this->infoDB['dbpassword'];
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