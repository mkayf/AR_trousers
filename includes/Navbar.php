<nav class="navbar navbar-expand-md px-2 px-md-4 py-2">
  <div class="container-fluid">

    <!-- logo -->
    <div class="logo-div">
      <a class="navbar-brand pt-0" href="<?= ROOT_URL ?>index.php" tabindex="-1">
        <img class="logo" src="<?= ROOT_URL ?>assets/images/logo-1.png" alt="">
      </a>
    </div>
    <!-- logo -->

    <!-- nav-links -->
      <div class="nav-links-div">
        <ul>
          <li class="nav-link"><a href="<?= ROOT_URL ?>index.php">Home</a></li>
          <li class="nav-link"><a href="<?= ROOT_URL ?>products/trousers.php">Trousers</a></li>
          <li class="nav-link"><a href="<?= ROOT_URL ?>about.php">About</a></li>
          <li class="nav-link"><a href="<?= ROOT_URL ?>contact.php">Contact</a></li>
        </ul>
      </div>
    <!-- nav-links -->

    <!-- nav icons -->
    <div class="nav-icons d-flex align-items-center">
        <span class="mx-2">
        <div class="dropdown">
          <button class="dropdown-toggle auth-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false" tabindex="-1">
          <i class="  bi bi-person" style="font-size: 1.5rem;"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-end">
            <?php if(isset($_SESSION['authenticated'])) : ?>

              <?php if($_SESSION['user_data']['user_role'] == 'admin') :?>
                <li><a class="dropdown-item" href="<?= ROOT_URL ?>admin/products.php">Admin panel</a></li>

                <?php endif; ?>

              <li><a class="dropdown-item" href="<?= ROOT_URL ?>myaccount/orders.php">My account</a></li>
              <li>
              <form method="POST">
                  <button type="submit" class="dropdown-item" name="logout-btn">Logout</button>
              </form>
              </li>

            <?php else : ?>

              <li><a class="dropdown-item" href="<?= ROOT_URL ?>login.php#login">Login</a></li>
              <li><a class="dropdown-item" href="<?= ROOT_URL ?>signup.php#signup">Sign up</a></li>

            <?php endif; ?>
          </ul>
        </div>
        </span>
        
        <a href="<?= ROOT_URL ?>cart.php" class="">
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

        <button class="menu-btn ms-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#nav-sidebar" aria-controls="nav-sidebar"><img src="<?= ROOT_URL ?>assets/images/menu_icon.png" alt=""></button>

      </div>
      <!-- nav icons -->

  </div>
</nav>


<div class="offcanvas offcanvas-end nav-sidebar" tabindex="-1" id="nav-sidebar" aria-labelledby="offcanvasExampleLabel">
  <div class="offcanvas-header">
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body nav-sidebar-body">
      <nav>
        <ul>
         <li><a href="<?= ROOT_URL ?>index.php">Home</a></li>
          <li><a href="<?= ROOT_URL ?>products/trousers.php">Trousers</a></li>
          <li><a href="<?= ROOT_URL ?>about.php">About</a></li>
          <li><a href="<?= ROOT_URL ?>contact.php">Contact</a></li>
        </ul>
      </nav>
  </div>
</div>