<?php

include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../auth/auth.php';
include_once __DIR__ . '/../controllers/CartController.php';

if(!isset($_SESSION['authenticated']) && !$_SESSION['authenticated'] == true){
    redirect('', '', 'login.php');
}

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
<link rel="stylesheet" href="../css/style.css">

<body>
    <!-- NAVBAR -->
    <header>
        <?php include '../includes/Navbar.php'; ?>
    </header>

    <!-- Sidebar -->
    <div class="pt-4 px-4 px-md-5">
        <button type="button" class="sidebar-toggler" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample" tabindex="-1">
        <i class="bi bi-list"></i>
        </button>
    
        <?php include '../includes/Sidebar.php' ?>
    </div>
    <!-- Sidebar -->

    <main class="myaccount-main content">

        <div class="container-fluid mt-4 mb-5 px-4 px-md-5">
        <h2 class="myaccount-heading">Shipping details</h2>
        <div class="row justify-content-center">
            
        </div>
    </div>

    </main>

    <!-- Footer -->
    <?php include '../includes/Footer.php'; ?>

    <!-- BOOTSTRAP SCRIPT CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- VANILLA JS -->
    <script src="../scripts/script.js"></script>
</body>
</html>