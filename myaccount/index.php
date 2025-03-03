<?php

include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../auth/auth.php';
include_once __DIR__ . '/../controllers/CartController.php';

if(!isset($_SESSION['authenticated']) && !$_SESSION['authenticated'] == true){
    redirect('', '', 'login.php');
}

header('location: orders.php');
exit();