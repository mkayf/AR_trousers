<?php
include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../controllers/signupController.php';
include_once __DIR__ . '/../controllers/LoginController.php';

// Signup user:

if(isset($_POST['signup-btn'])){
    $user_name = mysqli_real_escape_string($DB->conn, $_POST['user_name']);
    $user_email = mysqli_real_escape_string($DB->conn, $_POST['user_email']);
    $user_password = mysqli_real_escape_string($DB->conn, $_POST['user_password']);
    $user_c_password = mysqli_real_escape_string($DB->conn, $_POST['user_c_password']);

    $signup = new SignupController($DB->conn);

    // Validations for user account creation:

    if(!empty($user_name) && !empty($user_email) && !empty($user_password) && !empty($user_c_password)){
        if(!$signup->doesUserExist($user_email)){
            if($signup->validEmail($user_email)){   
                if($signup->validPassword($user_password)){
                    if($signup->confirmPassword($user_password, $user_c_password)){
                        if($signup->signupUser($user_name, $user_email, $user_password)){
                            redirect("Your account has been created successfully!", "", "index.php");
                        } else{
                            redirect('Internal server error, please signup again.' ,'red', 'signup.php');
                        }
                    } else{
                        redirect('Passwords do not match.', 'red', 'signup.php');
                    }
                } else{
                    redirect('Password length should be 8 characters, and must contain 1 uppercase letter, 1 lowercase letter and 1 digit.', 'red', 'signup.php');
                }
            } else{
                redirect('Please enter a valid email address.', 'red', 'signup.php');
            }
        } else{
            redirect('This email already exists, try different email.', 'red', 'signup.php');
        }
    } else{
        redirect("Fields can't be empty!", 'red', 'signup.php');
    }

}

// Login user:

// Placing LoginController instance outside of isset to use the isUserLoggedIn function in other files; 

$login = new LoginController($DB->conn);

if(isset($_POST['login-btn'])){
    $user_email = mysqli_real_escape_string($DB->conn, $_POST['user_email']);
    $user_password = mysqli_real_escape_string($DB->conn, $_POST['user_password']);

    // Validation for logging user in:
 
    if(!empty(trim($user_email)) && !empty(trim($user_password))){
        if($login->loginUser($user_email, $user_password)){
                if(isset($_POST['remember-me'])){
                    $login->rememberUserCredentials($user_email);
                } 
                
                if(isset($_GET['redirect']) && $_GET['redirect'] == 'checkout'){
                    redirect('You are logged in.', '', 'checkout.php');
                    exit();
                }

                redirect("You are logged in.", "", "index.php");
        } else{
                exit(0);
        }
    } else{
        redirect("Please enter all login details.", "red", "login.php");
    }
    
}


// Logging user out:

if(isset($_POST['logout-btn'])){
    if($login->logout()){
        header('location: login.php');  
    }
    else{
        echo "<script>alert('Some error occured while logging out. Please try again.');</script>";
    }
}


?>