<?php
include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../config/RateLimiter.php';

$rateLimiter = new RateLimiter(60, 10);

header('Content-Type: Application/json');

if ($rateLimiter->checkRateLimit()) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $limit = 24;
        $request_body = json_decode(file_get_contents('php://input'), true);
        $offset = mysqli_real_escape_string($DB->conn, $request_body['offset'] ?? 24);
        $filterType = mysqli_real_escape_string($DB->conn, $request_body['filterType'] ?? null);
        $sortType = mysqli_real_escape_string($DB->conn, $request_body['sortType'] ?? null);
        
    

        $fetchProducts = "SELECT product_ID, product_cat_ID, product_name, product_actual_price, product_discounted_price, product_img_1, product_img_2, slug FROM products WHERE status = 'active' ORDER BY product_ID DESC LIMIT $limit OFFSET $offset";

        $result = $DB->conn->query($fetchProducts);

        if ($result) {

            $products = "";

            while ($row = $result->fetch_assoc()) {
                $products .= '
                <div class="product-card col-sm-6 col-md-3 col-lg-3">
                    <div class="product-img-div">
                        <img src=".' . htmlspecialchars($row['product_img_1']) . '" alt="">
                        <span class="product-cart-icon">
                            <i class="bi bi-bag" style="font-size: 1.2rem;"></i>
                        </span>
                        <span class="mini-size-box">
                            <div class="radio-inputs">
                                <label class="radio">
                                    <input checked="" name="radio" type="radio">
                                    <span class="name">S</span>
                                </label>
                                <label class="radio">
                                    <input name="radio" type="radio">
                                    <span class="name">M</span>
                                </label>
                                <label class="radio">
                                    <input name="radio" type="radio">
                                    <span class="name">L</span>
                                </label>
                                <label class="radio">
                                    <input name="radio" type="radio">
                                    <span class="name">XL</span>
                                </label>
                                <label class="radio">
                                    <input name="radio" type="radio">
                                    <span class="name">XXL</span>
                                </label>
                            </div>
                            <button class="mini-add-to-cart" tabindex="-1">Add to cart</button>
                        </span>
                    </div>
                    <div class="product-details-div">
                        <p class="product-title">' . htmlspecialchars($row['product_name']) . '</p>';

                if ($row['product_discounted_price'] != 0) {
                    $products .= '
                        <p class="product-price discount-strike">Rs ' . number_format($row['product_actual_price']) . '</p>
                        <p class="product-discounted-price">Rs ' . number_format($row['product_discounted_price']) . '</p>';
                } else {
                    $products .= '
                        <p class="product-price">Rs ' . number_format($row['product_actual_price']) . '</p>';
                }

                $products .= '
                    </div>
                </div>';
            }

            if (!empty($products)) {
                echo json_encode(['status' => 'success', 'products' => $products]);
            } else {
                echo json_encode(['status' => 'empty', 'msg' => 'More trousers are coming soon.']);
            }


            http_response_code(200);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'failed', 'msg' => 'Internal server error']);
        }
    } else {
        http_response_code(405);
        echo json_encode(['status' => 'failed', 'msg' => 'Request method not allowed']);
    }
} else {
    http_response_code(429);
    echo json_encode(['status' => 'failed', 'msg' => 'Too many requests']);
}
