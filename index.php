<?php
  include_once './config/App.php';
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

   <!-- SWIPER JS CDN LINK -->
   <link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
/>
  <body>
    
    <!-- NAVBAR -->
     <?php include './includes/Navbar.php'; ?>

    <main>
      <div class="slider">
        <!-- Slider -->
        <!-- Swiper -->
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
    <!-- <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div> -->
    <!-- <div class="swiper-pagination"></div> -->
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
    <div class="row d-flex justify-content-center align-items-center my-5">

      <div class="product-card col-sm-6 col-md-3 col-lg-3">
        <div class="product-img-div">
          <img src="<?php base_url('assets/product_images/trouser-1.jfif') ?>" alt="">
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
          <p class="product-title">Women's Trouser</p>
          <p class="product-price">Rs 999</p>
        </div>
      </div>


      <div class="product-card col-sm-6 col-md-3 col-lg-3">
        <div class="product-img-div">
          <img src="<?php base_url('assets/product_images/trouser-2.jfif') ?>" alt="">
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
          <p class="product-title">Women's Trouser</p>
          <p class="product-price">Rs 999</p>
        </div>
      </div>

      <div class="product-card col-sm-6 col-md-3 col-lg-3">
        <div class="product-img-div">
          <img src="<?php base_url('assets/product_images/trouser-3.jfif') ?>" alt="">
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
          <p class="product-title">Women's Trouser</p>
          <p class="product-price">Rs 999</p>
        </div>
      </div>

      <div class="product-card col-sm-6 col-md-3 col-lg-3">
        <div class="product-img-div">
          <img src="<?php base_url('assets/product_images/trouser-4.jfif') ?>" alt="">
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
          <p class="product-title">Women's Trouser</p>
          <p class="product-price">Rs 999</p>
        </div>
      </div>

      <div class="product-card col-sm-6 col-md-3 col-lg-3">
        <div class="product-img-div">
          <img src="<?php base_url('assets/product_images/trouser-5.jfif') ?>" alt="">
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
          <p class="product-title">Women's Trouser</p>
          <p class="product-price">Rs 999</p>
        </div>
      </div>

      <div class="product-card col-sm-6 col-md-3 col-lg-3">
        <div class="product-img-div">
          <img src="<?php base_url('assets/product_images/trouser-6.jfif') ?>" alt="">
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
          <p class="product-title">Women's Trouser</p>
          <p class="product-price">Rs 999</p>
        </div>
      </div>

      <div class="product-card col-sm-6 col-md-3 col-lg-3">
        <div class="product-img-div">
          <img src="<?php base_url('assets/product_images/trouser-7.jfif') ?>" alt="">
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
          <p class="product-title">Women's Trouser</p>
          <p class="product-price">Rs 999</p>
        </div>
      </div>

      <div class="product-card col-sm-6 col-md-3 col-lg-3">
        <div class="product-img-div">
          <img src="<?php base_url('assets/product_images/trouser-8.jfif') ?>" alt="">
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
          <p class="product-title">Women's Trouser</p>
          <p class="product-price">Rs 999</p>
        </div>
      </div>

    </div>

    <div class="d-flex justify-content-center align-items-center">
    <a href="<?php base_url('products.php'); ?>" class="view-more-btn">
    <p>View more</p> <i class="bi bi-arrow-right-short"></i></a>
    </div>
    
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
        <a href="<?php base_url('products.php') ?>" class="shop-now-btn">Shop now</a>
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
      <div class="swiper-slide">
        
        <div class="product-card col-sm-6 col-md-3 col-lg-3">
        <div class="product-img-div">
          <img src="<?php base_url('assets/product_images/trouser-1.jfif') ?>" alt="">
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
          <p class="product-title">Women's Trouser</p>
          <p class="product-price">Rs 999</p>
        </div>
      </div>

      </div>
      <div class="swiper-slide">

      <div class="product-card col-sm-6 col-md-3 col-lg-3">
        <div class="product-img-div">
          <img src="<?php base_url('assets/product_images/trouser-2.jfif') ?>" alt="">
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
          <p class="product-title">Women's Trouser</p>
          <p class="product-price">Rs 999</p>
        </div>
      </div>

      </div>
      <div class="swiper-slide">

      <div class="product-card col-sm-6 col-md-3 col-lg-3">
        <div class="product-img-div">
          <img src="<?php base_url('assets/product_images/trouser-3.jfif') ?>" alt="">
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
          <p class="product-title">Women's Trouser</p>
          <p class="product-price">Rs 999</p>
        </div>
      </div>

      </div>
      <div class="swiper-slide">

      <div class="product-card col-sm-6 col-md-3 col-lg-3">
        <div class="product-img-div">
          <img src="<?php base_url('assets/product_images/trouser-4.jfif') ?>" alt="">
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
          <p class="product-title">Women's Trouser</p>
          <p class="product-price">Rs 999</p>
        </div>
      </div>

      </div>
      <div class="swiper-slide">

      <div class="product-card col-sm-6 col-md-3 col-lg-3">
        <div class="product-img-div">
          <img src="<?php base_url('assets/product_images/trouser-5.jfif') ?>" alt="">
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
          <p class="product-title">Women's Trouser</p>
          <p class="product-price">Rs 999</p>
        </div>
      </div>

      </div>
      <div class="swiper-slide">

      <div class="product-card col-sm-6 col-md-3 col-lg-3">
        <div class="product-img-div">
          <img src="<?php base_url('assets/product_images/trouser-6.jfif') ?>" alt="">
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
          <p class="product-title">Women's Trouser</p>
          <p class="product-price">Rs 999</p>
        </div>
      </div>

      </div>
      <div class="swiper-slide">

      <div class="product-card col-sm-6 col-md-3 col-lg-3">
        <div class="product-img-div">
          <img src="<?php base_url('assets/product_images/trouser-7.jfif') ?>" alt="">
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
          <p class="product-title">Women's Trouser</p>
          <p class="product-price">Rs 999</p>
        </div>
      </div>

      </div>
      <div class="swiper-slide">

      <div class="product-card col-sm-6 col-md-3 col-lg-3">
        <div class="product-img-div">
          <img src="<?php base_url('assets/product_images/trouser-8.jfif') ?>" alt="">
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
          <p class="product-title">Women's Trouser</p>
          <p class="product-price">Rs 999</p>
        </div>
      </div>

      </div>

      <div class="swiper-slide view-more-slide">
        <a href="<?php base_url('products.php'); ?>" class="view-more-btn">
          <p>View more</p> <i class="bi bi-arrow-right-short"></i></a>
      </div>

    </div>
    <div class="swiper-pagination"></div>
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
      <div class="my-5">
        <form class="d-flex">
          <input type="email" placeholder="Enter your email address" name="news-email" required>
          <button type="submit" name="subscribe">Subscribe</button>
        </form>
      </div>
   </section>


  <!-- News letter section -->


    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- SWIPER JS SCRIPT CDN -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  
    <!-- VANILLA JS -->
    <script src="./scripts/script.js"></script>


  </body>
</html>