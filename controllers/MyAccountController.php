<?php

class MyAccountController{
    public $conn;

    public function __construct($db_connection)
    {
        $this->conn = $db_connection;
    }

    public function getShippingDetails($user_ID){
        $get_details = "SELECT * FROM shipping_details WHERE user_ID = $user_ID";

        $details_result = $this->conn->query($get_details);

        if($details_result){
            if($details_result->num_rows > 0){
                $shipping_details = $details_result->fetch_assoc();
                return $shipping_details;
            }
            return null;
        }

        return null;
    }

    public function saveShippingDetails($user_ID, $details){
        // Update details if shipping details are already stored for that user ID, if not then insert:
        
        $check_details = "SELECT shipping_ID FROM shipping_details WHERE user_ID = $user_ID";

        $check_result = $this->conn->query($check_details);

        if($check_result){
            if($check_result->num_rows > 0){
                $save_details = "UPDATE shipping_details SET ";
            }
        }
    }
}

?>