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
        <div class="row d-flex justify-content-center align-items-start gap-5">
            <div class="user-shipping-container row my-4 col-12 col-md-12 col-lg-6">
                <div class="mb-3 input-div col-12 col-md-6 col-lg-6">
                    <label for="first-name">First name <span class="star">*</span></label>
                    <input type="text" name="first-name" id="first-name">
                </div>
                <div class="mb-3 input-div col-12 col-md-6 col-lg-6">
                    <label for="last-name">Last name <span class="star">*</span></label>
                    <input type="text" name="last-name" id="last-name">
                </div>
                <div class="mb-3 input-div col-12 col-md-6 col-lg-6">
                    <label for="phone-number">Phone number <span class="star">*</span></label>
                    <input type="number" name="phone-number" id="phone-number">
                </div>
                <div class="mb-3 input-div col-12 col-md-6 col-lg-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                </div>
                <div class="mb-3 input-div col-12">
                    <label for="street-address">Street address / House number <span class="star">*</span></label>
                    <input type="text" name="address" id="address">
                </div>
                <div class="mb-3 input-div col-12">
                    <label for="landmark">Landmark / مشہور جگہ</label>
                    <input type="text" name="landmark" id="landmark">
                </div>
                <div class="mb-3 input-div col-12 col-md-6 col-lg-6">
                    <label for="state">State / Province <span class="star">*</span></label>
                    <select name="state" id="state">
                        <option value="null">Select your state</option>
                        <option value="Azad Kashmir">Azad Kashmir</option>
                        <option value="Balochistan">Balochistan</option>
                        <option value="Islamabad Capital Territory">Islamabad Capital Territory</option>
                        <option value="Khyber Pakhtunkhwa">Khyber Pakhtunkhwa</option>
                        <option value="Punjab">Punjab</option>
                        <option value="Sindh">Sindh</option>
                    </select>
                </div>
                <div class="mb-3 input-div col-12 col-md-6 col-lg-6">
                    <label for="landmark">City <span class="star">*</span></label>
                    <input type="text" name="city" id="city">
                </div>
                <div class="mt-4 input-div col-12">
                    <input type="submit" name="save-details" id="save-btn" value="Save">
                </div>
            </div>

            <div class="shipping-faqs-container my-4 col-12 col-md-12 col-lg-5">
                <h4>Shipping & Delivery FAQs</h4>
            <div class="accordion" id="accordionPanelsStayOpenExample">
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
      <p>How long does delivery take?</p>
      </button>
    </h2>
    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
      <div class="accordion-body px-4">
        Our standard delivery time is 3 to 5 days, depending on your location.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
      <p>What are the shipping charges?</p>
      </button>
    </h2>
    <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
      <div class="accordion-body px-4">
        Shipping charges are Rs 200 for Karachi and Rs 300 for other cities all across Pakistan.
      </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false" aria-controls="panelsStayOpen-collapseThree">
        <p>What should I do if I receive a damaged or wrong item?</p>
      </button>
    </h2>
    <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse">
      <div class="accordion-body px-4">
        <a class="text-muted" href="../contact.php">Contact us</a> within 3 hours with order details and photos, and we'll assist you.
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFour" aria-expanded="true" aria-controls="panelsStayOpen-collapseFour">
      <p>Do you ship internationally?</p>
      </button>
    </h2>
    <div id="panelsStayOpen-collapseFour" class="accordion-collapse collapse">
      <div class="accordion-body px-4">
        Currently, we only deliver within Pakistan.
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseFive" aria-expanded="true" aria-controls="panelsStayOpen-collapseFive">
      <p>Can I change my shipping address after placing an order??</p>
      </button>
    </h2>
    <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">
      <div class="accordion-body px-4">
      Yes, but only within 12 hours after placing the order and <a class="text-muted" href="../contact.php">Contact us</a> as soon as possible.
      </div>
    </div>
  </div>
</div>


</div>

            </div>
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