<?php
    class DB_Connection{
        public $conn;

        public function __construct()
        {
            $conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DATABASE);
            if($conn->connect_error){
                die("Database connection failed!");
            }
            
            return $this->conn = $conn;
        }
    }

?>