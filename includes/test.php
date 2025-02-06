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

CREATE TABLE orders(
	ORDER_ID INT PRIMARY KEY AUTO_INCREMENT,
    USER_ID INT DEFAULT NULL,
    GUEST_ID INT DEFAULT NULL,
    ORDER_STATUS ENUM('Pending', 'Confirmed', 'Processing', 'Shipped', )
)

<script>

</script>
</body>
</html>