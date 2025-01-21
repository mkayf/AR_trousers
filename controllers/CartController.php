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

            // Sync the cart items if any, when the user is logged in after adding products to cart as a guest:

            if(isset($_SESSION['guest_ID']) && isset($_SESSION['cart_items'])){
                // Store the guest's cart items in the database:

                $cart_items = $_SESSION['cart_items'];

                if(!empty($cart_items)){
                    foreach($cart_items as $item){
                        $storeCartItems = "INSERT INTO cart(user_ID, product_ID, size, color, quantity) VALUES($user_ID, $item[product_ID], '$item[size]', '$item[color]', $item[quantity])";

                        try{
                            $result = $this->conn->query($storeCartItems);
                        }
                        catch(Exception | Error $e){
                            echo "<script>console.log('Error in getCartCount('Failed to transfer session_cart_items to database'): ". $e->getMessage() .", Line number: ". $e->getLine() ."');</script>";
                            return null;            
                        }
                    }
                }                

                // Unset the cart items and guest ID after successfully transferring to database:
                unset($_SESSION['guest_ID']);
                unset($_SESSION['cart_items']);

            }    


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

        } else{
            if(isset($_SESSION['cart_items'])){
                $cartItems = $_SESSION['cart_items'];
                $cartCount = 0;             

                foreach($cartItems as $item){
                    $cartCount += $item['quantity'];
                }

                return $cartCount;
            }
            else{
                return null;
            }
        }
    }

}

// Creating it's instance here directly to easily include this controller in all the pages:

$cartController = new CartController($DB->conn);

$cartCount = $cartController->getCartCount();

?>