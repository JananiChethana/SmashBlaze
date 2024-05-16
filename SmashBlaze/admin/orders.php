<?php
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Include Composer's autoloader
require '../vendor/autoload.php';

// Initialize Firebase
$firebase = (new Factory)
    ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
    ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/');
$database = $firebase->createDatabase();

// Fetch data from Firebase Realtime Database
$dataSnapshot = $database->getReference('orders')->getSnapshot();
$data = $dataSnapshot->getValue();


// Check if POST request is made for deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['key'])) {
    // Get key to delete from POST data
    $keyToDelete = $_POST['key'];

    // Reference to the data node to be deleted
    $dataRef = $database->getReference('orders/' . $keyToDelete);

    try {
        // Delete the data
        $dataRef->remove();
        echo 'Row deleted successfully';
        exit; // Stop further execution
    } catch (\Exception $e) {
        // Handle any errors
        echo 'Error: ' . $e->getMessage();
        exit; // Stop further execution
    }
}

// HTML Table with dynamic data
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic Table</title>
    <!-- Include Tailwind CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.compat.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- Bootstrap JS and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

</head>
<body class="bg-gray-100">
    <?php include 'nav.php'; ?>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Orders</h1>
        <div class="overflow-x-auto">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-green-400 text-white">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"> <i class="fas fa-box ml-1"><br></i>Product</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"> <i class="fas fa-dollar-sign ml-1">  </i>Price</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"><i class="fas fa-shopping-basket ml-1">  </i>Quantity</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"><i class="fas fa-map-marker-alt ml-1"></i>Address</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"><i class="fas fa-truck ml-1">  </i>Delivery Option</th>
                <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider"><i class="fas fa-cogs ml-1">  </i>Action</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            <?php foreach($data as $key => $order): ?>
            <tr class="transition-colors hover:bg-gray-100">
                <td class="px-6 py-4 whitespace-nowrap"><?= $order['product_name'] ?></td>
                <td class="px-6 py-4 whitespace-nowrap"><?= $order['product_price'] ?></td>
                <td class="px-6 py-4 whitespace-nowrap"><?= $order['quantity'] ?></td>
                <td class="px-6 py-4 whitespace-nowrap"><?= $order['address'] ?></td>
                <td class="px-6 py-4 whitespace-nowrap"><?= $order['delivery_option'] ?></td>
                <td class="px-6 py-4 whitespace-nowrap flex justify-start">
                    <button class="text-red-500 hover:text-red-700 mr-2" onclick="deleteRow('<?= $key ?>')">
                        <i class="fas fa-trash"></i>
                    </button>
                 
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

    </div>

    <!-- Include Font Awesome JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

    <script>
        // Function to delete row
        function deleteRow(key) {
            // Confirm deletion
            if (confirm('Are you sure you want to delete this row?')) {
                // AJAX request to delete data
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.onload = function () {
                    if (xhr.status === 200) {
                        // Reload page after successful deletion
                        location.reload();
                    } else {
                        // Display error message
                        alert('Error deleting row: ' + xhr.responseText);
                    }
                };
                // Send data key to delete
                xhr.send('key=' + key);
            }
        }
    </script>
    <?php include 'footer.php'; ?>
</body>
</html>
