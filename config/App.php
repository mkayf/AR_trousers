<?php
    session_start();

    define("SERVER_NAME", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DATABASE", "ar_trousers");
    define("ROOT_URL", "/ar_trouser/");

    // Database connection
    include 'DB_connection.php';
    $DB = new DB_Connection;


    // Base url function for routing:
        
    function base_url($url){
        echo ROOT_URL . $url;
    }

    // To show any message and redirect to a page

    function redirect($msg = "", $msgColor = "", $url){
        $redirectTo = ROOT_URL . $url;
        $_SESSION['message'] = ["msg" => $msg, "msgColor" => $msgColor];
        header("Location: $redirectTo");
        exit(0);
    }    
?>