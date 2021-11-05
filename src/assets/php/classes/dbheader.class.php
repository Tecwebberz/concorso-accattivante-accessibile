<?php

class DbHeader{

    private $servername;
    private $username;
    private $password;
    private $dbname;

    protected function connect(){
        $this->servername = "";
        $this->username = "";
        $this->password = "";
        $this->dbname = "";

        $conn = new mysqli($this->servername,$this->username,$this->password,$this->dbname);

        return $conn;
    }

}
