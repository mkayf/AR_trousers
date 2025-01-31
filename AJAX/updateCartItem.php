<?php

include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../config/RateLimiter.php';
include_once __DIR__ . '/../controllers/CartController.php';

$rate_limiter = new RateLimiter(60, 30);

header('Content-Type: Application/json');

// Update cart Item's quantity and return the latest updated cart quantity:

if ($rate_limiter->checkRateLimit()) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        http_response_code(200);

        $request_body = json_decode(file_get_contents('php://input'), true);

        if (isset($request_body['cartID']) && is_numeric($request_body['cartID']) && !empty($request_body['cartID'])) {
            $cart_ID = mysqli_real_escape_string($DB->conn, $request_body['cartID']);
        } else {
            echo json_encode(['status' => 'failed', 'msg' => 'Invalid cart ID given.']);
            exit(0);
        }

        if (isset($request_body['qty']) && is_numeric($request_body['qty']) && !empty($request_body['qty'])) {
            $newQty = mysqli_real_escape_string($DB->conn, $request_body['qty']);
        } else {
            echo json_encode(['status' => 'failed', 'msg' => 'Invalid cart item quantity given.']);
            exit(0);
        }

        if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true) {
            $user_ID = $_SESSION['user_data']['user_ID'];

            // Fetch cart details for the given cart ID:

            $cartDetailsQuery = "SELECT product_ID, size, color FROM cart WHERE cart_ID = $cart_ID AND user_ID = $user_ID";

            $fetchCartDetails = $DB->conn->query($cartDetailsQuery);

            if ($fetchCartDetails) {

                if ($fetchCartDetails->num_rows > 0) {
                    $cartDetails = $fetchCartDetails->fetch_assoc();
                    

                    // Validate the stock for the new quantiy given:
                    $checkStock = "select s.stock_quantity from product_stock as s
                    where s.size_ID = (select size_ID from product_sizes where size = '$cartDetails[size]') AND
                    s.color_ID = (select color_ID from product_colors where color = '$cartDetails[color]') AND
                    s.product_ID = $cartDetails[product_ID]";

                    $stockResult = $DB->conn->query($checkStock);

                    if ($stockResult) {
                        $stock = $stockResult->fetch_column();

                        if ($newQty > $stock) {
                            $newQty = $stock;
                        }

                        // Update the cart quantity after validation:
                        $updateQtyQuery = "UPDATE cart SET quantity = $newQty WHERE cart_ID = $cart_ID AND user_ID = $user_ID";

                        $updateQty = $DB->conn->query($updateQtyQuery);

                        if($updateQty){
                            $cart_item_subtotal = $cartController->getCartItemSubtotal($cartDetails['product_ID'], $newQty);
                            $cart_total = $cartController->getCartTotal();

                            echo json_encode(['status' => 'success', 'updatedQty' => $newQty, 'cart_total' => $cart_total, 'cart_item_subtotal' => $cart_item_subtotal]);
                        }

                    } else {
                        http_response_code(500);
                        echo json_encode(['status' => 'failed', 'msg' => 'Internal server error']);
                        exit(0);
                    }
                } else {
                    echo json_encode(['status' => 'failed', 'msg' => 'No cart item found for the given cart ID or user ID']);
                    exit(0);
                }

            } else {
                http_response_code(500);
                echo json_encode(['status' => 'failed', 'msg' => 'Internal server error']);
                exit(0);
            }
        }


    } else {
        http_response_code(405);
        echo json_encode(['status' => 'failed', 'msg' => 'Request method not allowed']);
    }
} else {
    http_response_code(429);
    echo json_encode(['status' => 'failed', 'msg' => 'Too many requests']);
}
