<?php
    class SignupController{
        public $conn;

        public function __construct($db_connection){
            $this->conn = $db_connection;
        }

        public function signupUser($name, $email, $password){
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $signupQuery = "INSERT INTO users(user_name, user_email, user_password) VALUES('$name', '$email', '$hashedPassword')";
            $result = $this->conn->query($signupQuery);
            if($result){
                    $this->getUserInfo($email, $password);
                    return true;
            } else{
                return false;   
            }
        }

        public function doesUserExist($email){
            $checkUserQuery = "SELECT user_email FROM users WHERE user_email = '$email'";
            $result = $this->conn->query($checkUserQuery);
            return ($result->num_rows == 1) ? true : false;
        }

        public function confirmPassword($password, $c_password){
            return ($password == $c_password) ? true : false;
        }

        public function validPassword($password){
            $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/';
            if(preg_match($pattern, $password)){
                return true;
            }
            return false;
        }

        // A function to get user data when signed up or logged in:

        public function getUserInfo($email, $password){
            $getUserDataQuery = "SELECT * FROM users WHERE user_email = '$email'";
            $result = $this->conn->query($getUserDataQuery);
            if($result->num_rows == 1){
                $data = $result->fetch_assoc();
                if(password_verify($password, $data['user_password'])){
                    $_SESSION['authenticated'] = true;
                    $_SESSION['user_data'] = [
                    'user_ID' => $data['user_ID'],
                    'user_name' => $data['user_name'],
                    'user_email' => $data['user_email'],
                    'user_role' => $data['user_role'],
                    ];
                    return true;
                } else{
                    redirect('Invalid password!', 'red', 'login.php');
                }
            } else{
                redirect('Sorry, no account found with this email address.', 'red', 'login.php');
            }
        }
        
    }

?>