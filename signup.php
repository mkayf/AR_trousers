<?php
  include_once './config/App.php';
  include_once 'auth/auth.php';

  $login->isUserLoggedIn();
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AR Trousers - Shop Stylish Women's Stitched Trousers Online</title>
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
        <div class="auth-form-div">
            <img src="./assets/images/logo-2.png" alt="AR Trouser logo">
            <h3>Create your account</h3>
            <form method="POST">
                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="user_name" required>
                </div>
                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="user_email" required>
                </div>
                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="user_password">
                </div>
                <div class="mb-3">
                    <label for="c_password">Confirm password</label>
                    <input type="password" id="c_password" name="user_c_password">
                </div>
                <div class="message-div mb-3">
                <?php include 'includes/message.php'; ?>
                </div>
                <div class="mb-3 mt-2">
                    <input type="submit" id="signup-btn" name="signup-btn" value="Sign up">
                </div> 
            </form>
                <div class="mb-3">
                    <span>Already have account?
                    <a href="<?php base_url('login.php') ?>" class="login-link">Login</a>
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