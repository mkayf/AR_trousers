<?php

include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../config/RateLimiter.php';
include_once __DIR__ . '/../controllers/CartController.php';
include_once __DIR__ . '/../controllers/CheckoutController.php';

header('Content-Type: application/json');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $request_body = json_decode(file_get_contents('php://input'), true);
    $city = mysqli_real_escape_string($DB->conn, $request_body['cityName']);
    $cityNameArr = ['karachi', 'khi'];

    if(isset($city)){

        if(in_array(strtolower(trim($city)), $cityNameArr)){
            $checkout_controller->setShippingCharges(200);

            echo json_encode(['status' => 'success', 'shippingCharges' => number_format($checkout_controller->getShippingCharges()), 'checkoutTotal' => number_format($checkout_controller->getCheckoutTotal())]);
        } else{
            $checkout_controller->setShippingCharges(300);

            echo json_encode(['status' => 'success', 'shippingCharges' => number_format($checkout_controller->getShippingCharges()), 'checkoutTotal' => number_format($checkout_controller->getCheckoutTotal())]);
        }
        
    } else{
        echo json_encode(['status' => 'failed', 'msg' => 'City is not defined']);
        exit(0);
    }


} else{
    echo json_encode(['status' => 'failed', 'msg' => 'Invalid HTTP method.']);
    http_response_code(405);
    exit(0);
}

?>