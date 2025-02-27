<?php

include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../auth/auth.php';
include_once __DIR__ . '/../controllers/CartController.php';

if(!isset($_SESSION['authenticated']) && !$_SESSION['authenticated'] == true){
    redirect('', '', 'login.php');
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
            <div class="col-xxl-10 col-xl-12 px-0">
                <div class="order-container">
                    <!-- Order Header -->
                    <div class="order-header">
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <h4 class="mb-3" style="color: var(--primary);">Order #12345</h4>
                                <div class="d-flex flex-wrap gap-4">
                                    <div>
                                        <small class="text-muted">Order Date</small>
                                        <p class="mb-0">2024-02-20</p>
                                    </div>
                                    <div>
                                        <small class="text-muted">Status</small>
                                        <span class="status-badge">Processing</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-md-end mt-4">
                                <button class="btn btn-cancel">Cancel Order</button>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Summary -->
                    <div class="detail-card payment-summary">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-wrap gap-5">
                                    <div>
                                        <small class="text-muted">Subtotal</small>
                                        <h5 style="color: var(--primary);">$450.00</h5>
                                    </div>
                                    <div>
                                        <small class="text-muted">Shipping</small>
                                        <h5 style="color: var(--primary);">$15.00</h5>
                                    </div>
                                    <div>
                                        <small class="text-muted">Total</small>
                                        <h5 style="color: var(--primary);">$465.00</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 text-md-end mt-3 mt-md-0">
                                <div class="d-inline-block text-start">
                                    <small class="text-muted">Payment Method</small>
                                    <p class="mb-1">Credit Card</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="accordion" id="accordionExample">   
                        <div class="accordion-item">
                        <button class="accordion-button collapsed fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            More details
                        </button>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                        <div class="accordion-body">

                    <!-- Order Items -->
                    <div class="detail-card">
                        <h6 style="color: var(--primary);">Order Items</h6>
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
                                    <tr>
                                        <td><img src="https://via.placeholder.com/60x80" class="product-img"></td>
                                        <td>Product Name 1</td>
                                        <td>2</td>
                                        <td>565</td>
                                        <td>$150.00</td>
                                        <td>M</td>
                                        <td>black</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Shipping Details -->
                    <div class="detail-card shipping-details">
                        <h6 style="color: var(--primary); margin-bottom: 16px;">Shipping Details</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row mb-2">
                                    <div class="col-5 col-sm-4 text-muted">User ID:</div>
                                    <div class="col-7 col-sm-8">#USR123</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 col-sm-4 text-muted">Name:</div>
                                    <div class="col-7 col-sm-8">John Doe</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 col-sm-4 text-muted">Phone:</div>
                                    <div class="col-7 col-sm-8">+1 234 567 890</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 col-sm-4 text-muted">Email:</div>
                                    <div class="col-7 col-sm-8">john@example.com</div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3 mt-md-0">
                                <div class="row mb-2">
                                    <div class="col-5 col-sm-4 text-muted">Address:</div>
                                    <div class="col-7 col-sm-8">123 Main Street</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 col-sm-4 text-muted">Landmark:</div>
                                    <div class="col-7 col-sm-8">Near Central Park</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 col-sm-4 text-muted">City:</div>
                                    <div class="col-7 col-sm-8">New York</div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-5 col-sm-4 text-muted">State:</div>
                                    <div class="col-7 col-sm-8">NY</div>
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
        </div>
    </div>

    </main>

    <!-- Footer -->
    <?php include '../includes/Footer.php'; ?>

    <!-- BOOTSTRAP SCRIPT CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- VANILLA JS -->
    <script src="../scripts/script.js"></script>
</body>
</html>