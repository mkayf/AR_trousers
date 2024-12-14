<?php
    include_once __DIR__ . '/../config/App.php';
    include_once __DIR__ . '/controllers/ProductsController.php';

    // Message variables related to product adding:
    $product_added = false;
    $product_adding_errors = false;

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
                        'S' => mysqli_real_escape_string($DB->conn, $_POST['b-small']),
                        'M' => mysqli_real_escape_string($DB->conn, $_POST['b-medium']),
                        'L' => mysqli_real_escape_string($DB->conn, $_POST['b-large']),
                        'XL' => mysqli_real_escape_string($DB->conn, $_POST['b-xlarge']),
                        'XXL' => mysqli_real_escape_string($DB->conn, $_POST['b-xxlarge'])
                    ]
                ],
                'white' => [
                    'white_color_ID' => mysqli_real_escape_string($DB->conn, $_POST['white-color']),
                    'sizes' => [
                        'S' => mysqli_real_escape_string($DB->conn, $_POST['w-small']),
                        'M' => mysqli_real_escape_string($DB->conn, $_POST['w-medium']),
                        'L' => mysqli_real_escape_string($DB->conn, $_POST['w-large']),
                        'XL' => mysqli_real_escape_string($DB->conn, $_POST['w-xlarge']),
                        'XXL' => mysqli_real_escape_string($DB->conn, $_POST['w-xxlarge'])
                    ]
                ]
            ],
            'status' => mysqli_real_escape_string($DB->conn, $_POST['product-status']),
            'slug' => mysqli_real_escape_string($DB->conn, $_POST['product-slug'])
        ];


        if($productsController->addProduct($product_data) === true){
            $product_added = true;
        } else{
            $product_adding_errors = [...$productsController->addProduct($product_data)];
            
        }

        
        
    }
?>