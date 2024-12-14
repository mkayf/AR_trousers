<?php

include_once __DIR__ . '/config/App.php';
include_once __DIR__ . '/auth/auth.php';
include_once __DIR__ . '/controllers/ProductsController.php';

$productController = new ProductsController($DB->conn);

$productController->getProductsOnFirstLoad();

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
    <li><a class="dropdown-item" href="#">Pure cotton</a></li>
    <li><a class="dropdown-item" href="#">Polyster cotton</a></li>
    <li><a class="dropdown-item" href="#">Below Rs 1000</a></li>
    <li><a class="dropdown-item" href="#">Rs 1000 - Rs 2000</a></li>
    <li><a class="dropdown-item" href="#">Rs 2000 - Rs 3000</a></li>
  </ul>
</div>

    <select name="sort" id="sort" tabindex="-1">
      <option value="sort">sort</option>
      <option value="low-to-high">price, low to high</option> 
      <option value="high-to-low">price, high to low</option> 
      <option value="new-to-old">date, new to old</option> 
      <option value="old-to-new">date, old to new</option> 
    </select>

    </div>

    <div class="all-products-section container-fluid">
        <div class="row d-flex justify-content-center align-items-center">

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