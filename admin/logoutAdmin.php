<?php

include_once __DIR__ . '/../config/App.php';

if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true){
    
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

    header('location: ' . ROOT_URL . 'login.php');
    exit(0);
} else{
    header('location: ' . ROOT_URL . '404.php');
    exit(0);
}

?>