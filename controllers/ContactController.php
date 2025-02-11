    <?php

class ContactController{
    public $conn;

    public function __construct($db_connection)
    {
        $this->conn = $db_connection;
    }

    public function sendMessage($details){

        // Validate to prevent SQL Injection:

        $detailsArr = [];

        foreach($details as $key => $value){
            $detailsArr[$key] = mysqli_real_escape_string($this->conn, $value);
        }


        // Check for empty fields:
            
        $errors = [];
        $fields = ['name', 'email', 'phone-number', 'message'];

        foreach($fields as $field){
            if(empty(trim($details[$field]))){
                $errors[$field] = ucfirst(str_replace('-', ' ', $field)) . " is required";
            }   
        }


        // Validate email:

        if(!empty(trim($detailsArr['email']))){
            if(!filter_var($detailsArr['email'], FILTER_VALIDATE_EMAIL)){
                $errors['email'] = "Please enter a valid email";
            }
        }

        // Validate phone number:

        $pattern = '/^(0[3][0-9]{9}|[3][0-9]{9})$/';

        if(!empty(trim($detailsArr['phone-number']))){
            if(!preg_match($pattern, $detailsArr['phone-number'])){
                $errors['phone-number'] = 'Please enter a valid phone number';
            }
        }


        if(empty($errors)){

            // Insert customer data into customer inqueries table:

            $name = $detailsArr['name'];
            $email = $detailsArr['email'];
            $phone_number = $detailsArr['phone-number'];
            $message = $detailsArr['message'];

            $insertCusInq = "INSERT INTO customer_inquiries(ci_name, ci_email, ci_phone, ci_message) VALUES('$name', '$email', '$phone_number', '$message')";

            try{
                $result = $this->conn->query($insertCusInq);

                return true;
            }
            catch(Error | Exception $e){
                echo "<script>console.log('Error in sendMessage(Failed to insert user data into customer inquiries table): " . $e->getMessage() . ", Line number: " . $e->getLine() . "')</script>";
                return false;
            }

        } else{
            $_SESSION['contact_errors'] = $errors;
            $_SESSION['contact_old_data'] = $detailsArr;
            return false;
        }


    }
}

?>