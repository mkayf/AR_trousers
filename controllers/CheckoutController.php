<?php

class CheckoutController extends CartController{
    public $conn;
    public $shippingCharges = 200;
    
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

} 

$checkout_controller = new CheckoutController($DB->conn);

?>