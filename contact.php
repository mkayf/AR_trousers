<?php

include_once __DIR__ . '/config/App.php';
include_once __DIR__ . '/auth/auth.php';


?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AR Trousers - Shop Stylish Women's Stitched Trousers Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <!-- CUSTOM CSS STYLESHEET -->
   <link rel="stylesheet" href="./css/style.css">
   
  <body>
    
    <!-- NAVBAR -->
     <header>
         <?php include './includes/Navbar.php'; ?>
     </header>

     <main class="contact-main">
     <div class="heading-div d-flex justify-content-center align-items-center mt-5">
    <span class="separator"></span><h2 class="section-heading">Get in touch</h2><span class="separator"></span>
    </div>

    <p class="tag-line">We're here to help you with any questions or concerns.</p>

    <div class="container contact-container">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-sm-12 col-md-6 col-lg-4 contact-info-div d-flex justify-content-center align-items-start flex-column">
                <img src="./assets/images/logo-2.png" alt="logo" class="contact-logo">
                <h4>Contact info</h4>
                <div>
                    <p>
                        <a href="tel:+923401128236" class="text-reset text-decoration-none"><i class="bi bi-telephone"></i> +92 340 1128236</a>
                    </p>
                    <p>
                        <a href="mailto:artrouser@gmail.com" class="text-reset text-decoration-none"><i class="bi bi-envelope"></i> artrouser@gmail.com</a>
                    </p>
                    <p>
                        <a href="https://wa.me/923401128236" class="text-reset text-decoration-none"><i class="bi bi-whatsapp"></i> WhatsApp</a>
                    </p>
                </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-7 contact-form-div">
                <form>
                    <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone">Phone number</label>
                        <input type="tel" id="phone" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <button type="submit" name="send-message">Send message <i class="bi bi-send"></i></button>
                    </div>
                </form>
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