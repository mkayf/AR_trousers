<?php
    class LoginController extends SignupController{
        
        public function loginUser($email, $password){
            if($this->getUserInfo($email, $password)){
                return true;
            }
            else{
                return false;
            }
        }

        public function isUserLoggedIn(){
            if(isset($_SESSION['authenticated'])){
                redirect('', '', 'index.php');
            }
        }

        public function rememberUserCredentials($email){
            $auth_token = bin2hex(random_bytes(16));
            $hashed_auth_token = hash('SHA256', $auth_token);

            $getUserID = "SELECT user_ID FROM users WHERE user_email = '$email'";
            $userIDResult = $this->conn->query($getUserID);
            $userID = $userIDResult->fetch_assoc();


            $storeTokenQuery = "UPDATE users SET user_auth_token = '$hashed_auth_token' WHERE user_email = '$email'";
            $result = $this->conn->query($storeTokenQuery);

            if($result){
                setcookie('remember_me', json_encode(["user_ID" => $userID, "auth_token" => $auth_token]), [
                    "expires" => time() + 300,
                    "path" => "/",
                    "secure" => true,
                    "httponly" => true
                ]);
            }

        }

        public function validateUserCredentials(){
            if(isset($_COOKIE['remember_me'])){
                $cookie_data = json_decode($_COOKIE['remember_me'], true);
                $user_ID = $cookie_data['user_ID'];
                $auth_token = $cookie_data['auth_token'];

                $getStoredToken = "SELECT user_auth_token FROM users WHERE user_ID = $user_ID";
                $result = $this->conn->query($getStoredToken);
                $storedToken = $result->fetch_assoc();

                if(hash_equals($storedToken, $auth_token)){
                    return true;
                }

                return false;
            }
        }

        public function logout(){
            if(isset($_SESSION['authenticated'])){
                
                // Set auth_token to null after logging out in db:
                
                $user_ID = $_SESSION['user_data']['user_ID'];

                $setTokenToNull = "UPDATE users SET user_auth_token = null WHERE user_ID = $user_ID";
                $result = $this->conn->query($setTokenToNull);

                if(isset($_COOKIE['remember_me'])){
                    unset($_COOKIE['remember_me']);
                    setcookie('remember_me', '', [
                        "expires" => time() - 3600,
                        "path" => "/",
                        "secure" => true,
                        "httponly" => true
                    ]); 
                }

                unset($_SESSION['authenticated']);
                unset($_SESSION['user_data']);
                return true;
            }
            else{
                return false;
            }
        }

    }

?>