<?php

    include_once __DIR__ . '/../config/App.php';
    include_once __DIR__ . '/../auth/auth.php';
    include_once __DIR__ . '/controllers/OrdersController.php';

    if($_SESSION['user_data']['user_role'] !== 'admin'){
        redirect('', '', '404.php');
        exit(0);
    }

    $orders_controller = new OrdersController($DB->conn);    

    if(isset($_GET['status'])){
        $status = mysqli_real_escape_string($DB->conn, $_GET['status']);
    } else{
        $status = 'all';
    }

    $orders = $orders_controller->getOrders($status) ?? [];

    if(isset($_POST['order_status'])){
        $allowed_status = ['Pending', 'Confirmed', 'Processing', 'Shipped', 'Out for delivery', 'Delivered', 'Canceled'];

        $order_status = $_POST['order_status'];
        $order_ID = $_POST['order_ID'];

        if(in_array($order_status, $allowed_status)){
            if($orders_controller->updateOrderStatus($order_ID, $order_status)){
                $_SESSION['order-status-updated'] = "Order status updated successfully for Order ID: $order_ID";
                
            } else{
                $_SESSION['order-status-update-failed'] = 'Failed to update order status. Please try again';
            }
        } else{
            $_SESSION['invalid-order-status'] = 'Please select a valid order status';
            
        }
        
        header('location: orders.php');
        exit();

    }
    
    if(isset($_POST['payment-status'])){
        $allowed_status = ['Pending', 'Received'];
        $payment_status = $_POST['payment-status'];
        $order_ID = $_POST['order_ID'];

        if(in_array($payment_status, $allowed_status)){

            if($orders_controller->updatePaymentStatus($order_ID, $payment_status)){
                $_SESSION['payment-status-updated'] = "Payment status updated successfully for Order ID: $order_ID";
            } else{
                $_SESSION['payment-status-update-failed'] = 'Failed to update payment status. Please try again';
            }

        } else{
            $_SESSION['invalid-payment-status'] = 'Please select a valid payment status to update';
        }

        header('location: orders.php');
        exit();
    }


    $order_status_updated = $_SESSION['order-status-updated'] ?? null;
    $order_status_update_failed = $_SESSION['order-status-update-failed'] ?? null;
    $invalid_order_status = $_SESSION['invalid-order-status'] ?? null;
    $payment_status_updated = $_SESSION['payment-status-updated'] ?? null;
    $payment_status_update_failed = $_SESSION['payment-status-update-failed'] ?? null;
    $invalid_payment_status = $_SESSION['invalid-payment-status'] ?? null;


    unset($_SESSION['order-status-updated']);
    unset($_SESSION['order-status-update-failed']);
    unset($_SESSION['invalid-order-status']);
    unset($_SESSION['payment-status-updated']);
    unset($_SESSION['payment-status-update-failed']);
    unset($_SESSION['invalid-payment-status']);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin Panel - AR Trouser</title>
    <!-- BOOTSTRAP LINK CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   
    <!-- PREDEFINED CLASSES STYLESHEET -->
    <link href="css/styles.css" rel="stylesheet" />
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="css/custom.css">

</head>

