<?php
    class DB_Connection{
        public $conn;

        public function __construct()
        {   
            try{
                $conn = new mysqli(SERVER_NAME, USERNAME, PASSWORD, DATABASE);
                
                return $this->conn = $conn;
            }
            catch(Exception $e){
                echo '<script>console.log("Error: Database connection failed! '. $e->getMessage() .'")</script>';
            }

        }

    }

?>