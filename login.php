<?php
  
  include_once __DIR__ . '/config/App.php';
  include_once __DIR__ . '/auth/auth.php';
  include_once __DIR__ . '/controllers/CartController.php';
  
  if($login->validateUserCredentials()){
    if(isset($_GET['redirect']) && $_GET['redirect'] == 'checkout'){
      redirect('You are logged in.', '', 'checkout.php');
      exit();
    }
    
    redirect('You are logged in.', '', 'index.php');
  } else{
    $login->isUserLoggedIn();
  } 
   

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AR Trousers - Shop Stylish Women's Stitched Trousers Online</title>
    <link rel="apple-touch-icon" sizes="180x180" href="./assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon-16x16.png">
    <link rel="manifest" href="<?= ROOT_URL ?>site.webmanifest">
    <!-- BOOTSTRAP LINK CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <!-- CUSTOM CSS STYLESHEET -->
   <link rel="stylesheet" href="./css/style.css">
  </head>
  <body>
    
    <!-- NAVBAR -->
     <header>
         <?php include './includes/Navbar.php'; ?>
     </header>

     <main class="auth-main">

     <div class="container d-flex justify-content-center align-items-center">
        <div class="auth-form-div" id="login">
            <img src="./assets/images/logo-1.png" alt="AR Trouser logo">
            <h3>Login to your account</h3>
            <form method="POST">
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="user_email" required>
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="user_password">
                </div>
                <div class="remember-div">
                  <input type="checkbox" name="remember-me" id="checkbox">
                  <label for="checkbox" class="">Remember me</label>
                </div>
                <div class="message-div mb-3">
                <?php include 'includes/message.php'; ?>
                </div>
                <div class="mb-3 mt-2">
                    <input type="submit" id="login-btn" name="login-btn" value="Login">
                </div> 
            </form>
                <div class="mb-3">
                    <span>Don't have an account?
                    <a href="<?= ROOT_URL ?>signup.php" class="signup-link">Sign up</a>
                    </span>
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