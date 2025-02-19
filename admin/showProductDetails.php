<?php

    include_once __DIR__ . '/../config/App.php';
    include_once __DIR__ . '/../auth/auth.php';
    include_once __DIR__ . '/productsProcessor.php';
    include_once __DIR__ . '/controllers/ProductsController.php';

    if($_SESSION['user_data']['user_role'] !== 'admin'){
      redirect('', '', '404.php');
      exit(0);
  }
    $productsController = new ProductsController($DB->conn);

    // Show product details:

    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $product_details = $productsController->getProductDetails($_GET['id']);
    } else{
        redirect('', '', 'admin/products.php');
        exit(0);
    }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin Panel - AR Trouser</title>
    <!-- BOOTSTRAP LINK CDN -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <!-- PREDEFINED CLASSES STYLESHEET -->
    <link href="css/styles.css" rel="stylesheet" />
    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="css/custom.css" />
  </head>

  <body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
      <!-- Navbar Brand-->
      <a class="navbar-brand ps-3" href="index.html">AR Trouser</a>
      <!-- Sidebar Toggle-->
      <button
        class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0"
        id="sidebarToggle"
        href="#!"
      >
        <i class="bi bi-list text-white fs-4 text-white"></i>
      </button>
      <!-- Navbar-->
      <ul class="navbar-nav mx-auto me-3 me-lg-4">
        <li class="nav-item dropdown">
          <a
            class="nav-link dropdown-toggle"
            id="navbarDropdown"
            href="#"
            role="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
            ><i class="bi bi-person-circle fs-5 text-white"></i
          ></a>
          <ul
            class="dropdown-menu dropdown-menu-end py-1"
            aria-labelledby="navbarDropdown"
          >
            <form method="POST">
              <button
                type="submit"
                class="dropdown-item d-flex align-items-center gap-2"
                name="logout-btn"
              >
                <i class="bi bi-box-arrow-right fs-5"></i> Logout
              </button>
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

        <div class="products-content-div px-4">
          <h1 class="mt-4">Product details</h1>
          <div class="products-container my-5">
          <div class="product-imgs container my-5">
              <div class="row d-flex justify-content-center align-items-center">
                <div class="img-1 col-12 col-md-4 col-lg-4 my-2">
                  <img src="..<?= $product_details['product_details'][0]['product_img_1'] ?>" alt="<?= $product_details['product_details'][0]['product_name'] ?>" height="300px" width="250px" id="preview-1">
                </div>
                <div class="img-2 col-12 col-md-4 col-lg-4 my-2">
                  <img src="..<?= $product_details['product_details'][0]['product_img_2'] ?>" alt="<?= $product_details['product_details'][0]['product_name'] ?>" height="300px" width="250px" id="preview-2">
                </div>
                <div class="img-3 col-12 col-md-4 col-lg-4 my-2">
                  <img src="..<?= $product_details['product_details'][0]['product_img_3'] ?>" alt="<?= $product_details['product_details'][0]['product_name'] ?>" height="300px" width="250px" id="preview-3">
                </div>
              </div>
            </div>
            <div class="product-details container">
        <div class="detail-row">
            <div class="detail-label">Product ID</div>
            <div class="detail-value"><?= $_GET['id']; ?></div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Product Name</div>
            <div class="detail-value"><?= $product_details['product_details'][0]['product_name'] ?></div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Description</div>
            <div class="detail-value"><?= $product_details['product_details'][0]['product_desc'] ?></div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Category</div>
            <div class="detail-value"><?= $product_details['product_details'][0]['product_cat_ID'] == '1' ? 'Pure cotton' : 'Polyestor cotton' ?></div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Price</div>
            <div class="detail-value">Rs <?= number_format($product_details['product_details'][0]['product_actual_price']) ?></div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Discounted price</div>
            <div class="detail-value">Rs <?= number_format($product_details['product_details'][0]['product_discounted_price']) ?></div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Stock</div>
            <div class="detail-value">
                <div class="stock-grid">
                    <div class="color-variant">
                        <div><strong>Black</strong></div>
                        <div>S: <?= $product_details['stock_details']['blackS'] ?></div>
                        <div>M: <?= $product_details['stock_details']['blackM'] ?></div>
                        <div>L: <?= $product_details['stock_details']['blackL'] ?></div>
                        <div>XL: <?= $product_details['stock_details']['blackXL'] ?></div>
                        <div>XXL: <?= $product_details['stock_details']['blackXXL'] ?></div>
                    </div>
                    <div class="color-variant">
                        <div><strong>White</strong></div>
                        <div>S: <?= $product_details['stock_details']['whiteS'] ?></div>
                        <div>M: <?= $product_details['stock_details']['whiteM'] ?></div>
                        <div>L: <?= $product_details['stock_details']['whiteL'] ?></div>
                        <div>XL: <?= $product_details['stock_details']['whiteXL'] ?></div>
                        <div>XXL: <?= $product_details['stock_details']['whiteXXL'] ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Status</div>
            <div class="detail-value status-active">Active</div>
        </div>
        <div class="detail-row">
            <div class="detail-label">Product Slug</div>
            <div class="detail-value">premium-cotton-t-shirt</div>
        </div>
    </div>
          </div>
        </div>
      </main>

      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <div class="d-flex align-items-center justify-content-end small">
            <div class="text-muted">
              Copyright &copy;
              <a href="<?php base_url('index.php') ?>">AR Trouser</a> <span class="year"></span>
            </div>
          </div>
        </div>
      </footer>
    </div>

    <!-- BOOTSTRAP SCRIPT CDN -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <!-- VANILLA JS SCRIPT -->
    <script src="js/scripts.js"></script>
  </body>
</html>
