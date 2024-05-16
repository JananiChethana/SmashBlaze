<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <!-- Include any CSS or styling here -->
</head>
<body>
    <div class="container">
        <h1>Payment Success!</h1>
        <p>Thank you for your purchase.</p>
        <!-- You can customize this message or display additional information here -->
    </div>
</body>
</html>

<?php
// Include Firebase configuration and dependencies
require 'vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Initialize Firebase
$firebase = (new Factory)
    ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
    ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/')
    ->createDatabase();

// Check if payment ID is present in the URL
if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['payment_id'])) {
    // Retrieve payment ID from the URL
    $paymentId = $_GET['payment_id'];

    // Retrieve order data from Firebase based on the payment ID
    $orderRef = $firebase->getReference('orders')->orderByChild('payment_id')->equalTo($paymentId);
    $orderSnapshot = $orderRef->getValue();

    // Check if order data exists for the given payment ID
    if (!empty($orderSnapshot)) {
        // Display order details or perform any additional actions as needed
        foreach ($orderSnapshot as $orderId => $orderData) {
            echo "<p>Order ID: $orderId</p>";
            echo "<p>Product Name: {$orderData['product_name']}</p>";
            echo "<p>Quantity: {$orderData['quantity']}</p>";
            echo "<p>Total Amount: {$orderData['total_amount_lkr']} LKR</p>";
            // You can display more order details here
        }
    } else {
        echo "<p>No order found for payment ID: $paymentId</p>";
    }
} else {
    echo "<p>No payment ID specified.</p>";
}
?>
