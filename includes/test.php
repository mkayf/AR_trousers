<?php
    include_once __DIR__ . '/../config/App.php';

    $SQL = "SELECT product_name, product_actual_price, product_discounted_price, product_img_1 FROM products WHERE product_ID = 31";

    $result = $DB->conn->query($SQL);

    $data = $result->fetch_assoc();

    print_r($_SESSION['cart_items'][0]['quantity'] += 3);



?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div class="container">
    <button>Add</button>
</div>


<script>

</script>
</body>
</html>