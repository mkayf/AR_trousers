<?php

include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../auth/auth.php';
include_once __DIR__ . '/../controllers/ProductsController.php';

$productController = new ProductsController($DB->conn);

$products = $productController->getProductsOnFirstLoad() ?? [];

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
         <?php include './../includes/Navbar.php'; ?>
     </header>

     <main class="products-main">
     <div class="heading-div d-flex justify-content-center align-items-center mt-5">
    <span class="separator"></span><h2 class="section-heading">Trousers galore</h2><span class="separator"></span>
    </div>
    <p class="tag-line">Discover style that moves with you.</p>

    <div class="sort-filter-div d-flex justify-content-center justify-content-between align-items-center mx-sm-5 mx-3 my-4 gap-3">

<!-- Filter products dropdown -->
  <?php if(!empty($products)) : ?>

  <div class="dropdown">
  <button class="filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" tabindex="-1">
    Filter <i class="bi bi-funnel"></i>
  </button>
  <ul class="dropdown-menu">
    <li class="dropdown-item d-flex justify-content-between align-items-center gap-2" role="button" onclick="filterAndSortProducts('Pure_cotton')">
      Pure cotton
    </li>
    <li class="dropdown-item d-flex justify-content-between align-items-center gap-2" role="button" onclick="filterAndSortProducts('Polyester_cotton')">
      Polyester cotton
    </li>
    <li class="dropdown-item d-flex justify-content-between align-items-center gap-2" role="button" onclick="filterAndSortProducts('below-1000')">
      Below Rs 1000
    </li>
    <li class="dropdown-item d-flex justify-content-between align-items-center gap-2" role="button" onclick="filterAndSortProducts('1000-2000')">
      Rs 1000 - Rs 2000
    </li>
    <li class="dropdown-item d-flex justify-content-between align-items-center gap-2" role="button" onclick="filterAndSortProducts('2000-3000')">
      Rs 2000 - Rs 3000
    </li>
    <li class="dropdown-item d-flex justify-content-between align-items-center gap-2" role="button" onclick="filterAndSortProducts('reset-filters')">
      Reset filters
    </li>
  </ul>
</div>

<!-- Sort products dropdown -->

<div class="dropdown">
  <button class="sort-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" tabindex="-1">
    Sort <i class="bi bi-sort-alpha-up"></i>
  </button>
  <ul class="dropdown-menu">
    <li class="dropdown-item dropdown-item d-flex justify-content-between align-items-center gap-2" role="button" onclick="filterAndSortProducts(undefined,'low-to-high')">
      price, low to high
    </li>
    <li class="dropdown-item dropdown-item d-flex justify-content-between align-items-center gap-2" role="button" onclick="filterAndSortProducts(undefined,'high-to-low')">
      price, high to low
    </li>
    <li class="dropdown-item dropdown-item d-flex justify-content-between align-items-center gap-2" role="button" onclick="filterAndSortProducts(undefined,'new-to-old')">
      date, new to old
    </li>
    <li class="dropdown-item dropdown-item d-flex justify-content-between align-items-center gap-2" role="button" onclick="filterAndSortProducts(undefined,'old-to-new')">
      date, old to new
    </li>
    <li class="dropdown-item d-flex justify-content-between align-items-center gap-2" role="button" onclick="filterAndSortProducts(undefined,'reset-sort')">
      Reset sort
    </li>
  </ul>
</div>
<?php endif; ?>

    </div>

    <div class="all-products-section container-fluid">
        <div class="row d-flex justify-content-center align-items-center" id="all-products">

        <?php if(!empty($products)) : ?>

        <?php foreach($products as $product) : ?>
        <div class="product-card">
        <div class="product-img-div">
        <a class="product-link text-reset col-sm-6 col-md-3 col-lg-3" href="product.php?<?php echo 'id=' . $product['product_ID'] . '&' . 'slug=' . $product['slug'] ?>">
          <img src="../<?php echo $product['product_img_1'] ?>" alt="">
        </a>
        </div>
        <div class="product-details-div">
        <a class="product-link text-reset col-sm-6 col-md-3 col-lg-3" href="product.php?<?php echo 'id=' . $product['product_ID'] . '&' . 'slug=' . $product['slug'] ?>">
          <p class="product-title"><?php echo $product['product_name'] ?></p>
          <?php if($product['product_discounted_price'] != 0) : ?>
          <p class="product-price discount-strike">Rs <?php echo number_format($product['product_actual_price']) ?></p>
            <p class="product-discounted-price">Rs <?php echo number_format($product['product_discounted_price']); ?></p>
            <?php else : ?>
              <p class="product-price">Rs <?php echo number_format($product['product_actual_price']) ?></p>
          <?php endif; ?>
          </a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="load-btn-div d-flex justify-content-center align-items-center">
            <button class="load-more" tabindex="-1" onclick="loadMoreProducts()">
              <span class="load-more-text">Load more</span>
            <div class="spinner-border spinner-border-sm" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
            </button>
            <p id="more-products"></p>
            <input type="hidden" name="offset" id="offset" value="0">
          </div>
      
      <?php else : ?>

        <p class="text-center">We are unable to load products at the moment. Please try again later.</p>
        
      <?php endif; ?>
      
    </div>
     </main>

  <!-- Footer -->
  <?php include '../includes/Footer.php'; ?>

<!-- BOOTSTRAP SCRIPT CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- VANILLA JS -->
<script src="../scripts/script.js"></script>

<!-- AJAX handler -->
 <script src="../scripts/ajaxHandler.js"></script>

</body>
</html>   