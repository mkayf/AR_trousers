<?php

include_once __DIR__ . '/config/App.php';
include_once __DIR__ . '/auth/auth.php';
include_once __DIR__ . '/controllers/CartController.php';
include_once __DIR__ . '/controllers/CheckoutController.php';
include_once __DIR__ . '/placeOrder.php';


if(isset($_SESSION['order_ID'])){
    $order_ID = $_SESSION['order_ID'];

    $orderSummaryQuery = "SELECT s.first_name, s.last_name, SUM(ot.quantity) as total_items, o.total, o.payment_method
    FROM orders as o
    INNER JOIN shipping_details as s
    ON o.shipping_ID = s.shipping_ID
    INNER JOIN order_items as ot
    ON o.order_ID = ot.order_ID
    WHERE o.order_ID = $order_ID";    

    try{
        $summaryResult = $DB->conn->query($orderSummaryQuery);
        
        $summaryData = $summaryResult->fetch_assoc();

    }
    catch(Error | Exception $e){
        echo "<script>console.log('Error in thankyou.php(Failed to fetch order summary details): ". $e->getMessage() .", Line number: ". $e->getLine() ."');</script>";
        redirect('', '', 'checkout.php');
        exit(0);
    }

    unset($_SESSION['order_ID']);

} else{
    unset($_SESSION['message']);
    header("location: index.php");
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AR Trousers - Shop Stylish Women's Stitched Trousers Online</title>
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon-16x16.png">
    <link rel="manifest" href="<?= ROOT_URL ?>site.webmanifest">
    <!-- BOOTSTRAP LINK CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <!-- CUSTOM CSS STYLESHEET -->
   <link rel="stylesheet" href="./css/style.css">
   
  <body>

    <!-- NAVBAR -->
     <header>
         <?php include './includes/Navbar.php'; ?>
     </header>

     <main class="thankyou-main">
        <div class="heading-div d-flex justify-content-center align-items-center mt-5">
        <span class="separator"></span><h2 class="section-heading">Thank you</h2><span class="separator"></span>
        </div>
        <p class="tag-line">Order confirmed! We’re getting things ready for you.</p>

        <div class="container thankyou-container my-5">
            <h3 class="text-center">Order summary</h3>
            <div class="container summary-container">
            <table class="summary-table my-3 ">
                <tbody>
                    <tr>
                        <td>Order ID</td>
                        <td><?= $order_ID ?></td>
                    </tr>
                    <tr>
                        <td>Customer Name</td>
                        <td><?= $summaryData['first_name'] ?? '' ?> <?= $summaryData['last_name'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>Total Items</td>
                        <td><?= $summaryData['total_items'] ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>Total Price</td>
                        <td>Rs <?= number_format($summaryData['total']) ?? '' ?></td>
                    </tr>
                    <tr>
                        <td>Payment method</td>
                        <td><?= $summaryData['payment_method'] ?></td>
                    </tr>
                    <tr>
                        <td>Estimated Delivery</td>
                        <td>3 to 5 days</td>
                    </tr>
                </tbody>
            </table>
            </div>
            <div class="d-flex justify-content-center">
                <a href="<?= ROOT_URL ?>products/trousers.php">
                    <button class="con-shop-empty">Continue shopping</button>
                </a>
            </div>
        </div>    

     </main>

       <!-- Footer -->
  <?php include './includes/Footer.php'; ?>

<!-- BOOTSTRAP SCRIPT CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- VANILLA JS -->
<script src="./scripts/script.js"></script>

<!-- AJAX HANDLER -->
<script src="./scripts//ajaxHandler.js"></script>

</body>
</html>   