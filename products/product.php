<?php

include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../auth/auth.php';
include_once __DIR__ . '/../controllers/ProductsController.php';

$productDetails = new ProductsController($DB->conn);
$productDetails = $productDetails->getSingleProduct();

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AR Trousers - Shop Stylish Women's Stitched Trousers Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <!-- CUSTOM CSS STYLESHEET -->
   <link rel="stylesheet" href="../css/style.css">
   
  <body>
    
    <!-- NAVBAR -->
     <header>
         <?php include '../includes/Navbar.php'; ?>
     </header>

     <main class="product-main">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="product-imgs-div d-flex flex-column-reverse flex-md-row justify-content-center gap-4 col-12 col-sm-12 col-md-12 col-lg-6 mb-5">
                <div class="other-imgs-div d-flex flex-row flex-md-column justify-content-center gap-4">
                  <?php if(isset($productDetails['product_img_2']) && !empty($productDetails['product_img_2'])) : ?>
                  <div class="product-img img-1 active">
                    <img src="..<?= $productDetails['product_img_1'] ?>" alt="trouser-img-1">
                  </div>
                  <?php endif; ?>
                  <?php if(isset($productDetails['product_img_2']) && !empty($productDetails['product_img_2'])) : ?>
                  <div class="product-img img-2">
                    <img src="..<?= $productDetails['product_img_2'] ?>" alt="trouser-img-2">
                  </div>
                  <?php endif; ?>
                  <?php if(isset($productDetails['product_img_3']) && !empty($productDetails['product_img_3'])) : ?>
                  <div class="product-img img-3">
                    <img src="..<?= $productDetails['product_img_3'] ?>" alt="trouser-img-3">
                  </div>
                  <?php endif; ?>
                </div>
                <div class="main-img-div d-flex justify-content-center">
                  <div class="product-main-img">
                  <img src="../<?= $productDetails['product_img_1'] ?>" alt="trouser-main-img" id="main-img">
                  </div>
                </div>
            </div>
            <div class="product-info-div col-12 col-sm-12 col-md-12 col-lg-6">
              <p class="fabric-type mb-3">Fabric type</p>
              <h2 class="product-name"><?= $productDetails['product_name']?></h2>
              <?php if($productDetails['product_discounted_price'] != 0) : ?>
                <p class="product-actual-price discount-strike">Rs <?= number_format($productDetails['product_actual_price']) ?></p>
                <p class="product-discounted-price">Rs <?= number_format($productDetails['product_discounted_price']) ?></p>
              <?php else : ?>
                <p class="product-actual-price">Rs <?= number_format($productDetails['product_actual_price']) ?></p>
              <?php endif; ?>
              
              <p class="mt-4 mb-2 selected-size fw-bold"></p>
              <div class="sizes-div d-flex flex-wrap justify-content-between align-items-center">
                <div class="size-btns">
                  <div class="radio-inputs">
                  <label class="radio">
                    <input type="radio" name="size" checked="" value="small">
                    <span class="name">S</span>
                  </label>
                  <label class="radio">
                    <input type="radio" name="size" value="medium">
                    <span class="name">M</span>
                  </label>
                      
                  <label class="radio">
                    <input type="radio" name="size" value="large">
                    <span class="name">L</span>
                  </label>

                  <label class="radio">
                    <input type="radio" name="size" value="x-large">
                    <span class="name">XL</span>
                  </label>

                  <label class="radio">
                    <input type="radio" name="size" value="xx-large">
                    <span class="name">XXL</span>
                  </label>
                  </div>
                </div>
                <button class="size-guide-btn">Size guide</button>
              </div>
              <p class="mt-4 mb-2 selected-color fw-bold"></p>
              <div class="colors-div d-flex justify-content-start align-items-center gap-2">
                <label for="color-black">
                  <input type="radio" class="radio-color" name="color" id="color-black" value="Black" checked>
                  <span class="color-black color"></span>
                </label>
                <label for="color-white">
                  <input type="radio" class="radio-color" name="color" id="color-white" value="White">
                  <span class="color-white color"></span>
                </label>
              </div>
              <div class="product-desc-div mt-3">
                <p class="mt-4 mb-2 fw-bold">Product description:</p>
                <p><?= $productDetails['product_desc'] ?></p>
              </div>
              <hr> 
              <div class="mt-4 d-flex flex-column flex-sm-row justify-content-start align-items-start align-items-sm-center gap-3">
                <div class="d-flex justify-content-center align-items-center gap-2">
                  <label>Quantity:</label>
                  <div class="qty">
                    <button class="qtyminus">&minus;</button>
                    <input type="number" name="qty" id="qty" min="1" max="10" step="1" value="1" readonly>
                    <button class="qtyplus">&plus;</button>
                  </div>
                </div>
                <button class="add-to-cart-btn">Add to cart <i class="bi bi-bag-plus"></i></button>
              </div>
            </div>
          </div>                  
          <div class="row d-flex justify-content-center align-items-center mt-5">
                <h3 class="text-center">You may also like</h3>
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