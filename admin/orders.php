<?php

    include_once __DIR__ . '/../config/App.php';
    include_once __DIR__ . '/../auth/auth.php';
    include_once __DIR__ . '/controllers/OrdersController.php';

    if($_SESSION['user_data']['user_role'] !== 'admin'){
        redirect('', '', '404.php');
        exit(0);
    }

    $orders_controller = new OrdersController($DB->conn);    

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

    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <!-- Navbar Brand-->
        <a class="navbar-brand ps-3" href="index.html">AR Trouser</a>
        <!-- Sidebar Toggle-->
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i
                class="bi bi-list text-white fs-4 text-white"></i></button>
        <!-- Navbar-->
        <ul class="navbar-nav mx-auto me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false"><i class="bi bi-person-circle fs-5 text-white"></i></a>
                <ul class="dropdown-menu dropdown-menu-end py-1" aria-labelledby="navbarDropdown">
                    <form method="POST">
                        <button type="submit" class="dropdown-item d-flex align-items-center gap-2" name="logout-btn"><i
                                class="bi bi-box-arrow-right fs-5"></i> Logout</button>
                    </form>
                </ul>
            </li>
        </ul>
    </nav>

    <!-- Side bar -->
    <?php include './includes/sidebar.php' ?>
    <!-- Side bar -->

    <div id="layoutSidenav_content">
        <main>
            <div class="px-4">
                <h1 class="mt-4">Manage orders</h1>
                <div class="order mt-5">
                <!-- Order Header -->
                <div class="order-header">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h4 class="mb-3">Order ID #1</h4>
                            <div class="d-flex gap-4">
                                <div>
                                    <small class="text-muted">Order Date</small>
                                    <p class="mb-0">2024-02-20</p>
                                </div>
                                <div>
                                    <small class="text-muted">Status</small>
                                    <span class="status-badge bg-warning text-dark">Processing</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-end">
                            <select class="form-select w-50 d-inline-block">
                                <option value="null">Update order status</option>
                                <option value="Pending">Pending</option>
                                <option value="Confirmed">Confirmed</option>
                                <option value="Processing">Processing</option>
                                <option value="Shipped">Shipped</option>
                                <option value="Out for delivery">Out for delivery</option>
                                <option value="Delivered">Delivered</option>
                                <option value="Canceled">Canceled</option>
                            </select>
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
                                        <h5>$450.00</h5>
                                    </div>
                                    <div>
                                        <small class="text-muted">Shipping</small>
                                        <h5>$15.00</h5>
                                    </div>
                                    <div>
                                        <small class="text-muted">Total</small>
                                        <h5 class="text-success">$465.00</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                <div class="d-inline-block text-start">
                                    <small class="text-muted">Payment Method</small>
                                    <p class="mb-1">Credit Card</p>
                                    <span class="badge bg-success">Paid</span>
                                </div>
                                <select class="form-select w-50 d-inline-block">
                                    <option value="null">Update payment status</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Received">Received</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="detail-card">
                        <h6 class="mb-3">Order Items</h6>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Size</th>
                                        <th>Color</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#67890</td>
                                        <td><img src="https://via.placeholder.com/60x80" class="product-img"></td>
                                        <td>Product Name 1</td>
                                        <td>2</td>
                                        <td>$150.00</td>
                                        <td>M</td>
                                        <td><div style="width:20px; height:20px; background-color:blue; border-radius:50%"></div></td>
                                    </tr>
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Shipping Details -->
                    <div class="detail-card">
                        <h6 class="mb-3">Shipping Details</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <div class="col-4 text-muted">User ID:</div>
                                    <div class="col-8">#USR123</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 text-muted">Name:</div>
                                    <div class="col-8">John Doe</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 text-muted">Phone:</div>
                                    <div class="col-8">+1 234 567 890</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 text-muted">Email:</div>
                                    <div class="col-8">john@example.com</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <div class="col-4 text-muted">Address:</div>
                                    <div class="col-8">123 Main Street</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 text-muted">Landmark:</div>
                                    <div class="col-8">Near Central Park</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 text-muted">City:</div>
                                    <div class="col-8">New York</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-4 text-muted">State:</div>
                                    <div class="col-8">NY</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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