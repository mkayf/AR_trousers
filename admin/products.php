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

    $products = $productsController->listProducts() ?? [];
  
    
    // Delete product:

    if(isset($_POST['delete-btn'])){
      // Get product id in the value of delete button:
      $product_ID = $_POST['delete-btn'];
      if($productsController->deleteProduct($product_ID)){
        $_SESSION['product_deleted'] = "Product deleted successfully!";
      } else{
        $_SESSION['product_delete_error'] = "Failed to delete product. Please try again";
      }
      header('location: products.php');
      exit();
    }

    $product_added = $_SESSION['product_added'] ?? false;
    $product_adding_errors = $_SESSION['product_adding_errors'] ?? false;
    $product_deleted = $_SESSION['product_deleted'] ?? false;
    $product_delete_error = $_SESSION['product_delete_error'] ?? false;
    $product_updated = $_SESSION['product-updated'] ?? false;

    unset($_SESSION['product_added']);
    unset($_SESSION['product_adding_errors']);
    unset($_SESSION['product_deleted']);
    unset($_SESSION['product_delete_error']);
    unset($_SESSION['product-updated']);


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
    <!-- DATA TABLE LINK CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />

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

      <!-- Alert messages -->

      <?php if($product_added) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        Product added successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif; ?>

      <?php if(isset($product_adding_errors['empty_fields'])) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $product_adding_errors['empty_fields'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif; ?>

      <?php if(isset($product_adding_errors['image_error'])) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $product_adding_errors['image_error'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif; ?>

      <?php if(isset($product_adding_errors['extension_error'])) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $product_adding_errors['extension_error'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif; ?>

      <?php if(isset($product_adding_errors['image_limit_error'])) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $product_adding_errors['image_limit_error'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif; ?>

      <?php if(isset($product_adding_errors['product_details_insertion'])) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $product_adding_errors['product_details_insertion'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif; ?>

      <?php if(isset($product_adding_errors['stock_error'])) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $product_adding_errors['stock_error'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif; ?>

      <?php if($product_deleted) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $product_deleted ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif; ?>

      <?php if($product_delete_error) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= $product_delete_error ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif; ?>
    
      <?php if($product_updated) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $product_updated ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php endif; ?>

        <!-- Product add and update modal -->
        <div
          class="modal fade"
          id="productModal"
          tabindex="-1"
          aria-labelledby="productModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                  Add a new product
                </h1>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body container-fluid">
                <form method="POST" enctype="multipart/form-data">
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
                    />
                  </div>
                  <div class="mb-3 col-12 col-sm-12 col-md-4 col-lg-4">
                    <label for="product-category" class="form-label"
                      >Select Category *</label
                    >
                    <select name="product-category" id="product-category" class="form-control">
                        <option value="1">Pure cotton</option>
                        <option value="2">Polyester cotton</option>
                    </select>
                  </div>
                  <div class="mb-3 col-12 col-sm-12 col-md-4 col-lg-4">
                    <label for="product-images" class="form-label"
                      >Upload images *</label
                    >
                    <input type="file" name="product-images[]" id="product-images" multiple class="form-control" accept=".avif, .webp, .png, .jpeg, .jpg, .jfif">
                  </div>
                  <div class="mb-3 col-12">
                    <label for="product-description" class="form-label"
                      >Product description *</label
                    >
                    <textarea name="product-description" id="product-description" class="form-control" rows="4"></textarea>
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
                      value="0"
                    />
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
                      value="0"
                    />
                  </div>

                  <div class="mb-3 col-4 col-sm-4 col-md-2 col-lg-2">
                    <label for="black-color" class="form-label"
                      >Color</label
                    >
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
                      value="0"
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
                      value="0"
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
                      value="0"
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
                      value="0"
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
                      value="0"
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
                      value="0"
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
                      value="0"
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
                      value="0"
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
                      value="0"
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
                      value="0"
                    />
                  </div>

                  <div class="mb-3 col-6 col-sm-6 col-md-6 col-lg-6">
                    <label for="product-status" class="form-label"
                      >Product status</label
                    >
                    <select name="product-status" id="product-status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                  </div>
                  <div class="mb-3 col-6 col-sm-6 col-md-6 col-lg-6">
                    <label for="product-slug" class="form-label"
                      >Product slug</label
                    >
                    <input
                      type="text"
                      class="form-control"
                      id="product-slug"
                      name="product-slug"
                    />
                  </div>
                  </div>
              </div>
              <div class="modal-footer">
                <button
                  type="button"
                  class="btn btn-secondary"
                  data-bs-dismiss="modal"
                >
                  Cancel
                </button>
                <input type="submit" value="Add" class="btn btn-primary" name="add-product">
              </div>
              </form>
            </div>
          </div>
        </div>
        <!-- Product add and update modal -->

        <div class="products-content-div px-4">
          <h1 class="mt-4">Manage Products</h1>
          <div class="action-btns mt-4">
            <button
              class="add-product btn btn-primary"
              data-bs-toggle="modal"
              data-bs-target="#productModal"
            >
              <i class="bi bi-plus-circle"></i> Add product
            </button>
          </div>
          <div class="products-container my-5 table-responsive">
          <table class="table table-hover" id="productsTable">
            <thead>
              <tr>
                <th></th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Discounted Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <?php if(!empty($products)) :  ?>
                <?php foreach($products as $product) : ?>
                  <tr>
                    <td><img src="../<?= $product['product_img_1'] ?>" alt="<?= $product['product_name'] ?>" height="80px" width="60px"></td>
                    <td><?= $product['product_name'] ?></td>
                    <td><?= $product['cat_name'] == 'Pure_cotton' ? 'Pure cotton' : 'Polyester cotton' ?></td>
                    <td>Rs <?= number_format($product['product_actual_price']) ?></td>
                    <td>Rs <?= number_format($product['product_discounted_price'] ?? 0) ?></td>
                    <td><?= $product['total_stock'] ?></td>
                    <td><?= $product['status'] ?></td>
                    <td>
                      <a href="./showProductDetails.php?id=<?= $product['product_ID']; ?>" class="btn btn-success btn-sm">Show details</a>
                      <a href="./updateProduct.php?id=<?= $product['product_ID']; ?>" class="btn btn-primary btn-sm">Update</a>
                      <form method="POST" class="d-inline-block">
                        <button class="btn btn-danger btn-sm" value="<?= $product['product_ID']; ?>" name="delete-btn">Delete</button>
                      </form>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
          </table>
          </div>
        </div>
      </main>

      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid px-4">
          <div class="d-flex align-items-center justify-content-end small">
            <div class="text-muted">
              Copyright &copy;
              <a href="<?php base_url('index.php') ?>">AR Trouser</a> 2023
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
    <!-- JQUERY CDN -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <!-- DATA TABLE WITH BOOTSTRAP -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script>
      $(document).ready( function () {
        $('#productsTable').DataTable();
      });
    </script>
    <!-- VANILLA JS SCRIPT -->
    <script src="js/scripts.js"></script>
  </body>
</html>
