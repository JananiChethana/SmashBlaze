<?php
require 'vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Error\Api as StripeApiError;

// Include Firebase configuration and dependencies
$firebase = (new Factory)
    ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
    ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/')
    ->createDatabase();

// Set up Stripe API key
Stripe::setApiKey('sk_test_51P3tHSSJWLcN9q80agZTcarKzClIwA5XRa03MP6eggjL2PubRakAE5JCP9aOY5q4nCR9VwNs0ASnO772CiI7NUJf00PB6Ceddn');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $quantity = $_POST['quantity'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];
    $deliveryOption = $_POST['delivery_option'];
    
    // Calculate the delivery fee based on the selected delivery option
    $deliveryFee = ($deliveryOption === 'standard') ? 100 : 200;
    
    // Calculate the total amount in LKR
    $subtotalLKR = $productPrice * $quantity;
    $totalAmountLKR = $subtotalLKR + $deliveryFee;
    
    // Convert LKR to cents (Stripe uses smallest currency units)
    $totalAmountCents = round($totalAmountLKR * 100);
    
    // Create a Stripe Checkout Session
    try {
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'INR',
                        'product_data' => [
                            'name' => $productName,
                        ],
                        'unit_amount' => $totalAmountCents,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => 'http://localhost/SmashBlaze/success.php?session_id=' . '{CHECKOUT_SESSION_ID}',
            'cancel_url' => 'http://localhost/SmashBlaze/cancel.php',
        ]);

        // Redirect the user to the Stripe checkout page
        header('Location: ' . $session->url);
        exit;
    } catch (StripeApiError $e) {
        // Handle Stripe API errors
        echo 'Stripe API Error: ' . $e->getMessage();
        exit;
    }
}

// Handle payment success
if (isset($_GET['session_id'])) {
    $sessionId = $_GET['session_id'];

    try {
        // Retrieve the session details from Stripe
        $session = Session::retrieve($sessionId);

        // Check if payment was successful
        if ($session->payment_status === 'paid') {
            // Retrieve the order data
            $name = $_POST['name'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];
            $productId = $_POST['product_id'];
            $productName = $_POST['product_name'];
            $quantity = $_POST['quantity'];
            $deliveryOption = $_POST['delivery_option'];
            $deliveryFee = ($deliveryOption === 'standard') ? 100 : 200;
            $totalAmountLKR = $_POST['product_price'] * $quantity + $deliveryFee;

            // Create an order data array
            $orderData = [
                'name' => $name,
                'address' => $address,
                'phone' => $phone,
                'product_id' => $productId,
                'product_name' => $productName,
                'quantity' => $quantity,
                'delivery_option' => $deliveryOption,
                'delivery_fee' => $deliveryFee,
                'total_amount_lkr' => $totalAmountLKR,
            ];

            // Store the order data in Firebase Realtime Database
            $firebase->getReference('orders')->push($orderData);

            // Redirect the user to a thank-you page
            echo '<script>
            Swal.fire({
                title: "Payment Success!",
                text: "Thank you for your purchase!",
                icon: "success",
                confirmButtonText: "OK"
            }).then(() => {
                window.location.href = "product_view.php";
            });
        </script>';

            exit;
        } else {
            // Handle payment failure
       echo '<script>
                Swal.fire({
                    title: "Payment Failed",
                    text: "Please try again.",
                    icon: "error",
                    confirmButtonText: "OK"
                }).then(() => {
                    window.location.href = "product_view.php";
                });
            </script>';;
            exit;
        }
    } catch (StripeApiError $e) {
        // Handle Stripe API errors
        echo 'Stripe API Error: ' . $e->getMessage();
        exit;
    }
}
?>