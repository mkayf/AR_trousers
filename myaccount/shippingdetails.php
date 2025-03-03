<?php

include_once __DIR__ . '/../config/App.php';
include_once __DIR__ . '/../auth/auth.php';
include_once __DIR__ . '/../controllers/CartController.php';
include_once __DIR__ . '/../controllers/MyAccountController.php';


if(!isset($_SESSION['authenticated']) && $_SESSION['authenticated'] != true){
    redirect('', '', 'login.php');
}

$myaccount_controller = new MyAccountController($DB->conn);

$shipping_details = $myaccount_controller->getShippingDetails($_SESSION['user_data']['user_ID']) ?? null;

$states = ['Azad Kashmir', 'Balochistan', '
Islamabad Capital Territory', 'Khyber Pakhtunkhwa', 'Punjab', 'Sindh'];

if(isset($_POST['save-details'])){
  
  $myaccount_controller->saveShippingDetails($_SESSION['user_data']['user_ID'], $_POST);

  header('location: shippingdetails.php');
  exit();
}


$details_saved = $_SESSION['details_saved'] ?? null;
$errors = $_SESSION['errors'] ?? null;

unset($_SESSION['details_saved']);
unset($_SESSION['errors']);


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AR Trousers - Shop Stylish Women's Stitched Trousers Online</title>
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon-16x16.png">
    <link rel="manifest" href="./config/site.webmanifest">
    <!-- BOOTSTRAP LINK CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<!-- CUSTOM CSS STYLESHEET -->
<link rel="stylesheet" href="../css/style.css">

<body>
    <!-- NAVBAR -->
    <header>
        <?php include '../includes/Navbar.php'; ?>
        <?php if(isset($details_saved)) :  ?>
          <div class="header-msg d-flex align-items-center justify-content-between">
          <p style="font-size: 1rem;"><?= $details_saved ?></p>
          <span class="msg-close-btn"><i class="bi bi-x-lg"></i></span>
          </div>  
        <?php endif; ?>
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
              <form method="POST">
                <div class="row">
                <div class="mb-3 input-div col-12 col-md-6 col-lg-6">
                    <label for="first-name">First name <span class="star">*</span></label>
                    <input type="text" name="first-name" id="first-name" value="<?= $shipping_details['first_name'] ?? '' ?>">
                    <small style="color: red;"><?= $errors['first-name'] ?? '' ?></small>
                </div>
                <div class="mb-3 input-div col-12 col-md-6 col-lg-6">
                    <label for="last-name">Last name <span class="star">*</span></label>
                    <input type="text" name="last-name" id="last-name" value="<?= $shipping_details['last_name'] ?? '' ?>">
                    <small style="color: red;"><?= $errors['last-name'] ?? '' ?></small>
                </div>
                <div class="mb-3 input-div col-12 col-md-6 col-lg-6">
                    <label for="phone-number">Phone number <span class="star">*</span></label>
                    <input type="number" name="phone-number" id="phone-number" value="<?= $shipping_details['phone_number'] ?? '' ?>">
                    <small style="color: red;"><?= $errors['phone-number'] ?? '' ?></small>
                </div>
                <div class="mb-3 input-div col-12 col-md-6 col-lg-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?= $shipping_details['email'] ?? '' ?>">
                    <small style="color: red;"><?= $errors['email'] ?? '' ?></small>
                </div>
                <div class="mb-3 input-div col-12">
                    <label for="street-address">Street address / House number <span class="star">*</span></label>
                    <input type="text" name="address" id="address" value="<?= $shipping_details['street_address'] ?? '' ?>">
                    <small style="color: red;"><?= $errors['address'] ?? '' ?></small>
                </div>
                <div class="mb-3 input-div col-12">
                    <label for="landmark">Landmark / مشہور جگہ</label>
                    <input type="text" name="landmark" id="landmark" value="<?= $shipping_details['landmark'] ?? '' ?>">
                </div>
                <div class="mb-3 input-div col-12 col-md-6 col-lg-6">
                    <label for="state">State / Province <span class="star">*</span></label>
                    <select name="state" id="state">
                        <option value="null">Select your state</option>
                        <?php foreach($states as $state) : ?>
                        <option value="<?= $state ?>" <?= $state == $shipping_details['state'] ? 'selected' : '' ?>><?= $state ?></option>
                        <?php endforeach; ?>
                    </select>
                    <small style="color: red;"><?= $errors['state'] ?? '' ?></small>
                </div>
                <div class="mb-3 input-div col-12 col-md-6 col-lg-6">
                    <label for="landmark">City <span class="star">*</span></label>
                    <input type="text" name="city" id="city" value="<?= $shipping_details['city'] ?>">
                    <small style="color: red;"><?= $errors['city'] ?? '' ?></small>
                </div>
                <div class="mt-4 input-div col-12">
                    <input type="submit" name="save-details" id="save-btn" value="Save">
                </div>
              </div>
           </form>
        </div>

            <div class="shipping-faqs-container my-0 my-md-4 col-12 col-md-12 col-lg-5">
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
      <p>Can I change my shipping address after placing an order?</p>
      </button>
    </h2>
    <div id="panelsStayOpen-collapseFive" class="accordion-collapse collapse">
      <div class="accordion-body px-4">
      Yes, but only within 12 hours after placing the order and <a class="text-muted" href="../contact.php">Contact us</a> as soon as possible.
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseSix" aria-expanded="true" aria-controls="panelsStayOpen-collapseSix">
      <p>What happens if I’m not available at the time of delivery?</p>
      </button>
    </h2>
    <div id="panelsStayOpen-collapseSix" class="accordion-collapse collapse">
      <div class="accordion-body px-4">
      Our delivery partner will attempt 2 times before returning the parcel.
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