<body class="sb-nav-fixed">

    <!-- navbar -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">AR Trouser</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="bi bi-list text-white fs-4 text-white"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav mx-auto me-3 me-lg-4">
            <li class="nav-item">
                <a href="<?php base_url('index.php') ?>" class="nav-link text-white">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="bi bi-person-circle fs-5 text-white"></i></a>
                <ul class="dropdown-menu dropdown-menu-end py-1" aria-labelledby="navbarDropdown">
                    <form method="POST">
                        <button type="submit" class="dropdown-item d-flex align-items-center gap-2" name="logout-btn"><i
                                class="bi bi-box-arrow-right fs-5"></i> Logout
                        </button>
                    </form>
                </ul>
            </li>
        </ul>
    </nav>
    <!-- navbar -->

    <!-- Side bar -->
    <?php include './includes/sidebar.php' ?>
    <!-- Side bar -->

    <div id="layoutSidenav_content">
        <main>

        <!-- alert messages -->
        <?php if(isset($invalid_order_status)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $invalid_order_status ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if(isset($order_status_updated)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $order_status_updated ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
        
        <?php if(isset($order_status_update_failed)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $order_status_update_failed ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if(isset($payment_status_updated)) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $payment_status_updated ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if(isset($payment_status_update_failed)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $payment_status_update_failed ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if(isset($invalid_payment_status)) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $invalid_payment_status ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <!-- alert messages -->

            <div class="px-4">
                <h1 class="mt-4">Manage orders</h1>

                <!-- Order tabs -->
                <div class=" mt-4 d-flex flex-wrap">
                    <a href="orders.php?status=all" class="btn btn-sm order-tab <?= $status == 'all' ? 'active' : '' ?>">All</a>
                    <a href="orders.php?status=pending" class="btn btn-sm order-tab <?= $status == 'pending' ? 'active' : '' ?>">Pending</a>
                    <a href="orders.php?status=confirmed" class="btn btn-sm  order-tab <?= $status == 'confirmed' ? 'active' : '' ?>">Confirmed</a>
                    <a href="orders.php?status=processing" class="btn btn-sm  order-tab <?= $status == 'processing' ? 'active' : '' ?>">Processing</a>
                    <a href="orders.php?status=shipped" class="btn btn-sm  order-tab <?= $status == 'shipped' ? 'active' : '' ?>">Shipped</a>
                    <a href="orders.php?status=out-for-delivery" class="btn btn-sm  order-tab <?= $status == 'out-for-delivery' ? 'active' : '' ?>">Out for delivery</a>
                    <a href="orders.php?status=delivered" class="btn btn-sm  order-tab <?= $status == 'delivered' ? 'active' : '' ?>">Delivered</a>
                    <a href="orders.php?status=canceled" class="btn btn-sm  order-tab <?= $status == 'canceled' ? 'active' : '' ?>">Canceled</a>
                </div>

                <?php if(!empty($orders)) : ?>
                <?php foreach($orders as $order) : ?>
                <div class="order mt-5">
                <!-- Order Header -->
                <div class="order-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="mb-3">Order ID #<?= $order['order_ID'] ?></h4>
                            <div class="d-flex gap-4">
                                <div>
                                    <small class="text-muted">Order Date</small>
                                    <p class="mb-0"><?= (new DateTime($order['order_date']))->format('d F, Y') ?></p>
                                </div>
                                <div>
                                    <small class="text-muted">Status</small>
                                    <?php 
                                    if($order['order_status'] == 'Pending'){
                                        echo '<span class="status-badge bg-secondary text-white">'.$order['order_status'].'</span>';
                                    }
                                    else if($order['order_status'] == 'Confirmed'){
                                        echo '<span class="status-badge bg-primary text-white">'.$order['order_status'].'</span>';
                                    }
                                    else if($order['order_status'] == 'Processing'){
                                        echo '<span class="status-badge bg-warning text-dark">'.$order['order_status'].'</span>';
                                    }
                                    else if($order['order_status'] == 'Shipped'){
                                        echo '<span class="status-badge bg-info text-white">'.$order['order_status'].'</span>';
                                    }
                                    else if($order['order_status'] == 'Out for delivery'){
                                        echo '<span class="status-badge bg-info text-white">'.$order['order_status'].'</span>';
                                    }
                                    else if($order['order_status'] == 'Delivered'){
                                        echo '<span class="status-badge bg-success text-white">'.$order['order_status'].'</span>';
                                    }
                                    else if($order['order_status'] == 'Canceled'){
                                        echo '<span class="status-badge bg-danger text-white">'.$order['order_status'].'</span>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <small class="text-muted d-block mb-2">Update order status</small>
                            <form method="POST" id="order-status-form-<?= $order['order_ID'] ?>">
                                <input type="hidden" name="order_ID" value="<?= $order['order_ID'] ?>">
                            <select class="form-select w-50 d-inline-block" name="order_status" onchange="document.getElementById('order-status-form-<?= $order['order_ID'] ?>').submit()">
                                <option value="Pending" <?= $order['order_status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="Confirmed" <?= $order['order_status'] == 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                                <option value="Processing" <?= $order['order_status'] == 'Processing' ? 'selected' : '' ?>>Processing</option>
                                <option value="Shipped" <?= $order['order_status'] == 'Shipped' ? 'selected' : '' ?>>Shipped</option>
                                <option value="Out for delivery" <?= $order['order_status'] == 'Out for delivery' ? 'selected' : '' ?>>Out for delivery</option>
                                <option value="Delivered" <?= $order['order_status'] == 'Delivered' ? 'selected' : '' ?>>Delivered</option>
                                <option value="Canceled" <?= $order['order_status'] == 'Canceled' ? 'selected' : '' ?>>Canceled</option>
                            </select>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="p-4">
                    <!-- Payment Summary -->
                    <div class="detail-card">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex gap-5">
                                    <div>
                                        <small class="text-muted">Subtotal</small>
                                        <h5>Rs <?= number_format($order['subtotal']) ?></h5>
                                    </div>
                                    <div>
                                        <small class="text-muted">Shipping</small>
                                        <h5>Rs <?= number_format($order['shipping_charges']) ?></h5>
                                    </div>
                                    <div>
                                        <small class="text-muted">Total</small>
                                        <h5 class="text-success">Rs <?= number_format($order['total']) ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-end gap-5">
                                <div class="d-inline-block text-start">
                                    <small class="text-muted">Payment Method</small>
                                    <p class="mb-1"><?= $order['payment_method'] ?></p>
                                </div>
                                <div>
                                <small class="text-muted">Payment Status</small>
                                <form method="POST" id="payment-status-form-<?= $order['order_ID'] ?>">
                                    <input type="hidden" name="order_ID" value="<?= $order['order_ID'] ?>">
                                <select class="form-select w-100 d-inline-block mt-1" name="payment-status" onchange="document.getElementById('payment-status-form-<?= $order['order_ID'] ?>').submit()">
                                    <option value="Pending" <?= $order['payment_status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                                    <option value="Received" <?= $order['payment_status'] == 'Received' ? 'selected' : '' ?>>Received</option>
                                </select>
                                </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="detail-card">
                        <h6 class="mb-3">Order Items</h6>
                        <div class="table-responsive" style="max-height: 250px; overflow-y: auto;">
                            <table class="table table-hover" >
                                <thead style="position: sticky; top: 0; z-index: 1; background-color: white;">
                                    <tr>
                                        <th></th>
                                        <th>Product ID</th>
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
                                        $order_items = $orders_controller->getOrderItems($order['order_ID']);
                                    ?>
                                    <?php foreach($order_items as $item) : ?>
                                    <tr>
                                        <td><a href="../products/product.php?id=<?= $item['product_ID'] ?>" target="_blank">
                                        <img src="../<?= $item['product_img_1'] ?>" class="product-img">
                                        </a></td>
                                        <td><?= $item['product_ID'] ?></td>
                                        <td><?= $item['product_name'] ?></td>
                                        <td><?= $item['quantity'] ?></td>
                                        <td>Rs <?= number_format($item['price']) ?></td>
                                        <td>Rs <?= number_format($item['subtotal']) ?></td>
                                        <td><?= $item['size'] ?></td>
                                        <td><?= $item['color'] ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
 
                    <!-- Shipping Details -->
                    <div class="detail-card">
                        <h6 class="mb-3">Shipping Details</h6>
                        <div class="row">
                        <?php 
                        $shipping_details = $orders_controller->getShippingDetails($order['order_ID']) ?? [];
                        ?>
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <div class="col-4 text-muted">Name:</div>
                                    <div class="col-8"><?= $shipping_details['first_name'] . ' ' . $shipping_details['last_name'] ?? 'Error' ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 text-muted">Phone:</div>
                                    <div class="col-8"><?= $shipping_details['phone_number'] ?? 'Error' ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 text-muted">Email:</div>
                                    <div class="col-8"><?= $shipping_details['email'] ?? 'Not given' ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <div class="col-4 text-muted">Street Address:</div>
                                    <div class="col-8"><?= $shipping_details['street_address'] ?? 'Error' ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 text-muted">Landmark:</div>
                                    <div class="col-8"><?= $shipping_details['landmark'] ?? '' ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 text-muted">City:</div>
                                    <div class="col-8"><?= $shipping_details['city'] ?? 'Error' ?></div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 text-muted">State:</div>
                                    <div class="col-8"><?= $shipping_details['state'] ?? 'Error' ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="contact-actions fs-4 d-flex justify-content-end gap-2">
                            <a href="https://wa.me/+92<?= $shipping_details['phone_number'] ?>" class="text-success" target="_blank"><i class="bi bi-whatsapp"></i></a>
                                
                            <?php if(!empty($shipping_details['email'])) : ?>
                                <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?= $shipping_details['email'] ?>" class="text-primary" target="_blank"><i class="bi bi-envelope"></i></a>
                            <?php endif; ?>
                            
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <?php else:  ?>
                <div class=" mt-5 ms-2">
                    <p class="fs-3">No orders found for this status.</p>
                </div>
            <?php endif; ?>
            </div>
        </main>

        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-end small">
                    <div class="text-muted">
                    Copyright &copy; <a href="<?php base_url('index.php') ?>">AR Trouser</a> <span class="year"></span>
                    </div>
                </div>
            </div>
        </footer>
    </div>

        <!-- BOOTSTRAP SCRIPT CDN -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
        </script>
        <!-- VANILLA JS SCRIPT -->
        <script src="js/scripts.js"></script>
</body>

</html>