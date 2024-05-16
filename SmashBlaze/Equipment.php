<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Tailwind CSS -->
    <link rel="stylesheet" href="https://cdn.tailwindcss.com/">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>SmashBlaze -  Equipments</title>
</head>

<body class="bg-gray-100">
<style>
        body{
            font-family: Poppins, sans-serif;
        }
    </style>
    <!-- Navigation -->
    <?php include './components/nav.php'; ?>

    <!-- Container for the product cards -->
    <div class="container mx-auto mt-10 px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
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

            // Retrieve data from the 'products' reference in the database
            $products = $firebase->getReference('products')->getSnapshot()->getValue();

            // Iterate through the products and display each one in a card layout
            foreach ($products as $productId => $product) {
                // Extract data from the product
                $productName = $product['product_name'] ?? '';
                $category = $product['category'] ?? '';
                $price = $product['price'] ?? 0;
                $description = $product['description'] ?? '';
                $imageUrl = $product['image_url'] ?? '';
                $featured = $product['featured'] ?? false;
                $published = $product['published'] ?? false;
                $rating = $product['rating'] ?? 0;

                // Create an advanced product card
                echo '<div class="bg-white rounded-lg shadow-lg hover:shadow-2xl transition-shadow duration-300 ease-in-out">';
                echo '<a href="#" class="block relative overflow-hidden rounded-t-lg">';

                // Display a discount badge if the product is featured
                if ($featured) {
                    echo '<span class="absolute top-4 left-4 bg-red-500 text-white text-sm font-semibold px-2 py-1 rounded">Used</span>';
                }

                // Display product image
                echo '<img src="' . htmlspecialchars($imageUrl) . '" alt="Product Image" class="w-full h-48 object-contain rounded-t-lg transition-transform duration-300 hover:scale-105">';


                echo '</a>';

                // Display product details
                echo '<div class="p-6">';
                echo '<a href="#">';
                echo '<h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white hover:text-blue-700">' . htmlspecialchars($productName) . '</h5>';
                echo '</a>';
                
                // Display category
                echo '<p class="text-sm text-gray-500 mt-1">' . htmlspecialchars($category) . '</p>';

                // Display rating with stars
                echo '<div class="flex items-center mt-2 mb-4">';
                for ($i = 0; $i < 5; $i++) {
                    echo '<span class="text-' . ($i < $rating ? 'yellow-400' : 'gray-300') . '"><i class="fa fa-star"></i></span>';
                }
                echo '</div>';

                // Display price and "Add to cart" button
                echo '<div class="flex justify-between items-center">';
                echo '<span class="text-2xl font-bold text-gray-900">Rs. ' . number_format($price, 2) . '</span>';
                echo '<a href="product_view.php?id=' . htmlspecialchars($productId) . '" target="_blank" class="flex items-center bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 transition-colors duration-300">';
                echo '<i class="fas fa-cart-plus mr-2"></i>View Product';
                echo '</a>';
                
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <!-- Include necessary scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <br><br>
    <?php include'components/footer.php'
?></body>

</html>
