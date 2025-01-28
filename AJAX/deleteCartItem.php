<?php

include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../config/RateLimiter.php';

$rate_limiter = new RateLimiter(60, 10);

header('Content-Type: Application/json');

if($rate_limiter->checkRateLimit()){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $request_body = json_decode(file_get_contents('php://input'), true);
    $cart_ID = mysqli_real_escape_string($DB->conn, $request_body['cartID']);

    $deleteQuery = "DELETE FROM cart WHERE cart_ID = $cart_ID";

    $result = $DB->conn->query($deleteQuery);

    if($result){
        echo json_encode(['status' => 'success', 'msg' => 'Cart item deleted successfully']);
    }


    
    http_response_code(200);

    } else{
        http_response_code(405);
        echo json_encode(['status' => 'failed', 'msg' => 'Request method not allowed']);
    }


} else{
    http_response_code(429);
    echo json_encode(['status' => 'failed', 'msg' => 'Too many requests']);
}


?>