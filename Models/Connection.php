<?php

class Connection
{
    private $db;
    private $host;
    private $port;

    public function __construct($host="127.0.0.1",$port="3306",$db="todo",$user="root",$pass="")
    {
        $this->host = $host;
        $this->db = $db;
        $this->conn = new mysqli($host, $user, $pass, $db);

    }

    public function get_conection()
    {
        return $this->conn;
    }

    public function close()
    {
        mysqli_close($this->conn);
    }
}