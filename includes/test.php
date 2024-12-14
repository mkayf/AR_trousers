<?php 
    include_once __DIR__ . '/../config/App.php';
   
    $product_stock = [
        'colors' => [
            'black' => [
                'sizes' => [
                    's' => 3,
                    'm' => 14,
                    'l' => 53,
                    'xl' => 23,
                    'xxl' => 43,
                ]
            ]
        ]
     ];

    // $size_arr = ['s', 'm', 'l', 'xl', 'xxl'];

    $size_keys = array_keys($product_stock['colors']['black']['sizes']);

    $query = "";

    for($i = 0; $i < 5; $i++){
        $query .= "stock in black color for size " . $product_stock['colors']['black']['sizes'][$size_keys[$i]] . "<br>";
    }

    echo $query;


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test file</title>
</head>
<body>
    <form method="POST" enctype="multipart/form-data">
        <input type="file" name="images[]" multiple>
        <input type="submit" value="Submit">
    </form>

</body>
</html>