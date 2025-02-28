<?php

include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../auth/auth.php';
include_once __DIR__ . '/../controllers/CartController.php';
include_once __DIR__ . '/../controllers/OrdersController.php';

if(!isset($_SESSION['authenticated']) && !$_SESSION['authenticated'] == true){
    redirect('', '', 'login.php');
}

if(isset($_SESSION['authenticated']) && $_SESSION['authenticated'] == true){
    $orders_controller = new OrdersController($DB->conn);

    $orders = $orders_controller->getUserOrders($_SESSION['user_data']['user_ID']) ?? [];

    if(isset($_POST['cancel-order'])){
        $order_ID = $_POST['order_ID'];

        if($orders_controller->cancelOrder($order_ID)){
            $_SESSION['order_canceled'] = "Your order has been canceled of order ID $order_ID";   
        }
        else{
            $_SESSION['order_cancel_failed'] = "We couldn't cancel your at the moment. Refresh the page and try again or contact us.";
        }

        header('location: orders.php');
        exit();
    }
}


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AR Trousers - Shop Stylish Women's Stitched Trousers Online</title>
    <!-- BOOTSTRAP LINK CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<!-- CUSTOM CSS STYLESHEET -->
<link rel="stylesheet" href="../css/style.css">

<body>
    <!-- NAVBAR -->
    <header>
        <?php include '../includes/Navbar.php'; ?>
        <?php if(isset($_SESSION['order_canceled'])) : ?>
        <div class="header-msg d-flex align-items-center justify-content-between">
          <p style="font-size: 1rem;"><?= $_SESSION['order_canceled']; ?></p>
          <span class="msg-close-btn"><i class="bi bi-x-lg"></i></span>
        </div>
        <?php unset($_SESSION['order_canceled']); ?>
        <?php endif; ?>

        <?php if(isset($_SESSION['order_cancel_failed'])) : ?>
        <div class="header-msg d-flex align-items-center justify-content-between">
          <p style="font-size: 1rem;"><?= $_SESSION['order_cancel_failed']; ?></p>
          <span class="msg-close-btn"><i class="bi bi-x-lg"></i></span>
        </div>
        <?php unset($_SESSION['order_cancel_failed']); ?>
        <?php endif; ?>
    </header>

    <!-- Sidebar -->
    <div class="pt-4 px-3 px-md-5">
        <button type="button" class="sidebar-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" tabindex="-1">
        <i class="bi bi-list"></i>
        </button>
    
        <?php include '../includes/Sidebar.php' ?>
    </div>
    <!-- Sidebar -->

    <main class="myaccount-main content">

        <div class="container-fluid mt-4 mb-5 px-3 px-md-5">
        <h2 class="myaccount-heading">My orders</h2>
        <div class="row justify-content-center">
        <?php if(!empty($orders)) : ?>
            <?php foreach($orders as $order) : ?>
            <div class="col-xxl-10 col-xl-12 px-0">
                <div class="order-container">
                    <!-- Order Header -->
                    <div class="order-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4 class="mb-3" style="color: var(--primary);">Order ID #<?= $order['order_ID'] ?></h4>
                                <div class="d-flex flex-wrap gap-4">
                                    <div>
                                        <small class="text-muted">Order Date</small>
                                        <p class="mb-0"><?= (new DateTime($order['order_date']))->format('d F, Y') ?></p>
                                    </div>
                                    <div>
                                        <small class="text-muted">Status</small>
                                        <span class="status-badge d-block" style="<?= $order['order_status'] == 'Delivered' ? 'background-color: var(--primary-color); color: white;' : 'color: var(--text-color);' ?>"><?= $order['order_status'] ?></span>
                                    </div>
                                </div>
                            </div>
                            <?php if($order['order_status'] == 'Pending') : ?>
                            <div class="col-md-6 text-md-end mb-0 mb-sm-5">
                                <form method="POST">
                                    <input type="hidden" name="order_ID" value="<?= $order['order_ID'] ?>">
                                    <button class="btn btn-cancel" name="cancel-order">Cancel Order</button>
                                </form>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Payment Summary -->
                    <div class="detail-card payment-summary">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-wrap gap-5">
                                    <div>
                                        <small class="text-muted">Subtotal</small>
                                        <h5 style="color: var(--primary);">Rs <?= number_format($order['subtotal']) ?></h5>
                                    </div>
                                    <div>
                                        <small class="text-muted">Shipping</small>
                                        <h5 style="color: var(--primary);">Rs <?= number_format($order['shipping_charges']) ?></h5>
                                    </div>
                                    <div>
                                        <small class="text-muted">Total</small>
                                        <h5 style="color: var(--primary);">Rs <?= number_format($order['total']) ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                <div class="d-inline-block text-start">
                                    <small class="text-muted">Payment Method</small>
                                    <p class="mb-1"><?= $order['payment_method'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion" id="accordionExample">   
                        <div class="accordion-item">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            More details
                        </button>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                    <!-- Order Items -->
                    <div class="detail-card">
                        <h6 style="color: var(--primary); font-family: 'proxima-semibold';">Order Items</h6>
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                        <th>Size</th>
                                        <th>Color</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $order_items = $orders_controller->getOrderItems($order['order_ID']) ?? [];
                                    ?>
                                    <?php if(!empty($order_items)) : ?>
                                    <?php foreach($order_items as $item) : ?>
                                    <tr>
                                        <td><a href="../products/product.php?id=<?= $item['product_ID'] ?>">
                                        <img src="..<?= $item['product_img_1'] ?>" class="product-img"></a></td>
                                        <td><?= $item['product_name'] ?></td>
                                        <td><?= $item['quantity'] ?></td>
                                        <td><?= $item['price'] ?></td>
                                        <td><?= $item['subtotal'] ?></td>
                                        <td><?= $item['size'] ?></td>
                                        <td><?= $item['color'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else : ?>
                                    <tr class="text-center w-100">
                                        <td>No product item</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Shipping Details -->
                    <div class="detail-card shipping-details">
                        <h6 style="color: var(--primary); margin-bottom: 16px;">Shipping Details</h6>
                        <div class="row">
                        <?php 
                        $shipping_details = $orders_controller->getShippingDetails($order['order_ID']) ?? [];
                        ?>
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <div class="col-5 col-sm-4 text-muted">Name:</div>
                                    <div class="col-7 col-sm-8"><?= $shipping_details['first_name'] . ' ' . $shipping_details['last_name'] ?? '' ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 col-sm-4 text-muted">Phone:</div>
                                    <div class="col-7 col-sm-8"><?= $shipping_details['phone_number'] ?? '' ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 col-sm-4 text-muted">Email:</div>
                                    <div class="col-7 col-sm-8"><?= $shipping_details['email'] ?? '' ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-5 col-sm-4 text-muted">Address:</div>
                                    <div class="col-7 col-sm-8"><?= $shipping_details['street_address'] ?? '' ?></div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-md-0">
                                <div class="row mb-2">
                                    <div class="col-5 col-sm-4 text-muted">Landmark:</div>
                                    <div class="col-7 col-sm-8"><?= $shipping_details['landmark'] ?? '' ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 col-sm-4 text-muted">City:</div>
                                    <div class="col-7 col-sm-8"><?= $shipping_details['city'] ?? '' ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 col-sm-4 text-muted">State:</div>
                                    <div class="col-7 col-sm-8"><?= $shipping_details['state'] ?? '' ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                        </div>
                        </div>
                        </div>
                    </div>

                </div>
            </div>
            <?php endforeach; ?>
            <?php else : ?>
                <div class="container text-center mt-5">
                    <p class="mb-4 fs-5" style="font-family: 'proxima-regular';">Your order history is empty. Time to change that!</p>
                    <a href="<?php base_url('products/trousers.php') ?>" class="shop-now-btn">Shop now</a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    </main>

    <!-- Footer -->
    <?php include '../includes/Footer.php'; ?>

    <!-- BOOTSTRAP SCRIPT CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- VANILLA JS -->
    <script src="../scripts/script.js"></script>

    <!-- AJAX HANDLER -->
    <script src="../scripts//ajaxHandler.js"></script>
</body>
</html>