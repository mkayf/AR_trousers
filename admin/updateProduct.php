<?php

    include_once __DIR__ . '/../config/App.php';
    include_once __DIR__ . '/../auth/auth.php';
    include_once __DIR__ . '/productsProcessor.php';
    include_once __DIR__ . '/controllers/ProductsController.php';

    if($_SESSION['user_data']['user_role'] !== 'admin'){
        redirect('', '', 'admin/404.php');
        exit(0);
    }

    $productsController = new ProductsController($DB->conn);

    // Update product:

    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $product_details = $productsController->getProductDetails($_GET['id']);
    } else{
        redirect('', '', 'admin/products.php');
        exit(0);
    }

    if(isset($_POST['update-btn'])){
      $productsController->updateProduct($_POST, $_FILES);
    }

    $update_errors = $_SESSION['update_errors'] ?? false;

    unset($_SESSION['update_errors']);
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
          <h1 class="mt-4">Update Product</h1>

          <div class="products-container my-5">
            <form method="POST" enctype="multipart/form-data">
              <input type="hidden" name="product-id" value="<?= $_GET['id'] ?>">
            <div class="product-imgs container my-5">
              <div class="row d-flex justify-content-center align-items-center">
                <div class="img-1 col-12 col-md-4 col-lg-4 my-2">
                  <img src="..<?= $product_details['product_details'][0]['product_img_1'] ?>" alt="<?= $product_details['product_details'][0]['product_name'] ?>" height="300px" width="250px" id="preview-1">
                  <input type="file" name="img-1" id="img-1" class="my-4" accept="image/*">
                </div>
                
                <div class="img-2 col-12 col-md-4 col-lg-4 my-2">
                <img src="..<?= $product_details['product_details'][0]['product_img_2'] ?>" alt="<?= $product_details['product_details'][0]['product_name'] ?>" height="300px" width="250px" id="preview-2">
                <input type="file" name="img-2" id="img-2" class="my-4" accept="image/*">
                </div>

                <div class="img-3 col-12 col-md-4 col-lg-4 my-2">
                <img src="..<?= $product_details['product_details'][0]['product_img_3'] ?>" alt="<?= $product_details['product_details'][0]['product_name'] ?>" height="300px" width="250px" id="preview-3">
                <input type="file" name="img-3" id="img-3" class="my-4" accept="image/*">
                </div>

              </div>
              <small style="color: red;"><?= $update_errors['image-error'] ?? '' ?></small>
            </div>
                <div class="row">
                <div class="mb-3 col-12 col-sm-12 col-md-4 col-lg-4">
                    <label for="product-name" class="form-label"
                      >Product name *</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      id="product-name"
                      name="product-name"
                      value="<?= $product_details['product_details'][0]['product_name'] ?>"
                    />
                    <small style="color: red;"><?= $update_errors['product-name']  ?? '' ?></small>
                  </div>
                  <div class="mb-3 col-12 col-sm-12 col-md-4 col-lg-4">
                    <label for="product-category" class="form-label"
                      >Select Category *</label
                    >
                    <select name="product-category" id="product-category" class="form-control">
                        <option value="1" <?= $product_details['product_details'][0]['product_cat_ID'] == '1' ? 'selected' : '' ?>>Pure cotton</option>
                        <option value="2" <?= $product_details['product_details'][0]['product_cat_ID'] == '2' ? 'selected' : '' ?>>Polyester cotton</option>
                    </select>
                    <small style="color: red;"><?= $update_errors['product-category'] ?? '' ?></small>
                  </div>
                  <div class="mb-3 col-12 col-sm-12 col-md-4 col-lg-4">
                    <label for="product-status" class="form-label"
                      >Product status</label
                    >
                    <select name="product-status" id="product-status" class="form-control">
                        <option value="active"  <?= $product_details['product_details'][0]['status'] == 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive"  <?= $product_details['product_details'][0]['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                    <small style="color: red;"><?= $update_errors['product-status'] ?? '' ?></small>
                  </div>
                  <div class="mb-3 col-12">
                    <label for="product-description" class="form-label"
                      >Product description *</label
                    >
                    <textarea name="product-description" id="product-description" class="form-control" rows="4"><?= $product_details['product_details'][0]['product_desc'] ?></textarea>
                    <small style="color: red;"><?= $update_errors['product-description'] ?? '' ?></small>
                  </div>
                  <div class="mb-3 col-12 col-sm-12 col-md-6 col-lg-6">
                    <label for="product-price" class="form-label"
                      >Product price *</label
                    >
                    <input
                      type="number"
                      class="form-control"
                      id="product-price"
                      name="product-price"
                      value="<?= $product_details['product_details'][0]['product_actual_price'] ?>"
                    />
                    <small style="color: red;"><?= $update_errors['product-price'] ?? '' ?></small>
                  </div>
                  <div class="mb-3 col-12 col-sm-12 col-md-6 col-lg-6">
                    <label for="product-discounted-price" class="form-label"
                      >Product discounted price</label
                    >
                    <input
                      type="number"
                      class="form-control"
                      id="product-discounted-price"
                      name="product-discounted-price"
                      value="<?= $product_details['product_details'][0]['product_discounted_price'] ?>"
                    />
                  </div>

                  <div class="mb-3 col-4 col-sm-4 col-md-2 col-lg-2">
                    <label for="black-color" class="form-label">Color</label>
                    <input type="hidden" name="black-color" value="1">
                    <input type="text" id="black-color" readonly class="form-control" value="Black">
                  </div>
                  <div class="mb-3 col-4 col-sm-4 col-md-2 col-lg-2">
                    <label for="b-small" class="form-label"
                      >Small</label
                    >
                    <input
                      type="number"
                      class="form-control"
                      id="b-small"
                      name="b-small"
                      value="<?= $product_details['stock_details']['blackS'] ?>"
                    />
                  </div>
                  <div class="mb-3 col-4 col-sm-4 col-md-2 col-lg-2">
                    <label for="b-medium" class="form-label"
                      >Medium</label
                    >
                    <input
                      type="number"
                      class="form-control"
                      id="b-medium"
                      name="b-medium"
                      value="<?= $product_details['stock_details']['blackM'] ?>"
                    />
                  </div>
                  <div class="mb-3 col-4 col-sm-4 col-md-2 col-lg-2">
                    <label for="b-large" class="form-label"
                      >Large</label
                    >
                    <input
                      type="number"
                      class="form-control"
                      id="b-large"
                      name="b-large"
                      value="<?= $product_details['stock_details']['blackL'] ?>"
                    />
                  </div>
                  <div class="mb-3 col-4 col-sm-4 col-md-2 col-lg-2">
                    <label for="b-xlarge" class="form-label"
                      >X large</label
                    >
                    <input
                      type="number"
                      class="form-control"
                      id="b-xlarge"
                      name="b-xlarge"
                      value="<?= $product_details['stock_details']['blackXL'] ?>"
                    />
                  </div>
                  <div class="mb-3 col-4 col-sm-4 col-md-2 col-lg-2">
                    <label for="b-xxlarge" class="form-label"
                      >XX large</label
                    >
                    <input
                      type="number"
                      class="form-control"
                      id="b-xxlarge"
                      name="b-xxlarge"
                      value="<?= $product_details['stock_details']['blackXXL'] ?>"
                    />
                  </div>

                  <div class="mb-3 col-4 col-sm-4 col-md-2 col-lg-2">
                    <label for="white-color" class="form-label"
                      >Color</label
                    >
                    <input type="hidden" name="white-color" value="2">
                    <input type="text" id="white-color" readonly class="form-control" value="White">
                  </div>
                  <div class="mb-3 col-4 col-sm-4 col-md-2 col-lg-2">
                    <label for="w-small" class="form-label"
                      >Small</label
                    >
                    <input
                      type="number"
                      class="form-control"
                      id="w-small"
                      name="w-small"
                      value="<?= $product_details['stock_details']['whiteS'] ?>"
                    />
                  </div>
                  <div class="mb-3 col-4 col-sm-4 col-md-2 col-lg-2">
                    <label for="w-medium" class="form-label"
                      >Medium</label
                    >
                    <input
                      type="number"
                      class="form-control"
                      id="w-medium"
                      name="w-medium"
                      value="<?= $product_details['stock_details']['whiteM'] ?>"
                    />
                  </div>
                  <div class="mb-3 col-4 col-sm-4 col-md-2 col-lg-2">
                    <label for="w-large" class="form-label"
                      >Large</label
                    >
                    <input
                      type="number"
                      class="form-control"
                      id="w-large"
                      name="w-large"
                      value="<?= $product_details['stock_details']['whiteL'] ?>"
                    />
                  </div>
                  <div class="mb-3 col-4 col-sm-4 col-md-2 col-lg-2">
                    <label for="w-xlarge" class="form-label"
                      >X large</label
                    >
                    <input
                      type="number"
                      class="form-control"
                      id="w-xlarge"
                      name="w-xlarge"
                      value="<?= $product_details['stock_details']['whiteXL'] ?>"
                    />
                  </div>
                  <div class="mb-3 col-4 col-sm-4 col-md-2 col-lg-2">
                    <label for="w-xxlarge" class="form-label"
                      >XX large</label
                    >
                    <input
                      type="number"
                      class="form-control"
                      id="w-xxlarge"
                      name="w-xxlarge"
                      value="<?= $product_details['stock_details']['whiteXXL'] ?>"
                    />
                  </div>
                  <div class="mb-3 col-12">
                    <label for="product-slug" class="form-label"
                      >Product slug</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      id="product-slug"
                      name="product-slug"
                      value="<?= $product_details['product_details'][0]['slug'] ?>"
                    />
                  </div>
                  <small style="color: red;"><?= $update_errors['stock-error'] ?? '' ?></small>
                  <div class="mb-3">
                    <input type="submit" name="update-btn" class="btn btn-primary" value="Update product">
                  </div>
                </div>
            </form>
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
