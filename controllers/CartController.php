<?php

class CartController{
    public $conn;

    private $user_ID;

    public function __construct($db_connection)
    {
        $this->conn = $db_connection;
    }

    // Get the count of total product quantity for the logged in user:
    
    public function getCartCount(){
        if(isset($_SESSION['authenticated']) && $_SESSION['authenticated']){


            $this->user_ID = $_SESSION['user_data']['user_ID'];

            // Sync the cart items if any, when the user is logged in after adding products to cart as a guest:

            if(isset($_SESSION['guest_ID']) && isset($_SESSION['cart_items'])){
                // Store the guest's cart items in the database:

                $cart_items = $_SESSION['cart_items'];

                if(!empty($cart_items)){
                    foreach($cart_items as $item){
                        $storeCartItems = "INSERT INTO cart(user_ID, product_ID, size, color, quantity) VALUES($this->user_ID, $item[product_ID], '$item[size]', '$item[color]', $item[quantity])";

                        try{
                            $result = $this->conn->query($storeCartItems);
                        }
                        catch(Exception | Error $e){
                            echo "<script>console.log('Error in getCartCount('Failed to transfer session_cart_items to database'): ". $e->getMessage() .", Line number: ". $e->getLine() ."');</script>";
                            return null;            
                        }
                    }
                }                

                // Unset the cart items, guest ID and cart_ID after successfully transferring to database:
                unset($_SESSION['guest_ID']);
                unset($_SESSION['cart_items']);
                unset($_SESSION['cart_ID']);
            }    


            $fetchCartCount = "SELECT SUM(quantity) as cart_count FROM cart WHERE user_ID = $this->user_ID";

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

    public function getCartItems(){
    
        if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true){

            $getItems = "select c.cart_ID, p.product_name, p.product_actual_price, p.  product_discounted_price, p.product_img_1, c.color, c.size, c.quantity
            from products as p
            inner join cart as c
            on p.product_ID = c.product_ID
            where user_ID = $this->user_ID order by c.cart_ID DESC";
            
            try{
                $result = $this->conn->query($getItems);
                $cart_items = [];
                while($row = $result->fetch_assoc()){
                    $cart_items[] = $row;
                }

                return $cart_items;
                
            }
            catch(Exception|Error $e){
                echo "<script>console.log('Error in getCartItems: ". $e->getMessage() .", Line number: ". $e->getLine() ."');</script>";
                return null;
            }
            
        } else if(isset($_SESSION['cart_items']) && isset($_SESSION['guest_ID'])){

            $cart_items = [];

            foreach(array_reverse($_SESSION['cart_items']) as $item){
                $cart_items[] = $item;
            }

            return $cart_items;

        } else{
            return null;
        }

    }

    public function getCartTotal(){
        if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true){
            
            $totalQuery = "select if(p.product_discounted_price > 0, sum(p.product_discounted_price * c.quantity), sum(p.product_actual_price * c.quantity)) as cart_total from products as p
            inner join cart as c
            on p.product_ID = c.product_ID
            WHERE user_ID = $this->user_ID";
    
            try{
                $totalResult = $this->conn->query($totalQuery);
                $cart_total = $totalResult->fetch_column();
    
                return $cart_total ?? 0;
            }
            catch(Exception|Error $e){
                echo "<script>console.log('Error in getCartTotal: ". $e->getMessage() .", Line number: ". $e->getLine() ."');</script>";
                return null ?? 0;
            }

        } else if(isset($_SESSION['cart_items'])){
            
            $cart_total = 0;

            foreach($_SESSION['cart_items'] as $item){
                if($item['product_discounted_price'] > 0){
                    $cart_total = $cart_total + ($item['product_discounted_price'] * $item['quantity']);
                } else{
                    $cart_total = $cart_total + ($item['product_actual_price'] * $item['quantity']);
                }
            }

            return $cart_total;

        } else{
            return null ?? 0;
        }

    }
    
    public function getCartItemSubtotal($product_ID, $qty){

        // Calculate subtotal to use for updated cart item subtotal:
        
        $priceQuery = "SELECT IF(product_discounted_price IS NOT NULL AND product_discounted_price > 0, product_discounted_price, product_actual_price) AS price FROM products
        WHERE product_ID = $product_ID";

        try{
            $result = $this->conn->query($priceQuery);
            $price = $result->fetch_column();
            $subtotal = $price * $qty;
            return $subtotal;
        }
        catch(Exception | Error $e){
            echo "<script>console.log('Error in getCartItemSubtotal: ". $e->getMessage() .", Line number: ". $e->getLine() ."');</script>";
            return null ?? 0;
        }

    }

}

// Creating it's instance here directly to easily include this controller in all the pages:

$cartController = new CartController($DB->conn);

$cartCount = $cartController->getCartCount();

?>