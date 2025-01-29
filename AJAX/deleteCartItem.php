<?php

include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../config/RateLimiter.php';
include_once __DIR__ . '/../controllers/CartController.php';

$rate_limiter = new RateLimiter(60, 30);

header('Content-Type: Application/json');
// Deleting cart item and retrieving cart total:

if ($rate_limiter->checkRateLimit()) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        http_response_code(200);

        $request_body = json_decode(file_get_contents('php://input'), true);
        $cart_ID = mysqli_real_escape_string($DB->conn, $request_body['cartID']);

        if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true){
            $deleteQuery = "DELETE FROM cart WHERE cart_ID = $cart_ID";

            $result = $DB->conn->query($deleteQuery);

            if ($result) {
                $cart_total = $cartController->getCartTotal();

                echo json_encode(['status' => 'success', 'cart_total' => $cart_total]);
            }
        } 
        else if(isset($_SESSION['cart_items'])){

            foreach ($_SESSION['cart_items'] as $key => $item) {
                if ($item['cart_ID'] == $cart_ID) {
                    unset($_SESSION['cart_items'][$key]);
                    break;
                }
            }
            
            $cart_total = $cartController->getCartTotal();

            echo json_encode(['status' => 'success', 'cart_total' => $cart_total]);

        } 
        else{
            echo json_encode(['status' => 'failed', 'msg' => 'No user or guest ID given']);    
        }
        
        
        
    } else {
        http_response_code(405);
        echo json_encode(['status' => 'failed', 'msg' => 'Request method not allowed']);
    }
} else {
    http_response_code(429);
    echo json_encode(['status' => 'failed', 'msg' => 'Too many requests']);
}
