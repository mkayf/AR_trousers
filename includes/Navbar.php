  <nav class="navbar navbar-expand-md px-4 py-2">
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
          <a class="nav-link" aria-current="page" href="<?php base_url('trousers.php'); ?>">Trousers</a>
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

        <span class="mx-2">
        <div class="dropdown">
          <button class="dropdown-toggle auth-dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false" tabindex="-1">
          <i class="bi bi-person" style="font-size: 1.5rem;"></i>
          </button>
          <ul class="dropdown-menu dropdown-menu-md-end">
            <li><a class="dropdown-item" href="#">Login</a></li>
            <li><a class="dropdown-item" href="#">Signup</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </div>
        </span>

        <span class="mx-2"><i class="bi bi-bag" style="font-size: 1.2rem;"></i></span>
      </div>
    </div>
  </div>
</nav>