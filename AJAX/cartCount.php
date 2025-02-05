<?php

include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../config/RateLimiter.php';
include_once __DIR__ . '/../controllers/CartController.php';

header('Content-Type: application/json'); // Set the content type to JSON
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['cart_count']) && $_GET['cart_count'] === 'true') {
        echo json_encode(['status' => 'success', 'cart_count' => $cartCount]);

        http_response_code(200);
    } else {
        echo json_encode(['status' => 'failed', 'message' => 'Invalid request.']);
        http_response_code(400);
    }
} else {
    echo json_encode(['status' => 'failed', 'message' => 'Invalid HTTP method.']);
    http_response_code(405);
}


?>