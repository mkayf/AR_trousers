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

        public function logout(){
            if(isset($_SESSION['authenticated'])){
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