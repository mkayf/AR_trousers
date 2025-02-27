<nav class="navbar navbar-expand-md px-2 px-md-4 py-2">
  <div class="container-fluid">
    <a class="navbar-brand pt-0" href="<?php base_url('index.php');?>" tabindex="-1">
      <img class="logo" src="<?php base_url('assets/images/logo-1.png') ?>" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
        <img src="<?php base_url('assets/images/menu_icon.png') ?>" alt="">
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav m-auto pe-5 mb-2">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php base_url('index.php'); ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php base_url('products/trousers.php'); ?>">Trousers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="<?php base_url('about.php'); ?>">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php base_url('contact.php'); ?>">Contact</a>
        </li>
      </ul>
      <div class="nav-icons d-flex align-items-center">
        <span class="mx-2">
        <div class="dropdown">
          <button class="dropdown-toggle auth-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false" tabindex="-1">
          <i class="  bi bi-person" style="font-size: 1.5rem;"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-md-end">
            <?php if(isset($_SESSION['authenticated'])) : ?>

              <?php if($_SESSION['user_data']['user_role'] == 'admin') :?>
                <li><a class="dropdown-item" href="<?php echo base_url('admin/products.php') ?>">Admin panel</a></li>

                <?php endif; ?>

              <li><a class="dropdown-item" href="<?php base_url('myaccount/accountdetails.php') ?>">My account</a></li>
              <li>
              <form method="POST">
                  <button type="submit" class="dropdown-item" name="logout-btn">Logout</button>
              </form>
              </li>

            <?php else : ?>

              <li><a class="dropdown-item" href="<?php base_url('login.php#login') ?>">Login</a></li>
              <li><a class="dropdown-item" href="<?php base_url('signup.php#signup') ?>">Sign up</a></li>

            <?php endif; ?>
          </ul>
        </div>
        </span>
        
        <a href="<?php base_url('cart.php') ?>">
        <div class="cart-icon">
          <span class="count-badge">
            <?php 
              if(isset($cartCount) && $cartCount > 0){
               echo $cartCount <= 99 ? $cartCount : '99+'; 
              } else{
                echo 0;
              }
            ?>
          </span>
          <span class="mx-2"><i class="bi bi-bag" style="font-size: 1.2rem;"></i></span>
        </div>
        </a>

      </div>
    </div>
  </div>
</nav>