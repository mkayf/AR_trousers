<?php 
    include_once __DIR__ . '/../config/App.php';

    function returnErrors() : array
    {
        $product_errors = [
            'upload_error' => 'failed to upload images',
            'details_error' => 'incorrect details',
            'stock_error' => 'fill all the stock fields'
        ];

        return $product_errors;
    }

    $errors = [...returnErrors()];
    


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