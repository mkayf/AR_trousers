<?php

class CheckoutController extends CartController{
    public $conn;
    public $shippingCharges = 300;

    public function __construct($db_connection){
        parent::__construct($db_connection);
        $this->conn = $db_connection;
    }

    public function setShippingCharges($charges){
        $this->shippingCharges = $charges;
        return $this->shippingCharges;
    }

    public function getCheckoutTotal(){
        return $this->getCartTotal() + $this->shippingCharges;
    }

    public function placeOrder($cusDetails){
        // Place order for the authenticated user:
        if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true){
            // Insert customer shipping details into shipping details table first:

            $shippingDetailsQuery = "INSERT INTO shipping_details (user_ID, first_name, last_name, phone_number, )";
        }
    }


} 

$checkout_controller = new CheckoutController($DB->conn);

?>