<?php

    class Database {
        private $host;
        private $database_name;
        private $username;
        private $password;

        public $conn;

        // Db connection
        public function __construct(){
            $this->host = base64_decode($_ENV['DATABASE_HOST']);
            $this->database_name = base64_decode($_ENV['DATABASE_NAME']);
            $this->username = base64_decode($_ENV['DATABASE_USER']);
            $this->password = base64_decode($_ENV['DATABASE_PASSWORD']);
        }

        public function getConnection(){
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }  
?>