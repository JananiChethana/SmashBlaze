<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <!-- Include Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Include Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Poppins, sans-serif;
        }

        /* Custom styles for smooth transitions and animations */
        button:hover {
            transition: background-color 0.2s ease-in-out;
        }
    </style>
</head>

<body class="bg-gray-100 ">
    <style>
        body {
            font-family: 'Poppins', sans-serif;

        }
    </style>
    <?php include 'components/nav.php' ?>
    <!-- Main Content -->
    <div class="container mx-auto p-8">
        <?php
        // Include Firebase configuration and dependencies
        require 'vendor/autoload.php';
        use Kreait\Firebase\Factory;
        use Kreait\Firebase\ServiceAccount;

        // Set up Firebase with the service account JSON file and database URI
        $firebase = (new Factory)
            ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
            ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/')
            ->createDatabase();

        // Get the product ID from the query string
        $productId = $_GET['id'];

        // Retrieve data for the specific product using the product ID
        $product = $firebase->getReference('products/' . $productId)->getSnapshot()->getValue();

        // Check if the product exists
        if ($product) {
            // Begin the checkout page design
            echo '<div class="grid grid-cols-1 md:grid-cols-2 gap-8 bg-white p-8 rounded-lg shadow-lg mb-8">';

            // Product details section
            echo '<div class="product-details">';
            echo '<img class="w-full h-80 object-contain rounded-lg mb-4" src="' . htmlspecialchars($product['image_url']) . '" alt="Product Image">';
            echo '<h1 class="text-3xl font-bold mb-4">' . htmlspecialchars($product['product_name']) . '</h1>';
            echo '<p class="text-gray-700 mb-4">' . htmlspecialchars($product['description']) . '</p>';
            echo '<p class="text-xl font-semibold mb-4">Price: Rs. ' . number_format($product['price'], 2) . '</p>';
            echo '</div>';

            // Start the form for checkout and order placement
            echo '<form id="checkoutForm" method="POST" class="col-span-1 md:col-span-2 bg-gray-50 p-4 rounded-lg shadow-md">';
            // Hidden inputs for product details
            echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($productId) . '">';
            echo '<input type="hidden" name="product_name" value="' . htmlspecialchars($product['product_name']) . '">';
            echo '<input type="hidden" name="product_price" value="' . htmlspecialchars($product['price']) . '">';

            // Cart overview and quantity controls
            echo '<div class="cart-overview">';
            echo '<div class="flex items-center justify-between mb-4">';
            echo '<span class="text-gray-700">' . htmlspecialchars($product['product_name']) . '</span>';
            echo '<div class="flex items-center space-x-0">';
            echo '<button id="decreaseQty" type="button" class="bg-red-500 text-white px-2 py-0 rounded-l hover:bg-red-600 transition"><i class="fas fa-minus"></i></button>';
            echo '<input type="number" id="quantity" name="quantity" class="w-12 text-center border border-gray-300 rounded" value="1" min="1" required>';
            echo '<button id="increaseQty" type="button" class="bg-green-500 text-white px-2 py-0 rounded-r hover:bg-green-600 transition"><i class="fas fa-plus"></i></button>';
            echo '</div>';
            echo '</div>';

            // Delivery details form
            echo '<h2 class="text-2xl font-semibold mb-4">Delivery Details</h2>';
            echo '<div class="mb-4">';
            echo '<label for="name" class="block text-gray-700 mb-2">Name:</label>';
            echo '<input type="text" id="name" name="name" class="w-full border border-gray-300 p-2 rounded" required>';
            echo '</div>';
            echo '<div class="mb-4">';
            echo '<label for="address" class="block text-gray-700 mb-2">Address:</label>';
            echo '<textarea id="address" name="address" class="w-full border border-gray-300 p-2 rounded" rows="3" required></textarea>';
            echo '</div>';
            echo '<div class="mb-4">';
            echo '<label for="phone" class="block text-gray-700 mb-2">Phone Number:</label>';
            echo '<input type="text" id="phone" name="phone" class="w-full border border-gray-300 p-2 rounded" required>';
            echo '</div>';
            echo '<h3 class="text-lg font-semibold mb-2">Delivery Options</h3>';
            echo '<div class="mb-4">';
            echo '<input type="radio" id="standard-delivery" name="delivery_option" value="standard" class="mr-2" required>';
            echo '<label for="standard-delivery">Standard Delivery (3-5 days) - Rs. 100</label>';
            echo '</div>';
            echo '<div class="mb-4">';
            echo '<input type="radio" id="express-delivery" name="delivery_option" value="express" class="mr-2" required>';
            echo '<label for="express-delivery">Express Delivery (1-2 days) - Rs. 200</label>';
            echo '</div>';

            // Order summary and submit button
            echo '<div class="bg-gray-50 p-4 rounded-lg shadow-md col-span-2">';
            echo '<h2 class="text-2xl font-semibold mb-4">Order Summary</h2>';
            echo '<div class="flex justify-between mb-4">';
            echo '<span class="text-gray-700">Subtotal</span>';
            echo '<span id="subtotal" class="text-lg">Rs. ' . number_format($product['price'], 2) . '</span>';
            echo '</div>';
            echo '<div class="flex justify-between mb-4">';
            echo '<span class="text-gray-700">Delivery Fee</span>';
            echo '<span id="delivery-fee" class="text-lg">Rs. 0.00</span>';
            echo '</div>';
            echo '<div class="flex justify-between mb-4">';
            echo '<span class="text-lg font-semibold">Total</span>';
            echo '<span id="totalPrice" class="text-lg font-semibold">Rs. ' . number_format($product['price'], 2) . '</span>';
            echo '</div>';
            
            echo '<button id="placeOrderBtn" type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition w-full" ; ">Place Order</button>';
            echo '</div>';

            // Close the form
            echo '</form>';

            echo '</div>';
        } else {
            echo '<div class="bg-white p-6 rounded-lg shadow-lg mb-8">';
            echo '<h2 class="text-red-500 text-lg font-semibold">Product not found.</h2>';
            echo '</div>';
        }
        ?>
