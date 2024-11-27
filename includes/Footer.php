<footer class="text-center text-lg-start text-muted">
    
  <section class="d-flex justify-content-center justify-content-md-between py-4 px-5 border-bottom">
    <div class="me-5 d-none d-md-block">
      <span class="">Get connected with us on social networks:</span>
    </div>

    <div>
    <a href="https://wa.me/923401128236" target="_blank" class="me-4 text-reset text-decoration-none">
        <i class="bi bi-whatsapp social-icon"></i>
      </a>
      <a href="https://www.facebook.com/ArTrouser786" target="_blank" class="me-4 text-reset text-decoration-none">
        <i class="bi bi-facebook social-icon"></i>
      </a>
      <a href="https://www.instagram.com/ar_trouser786" target="_blank" class="text-reset text-decoration-none">
        <i class="bi bi-instagram social-icon"></i>
      </a>
    </div>
  </section>

  <section class="">
    <div class="container text-center text-md-start mt-5">
      <div class="row mt-3 d-flex align-items-center">
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <a class="navbar-brand pt-0" href="<?php base_url('index.php'); ?>">
            <img class="logo" src="<?php base_url('assets/images/logo-2.png') ?>" alt="">
         </a>
          <p class="footer-about">
          At AR Trouser, we offer stylish, high-quality women's trousers that combine comfort and affordability. Shop with confidence!
          </p>
        </div>

        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            Quick links
          </h6>
          <p class="mb-2 footer-link">
            <a href="<?php base_url('index.php') ?>" class="text-reset text-decoration-none">Home</a>
          </p>
          <p class="mb-2 footer-link">
            <a href="<?php base_url('trousers.php') ?>" class="text-reset text-decoration-none">Trousers</a>
          </p>
          <p class="mb-2 footer-link">
            <a href="<?php base_url('about.php') ?>" class="text-reset text-decoration-none">About</a>
          </p>
        </div>

        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">
            Account
          </h6>
          <?php if(isset($_SESSION['authenticated'])) : ?>
            
            <?php if($_SESSION['user_data']['user_role'] == 'admin') : ?>
              <p class="mb-2 footer-link">
              <a href="<?php base_url('adminpanel.php') ?>" class="text-reset text-decoration-none">Admin panel</a>
              </p>  
            <?php endif; ?>  

            <p class="mb-2 footer-link">
            <a href="<?php base_url('myaccount.php') ?>" class="text-reset text-decoration-none">My account</a>
            </p>
            <form method="POST">
            <p class="mb-2 footer-link">
              <button type="submit" name="logout-btn" class="text-reset text-decoration-none bg-transparent" style="border: none;">Logout</button>
            </p>
            </form>

            <?php else : ?>
              <p class="mb-2 footer-link">
                <a href="<?php base_url('login.php') ?>" class="text-reset text-decoration-none">Login</a>
              </p>
              <p class="mb-2 footer-link">
                <a href="<?php base_url('signup.php') ?>" class="text-reset text-decoration-none">Signup</a>
              </p>
              <p class="mb-2 footer-link">
                <a href="<?php base_url('user_account.php') ?>" class="text-reset text-decoration-none">My account</a>
              </p>

            <?php endif; ?>
        </div>

        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">Customer service</h6>
          <p class="mb-2 footer-link">
            <a href="<?php base_url('exchange_policy.php') ?>" class="text-reset text-decoration-none">Exchange Policy</a>
          </p>
          <p class="mb-2 footer-link">
            <a href="<?php base_url('contact.php') ?>" class="text-reset text-decoration-none">Contact us</a>
          </p>
          <p class="mb-2 footer-link">
            <a href="#!" class="text-reset text-decoration-none">Size chart</a>
          </p>
        </div>
      </div>
    </div>
  </section>

  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2024
    <a class="text-reset fw-bold" href="<?php base_url('index.php') ?>">AR Trouser</a>
    All rights reserved.
  </div>
</footer>