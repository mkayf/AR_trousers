<?php

class OrdersController {
    public $conn;

    public function __construct($db_connection)
    {
        $this->conn = $db_connection;
    }
}

?>