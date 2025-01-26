<?php
include_once __DIR__ . '/config/App.php';
include_once __DIR__ . '/auth/auth.php';
include_once __DIR__ . '/controllers/ProductsController.php';
include_once __DIR__ . '/controllers/CartController.php';

$productController = new ProductsController($DB->conn);

$newArrivalProducts = $productController->newArrivalProducts() ?? [];
$polyCottonTrousers = $productController->polyCottonTrousers(8) ?? [];

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AR Trousers - Shop Stylish Women's Stitched Trousers Online</title>
    <!-- BOOTSTRAP LINK CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- CUSTOM CSS STYLESHEET -->
    <link rel="stylesheet" href="./css/style.css">

    <!-- SWIPER JS CDN LINK -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
  </head>
  <body>
    
    <!-- NAVBAR -->

     <header>
       <?php include './includes/Navbar.php'; ?>

        <?php if(isset($_SESSION['authenticated']) && isset($_SESSION['message'])) : ?>
       <div class="header-msg d-flex align-items-center justify-content-between">
        <?php include './includes/message.php' ?>
        <span class="msg-close-btn"><i class="bi bi-x-lg"></i></span>
       </div>
       <?php endif; ?>
     </header>

    <main>
      <div class="slider">
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <div class="swiper-slide">
        <div class="slide-img-bg-1 slide-img">
        <h1 class="heading">AR Trousers</h1>
        </div>
      </div>
      <div class="swiper-slide">
        <div class="slide-img-bg-2 slide-img">
        <h1 class="heading">AR Trousers</h1>
        </div>
      </div>
      <div class="swiper-slide">
        <div class="slide-img-bg-3 slide-img">
        <h1 class="heading">AR Trousers</h1>
        </div>
      </div>
    </div>
    <div class="autoplay-progress">
      <svg viewBox="0 0 48 48">
        <circle cx="24" cy="24" r="20"></circle>
      </svg>
      <span></span>
    </div>
  </div>
 </div>
 <!-- slider -->

<!-- Marquee -->

<div class="marquee">

 <div class="marquee-slide"> 

  <div class="marquee-content">
  <img src="<?php base_url('assets/images/mandala.svg') ?>" alt="Marquee mandala art icon"> <h3>Quality fabric</h3>  
  </div>

  <div class="marquee-content">
  <img src="<?php base_url('assets/images/mandala.svg') ?>" alt="Marquee mandala art icon"> <h3>Soft & breathable</h3>  
  </div>

  <div class="marquee-content">
  <img src="<?php base_url('assets/images/mandala.svg') ?>" alt="Marquee mandala art icon"> <h3>Tailored fit</h3>  
  </div>

  <div class="marquee-content">
  <img src="<?php base_url('assets/images/mandala.svg') ?>" alt="Marquee mandala art icon"> <h3>Pure cotton</h3>  
  </div>

  <div class="marquee-content">
  <img src="<?php base_url('assets/images/mandala.svg') ?>" alt="Marquee mandala art icon"> <h3>Luxurious feel</h3>  
  </div>

  <div class="marquee-content">
  <img src="<?php base_url('assets/images/mandala.svg') ?>" alt="Marquee mandala art icon"> <h3>Ethnic charm</h3>  
  </div>

  <div class="marquee-content">
  <img src="<?php base_url('assets/images/mandala.svg') ?>" alt="Marquee mandala art icon"> <h3>Fully handcrafted</h3>  
  </div>

 </div>


 <div class="marquee-slide"> 

  <div class="marquee-content">
  <img src="<?php base_url('assets/images/mandala.svg') ?>" alt="Marquee mandala art icon"> <h3>Quality fabric</h3>  
  </div>

  <div class="marquee-content">
  <img src="<?php base_url('assets/images/mandala.svg') ?>" alt="Marquee mandala art icon"> <h3>Soft & breathable</h3>  
  </div>

  <div class="marquee-content">
  <img src="<?php base_url('assets/images/mandala.svg') ?>" alt="Marquee mandala art icon"> <h3>Tailored fit</h3>  
  </div>

  <div class="marquee-content">
  <img src="<?php base_url('assets/images/mandala.svg') ?>" alt="Marquee mandala art icon"> <h3>Pure cotton</h3>  
  </div>

  <div class="marquee-content">
  <img src="<?php base_url('assets/images/mandala.svg') ?>" alt="Marquee mandala art icon"> <h3>Luxurious feel</h3>  
  </div>

  <div class="marquee-content">
  <img src="<?php base_url('assets/images/mandala.svg') ?>" alt="Marquee mandala art icon"> <h3>Ethnic charm</h3>  
  </div>

  <div class="marquee-content">
  <img src="<?php base_url('assets/images/mandala.svg') ?>" alt="Marquee mandala art icon"> <h3>Fully handcrafted</h3>  
  </div>

 </div> 


