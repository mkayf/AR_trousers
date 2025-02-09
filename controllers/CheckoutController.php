<?php

class CheckoutController extends CartController{
    public $conn;
    private $shippingCharges = 300;

    public function __construct($db_connection){
        parent::__construct($db_connection);
        $this->conn = $db_connection;
    }

    public function setShippingCharges($charges){
        $this->shippingCharges = $charges;
    }

    public function getShippingCharges(){
        return $this->shippingCharges;
    }

    public function getCheckoutTotal(){
        return $this->getCartTotal() + $this->getShippingCharges();
    }

    public function placeOrder($cusDetails){

        $first_name = $cusDetails['first-name'];
        $last_name = $cusDetails['last-name'];
        $phone_number = $cusDetails['phone-number'];
        $email = $cusDetails['email'];
        $address = $cusDetails['address'];
        $landmark = $cusDetails['landmark'];
        $state = $cusDetails['state'];
        $city = $cusDetails['city'];

        // Place order for the authenticated user:
        if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true){

            // Change the shipping charges if city name is Karachi:
            $cityNameArr = ['karachi', 'khi'];

            if(in_array(strtolower(trim($city)), $cityNameArr)){
                $this->setShippingCharges(200);
            } else{
                $this->setShippingCharges(300);
            }
            

            // Check if the shipping details already exists for the given user id:
            
            $checkShippingDetails = "SELECT shipping_ID FROM shipping_details WHERE user_ID = $this->user_ID";

            $result = $this->conn->query($checkShippingDetails);

            if($result->num_rows == 0){
                
                // Insert customer shipping details into shipping details table if doesn't exists:

                $shippingDetailsInsert = "INSERT INTO shipping_details (user_ID, first_name, last_name, phone_number, email, street_address, landmark, state, city) VALUES($this->user_ID, '$first_name', '$last_name', '$phone_number', '$email', '$address', '$landmark', '$state', '$city')";
                
                try{
                    $shippingInsertResult = $this->conn->query($shippingDetailsInsert);
    
                    $shipping_ID = $this->conn->insert_id;
                }
                catch(Error | Exception $e){
                    echo "<script>console.log('Error in placeOrder(Failed to insert shipping details): ". $e->getMessage() .", Line number: ". $e->getLine() ."');</script>";
                    return false;
                }

            } 
            else {
                $shipping_ID = $result->fetch_column();

                // Update the existing user's shipping details:
                $shippingDetailsUpdate = "UPDATE shipping_details SET first_name = '$first_name', last_name = '$last_name', phone_number = '$phone_number', email = '$email', street_address = '$address', landmark = '$landmark', state = '$state', city = '$city' WHERE user_ID = $this->user_ID";
                
                try{
                    $shippingUpdateResult = $this->conn->query($shippingDetailsUpdate);
                }
                catch(Error | Exception $e){
                    echo "<script>console.log('Error in placeOrder(Failed to update shipping details): ". $e->getMessage() .", Line number: ". $e->getLine() ."');</script>";
                    return false;
                }
                
            }

            
            // Insert data into orders table:

            $addOrderQuery = "INSERT INTO orders(user_ID, shipping_ID, subtotal, shipping_charges, total) VALUES($this->user_ID, $shipping_ID, ". $this->getCartTotal() .", ". $this->getShippingCharges() .", ". $this->getCheckoutTotal() .")";

            try{
                $order_result = $this->conn->query($addOrderQuery);
                $order_ID = $this->conn->insert_id;
            }
            catch(Error | Exception $e){
                echo "<script>console.log('Error in placeOrder(Failed to insert data into orders table): ". $e->getMessage() .", Line number: ". $e->getLine() ."');</script>";
                return false;
            }

            // Insert each cart item into order items table:

            $cart_items = $this->getCartItems() ?? [];

            foreach($cart_items as $item){
                $cartItemSubtotal = $this->getCartItemSubtotal($item['product_ID'], $item['quantity']);

                $insertItemsToOrders = "INSERT INTO order_items(order_ID, product_ID, quantity, subtotal, size, color) VALUES($order_ID, $item[product_ID], $item[quantity], $cartItemSubtotal, '$item[size]', '$item[color]')";

                try{
                    $orderItemResult = $this->conn->query($insertItemsToOrders);
                }
                catch(Error | Exception $e){
                    echo "<script>console.log('Error in placeOrder(Failed to insert cart items into order items table): ". $e->getMessage() .", Line number: ". $e->getLine() ."');</script>";
                    return false;
                }   
            }

            // Empty cart items for the user who placed order after successfully transferring cart items into order items table:
                        
            $emptyCartItems = "DELETE FROM cart WHERE user_ID = $this->user_ID";

            try{
                $emptyCartResult = $this->conn->query($emptyCartItems);
            }
            catch(Error | Exception $e){
                echo "<script>console.log('Error in placeOrder(Failed to empty cart items after inserting into order items table): ". $e->getMessage() .", Line number: ". $e->getLine() ."');</script>";
                return false;
            }

            // Set order_ID into session:

            $_SESSION['order_ID'] = $order_ID;

            return true;
        }

    }


} 

$checkout_controller = new CheckoutController($DB->conn);

?>