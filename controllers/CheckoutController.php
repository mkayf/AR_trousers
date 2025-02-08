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

        $charges = $this->getShippingCharges();
        $subtotal = $this->getCartTotal();
        $total = $this->getCheckoutTotal();

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

            $addOrderQuery = "INSERT INTO orders(user_ID, shipping_ID, subtotal, shipping_charges, total) VALUES($this->user_ID, $shipping_ID, $subtotal, $charges, $total)";

            try{
                $order_result = $this->conn->query($addOrderQuery);
            }
            catch(Error | Exception $e){
                echo "<script>console.log('Error in placeOrder(Failed to data into orders table): ". $e->getMessage() .", Line number: ". $e->getLine() ."');</script>";
                return false;
            }


            return true;
        }

    }


} 

$checkout_controller = new CheckoutController($DB->conn);

?>