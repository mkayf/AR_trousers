<?php
    include_once __DIR__ . '/../config/App.php';
    include_once __DIR__ . '/controllers/ProductsController.php';

    // Message variables related to product adding:

    $productsController = new ProductsController($DB->conn);

    // Add products processing:
    if(isset($_POST['add-product'])){
        // Get all the product details and store them into associative array:

        $product_data = [
            'name' => mysqli_real_escape_string($DB->conn, $_POST['product-name']),
            'category' => mysqli_real_escape_string($DB->conn, $_POST['product-category']),
            'images' => $_FILES['product-images'],
            'desc' => mysqli_real_escape_string($DB->conn, $_POST['product-description']),
            'price' => mysqli_real_escape_string($DB->conn, $_POST['product-price']),
            'discounted_price' => mysqli_real_escape_string($DB->conn, $_POST['product-discounted-price']),
                'colors' => [
                'black' => [
                    'black_color_ID' => mysqli_real_escape_string($DB->conn, $_POST['black-color']),
                    'sizes' => [
                        'small' => mysqli_real_escape_string($DB->conn, $_POST['b-small']),
                        'medium' => mysqli_real_escape_string($DB->conn, $_POST['b-medium']),
                        'large' => mysqli_real_escape_string($DB->conn, $_POST['b-large']),
                        'xlarge' => mysqli_real_escape_string($DB->conn, $_POST['b-xlarge']),
                        'xxlarge' => mysqli_real_escape_string($DB->conn, $_POST['b-xxlarge'])
                    ]
                ],
                'white' => [
                    'white_color_ID' => mysqli_real_escape_string($DB->conn, $_POST['white-color']),
                    'sizes' => [
                        'small' => mysqli_real_escape_string($DB->conn, $_POST['w-small']),
                        'medium' => mysqli_real_escape_string($DB->conn, $_POST['w-medium']),
                        'large' => mysqli_real_escape_string($DB->conn, $_POST['w-large']),
                        'xlarge' => mysqli_real_escape_string($DB->conn, $_POST['w-xlarge']),
                        'xxlarge' => mysqli_real_escape_string($DB->conn, $_POST['w-xxlarge'])
                    ]
                ]
            ],
            'status' => mysqli_real_escape_string($DB->conn, $_POST['product-status']),
            'slug' => mysqli_real_escape_string($DB->conn, $_POST['product-slug'])
        ];


        $productsController->addProduct($product_data);
        
    }
?>