<?php

include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../config/RateLimiter.php';

$rateLimiter = new RateLimiter(60, 30);

header('Content-Type: Application/json');

if ($rateLimiter->checkRateLimit()) {

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Get all the request body data:

        $request_body = json_decode(file_get_contents('php://input'), true);
        $filterType = mysqli_real_escape_string($DB->conn, $request_body['filterType'] ?? 'reset-filters');
        $sortType = mysqli_real_escape_string($DB->conn, $request_body['sortType'] ?? 'reset-sort');

        // Conditions for checking filter and sort type to query products according to them:

        $where_clause = "p.status = 'active'";
        $order_by = "p.product_ID DESC";

        if ($filterType && $filterType !== 'reset-filters') {
            if ($filterType === 'Pure_cotton') {
                $where_clause .= "AND p.product_cat_ID = 1";
            } else if ($filterType === 'Polyester_cotton') {
                $where_clause .= "AND p.product_cat_ID = 2";
            } else if ($filterType === 'below-1000') {
                $where_clause .= "AND p.product_actual_price < 1000";
            } else if ($filterType === "1000-2000") {
                $where_clause .= "AND p.product_actual_price BETWEEN 1000 AND 2000";
            } else if ($filterType === "2000-3000") {
                $where_clause .= "AND p.product_actual_price BETWEEN 2000 AND 3000";
                } else {
                echo json_encode(['status' => 'failed', 'msg' => 'Something went wrong with your request. Please refresh the page and try again.']);
                exit(0);
            }
        }

        if($sortType && $sortType !== 'reset-sort'){
            if($sortType === 'low-to-high'){
                $order_by = "p.product_actual_price ASC";
            } else if($sortType === 'high-to-low'){
                $order_by = "p.product_actual_price DESC";
            } else if($sortType === 'new-to-old'){
                $order_by = "p.product_ID DESC";
            } else if($sortType === 'old-to-new'){
                $order_by = "p.product_ID ASC";
            } else{
                echo json_encode(['status' => 'failed', 'msg' => 'Something went wrong with your request. Please refresh the page and try again.']);
                exit(0);
            }
        }

        $fetchProducts = "SELECT p.product_ID, p.product_cat_ID, p.product_name, p.product_actual_price, p.product_discounted_price, p.product_img_1, p.product_img_2, p.slug FROM products AS p
        WHERE $where_clause ORDER BY $order_by LIMIT 24";

        $result = $DB->conn->query($fetchProducts);

        if ($result) {

            $products = "";

            while ($row = $result->fetch_assoc()) {
                $products .= '
                <div class="product-card col-sm-6 col-md-3 col-lg-3">
                    <div class="product-img-div">
                        <a class="product-link text-reset col-sm-6 col-md-3 col-lg-3" href="product.php?id='. $row['product_ID'] .'&slug='. $row['slug'] .'">
                        <img src="../' . htmlspecialchars($row['product_img_1']) . '" alt="">
                        </a>
                    </div>
                    <div class="product-details-div">
                        <a class="product-link text-reset col-sm-6 col-md-3 col-lg-3" href="product.php?id='. $row['product_ID'] .'&slug='. $row['slug'] .'">
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
                        </a>
                    </div>
                </div>';
            }

            if (!empty($products)) {
                echo json_encode(['status' => 'success', 'products' => $products]);
            } else {
                echo json_encode(['status' => 'empty', 'msg' => 'No products found. Try adjusting the filters']);
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
