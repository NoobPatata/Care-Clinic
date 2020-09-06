<?php

class Dbh {

    private $dbHost = 'localhost';
    private $dbUser = 'root';
    private $dbPass = '';
    private $dbName = 'careclinic';

    protected function connect() {

        $this->conn = new mysqli($this->dbHost , $this->dbUser , $this->dbPass , $this->dbName);
        
        if($this->conn->connect_error) {
            die('Connection to database failed!');
        }

        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->conn->set_charset('utf8mb4');
        return $this->conn;

    }
    
}
?>