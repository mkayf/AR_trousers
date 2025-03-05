<?php

include_once __DIR__ . '/config/App.php';
include_once __DIR__ . '/auth/auth.php';
include_once __DIR__ . '/controllers/CartController.php';
include_once __DIR__ . '/controllers/CheckoutController.php';
include_once __DIR__ . '/placeOrder.php';


$cart_items = $cartController->getCartItems() ?? [];

$state_arr = ['Azad Kashmir', 'Balochistan', 'Islamabad Capital Territory', 'Khyber Pakhtunkhwa', 'Punjab', 'Sindh'];

if(isset($_SESSION['order_placed']) && $_SESSION['order_placed'] == true){
  $order_ID = $_SESSION['order_ID'];
  unset($_SESSION['order_placed']);
  redirect('', '', "thankyou.php");
  exit(0);
}


if(empty($cart_items)){
  redirect('', '', 'cart.php');
  exit(0);
}

if(isset($_SESSION['authenticated'])){
  $shipping_details = $checkout_controller->getShippingDetails();
}


$errors = $_SESSION['errors'] ?? [];
$old_data = $_SESSION['old_data'] ?? [];


unset($_SESSION['errors']);
unset($_SESSION['old_data']);

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AR Trousers - Shop Stylish Women's Stitched Trousers Online</title>
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon-16x16.png">
    <link rel="manifest" href="./config/site.webmanifest">
    <!-- BOOTSTRAP LINK CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <!-- CUSTOM CSS STYLESHEET -->
   <link rel="stylesheet" href="./css/style.css">
   
  <body>

    <!-- NAVBAR -->
     <header>
         <?php include './includes/Navbar.php'; ?>
         
         <?php if(isset($_SESSION['authenticated']) && isset($_SESSION  ['message'])) : ?>
        <div class="header-msg d-flex align-items-center justify-content-between">
          <?php include './includes/message.php' ?>
          <span class="msg-close-btn"><i class="bi bi-x-lg"></i></span>
        </div>
        <?php endif; ?>       

         <?php if(isset($_SESSION['order_placement_error'])) : ?>
          <div class="header-msg d-flex align-items-center justify-content-between">
          <p style="font-size: 1rem;"><?= $_SESSION['order_placement_error']; ?></p>
          <span class="msg-close-btn"><i class="bi bi-x-lg"></i></span>
         </div>
         <?php unset($_SESSION['order_placement_error']) ?>
         <?php endif; ?>
     </header>

     <main class="checkout-main">
        <div class="heading-div d-flex justify-content-center align-items-center mt-5">
        <span class="separator"></span><h2 class="section-heading">Checkout</h2><span class="separator"></span>
        </div>

        <div class="container checkout-section my-3">
            <div class="row d-flex justify-content-center align-items-start gap-4">
                <div class="col-sm-12 col-md-12 col-lg-7 shipping-details my-3 my-md-4 my-lg-5 order-2 order-md-1">
                    <div class="d-flex justify-content-between align-items-center">
                      <h4>Shipping</h4>
                    </div>
                    <?php if(!isset($_SESSION['authenticated'])) : ?>
                    <p style="font-size: 1rem;"><a href="<?php base_url('login.php?redirect=checkout'); ?>">Login</a> to view your order status and manage your account.</p>
                    <?php endif; ?>
                    <form method="post" class="checkout-form">
                      <div class="row mt-4">
                        <div class="mb-3 input-div col-sm-12 col-md-6 col-lg-6">
                          <label for="first-name">First name <span class="star">*</span></label>
                          <input type="text" id="first-name" name="first-name" value="<?php 
                            if(isset($shipping_details) && !empty($shipping_details)){
                              echo $shipping_details['first_name'];
                            } else{
                              $old_data['first-name'] ?? '';
                            }
                          ?>">
                          <small style="color: red;"><?= $errors['first-name'] ?? '' ?></small>
                        </div>
                        <div class="mb-3 input-div col-sm-12 col-md-6 col-lg-6">
                          <label for="last-name">Last name <span class="star">*</span></label>
                          <input type="text" id="last-name" name="last-name" value="<?php 
                            if(isset($shipping_details) && !empty($shipping_details)){
                              echo $shipping_details['last_name'];
                            } else{
                              $old_data['last-name'] ?? '';
                            }
                          ?>">
                          <small style="color: red;"><?= $errors['last-name'] ?? '' ?></small>
                        </div>
                        <div class="mb-3 input-div col-sm-12 col-md-6 col-lg-6">
                          <label for="phone-number">Phone number <span class="star">*</span></label>
                          <input type="number" id="phone-number" name="phone-number" value="<?php 
                            if(isset($shipping_details) && !empty($shipping_details)){
                              echo $shipping_details['phone_number'];
                            } else{
                              $old_data['phone_number'] ?? '';
                            }
                          ?>">
                          <small style="color: red;"><?= $errors['phone-number'] ?? '' ?></small>
                        </div>
                        <div class="mb-3 input-div col-sm-12 col-md-6 col-lg-6">
                          <label for="email">Email</label>
                          <input type="email" id="email" name="email" value="<?php 
                            if(isset($shipping_details) && !empty($shipping_details)){
                              echo $shipping_details['email'];
                            } else{
                              $old_data['email'] ?? '';
                            }
                          ?>">
                          <small style="color: red;"><?= $errors['email'] ?? '' ?></small>
                        </div>
                        <div class="mb-3 input-div col-sm-12 col-md-12 col-lg-12">
                          <label for="address">Street address / House number <span class="star">*</span></label>
                          <input type="text" id="address" name="address" value="<?php 
                            if(isset($shipping_details) && !empty($shipping_details)){
                              echo $shipping_details['street_address'];
                            } else{
                              $old_data['street_address'] ?? '';
                            }
                          ?>">
                          <small style="color: red;"><?= $errors['address'] ?? '' ?></small>
                        </div>
                        <div class="mb-3 input-div col-sm-12 col-md-12 col-lg-12">
                          <label for="landmark">Landmark / مشہور جگہ</label>
                          <input type="text" id="landmark" name="landmark" value="<?php 
                            if(isset($shipping_details) && !empty($shipping_details)){
                              echo $shipping_details['landmark'];
                            } else{
                              $old_data['landmark'] ?? '';
                            }
                          ?>">
                        </div>
                        <div class="mb-3 input-div col-sm-12 col-md-6 col-lg-6">
                         <label for="state">State / Province <span class="star">*</span></label>
                          <select name="state" id="state">
                            <option value="null">Select your state</option>
                            <?php foreach($state_arr as $state) : ?>
                              <option value="<?= $state ?>" <?= $shipping_details['state'] == $state ? 'selected' : '' ?>><?= $state ?></option>
                            <?php endforeach; ?>
                          </select>
                          <small style="color: red;"><?= $errors['state'] ?? '' ?></small>
                        </div>
                        <div class="mb-3 input-div col-sm-12 col-md-6 col-lg-6">
                          <label for="city">City <span class="star">*</span></label>
                          <input type="text" id="city" name="city" value="<?php 
                            if(isset($shipping_details) && !empty($shipping_details)){
                              echo $shipping_details['city'];
                            } else{
                              $old_data['city'] ?? '';
                            }
                          ?>">
                          <small style="color: red;"><?= $errors['city'] ?? '' ?></small>
                        </div>
                        <div class="mb-3 mt-3 col-12">
                          <h5>Payment</h5>
                          <input type="radio" name="payment-method" id="COD" value="COD" checked>
                          <label for="COD">Cash On Delivery</label>
                          <p style="font-size: 0.9rem;">* Shipping charges are Rs 200 for Karachi and Rs 300 for other cities.</p>
                          <small style="color: red;"><?= $errors['payment-method'] ?? '' ?></small>
                        </div>
                        <div class="mb-3 col-12">
                          <button type="submit" class="place-order-btn" name="place-order">Place order</button>
                        </div>
                      </div>
                    </form>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-4 checkout-cart-details my-3 my-md-4 my-lg-5 order-1 order-md-2 mx-auto">
                    <h4>Your cart</h4>
                    <div class="checkout-products-container">
                      <?php foreach($cart_items as $item) : ?>              
                      <div class="checkout-product mt-3 d-flex align-items-center">
                        <div class="checkout-img">
                          <span class="checkout-item-count"><?= $item['quantity'] ?></span>
                          <img src=".<?= $item['product_img_1'] ?>" alt="<?= $item['product_name'] ?>">
                        </div>
                        <div class="flexer">
                        <div class="checkout-product-details ms-2">
                          <p><?php echo substr($item['product_name'], 0,25) ?>...</p>
                          <p class="text-secondary" style="font-size: 0.8rem;"><?= $item['size'] ?> | <?= ucfirst($item['color']) ?></p>
                        </div>
                        <div class="checkout-product-subtotal">
                          <p>Rs <?php echo number_format($cartController->getCartItemSubtotal($item['product_ID'], $item['quantity'])) ?></p>
                        </div>
                        </div>
                      </div>
                      <?php endforeach; ?>
                    </div>
                    <div class="checkout-totals mt-4">
                      <div class="d-flex justify-content-between mt-2">
                        <p>Subtotal</p>
                        <p>Rs <?= number_format($cartController->getCartTotal()) ?></p>
                      </div>
                      <div class="d-flex justify-content-between mt-2">
                        <p>Shipping</p>
                        <p class="shipping-charges">Rs <?= number_format($checkout_controller->getShippingCharges()) ?></p>
                      </div>
                      <div class="d-flex justify-content-between mt-2 checkout-total">
                        <p>Total</p>
                        <p id="checkout-total-price">Rs <?= number_format($checkout_controller->getCheckoutTotal()) ?></p>
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