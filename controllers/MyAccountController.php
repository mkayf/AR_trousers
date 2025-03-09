<?php

class MyAccountController
{
    public $conn;

    public function __construct($db_connection)
    {
        $this->conn = $db_connection;
    }

    public function getShippingDetails($user_ID)
    {
        $get_details = "SELECT * FROM shipping_details WHERE user_ID = $user_ID";

        $details_result = $this->conn->query($get_details);

        if ($details_result) {
            if ($details_result->num_rows > 0) {
                $shipping_details = $details_result->fetch_assoc();
                return $shipping_details;
            }
            return null;
        }

        return null;
    }

    public function saveShippingDetails($user_ID, $details)
    {

        // Validate shipping details;

        $details_arr = [];
        $errors = [];

        foreach ($details as $key => $value) {
            $details_arr[$key] = mysqli_real_escape_string($this->conn, $value);
        }

        // Empty value check:

        $fields = ['first-name', 'last-name', 'phone-number', 'address', 'city'];

        foreach ($fields as $field) {
            if (empty(trim($details_arr[$field]))) {
                $errors[$field] = ucfirst(str_replace('-', ' ', $field)) . " is required";
            }
        }

        // Validate phone number:

        $pattern = '/^(0[3][0-9]{9}|[3][0-9]{9})$/';

        if (!empty($details_arr['phone-number'])) {
            if (!preg_match($pattern, $details_arr['phone-number'])) {
                $errors['phone-number'] = 'Please enter a valid phone number';
            }
        }

        // Validate email if given

        if (!empty($details_arr['email'])) {
            if (!filter_var($details_arr['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Please enter valid email";
            }
        }
 
        // Validate state:

        $state_arr = ['Azad Kashmir', 'Balochistan', 'Islamabad Capital Territory', 'Khyber Pakhtunkhwa', 'Punjab', 'Sindh'];

        if ($details_arr['state'] == 'null' || !in_array($details_arr['state'], $state_arr)) {
            $errors['state'] = 'Please select a valid state';
        }

        if (empty($errors)) {

            // Update details if shipping details are already stored for that user ID, if not then insert:

            $check_details = "SELECT shipping_ID FROM shipping_details WHERE user_ID = $user_ID";

            $check_result = $this->conn->query($check_details);

            if ($check_result) {
                if ($check_result->num_rows > 0) {
                    $shipping_ID = $check_result->fetch_assoc();

                    $save_details = "UPDATE shipping_details SET first_name = '{$details_arr['first-name']}', last_name = '{$details_arr['last-name']}', phone_number = '{$details_arr['phone-number']}', email = '{$details_arr['email']}', street_address = '{$details_arr['address']}', landmark = '{$details_arr['landmark']}', state = '{$details_arr['state']}', city = '{$details_arr['city']}' WHERE shipping_ID = $shipping_ID[shipping_ID]";
                }
                else{
                    $save_details = "INSERT INTO shipping_details (user_ID, first_name, last_name, phone_number, email, street_address, landmark, state, city) VALUES ($user_ID, '{$details_arr['first-name']}', '{$details_arr['last-name']}', '{$details_arr['phone-number']}', '{$details_arr['email']}', {$details_arr['address']}', '{$details_arr['landmark']}', '{$details_arr['state']}', '{$details_arr['city']}')";
                }

                $save_details_result = $this->conn->query($save_details);

                if($save_details_result){
                    $_SESSION['details_saved'] = "Your shipping details have been saved successfully!";
                }

            }


        }
        else {
            $_SESSION['errors'] = $errors;
            $_SESSION['save_error'] = "Please provide all required details correctly.";
        }

    }
}
