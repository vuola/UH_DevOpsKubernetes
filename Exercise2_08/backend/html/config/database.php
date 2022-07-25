<?php

    class Database {
        private $host;
        private $database_name;
        private $username;
        private $password;

        public $conn;

        // Db connection
        public function __construct(){
            $this->host = getenv('MARIADB_HOST');
            $this->database_name = getenv('MARIADB_DATABASE');
            $this->username = getenv('MARIADB_USER');
            $this->password = getenv('MARIADB_PASSWORD');
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