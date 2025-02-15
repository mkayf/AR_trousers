<?php
include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../auth/auth.php';
include_once __DIR__ . '/controllers/ProductsController.php';

$productsController = new ProductsController($DB->conn);

    // Update product:

    $product_details = $productsController->getProductDetails(31);

    print_r($product_details)

?>