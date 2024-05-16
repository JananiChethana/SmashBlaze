<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- Include Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="../css/boostrap.min.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-gray-100">
    <?php include'nav.php' ?>
    <style>
        body{
            font-family: Poppins, sans-serif;
        }
    </style>
    <div class="container mx-auto py-10">
        <div class="max-w-4xl mx-auto bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-6"><i class="fas fa-plus-square text-green-500"></i> Add New
                Product</h2>
                <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="product_name"
                            class="block text-gray-700 font-semibold mb-2"><i class="fas fa-tag text-green-500"></i>
                            Product Name</label>
                        <input type="text" id="product_name" name="product_name"
                            placeholder="Enter product name"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-400">
                    </div>
                    <div>
                        <label for="category"
                            class="block text-gray-700 font-semibold mb-2"><i class="fas fa-clipboard-list text-green-500"></i>
                            Category</label>
                        <select id="category" name="category"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-400">
                            <option value="">Select category</option>
                            <option value="electronics">BrandNew</option>
                            <option value="clothing">Used</option>  
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="price"
                            class="block text-gray-700 font-semibold mb-2"><i class="fas fa-lira-sign text-green-500"></i>
                            Price</label>
                        <input type="number" id="price" name="price" placeholder="Enter price"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-400">
                    </div>
                    <div>
                        <label for="quantity"
                            class="block text-gray-700 font-semibold mb-2"><i class="fas fa-sort-numeric-up text-green-500"></i>
                            Quantity</label>
                        <input type="number" id="quantity" name="quantity" placeholder="Enter quantity"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-400">
                    </div>
                </div>
                <div class="mb-4">
                    <label for="description"
                        class="block text-gray-700 font-semibold mb-2"><i class="fas fa-align-left text-green-500"></i>
                        Description</label>
                    <textarea id="description" name="description" placeholder="Enter description"
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-400 resize-none"
                        rows="4"></textarea>
                </div>
                <div class="mb-6 flex items-center">
    <label for="image" class="block text-gray-700 font-semibold mr-4"><i class="fas fa-image text-green-500"></i> Image Upload</label>
    <div class="relative flex items-center">
        <input type="file" id="image" name="image" class="hidden" onchange="updateImageName(this)">
        <label for="image" class="cursor-pointer bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
            Choose Image
        </label>
        <span id="selected-image" class="ml-2 text-gray-600"></span>
    </div>
</div>
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" id="featured" name="featured"
                            class="h-4 w-4 text-green-600 focus:ring-blue-400 border-gray-300 rounded">
                        <label for="featured"
                            class="ml-2 text-gray-700 font-semibold"><i class="fas fa-star text-green-500"></i>Brand New</label>
                    </div>
                    <div class="flex items-center">
                        <input type="checkbox" id="published" name="published"
                            class="h-4 w-4 text-green-600 focus:ring-blue-400 border-gray-300 rounded">
                        <label for="published"
                            class="ml-2 text-gray-700 font-semibold"><i class="fas fa-check-circle text-green-500"></i>
                            Used</label>
                    </div>
                </div>
                <div class="flex justify-between">
                    <button type="submit"
                        class="w-2/3 bg-green-500 hover:bg-green-600 text-white font-semibold py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-75">
                        <i class="fas fa-plus"></i> Add Product
                    </button>
                    <button type="button"
                        class="w-1/3 bg-red-500 hover:bg-red-600 text-white font-semibold py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-400 focus:ring-opacity-75 ml-4">
                        <i class="fas fa-times"></i> Clear
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
    function updateImageName(input) {
        var fileName = input.files[0].name;
        document.getElementById('selected-image').innerText = fileName;
    }
</script>

<?php include 'footer.php' ?>

<?php
require '../vendor/autoload.php'; // Include Firebase Admin SDK

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Initialize Firebase
$firebase = (new Factory)
    ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
    ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/');
$database = $firebase->createDatabase();
$storage = $firebase->createStorage();

// Error handling function
function handle_error($error_message) {
    echo '<p>Error: ' . $error_message . '</p>';
    exit();
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Retrieve form data
        $product_name = $_POST['product_name'];
        $category = $_POST['category'];
        $price = $_POST['price'];
        $quantity = $_POST['quantity'];
        $description = $_POST['description'];
        $featured = isset($_POST['featured']) ? true : false;
        $published = isset($_POST['published']) ? true : false;

        // Validate image upload
        if ($_FILES['image']['error'] !== UPLOAD_ERR_OK) {
            handle_error('Image upload failed.');
        }

        // Upload image to Firebase Storage
        $image_name = $_FILES['image']['name'];
        $temp_image_path = $_FILES['image']['tmp_name'];
       $image_ref = $storage->getBucket()->upload(
    file_get_contents($temp_image_path),
    [
        'name' => 'Product_images/' . $image_name // Include folder name in the file path
    ]
);
        // Get download URL of the uploaded image
        $image_url = $image_ref->signedUrl(new \DateTime('+5 years'));

        // Store data in Firebase Realtime Database
        $newPost = $database->getReference('products')->push([
            'product_name' => $product_name,
            'category' => $category,
            'price' => $price,
            'quantity' => $quantity,
            'description' => $description,
            'image_url' => $image_url,
            'featured' => $featured,
            'published' => $published
        ]);

        echo ' <script>
        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Your Product  Added Success!",
          showConfirmButton: false,
          timer: 1500
        });
        </script>' ;

    } catch (Exception $e) {
        handle_error($e->getMessage());
    }
}
?>



</body>
</html>