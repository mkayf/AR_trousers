<?php

$product_ID = isset($_GET['id']) ? $_GET['id'] : 1;

if (!is_numeric($product_ID)) {
    $product_ID = 1; // Fallback to default product ID
}

try {
    // Step 1: Fetch the main product details
    $productQuery = "SELECT 
    p.product_ID, p.product_name, p.product_desc, 
    p.product_actual_price, p.product_discounted_price, 
    p.product_img_1, p.product_img_2, p.product_img_3, 
    p.slug, cat.cat_name 
    FROM products AS p
    INNER JOIN product_categories AS cat
    ON p.product_cat_ID = cat.cat_ID           
    WHERE p.product_ID = $product_ID";
    
    $productResult = $this->conn->query($productQuery);

    if ($productResult->num_rows == 0) {
        return null; // No product found
    }

    $productData = $productResult->fetch_assoc();

    // Step 2: Fetch stock details for the default color (black)
    $stockQuery = "SELECT 
                          c.color, si.size, s.stock_quantity 
                       FROM product_stock AS s
                       INNER JOIN product_colors AS c ON s.color_ID = c.color_ID
                       INNER JOIN product_sizes AS si ON s.size_ID = si.size_ID
                       WHERE s.product_ID = $product_ID AND c.color = 'black'";
    $stockResult = $this->conn->query($stockQuery);

    $stockData = [];
    while ($row = $stockResult->fetch_assoc()) {
        $stockData[] = $row;
    }

    // Step 3: If no stock for 'black', fetch stock for other colors
    if (empty($stockData)) {
        $fallbackStockQuery = "SELECT 
            c.color, si.size, s.stock_quantity 
            FROM product_stock AS s
            INNER JOIN product_colors AS c ON s.color_ID = c.color_ID
            INNER JOIN product_sizes AS si ON s.size_ID = si.size_ID
            WHERE s.product_ID = $product_ID AND s.stock_quantity > 0
            ORDER BY c.color ASC LIMIT 1"; // Fetch stock for the next available color
        $fallbackStockResult = $this->conn->query($fallbackStockQuery);

        if ($fallbackStockResult->num_rows > 0) {
            $stockData = [];
            while ($row = $fallbackStockResult->fetch_assoc()) {
                $stockData[] = $row;
            }
        }
    }

    $productData['stock'] = $stockData;

    return $productData;
} catch (Exception | Error $e) {
    echo "<script>console.log('Error in getSingleProduct: " . $e->getMessage() . ", Line: " . $e->getLine() . "');</script>";
    return null;
}
