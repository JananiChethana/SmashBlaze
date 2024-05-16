<?php
require 'vendor/autoload.php';

// Include the PayPal SDK classes
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Initialize PayPal API context
$apiContext = new ApiContext(
    new OAuthTokenCredential(
        'AfPIRowPq7zRhNo_OPG_gm7umsd-OydpAwZwECou-WTeHypDfMcsvzLh9BMreq2pS688Pan3pKJmxyCw', // Your PayPal client ID
        'EGuuiEkO6wkPujmGkbD03BPsIo-h0NI9PNC3NTItmWGET4NBuGpKcI7-Bj2bTVlkpMfj_u-w6LyTmePw'     // Your PayPal client secret
    )
);

$apiContext->setConfig([
    'mode' => 'sandbox', // Change to 'live' for production
]);

// Retrieve the payment ID and payer ID from the URL
$paymentId = $_GET['paymentId'];
$payerId = $_GET['PayerID'];

try {
    // Retrieve the PayPal payment
    $payment = Payment::get($paymentId, $apiContext);

    // Create a PaymentExecution object and set the payer ID
    $execution = new PaymentExecution();
    $execution->setPayerId($payerId);

    // Execute the payment
    $result = $payment->execute($execution, $apiContext);

    // Check if the payment was successful
    if ($result->getState() === 'approved') {
        // Retrieve form data
        $name = $_POST['name'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];
        $productId = $_POST['product_id'];
        $productName = $_POST['product_name'];
        $quantity = $_POST['quantity'];
        $deliveryOption = $_POST['delivery_option'];
        $productPrice = $_POST['product_price'];
        $deliveryFee = ($deliveryOption === 'standard') ? 100 : 200; // Adjust as needed

        $subtotalLKR = $productPrice * $quantity;
        $totalAmountLKR = $subtotalLKR + $deliveryFee;

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

        // Initialize Firebase and save the order data
        $firebase = (new Factory)
            ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
            ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/')
            ->createDatabase();

        // Store the order data in the Firebase Realtime Database
        $firebase->getReference('orders')->push($orderData);

        // Display success message and redirect the user
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
        </script>';
    }
} catch (Exception $ex) {
    // Handle PayPal API errors
    echo 'PayPal API Error: ' . $ex->getMessage();
    exit;
}
?>
