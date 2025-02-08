<?php
include_once __DIR__ . '/config/App.php';
include_once __DIR__ . '/auth/auth.php';
include_once __DIR__ . '/controllers/CartController.php';
include_once __DIR__ . '/controllers/CheckoutController.php';


if(isset($_POST['place-order'])){

    // Check cart items here also:

    $cart_items = $cartController->getCartItems() ?? [];

    if(empty($cart_items)){
        header('location: cart.php');
        exit(0);
    }

    // Validate each field:

    $errors = [];
    $fields = ['first-name', 'last-name', 'phone-number', 'address', 'city'];

    // Check for empty fields

    foreach($fields as $field){
        if(empty($_POST[$field])){
            $errors[$field] = ucfirst(str_replace('-', ' ', $field)) . " is required";
        }
    }

    // Validate phone number:

    $pattern = '/^(0[3][0-9]{9}|[3][0-9]{9})$/';

    if(!empty($_POST['phone-number'])){
        if(!preg_match($pattern, $_POST['phone-number'])){
            $errors['phone-number'] = 'Please enter a valid phone number';
        }
    }

    // Validate email if given

    if(!empty($_POST['email'])){
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $errors['email'] = "Please enter valid email";
        }
    }

    // Validate state:

    $state_arr = ['Azad Kashmir', 'Balochistan', 'Islamabad Capital Territory', 'Khyber Pakhtunkhwa', 'Punjab', 'Sindh'];

    if($_POST['state'] == 'null' || !in_array($_POST['state'], $state_arr)){
        $errors['state'] = 'Please select a valid state';
    }

    // Validate payment method:

    if(!isset($_POST['payment-method'])){
        $errors['payment-method'] = "Please select a payment method";
    }


    if(empty($errors)){

        if($checkout_controller->placeOrder($_POST)){
            $_SESSION['order_placed'] = true;
        } else{
            $_SESSION['order_placement_error'] = "We couldn't process your order at the moment. Please try again shortly or contact us if the issue persists.";
            $_SESSION['old_data'] = $_POST;    
        }
        
    } else{
        $_SESSION['errors'] = $errors;
        $_SESSION['old_data'] = $_POST;
    }

    header('location: checkout.php');
    exit(0);
}

?>