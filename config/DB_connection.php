<?php
    class DB_Connection{
        public $conn;

        public function __construct($server_name, $username, $password, $db)
        {   
            try{
                $conn = new mysqli($server_name, $username, $password, $db);
                
                return $this->conn = $conn;
            }
            catch(Exception $e){
                echo '<script>console.log("Error: Database connection failed! '. $e->getMessage() .'")</script>';
            }

        }

    }

?>