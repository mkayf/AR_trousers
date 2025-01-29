<?php

include_once __DIR__ . '/config/App.php';
include_once __DIR__ . '/auth/auth.php';
include_once __DIR__ . '/controllers/CartController.php';

$cart_items = $cartController->getCartItems() ?? [];

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

     <main class="cart-main">
        <div class="heading-div d-flex justify-content-center align-items-center mt-5">
        <span class="separator"></span><h2 class="section-heading">Your Cart</h2><span class="separator"></span>
        </div>

        <?php if(!empty($cart_items)): ?>
        <div class="container mt-4">
          <button class="con-shop" onclick="window.history.back()"><i class="bi bi-arrow-left-circle"></i> Continue shopping</button>
        </div>
        <?php endif; ?>


        <section class="cart-items-section container my-5">
        <?php if(!empty($cart_items)) : ?>

            <table class="cart-table">
              <thead>
                <tr class="row m-0">
                  <th class="col-sm-12 col-md-4 col-lg-4">Product</th>
                  <th class="col-sm-12 col-md-2 col-lg-2">Price</th>
                  <th class="col-sm-12 col-md-4 col-lg-4">Quantity</th>
                  <th class="col-sm-12 col-md-2 col-lg-2">Subtotal</th>
                </tr>
              </thead>

          
              <tbody class="cart-table-body">
                <?php foreach($cart_items as $item) : ?>
                <tr class="row table-row m-0" data-row-cart-id="<?= $item['cart_ID'] ?>">
                   <td class="col-sm-12 col-md-4 col-lg-4">
                    <div class="row d-flex justify-content-center align-items-center">
                      <div class="cart-item-img col-sm-12 col-md-4 col-lg-4">
                        <img src=".<?= $item['product_img_1'] ?>" alt="<?= $item['product_name'] ?>">
                      </div>
                      <div class="cart-item-details col-sm-12 col-md-8 col-lg-8">
                        <p class="bold"><?= $item['product_name'] ?></p>
                        <p>Color: <span class="bold text-capitalize"><?= $item['color'] ?></span> | Size: <span class="bold"><?= $item['size'] ?></span></p>
                      </div>
                    </div>
                  </td>
                  <td class="col-sm-12 col-md-2 col-lg-2 mt-2 mt-md-0"><span class="hidden">Price: </span><span class="bold-h">Rs 
                  <?php 
                    if($item['product_discounted_price'] > 0){
                      echo number_format($item['product_discounted_price']);
                    } else{
                      echo number_format($item['product_actual_price']);
                    }
                  ?>
                  </span></td>
                  <td class="col-sm-12 col-md-4 col-lg-4 d-flex  align-items-center justify-content-between justify-content-md-start gap-4 mt-2 mt-md-0">
                  <div class="qty-div">
                    <input type="number" name="qty" class="cart-qty" min="1" max="10" step="1" value="<?= $item['quantity'] ?>">
                  </div>
                  <button type="button" class="delete-cart-item" data-cart-id="<?= $item['cart_ID'] ?>"><i class="bi bi-trash3"></i></button>
                  </td>
                  <td class="col-sm-12 col-md-2 col-lg-2 mt-2 mt-md-0"><span class="hidden">Subtotal: </span><span class="bold-h">Rs
                    <?php
                      if($item['product_discounted_price'] > 0){
                        echo number_format($item['product_discounted_price'] * $item['quantity']);
                      } else{
                        echo number_format($item['product_actual_price'] * $item['quantity']);
                      }
                    ?>
                  </span></td>
                </tr>
                  <?php endforeach; ?>

                 <?php else: ?>
                  <div class="text-center">
                    <h3 class="empty-cart">No Products in Your cart.</h3>
                    <a href="<?php base_url('products/trousers.php') ?>">
                      <button class="con-shop-empty">Continue shopping</button>
                    </a>
                  </div>
                <?php endif; ?>
              </tbody>
            </table>
        </section>


        <?php if(!empty($cart_items)) : ?>
        <section class="cart-total-section container my-5 text-start text-md-end">
          <span class="ct">Cart Total: </span><span class="cart-total bold">Rs
            <?php echo number_format($cartController->getCartTotal()) ?? 0 ?>
          </span>
          <p>Shipping charges are calculated at checkout.</p>
          <a href="<?php base_url('checkout.php') ?>"><button class="checkout-btn text-center">Proceed to checkout</button></a>
        </section>
        <?php endif; ?>
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