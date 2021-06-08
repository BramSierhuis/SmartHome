<?php
class Base{

    // specify your own database credentials
    private $host = "127.0.0.1";
    private $db_name = "smarthome";
    private $username = "apache";
    private $password = "_#Br4manne1";
    public $conn = null;

    public function __construct()
    {
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
    }
}