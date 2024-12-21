<?php

include_once __DIR__ . '/config/App.php';
include_once __DIR__ . '/auth/auth.php';
include_once __DIR__ . '/controllers/ProductsController.php';

$productController = new ProductsController($DB->conn);

$products = $productController->getProductsOnFirstLoad();

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
   <link rel="stylesheet" href="./css/style.css">

  <body>
    
    <!-- NAVBAR -->
     <header>
         <?php include './includes/Navbar.php'; ?>
     </header>

     <main class="products-main">
     <div class="heading-div d-flex justify-content-center align-items-center mt-5">
    <span class="separator"></span><h2 class="section-heading">Trousers galore</h2><span class="separator"></span>
    </div>
    <p class="tag-line">Discover style that moves with you.</p>

    <div class="sort-filter-div d-flex justify-content-between align-items-center mx-5 my-4 gap-3">

  <div class="dropdown">
  <button class="filter-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" tabindex="-1">
    Filter <i class="bi bi-funnel"></i>
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" role="button" onclick="filterProducts('Pure_cotton')">Pure cotton</a></li>
    <li><a class="dropdown-item" role="button" onclick="filterProducts('Polyester_cotton')">Polyster cotton</a></li>
    <li><a class="dropdown-item" role="button" onclick="filterProducts('below-1000')">Below Rs 1000</a></li>
    <li><a class="dropdown-item" role="button" onclick="filterProducts('1000-2000')">Rs 1000 - Rs 2000</a></li>
    <li><a class="dropdown-item" role="button" onclick="filterProducts('2000-3000')">Rs 2000 - Rs 3000</a></li>
  </ul>
</div>


<div class="dropdown">
  <button class="sort-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" tabindex="-1">
    Sort <i class="bi bi-sort-alpha-up"></i>
  </button>
  <ul class="dropdown-menu">
    <li><a class="dropdown-item" role="button" onclick="sortProducts('low-to-high')">price, low to high</a></li>
    <li><a class="dropdown-item" role="button" onclick="sortProducts('high-to-low')">price, high to low</a></li>
    <li><a class="dropdown-item" role="button" onclick="sortProducts('new-to-old')">date, new to old</a></li>
    <li><a class="dropdown-item" role="button" onclick="sortProducts('old-to-new')">date, old to new</a></li>
  </ul>
</div>

    </div>

    <div class="all-products-section container-fluid">
        <div class="row d-flex justify-content-center align-items-center" id="all-products">

          
      
        <?php foreach($products as $product) : ?>

        <div class="product-card col-sm-6 col-md-3 col-lg-3">
        <div class="product-img-div">
          <img src=".<?php echo $product['product_img_1'] ?>" alt="">
          <span class="product-cart-icon">
          <i class="bi bi-bag" style="font-size: 1.2rem;"></i>
          </span>
          <span class="mini-size-box">
            <div class="radio-inputs">
              <label class="radio">
                <input checked="" name="radio" type="radio">
                <span class="name">S</span>
              </label>
              <label class="radio">
                <input name="radio" type="radio">
                <span class="name">M</span>
              </label>
                  
              <label class="radio">
                <input name="radio" type="radio">
                <span class="name">L</span>
              </label>
              
              <label class="radio">
                <input name="radio" type="radio">
                <span class="name">XL</span>
              </label>

              <label class="radio">
                <input name="radio" type="radio">
                <span class="name">XXL</span>
              </label>

            </div>
            <button class="mini-add-to-cart" tabindex="-1">Add to cart</button>
          </span>
        </div>
        <div class="product-details-div">
          <p class="product-title"><?php echo $product['product_name'] ?></p>
          <?php if($product['product_discounted_price'] != 0) : ?>
          <p class="product-price discount-strike">Rs <?php echo number_format($product['product_actual_price']) ?></p>
            <p class="product-discounted-price">Rs <?php echo number_format($product['product_discounted_price']); ?></p>
            <?php else : ?>
              <p class="product-price">Rs <?php echo number_format($product['product_actual_price']) ?></p>
          <?php endif; ?>
        </div>
      </div>

      <?php endforeach; ?>

      
        </div>
          <div class="load-btn-div d-flex justify-content-center align-items-center">
            <button class="load-more" tabindex="-1" onclick="fetchProducts()">
              <span class="load-more-text">Load more</span>
            <div class="spinner-border spinner-border-sm" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
            </button>
            <p id="more-products"></p>
            <input type="hidden" name="offset" id="offset" value="0">
          </div>
    </div>

     </main>

  <!-- Footer -->
  <?php include './includes/Footer.php'; ?>

<!-- BOOTSTRAP SCRIPT CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- VANILLA JS -->
<script src="./scripts/script.js"></script>

<!-- AJAX handler -->
 <script src="./scripts//ajaxHandler.js"></script>

</body>
</html>   