<!-- <div><button onclick="PaymentGaytway();">PayHere </button></div> -->
    </div>
    </div>
    </div>
    <script src = "payment.js"></script>
    <!-- Include jQuery and custom JavaScript for interactivity -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            var price = <?php echo $product['price']; ?>;
            var quantityInput = $('#quantity');
            var subtotalElement = $('#subtotal');
            var deliveryFeeElement = $('#delivery-fee');
            var totalPriceElement = $('#totalPrice');
            var deliveryFee = 0;

            // Function to calculate subtotal
            function calculateSubtotal() {
                var quantity = parseInt(quantityInput.val());
                var subtotal = quantity * price;
                subtotalElement.text('Rs. ' + subtotal.toFixed(2));
            }

            // Function to calculate total price
            function calculateTotal() {
                var quantity = parseInt(quantityInput.val());
                var subtotal = quantity * price;
                var total = subtotal + deliveryFee;
                totalPriceElement.text('Rs. ' + total.toFixed(2));
            }

            // Increase quantity
            $('#increaseQty').click(function() {
                var quantity = parseInt(quantityInput.val());
                quantity++;
                quantityInput.val(quantity);
                calculateSubtotal();
                calculateTotal();
            });

            // Decrease quantity
            $('#decreaseQty').click(function() {
                var quantity = parseInt(quantityInput.val());
                if (quantity > 1) {
                    quantity--;
                    quantityInput.val(quantity);
                    calculateSubtotal();
                    calculateTotal();
                }
            });

            // Handle delivery option change
            $('input[name="delivery_option"]').change(function() {
                var option = $(this).val();
                if (option === 'standard') {
                    deliveryFee = 100;
                } else if (option === 'express') {
                    deliveryFee = 200;
                }
                deliveryFeeElement.text('Rs. ' + deliveryFee.toFixed(2));
                calculateTotal();
            });

            // Initial calculations
            calculateSubtotal();
            calculateTotal();
        });

    </script>
<script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>

<?php include 'components/footer.php' ?>

<?php
// Initialize Firebase
$factory = (new Factory)
    ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
    ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/');

$database = $factory->createDatabase();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $qty = $_POST['quantity'];
    $phone = $_POST['phone'];
    $delivery_option = $_POST['delivery_option'];

    // Construct data to be stored
    $data = [
        'product_id' => $product_id,
        'product_name' => $product_name,
        'quantity' => $qty,
        'product_price' => $product_price,
        'name' => $name,
        'address' => $address,
        'phone' => $phone,
        'delivery_option' => $delivery_option,
    ];

    // Reference the database path where you want to store the data
    $reference = $database->getReference('orders')->push($data);

    // Check if data is successfully stored
    if ($reference->getKey()) {
        // Output success message or perform any other actions here
        echo '<script>PaymentGaytway();</script>';
    } else {
        echo 'Error storing data.';
    }
}
?>



</body>

</html>
