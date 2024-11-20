<nav class="navbar navbar-expand-lg px-4 py-2">
  <div class="container-fluid">
    <a class="navbar-brand pt-0" href="<?php base_url('index.php'); ?>">
      <img class="logo" src="<?php base_url('assets/images/logo-2.png') ?>" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-label="Toggle navigation">
        <img src="<?php base_url('assets/images/menu_icon.png') ?>" alt="">
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav m-auto mb-2">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php base_url('index.php'); ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php base_url('products.php'); ?>">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " aria-current="page" href="<?php base_url('about.php'); ?>">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="<?php base_url('contact.php'); ?>">Contact</a>
        </li>
      </ul>
      <div class="nav-icons d-flex align-items-center">
        <span class="mx-2"><i class="bi bi-search" style="font-size: 1.2rem;"></i></span>
        <span class="mx-2"><i class="bi bi-person" style="font-size: 1.5rem;"></i></span>
        <span class="mx-2"><i class="bi bi-bag" style="font-size: 1.2rem;"></i></span>
      </div>
    </div>
  </div>
</nav>