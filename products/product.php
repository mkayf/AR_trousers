<?php

include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../auth/auth.php';
include_once __DIR__ . '/../controllers/ProductsController.php';
include_once __DIR__ . '/../controllers/CartController.php';


$productDetails = new ProductsController($DB->conn);
$productDetails = $productDetails->getSingleProduct() ?? [];


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AR Trousers - Shop Stylish Women's Stitched Trousers Online</title>
    <!-- BOOTSTRAP LINK CDN -->
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon-16x16.png">
    <link rel="manifest" href="<?= ROOT_URL ?>site.webmanifest">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <!-- CUSTOM CSS STYLESHEET -->
   <link rel="stylesheet" href="../css/style.css">
   
  <body>
    
    <!-- NAVBAR -->
     <header class="product-header">
         <?php include '../includes/Navbar.php'; ?>
     </header>

     <main class="product-main">
        <!-- size guide modal -->
      <div class="modal fade" id="size-guide-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">Size Guide</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <div style="overflow-x: auto;">    
            <table class="table text-center size-table table-bordered border-dark">
              <thead>
                <tr>
                  <th scope="col" class="text-start">Size</th>
                  <th scope="col">Small</th>
                  <th scope="col">Medium</th>
                  <th scope="col">Large</th>
                  <th scope="col">X large</th>
                  <th scope="col">XX large</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="fw-bold text-start">Waist</td>
                  <td>24</td>
                  <td>28</td>
                  <td>30</td>
                  <td>32.5</td>
                  <td>34</td>
                </tr> 
                <tr>
                  <td class="fw-bold text-start">Hip</td>
                  <td>38</td>
                  <td>40</td>
                  <td>44</td>
                  <td>48</td>
                  <td>56</td>
                </tr>
                <tr>
                  <td class="fw-bold text-start">Thigh</td>
                  <td>23</td>
                  <td>24</td>
                  <td>26</td>
                  <td>28</td>
                  <td>32</td>
                </tr>
                <tr>
                  <td class="fw-bold text-start">Length</td>
                  <td>36</td>
                  <td>37</td>
                  <td>38</td>
                  <td>39</td>
                  <td>39</td>
                </tr>
                <tr>
                  <td class="fw-bold text-start">Bottom</td>
                  <td>6</td>
                  <td>6.5</td>
                  <td>7</td>
                  <td>7.5</td>
                  <td>7.5</td>
                </tr>
              </tbody>
           </table>
          </div>
           <p class="size-note"><span class="fw-bold">Note:</span> All measurements are in inches.</p>
            </div>
          </div>
        </div>
  </div>
<!-- Size guide modal -->


        <div class="container">
          <?php if(!empty($productDetails)) : ?>
          <div class="row d-flex justify-content-center <?php if(empty($productDetails['stock'])) echo 'align-items-center'; ?>">
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
                  <div class="radio-inputs size-btns-container">
              
              <?php if(!empty($productDetails['stock'])) : ?>
                
                <?php for($i = 0; $i < count($productDetails['stock']); $i++) : ?>
               
                  <label class="radio">
                    <input type="radio" name="size"
                    value="<?= $productDetails['stock'][$i]['size'] ?>">
                    <span class="name"><?= $productDetails['stock'][$i]['size'] ?></span>
                  </label>                    

                <?php endfor; ?>

                <?php else : ?>

                  <span>Out of stock.</span>
              <?php endif; ?>
                  </div>
                </div>
                <button class="size-guide-btn" data-bs-toggle="modal" data-bs-target="#size-guide-modal">Size guide</button>
              </div>
              <?php if(!empty($productDetails['stock'])) : ?>
              <p class="mt-4 mb-2 selected-color fw-bold"></p>
              <div class="colors-div d-flex justify-content-start align-items-center gap-2">
                <label for="color-black">
                  <input type="radio" class="radio-color" name="color" id="color-black" value="Black"
                  <?php
                  if(isset($productDetails['stock'][0]['color'])){
                    echo $productDetails['stock'][0]['color'] == 'black' ? 'checked' : '';
                  }
                  ?>
                  >
                  <span class="color-black color"></span>
                </label>
                <label for="color-white">
                  <input type="radio" class="radio-color" name="color" id="color-white" value="White"
                  <?php
                  if(isset($productDetails['stock'][0]['color'])){
                    echo $productDetails['stock'][0]['color'] == 'white' ? 'checked' : '';
                  }
                  ?>
                  >
                  <span class="color-white color"></span>
                </label>
              </div>
              <?php endif; ?>
              <p class="fabric-type mt-4">
                <span class="fw-bold">Fabric:</span>
                <?php if($productDetails['cat_name'] == 'Pure_cotton') :  ?>
                  Pure cotton
                <?php elseif($productDetails['cat_name'] == 'Polyester_cotton') : ?>
                  Polyester cotton
                <?php endif; ?>
              </p>
              <div class="product-desc-div mt-3">
                <p class="mt-4 mb-2 fw-bold">Description:</p>
                <p><?= $productDetails['product_desc'] ?></p>
              </div>
              <hr>
              <?php if(!empty($productDetails['stock'])) : ?> 
              <div class="mt-4 d-flex flex-column flex-sm-row justify-content-start align-items-start align-items-sm-center gap-3">
                <div class="d-flex justify-content-center align-items-center gap-2">
                  <label>Quantity:</label>
                  <div class="qty-div">
                    <button class="qtyminus">&minus;</button>
                    <input type="number" name="qty" id="qty" min="1" max="<?= $productDetails['stock'][0]['stock_quantity']; ?>" step="1" value="1">
                    <button class="qtyplus">&plus;</button>
                  </div>
                </div>
                <button class="add-to-cart-btn">Add to cart</button>
              </div>
              <?php endif; ?>
            </div>
          </div>
          <?php else : ?>
            <p class="text-center">We are unable to load product details at the moment. Please try again later.</p>           
          <?php endif; ?>
        </div>

     </main>

  <!-- Footer -->
  <?php include '../includes/Footer.php'; ?>

<!-- BOOTSTRAP SCRIPT CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- VANILLA JS -->
<script src="../scripts/script.js"></script>

<!-- AJAX HANDLER -->
<script src="../scripts/ajaxHandler.js"></script>

</body>
</html>   