</div>

<!-- Marquee -->


  <!-- Our latest products -->
   <section class="latest-products-section container-fluid">
    <div class="heading-div d-flex justify-content-center align-items-center">
    <span class="separator"></span><h2 class="section-heading">new arrivals</h2><span class="separator"></span>
    </div>
    <p class="tag-line">Step Into Style and Comfort: Explore Our Latest Arrivals Today!</p>
    <div class="row d-flex justify-content-center align-items-center my-5 new-arrivals">

    <?php if(!empty($newArrivalProducts)) : ?>
      <?php foreach($newArrivalProducts as $product) : ?>

      <div class="product-card col-sm-6 col-md-3 col-lg-3">
      <div class="product-img-div">
        <a class="product-link text-reset col-sm-6 col-md-3 col-lg-3" href="./products/product.php?<?php echo 'id=' . $product['product_ID'] . '&' . 'slug=' . $product['slug'] ?>">
        <img src=".<?php echo $product['product_img_1'] ?>" alt="<?php echo $product['product_name'] ?>">
        </a>
      </div>
      <div class="product-details-div">
      <a class="product-link text-reset col-sm-6 col-md-3 col-lg-3" href="./products/product.php?<?php echo 'id=' . $product['product_ID'] . '&' . 'slug=' . $product['slug'] ?>">
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
    <div class="d-flex justify-content-center align-items-center">
      <a href="<?php base_url('products/trousers.php'); ?>" class="view-more-btn">
      <p>View more <i class="bi bi-arrow-right-short"></i></p></a>
    </div>

    <?php else: ?>

    <div class="text-center">
      <p>We are unable to load products at the moment. Please try again later.</p>
    </div>
