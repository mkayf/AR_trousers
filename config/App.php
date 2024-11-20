<?php
    define("SERVER_NAME", "localhost");
    define("USERNAME", "root");
    define("PASSWORD", "");
    define("DATABASE", "ar_trousers");
    define("ROOT_URL", "/ar_trouser/");


    // Base url function for routing:
        
        function base_url($url){
            echo ROOT_URL . $url;
        }
?>