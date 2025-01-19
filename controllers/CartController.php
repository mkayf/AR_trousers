<?php

class CartController{
    public $conn;

    public function __construct($db_connection)
    {
        $this->conn = $db_connection;
    }

    // Get the count of total product quantity for the logged in user:
    
    public function getCartCount(){
        if(isset($_SESSION['authenticated']) && $_SESSION['authenticated']){
            $user_ID = $_SESSION['user_data']['user_ID'];

            $fetchCartCount = "SELECT SUM(quantity) as cart_count FROM cart WHERE user_ID = $user_ID";

            try{
                $result = $this->conn->query($fetchCartCount);
                $cartCount = $result->fetch_column();                
                return $cartCount;
            }
            catch(Exception|Error $e){
                echo "<script>console.log('Error in getCartCount: ". $e->getMessage() .", Line number: ". $e->getLine() ."');</script>";
                return null;
            }

        }
    }

}

?>