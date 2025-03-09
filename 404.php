<?php
include_once __DIR__ . '/config/App.php';
include_once __DIR__ . '/auth/auth.php';
include_once __DIR__ . '/controllers/CartController.php';

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 Page not found</title>
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon-16x16.png">
    <link rel="manifest" href="site.webmanifest">
    <!-- BOOTSTRAP LINK CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <!-- CUSTOM CSS STYLESHEET -->
   <link rel="stylesheet" href="./css/style.css">
    <style>
        body{
            height: 100vh;
        }
        h1{
            font-size: 6rem;
            color: var(--primary-color);
            font-family: 'proxima-bold';
        }
        h2{
            font-family: 'proxima-semibold';
            font-size: 3rem;
        }
        .container{
            margin: 80px auto;
        }
        .container .anchor{
            text-decoration: none;
            color: var(--background-color);
            background-color: var(--primary-color);
            font-family: 'proxima-regular';
            padding: 12px 16px;
        }

    </style>
</head>
<body>

    <!-- NAVBAR -->
    <header>
         <?php include './includes/Navbar.php'; ?>
     </header>

    <div class="container d-flex justify-content-center align-items-center flex-column">
        <h1>404</h1>
        <h2>Page not found</h2>
        <a href="index.php" class="anchor">Go to home page</a>
    </div>

     <!-- Footer -->
  <?php include './includes/Footer.php'; ?>


    <!-- BOOTSTRAP SCRIPT CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>