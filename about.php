<?php
  include_once './config/App.php';
  include_once 'auth/auth.php';
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

     <main class="about-main">
        <div class="container-fluid about-container">
            <div class="row about-row-1 d-flex justify-content-center align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <h2>Who we are</h2>
                    <p>Welcome to AR Trouser, where we bring style, comfort, and quality to every woman. We specialize in beautifully crafted trousers designed to fit your lifestyle, and we're just getting started!</p>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 d-flex justify-content-center ju align-items-center about-product-img">
                    <img src="./assets/product_images/trouser-4.jfif" alt="">
                </div>
            </div>

            <div class="row about-row-2 d-flex justify-content-center align-items-center flex-md-row">
                <div class="col-sm-12 col-md-12 col-lg-6 d-flex justify-content-center ju align-items-center about-product-img order-last order-lg-first">
                    <img src="./assets/product_images/trouser-3.jfif" alt="">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 order-first order-lg-last">
                    <h2>Our mission</h2>
                    <p>Our mission is to empower women with stylish and affordable clothing. We are committed to quality, comfort, and customer satisfaction.</p>
                </div>
            </div>

            <div class="row about-row-3 d-flex justify-content-center align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-6 ">
                    <h2>Our journey</h2>
                    <p>It all began with a dream to provide high-quality trousers that women can rely on. As a small-scale business in Pakistan, we take pride in our local roots and personal approach to fashion.</p>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 d-flex justify-content-center ju align-items-center about-product-img">
                    <img src="./assets/product_images/trouser-1.jfif" alt="">
                </div>
            </div>

            <div class="row about-row-4 d-flex justify-content-center align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-6 d-flex justify-content-center ju align-items-center about-product-img order-last order-lg-first">
                    <img src="./assets/product_images/trouser-5.jfif" alt="">
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 order-first order-lg-last">
                    <h2>Current offerings</h2>
                    <p>While we currently offer a curated selection of women's trousers, we are excited to expand into other categories like tops, accessories, and more.</p>
                </div>
            </div>

            <div class="row about-row-5 d-flex justify-content-center align-items-center">
                <div class="col-sm-12 col-md-12 col-lg-6">
                    <h2>Future vision</h2>
                    <p>We envision AR Trouser becoming a one-stop destination for women's fashion, offering a wide variety of products that reflect your unique style.</p>
                </div>
                <div class="col-sm-12 col-md-12 col-lg-6 d-flex justify-content-center ju align-items-center about-product-img">
                    <img src="./assets/product_images/trouser-2.jfif" alt="">
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


</body>
</html>   