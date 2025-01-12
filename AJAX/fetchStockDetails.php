<?php

include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../config/RateLimiter.php';

$rateLimiter = new RateLimiter(60, 30);

header('Content-Type: Application/json');

if ($rateLimiter->checkRateLimit()) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $request_body = json_decode(file_get_contents('php://input'), true);
        $size = mysqli_real_escape_string($DB->conn, $request_body['size'] ?? 'S');
        $color = mysqli_real_escape_string($DB->conn, $request_body['color'] ?? 'black');
        $product_ID = mysqli_real_escape_string($DB->conn, $request_body['productID'] ?? 1);


        // Fetch sizes for the given color:

        $fetchSizes = "select si.size from product_stock as s
        inner join product_sizes as si
        on s.size_ID = si.size_ID
        inner join product_colors as c
        on s.color_ID = c.color_ID
        where s.product_ID = $product_ID and c.color = '$color' and s.stock_quantity > 0;";

        $sizesResult = $DB->conn->query($fetchSizes);

        $sizes = [];

        if($sizesResult){

            while($row = $sizesResult->fetch_column()){
                    $sizes[] = $row;
            }; 
        
        } else{
            http_response_code(500);
            echo json_encode(['status' => 'failed', 'msg' => 'Internal server error']);
            exit(0);
        }

        // Fetch stock quantity for the given color and size:

        $fetchStockQuantity = "
        select stock_quantity from product_stock as s
        where s.product_ID = $product_ID
        and s.size_ID = (select size_ID from product_sizes where size = '$size')
        and s.color_ID = (select color_ID from product_colors where color = '$color');";

        $qtyResult = $DB->conn->query($fetchStockQuantity);

        if($qtyResult){
            $stock_qty = $qtyResult->fetch_column();
            
            echo json_encode(['status' => 'success', 'sizes' => $sizes, 'stock' => ['qty' => $stock_qty, 'for' => $size]]);

        } else{
            http_response_code(500);
            echo json_encode(['status' => 'failed', 'msg' => 'Internal server error']);
            exit(0);
        }   

        http_response_code(200);


    } else {
        http_response_code(405);
        echo json_encode(['status' => 'failed', 'msg' => 'Request method not allowed']);
    }
} else {
    http_response_code(429);
    echo json_encode(['status' => 'failed', 'msg' => 'Too many requests']);
}
