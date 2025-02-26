<?php
    class LoginController extends SignupController{

        // Logging user in:

        public function loginUser($email, $password){
            if($this->getUserInfo($email, $password)){
                return true;
            }
            else{
                return false;
            } 
        }

        // Check if user is already logged and if he is then redirect him to the home page whenever he tries to access login or signup page:

        public function isUserLoggedIn(){
            if(isset($_SESSION['authenticated'])){
                redirect('You are logged in.', '', 'index.php');
            }
        }

        // Remember user credentials by storing a token in DB along with in cookie whenever user checkmarks the remember me checkbox in login page:

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
                    "expires" => time() + 86400 * 3,
                    "path" => "/",
                    "secure" => true,
                    "httponly" => true
                ]);
            }

        }

        // Verify user credentials if there is a 'remember me' cookie stored:

        public function validateUserCredentials(){
            if(isset($_COOKIE['remember_me'])){
                $cookie_data = json_decode($_COOKIE['remember_me'], true);
                $user_ID = $cookie_data['user_ID']['user_ID'];
                $auth_token = $cookie_data['auth_token'];
                $hashed_cookie_token = hash('SHA256', $auth_token);

                $getUserDetails = "SELECT * FROM users WHERE user_ID = $user_ID";
                $result = $this->conn->query($getUserDetails);
                $data = $result->fetch_assoc();
                
                if($data['user_auth_token']){
                    
                    if(hash_equals($data['user_auth_token'], $hashed_cookie_token)){
                        $_SESSION['authenticated'] = true;
                        $_SESSION['user_data'] = [
                        'user_ID' => $data['user_ID'],
                        'user_name' => $data['user_name'],
                        'user_email' => $data['user_email'],
                        'user_role' => $data['user_role'],
                        ];
                        return true;
                    }
    
                    return false;
                }
                
            }
        }

        // log out the user:

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