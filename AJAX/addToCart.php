<?php

include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../config/RateLimiter.php';

$rate_limiter = new RateLimiter(60, 4);

header('Content-Type: Application/json');

if($rate_limiter->checkRateLimit()){
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $request_body = json_decode(file_get_contents('php://input'), true);
        $product_ID = mysqli_real_escape_string($DB->conn, $request_body['productID'] ?? 1);
        $size = mysqli_real_escape_string($DB->conn, $request_body['size'] ?? 'S');
        $color = mysqli_real_escape_string($DB->conn, $request_body['color'] ?? 'black');
        $quantity = mysqli_real_escape_string($DB->conn, $request_body['qty'] ?? 1);

        // Validate the payload:
        


        $size_arr = ['S', 'M', 'L', 'XL', 'XXL'];
        
        if(!in_array($size, $size_arr)){
            echo json_encode(['status' => 'failed', 'msg' => 'Invalid size given']);
            exit(0);
        }
        
        $color_arr = ['black', 'white'];
        
        if(!in_array($color, $color_arr)){
            echo json_encode(['status' => 'failed', 'msg' => 'Invalid color given']);
            exit(0);
        }

        // Validate the stock for the requested product:
        $checkStock = "select s.stock_quantity from product_stock as s
        where s.size_ID = (select size_ID from product_sizes where size = '$size') AND
        s.color_ID = (select color_ID from product_colors where color = '$color') AND
         s.product_ID = $product_ID";

        $stockResult = $DB->conn->query($checkStock);

        if($stockResult){
            $stock = $stockResult->fetch_column();
    
            if($quantity > $stock){
                $quantity = $stock;
            }
        }
        else{
            http_response_code(500);
            echo json_encode(['status' => 'failed', 'msg' => 'Internal server error']);
            exit(0);
        }
        
        // Check for the user authentication, if user is logged in then store cart data into Database and if not then store in the SESSION.
        
        if(isset($_SESSION['authenticated']) && $_SESSION['authenticated']){

            $user_ID = $_SESSION['user_data']['user_ID'];

            $storeProductInCart = "INSERT INTO cart(user_ID, product_ID, size, color, quantity) VALUES($user_ID, $product_ID, '$size', '$color', $quantity)";

            $cartResult = $DB->conn->query($storeProductInCart);
                        

            if($cartResult){
                echo json_encode(['status' => 'success', 'msg' => 'product successfully added to cart']);
            }
            else{
                http_response_code(500);
                echo json_encode(['status' => 'failed', 'msg' => 'Internal server error']);
                exit(0);
            }
            
        } 
        else{
            echo json_encode(['status' => 'failed', 'msg' => 'User is not authenticated']);
        }

        http_response_code(200);
    }
    else{
        http_response_code(405);
        echo json_encode(['status' => 'failed', 'msg' => 'Request method not allowed']);
    }
}
else{
    http_response_code(429);
    echo json_encode(['status' => 'failed', 'msg' => 'Too many requests']);
}



?>