<?php endif; ?>  

    

   </section>
  <!-- Our latest products -->

  <!-- Fabric quality display section -->
   <section class="fabric-quality-section container-fluid">
    <div class="row gap-5 d-flex justify-content-center">
    <div class="fabric-quality-img-div col-sm-12 col-md-12 col-lg-6">
      <img src="./assets/images/fabric.jpg" alt="High quality fabric">
    </div>
    <div class="fabric-quality-content-div col-sm-12 col-md-12 col-lg-6">
      <h3>Why choose our Trousers?</h3>
      <div class="fabric-quality-content">

        <div class="d-flex align-items-center gap-5 mt-4">
          <div class="fabric-img">
          <img src="./assets/images/cotton.png" alt="">
          </div>
          <div>
            <h4>Premium cotton blend</h4>
            <p>Soft and breathable material for ultimate comfort.</p>
          </div>
        </div>

        <div class="d-flex align-items-center gap-5 mt-4">
          <div class="fabric-img">
          <img src="./assets/images/stitching.png" alt="">
          </div>
          <div>
            <h4>Precision stitching</h4>
            <p>Expertly crafted with attention to detail for durability and style.</p>
          </div>
        </div>

        <div class="d-flex align-items-center gap-5 mt-4">
          <div class="fabric-img">
          <img src="./assets/images/airy.png" alt="">
          </div>
          <div>
            <h4>Lightweight & airy</h4>
            <p>Ideal for hot weather, ensuring breathability without compromising on style.</p>
          </div>
        </div>

        <div class="d-flex align-items-center gap-5 mt-4">
          <div class="fabric-img">
          <img src="./assets/images/eco-friendly.png" alt="">
          </div>
          <div>
            <h4>Eco-Friendly Fabric</h4>
            <p>Sustainably sourced materials that are gentle on the planet.</p>
          </div>
        </div>

        <div class="d-flex align-items-center gap-5 mt-4">
          <div class="fabric-img">
          <img src="./assets/images/easy-maintenance.png" alt="">
          </div>
          <div>
            <h4>Easy maintenance</h4>
            <p>Machine washable, quick-drying, and low-shrinkage fabric.</p>
          </div>
        </div>

        <div class="mt-5">
        <a href="<?php base_url('products/trousers.php') ?>" class="shop-now-btn">Shop now</a>
        </div>

      </div>
    </div>
    </div>
   </section>
  <!-- Fabric quality display section -->

  <!-- Poly cotton trousers section -->
    <section class="poly-cotton-section container-fluid">
    <div class="heading-div d-flex justify-content-center align-items-center">
    <span class="separator"></span><h2 class="section-heading">Affordable comfort</h2><span class="separator"></span>
    </div>
    <p class="tag-line">A blend of style and budget-friendly options for everyday wear.</p>

    <div class="swiper polyswiper my-5">
    <div class="swiper-wrapper">

    <?php if(!empty($polyCottonTrousers)) : ?>
      <?php foreach($polyCottonTrousers as $product) : ?>
        <div class="swiper-slide">
      <div class="product-card col-sm-6 col-md-3 col-lg-3">
      <div class="product-img-div">
      <a class="product-link text-reset col-sm-6 col-md-3 col-lg-3" href="./products/product.php?<?php echo 'id=' . $product['product_ID'] . '&' . 'slug=' . $product['slug'] ?>">
        <img src=".<?php echo $product['product_img_1'] ?>" alt="">
      </a>
      </div>
      <div class="product-details-div">
      <a class="product-link text-reset col-sm-6 col-md-3 col-lg-3" href="./products/product.php echo 'id=' . $product['product_ID'] . '&' . 'slug=' . $product['slug'] ?>">
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
</div>
  <?php endforeach; ?>
      <div class="swiper-slide view-more-slide">
        <a href="<?php base_url('products/trousers.php?product-category=Polyester_cotton'); ?>" class="view-more-btn">
          <p>View more <i class="bi bi-arrow-right-short"></i></p></a>
      </div>

      </div>
      <?php else: ?>
      <div class="mx-auto">
      <p>We are unable to load products at the moment. Please try again later.</p>
      </div>
      <?php endif; ?>
      <div class="swiper-pagination"></div>
    </div>    
  </div>
</section>

  <!-- Poly cotton trousers section -->

  <!-- speciality section -->
   <section class="speciality-section container-fluid">
    <div class="row d-flex justify-content-center align-items-center">
    <div class="speciality col-sm-12 col-md-6 col-lg-3"> 
      <div class="speciality-img">
        <img src="./assets/images/fast-delivery.png" alt="">
      </div>
      <h5>Timely Delivery</h5>
    </div>
    <div class="speciality col-sm-12 col-md-6 col-lg-3"> 
      <div class="speciality-img">
        <img src="./assets/images/return.png" alt="">
      </div>
      <h5>Easy Returns</h5>
    </div>
    <div class="speciality col-sm-12 col-md-6 col-lg-3"> 
      <div class="speciality-img">
        <img src="./assets/images/customer-service.png" alt="">
      </div>
      <h5>24/7 Customer Support</h5>
    </div>
    <div class="speciality col-sm-12 col-md-6 col-lg-3"> 
      <div class="speciality-img">
        <img src="./assets/images/quality.png" alt="">
      </div>
      <h5>Premium Quality</h5>
    </div>
    </div>
   </section>
  <!-- speciality section -->

  <!-- News letter section -->
    <section class="letter-section container-fluid">
      <h4>Newsletter</h4>
      <p class="tag-line">Subscribe to our news letter for updates about the trousers.</p>
      <div class="letter-form-div">
        <form class="d-flex">
          <input type="email" placeholder="Enter your email address" name="news-email" required>
          <button type="submit" name="subscribe">Subscribe</button>
        </form>
      </div>
   </section>
  <!-- News letter section -->
    </main>

    <!-- Footer -->
     <?php include './includes/Footer.php'; ?>

     
    <!-- BOOTSTRAP SCRIPT CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- SWIPER JS SCRIPT CDN -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  
    <!-- VANILLA JS -->
    <script src="./scripts/script.js"></script>

    <!-- AJAX Handler -->
    <script src="./scripts/ajaxHandler.js"></script>


  </body>
</html>