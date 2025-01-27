<?php

include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../config/RateLimiter.php';

$rate_limiter = new RateLimiter(60, 10);

header('Content-Type: Application/json');


if ($rate_limiter->checkRateLimit()) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $request_body = json_decode(file_get_contents('php://input'), true);
        $product_ID = mysqli_real_escape_string($DB->conn, $request_body['productID'] ?? 1);
        $size = mysqli_real_escape_string($DB->conn, $request_body['size'] ?? 'S');
        $color = mysqli_real_escape_string($DB->conn, $request_body['color'] ?? 'black');
        $quantity = mysqli_real_escape_string($DB->conn, $request_body['qty'] ?? 1);

        // Validate the payload:

        $size_arr = ['S', 'M', 'L', 'XL', 'XXL'];

        if (!in_array($size, $size_arr)) {
            echo json_encode(['status' => 'failed', 'msg' => 'Invalid size given']);
            exit(0);
        }

        $color_arr = ['black', 'white'];

        if (!in_array($color, $color_arr)) {
            echo json_encode(['status' => 'failed', 'msg' => 'Invalid color given, ' . $color]);
            exit(0);
        }

        // Validate the stock for the requested product:
        $checkStock = "select s.stock_quantity from product_stock as s
        where s.size_ID = (select size_ID from product_sizes where size = '$size') AND
        s.color_ID = (select color_ID from product_colors where color = '$color') AND
         s.product_ID = $product_ID";


        $stockResult = $DB->conn->query($checkStock);

        if ($stockResult) {
            $stock = $stockResult->fetch_column();

            if ($quantity > $stock) {
                $quantity = $stock;
            }
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'failed', 'msg' => 'Internal server error']);
            exit(0);
        }

        // Check for the user authentication, if user is logged in then store cart data into Database and if not then store in the SESSION.

        if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {

            $user_ID = $_SESSION['user_data']['user_ID'];

            // Check if the similar product with similar user_ID, size and color exists in the cart, if yes then just increment product quantity:

            $checkSimilarProduct = "SELECT cart_ID, quantity from cart WHERE user_ID = $user_ID AND product_ID = $product_ID AND `size` = '$size' AND color = '$color'";

            $productCheck = $DB->conn->query($checkSimilarProduct);

            if ($productCheck) {
                if ($productCheck->num_rows > 0) {
                    $fetchQty = $productCheck->fetch_assoc();

                    $cart_ID = $fetchQty['cart_ID'];
                    $newQty = $fetchQty['quantity'] + $quantity;

                    // Update the quantity of the same product:
                    $updateQtyQuery = "UPDATE cart set quantity = $newQty WHERE cart_ID = $cart_ID";

                    $updateQty = $DB->conn->query($updateQtyQuery);

                    echo json_encode(['status' => 'success', 'msg' => 'product successfully added to cart']);
                } else {

                    $storeProductInCart = "INSERT INTO cart(user_ID, product_ID, size, color, quantity) VALUES($user_ID, $product_ID, '$size', '$color', $quantity)";

                    $cartResult = $DB->conn->query($storeProductInCart);

                    if ($cartResult) {
                        echo json_encode(['status' => 'success', 'msg' => 'product successfully added to cart']);
                    } else {
                        http_response_code(500);
                        echo json_encode(['status' => 'failed', 'msg' => 'Internal server error']);
                        exit(0);
                    }
                }
            } else {
                http_response_code(500);
                echo json_encode(['status' => 'failed', 'msg' => 'Internal server error']);
                exit(0);
            }
        } else {

            // Generate a random guest ID for the guest user:
            if (!isset($_SESSION['guest_ID'])) {
                $_SESSION['guest_ID'] = random_int(1, 1000);
            }


            // Check for the similar product stored in the session cart, if yes then just increment the quantity:

            $similarProductExists = false;

            if (isset($_SESSION['cart_items'])) {

                foreach ($_SESSION['cart_items'] as &$item) {
                    if ($item['product_ID'] == $product_ID && $item['size'] == $size && $item['color'] == $color) {
                        $item['quantity'] = $item['quantity'] + $quantity;
                        $similarProductExists = true;
                    }
                }

                unset($item);  // Unset reference to avoid unintented modifications.

                if (!$similarProductExists) {

                 // Fetch product name, price, image:

                 $fetchProductDetails = "SELECT product_name, product_actual_price, product_discounted_price, product_img_1
                 FROM products
                 WHERE product_ID = $product_ID";

                 $result = $DB->conn->query($fetchProductDetails);

                 if($result){

                     $productDetails = $result->fetch_assoc();

                     $_SESSION['cart_items'][] = [
                         'guest_ID' => $_SESSION['guest_ID'],
                         'product_ID' => $product_ID,
                         'size' => $size,
                         'color' => $color,
                         'quantity' => $quantity,
                         'product_name' => $productDetails['product_name'],
                         'product_actual_price' => $productDetails['product_actual_price'],
                         'product_discounted_price' => $productDetails['product_discounted_price'],
                         'product_img_1' => $productDetails['product_img_1']
                     ];

                 } else{
                   http_response_code(500);
                   echo json_encode(['status' => 'failed', 'msg' => 'Internal server error']);
                   exit(0);  
                 }   

                }
            } else {
                
                // Fetch product name, price, image:

                $fetchProductDetails = "SELECT product_name, product_actual_price, product_discounted_price, product_img_1
                FROM products
                WHERE product_ID = $product_ID";

                $result = $DB->conn->query($fetchProductDetails);

                if($result){

                    $productDetails = $result->fetch_assoc();

                    $_SESSION['cart_items'][] = [
                        'guest_ID' => $_SESSION['guest_ID'],
                        'product_ID' => $product_ID,
                        'size' => $size,
                        'color' => $color,
                        'quantity' => $quantity,
                        'product_name' => $productDetails['product_name'],
                        'product_actual_price' => $productDetails['product_actual_price'],
                        'product_discounted_price' => $productDetails['product_discounted_price'],
                        'product_img_1' => $productDetails['product_img_1']
                    ];

                } else{
                  http_response_code(500);
                  echo json_encode(['status' => 'failed', 'msg' => 'Internal server error']);
                  exit(0);  
                }

            }



            echo json_encode(['status' => 'success', 'msg' => 'Product added successfully']);
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
