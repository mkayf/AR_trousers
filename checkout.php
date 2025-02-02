<?php

include_once __DIR__ . '/config/App.php';
include_once __DIR__ . '/auth/auth.php';
include_once __DIR__ . '/controllers/CartController.php';
include_once __DIR__ . '/controllers/CheckoutController.php';

$checkout_controller = new CheckoutController($DB->conn);


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
   <link rel="stylesheet" href="./css/style.css">
   
  <body>

    <!-- NAVBAR -->
     <header>
         <?php include './includes/Navbar.php'; ?>
     </header>

     <main class="checkout-main">
        <div class="heading-div d-flex justify-content-center align-items-center mt-5">
        <span class="separator"></span><h2 class="section-heading">Checkout</h2><span class="separator"></span>
        </div>

        <div class="container checkout-section my-3">
            <div class="row d-flex justify-content-center align-items-start gap-5">
                <div class="col col-sm-12 col-md-12 col-lg-7 shipping-details my-5">
                    <h4>Shipping</h4>
                    <form method="post" class="checkout-form">
                      <div class="row mt-4">
                        <div class="mb-3 input-div col col-sm-12 col-md-12 col-lg-6">
                          <label for="first-name">First name <span class="star">*</span></label>
                          <input type="text" id="first-name" name="first-name" required>
                        </div>
                        <div class="mb-3 input-div col col-sm-12 col-md-12 col-lg-6">
                          <label for="last-name">Last name <span class="star">*</span></label>
                          <input type="text" id="last-name" name="last-name" required>
                        </div>
                        <div class="mb-3 input-div col col-sm-12 col-md-12 col-lg-6">
                          <label for="phone-number">Phone number <span class="star">*</span></label>
                          <input type="text" id="phone-number" name="phone-number" required>
                        </div>
                        <div class="mb-3 input-div col col-sm-12 col-md-12 col-lg-6">
                          <label for="email">Email</label>
                          <input type="text" id="email" name="email">
                        </div>
                        <div class="mb-3 input-div col col-sm-12 col-md-12 col-lg-12">
                          <label for="address">Street address / House number <span class="star">*</span></label>
                          <input type="text" id="address" name="address" required>
                        </div>
                        <div class="mb-3 input-div col col-sm-12 col-md-12 col-lg-12">
                          <label for="landmark">Landmark <span class="star">*</span></label>
                          <input type="text" id="landmark" name="landmark" required>
                        </div>
                        <div class="mb-3 input-div col col-sm-12 col-md-12 col-lg-6">
                          <label for="state">State / Province <span class="star">*</span></label>
                          <select name="state" id="state" >
                            <option value="null">Select your state</option>
                            <option value="Azad Kashmir">Azad Kashmir</option>
                            <option value="Balochistan">Balochistan</option>
                            <option value="Islamabad Capital Territory">Islamabad Capital Territory</option>
                            <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Sindh">Sindh</option>
                          </select>
                        </div>
                        <div class="mb-3 input-div col col-sm-12 col-md-12 col-lg-6">
                          <label for="city">City <span class="star">*</span></label>
                          <input type="text" id="city" name="city" required>
                        </div>
                        <div class="mb-3 col-12">
                          <input type="checkbox" id="save-shipping" name="save-shipping" required>
                          <label for="save-shipping">Save this shipping address</label>
                        </div>
                        <div class="mb-3 col-12">
                          <h5>Payment</h5>
                          <input type="radio" name="COD" id="COD" checked>
                          <label for="COD">Cash On Delivery</label>
                        </div>
                        <div class="mb-3 col-12">
                          <button class="place-order-btn">Place order</button>
                        </div>
                      </div>
                    </form>
                </div>
                <div class="col col-sm-12 col-md-12 col-lg-4 checkout-cart-details my-5">
                    <h4>Your cart</h4>
                    <div class="checkout-product mt-3 d-flex align-items-center gap-3">
                      <div class="checkout-img">
                        <img src="./assets/product_images/Pure_cotton/Latest trouser designing ideas for summer dresses_cotton trouser designs for eid dressing_modstitch.jfif" alt="" height="80px" width="60px">
                      </div>
                      <div class="checkout-product-details">
                        <p>Product name</p>
                        <p>Size and color</p>
                      </div>
                      <div class="checkout-product-subtotal ms-auto">
                        4646
                      </div>
                    </div>
                    
                    <div class="checkout-totals mt-4">
                      <div class="d-flex justify-content-between">
                        <p>Subtotal</p>
                        <p>14686</p>
                      </div>
                      <div class="d-flex justify-content-between">
                        <p>Shipping</p>
                        <p>300</p>
                      </div>
                      <div class="d-flex justify-content-between">
                        <p>Shipping</p>
                        <p>300</p>
                      </div>
                    </div>
                </div>
            </div>
        </div>

     </main>

       <!-- Footer -->
  <?php include './includes/Footer.php'; ?>

<!-- BOOTSTRAP SCRIPT CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- VANILLA JS -->
<script src="./scripts/script.js"></script>

<!-- AJAX HANDLER -->
<script src="./scripts//ajaxHandler.js"></script>

</body>
</html>   