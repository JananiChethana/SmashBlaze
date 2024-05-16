<?php
// Include necessary libraries
require '../vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;
use Kreait\Firebase\Storage;
use Kreait\Firebase\Exception\FirebaseException;

// Initialize Firebase
$firebase = (new Factory)
    ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
    ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/');
   

// Initialize Firebase Database and Storage
$database = $firebase->createDatabase();
$storage = $firebase->createStorage();
$bucket = $storage->getBucket();

// Handle DELETE request
if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        // Delete the product from the Firebase database
        $database->getReference("products/{$id}")->remove();

        // Respond with a JSON object indicating success
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    } catch (FirebaseException $e) {
        // Handle errors gracefully
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'error' => 'An error occurred while deleting the product: ' . $e->getMessage()]);
    }
    exit;
}

// Handle POST request for updating product
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $id = $_POST['id'];
    $productName = $_POST['product_name'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $imageFile = $_FILES['image_file'];

    // Define the product reference
    $productRef = $database->getReference("products/{$id}");

    // Update image if provided
    if ($imageFile && $imageFile['error'] === UPLOAD_ERR_OK) {
        // Define the storage bucket and path
        $fileName = $imageFile['name'];
        $filePath = "product_images/{$id}/{$fileName}";

        // Upload the file to Firebase Storage
        $uploadedFile = $bucket->upload(file_get_contents($imageFile['tmp_name']), [
            'name' => $filePath
        ]);

        // Get the public URL of the uploaded file
        $imageURL = $uploadedFile->signedUrl(new DateTime('+1 year'));

        // Update the product's image URL in the database
        $productRef->update(['image_url' => $imageURL]);
    }

    // Update product details in the database
    $productRef->update([
        'product_name' => $productName,
        'category' => $category,
        'description' => $description,
        'price' => $price,
        'quantity' => $quantity
    ]);

    // Respond with a JSON object indicating success
    header('Content-Type: application/json');
    echo json_encode(['success' => true]);
    exit;
}

// Fetch data from Firebase Realtime Database
$products = $database->getReference('products')->getSnapshot()->getValue();

// HTML code begins
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Table</title>
    
    <!-- Include Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Include Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- SweetAlert2 for alert dialogs -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include 'nav.php' ?>

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        #editModal {
            display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.6); 
    justify-content: center;  /* Center horizontally */
    align-items: center;      /* Center vertically */
    z-index: 50;  /* Bring modal to the front */
}

.modal-content {
    background: white;
    padding: 20px;
    border-radius: 8px;
    max-width: 500px; 
    width: 90%; 
    margin: 0 auto;
}


    </style>

    <div class="container mx-auto p-4">
        <table class="min-w-full bg-white rounded-lg shadow-lg overflow-hidden">
            <thead class="bg-gradient-to-r from-green-500 to-green-700 text-white">
                <tr>
                    <th class="py-3 px-4 text-center">
                        <span class="flex justify-center items-center">
                            <i class="fas fa-tag mr-2"></i> Product Name
                        </span>
                    </th>
                    <th class="py-3 px-4 text-center">
                        <span class="flex justify-center items-center">
                            <i class="fas fa-list-ul mr-2"></i> Category
                        </span>
                    </th>
                    <th class="py-3 px-4 text-center">
                        <span class="flex justify-center items-center">
                            <i class="fas fa-info-circle mr-2"></i> Description
                        </span>
                    </th>
                    <th class="py-3 px-4 text-center">
                        <span class="flex justify-center items-center">
                            <i class="fas fa-dollar-sign mr-2"></i> Price
                        </span>
                    </th>
                    <th class="py-3 px-4 text-center">
                        <span class="flex justify-center items-center">
                            <i class="fas fa-cubes mr-2"></i> Quantity
                        </span>
                    </th>
                    <th class="py-3 px-4 text-center">
                        <span class="flex justify-center items-center">
                            <i class="fas fa-image mr-2"></i> Image
                        </span>
                    </th>
                    <th class="py-3 px-4 text-center">
                        <span class="flex justify-center items-center">
                            <i class="fas fa-edit mr-2"></i> Edit
                        </span>
                    </th>
                    <th class="py-3 px-4 text-center">
                        <span class="flex justify-center items-center">
                            <i class="fas fa-trash-alt mr-2"></i> Delete
                        </span>
                    </th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php foreach ($products as $id => $product): ?>
                    <tr class="hover:bg-blue-100 transition duration-300 ease-in-out transform hover:scale-105">
                        <td class="py-3 px-4 text-center"><?php echo htmlspecialchars($product['product_name']); ?></td>
                        <td class="py-3 px-4 text-center"><?php echo htmlspecialchars($product['category']); ?></td>
                        <td class="py-3 px-4 text-center"><?php echo htmlspecialchars($product['description']); ?></td>
                        <td class="py-3 px-4 text-center">Rs. <?php echo htmlspecialchars($product['price']); ?></td>
                        <td class="py-3 px-4 text-center"><?php echo htmlspecialchars($product['quantity']); ?></td>
                        <td class="py-3 px-4 text-center">
                            <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['product_name']); ?>" class="w-20 h-20 object-cover rounded-lg mx-auto">
                        </td>
                        <td class="py-3 px-4 text-center">
                            <a href="javascript:void(0);" onclick="editProduct('<?php echo htmlspecialchars($id); ?>', '<?php echo htmlspecialchars($product['product_name']); ?>', '<?php echo htmlspecialchars($product['category']); ?>', '<?php echo htmlspecialchars($product['description']); ?>', '<?php echo htmlspecialchars($product['price']); ?>', '<?php echo htmlspecialchars($product['quantity']); ?>', '<?php echo htmlspecialchars($product['image_url']); ?>')" class="text-blue-600 hover:text-blue-800 tooltip transition-transform transform hover:scale-110" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                        </td>
                        <td class="py-3 px-4 text-center">
                            <a href="javascript:void(0);" onclick="confirmDelete('<?php echo urlencode($id); ?>')" class="text-red-600 hover:text-red-800 tooltip transition-transform transform hover:scale-110" title="Delete">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Edit Modal -->
        <div id="editModal" class="modal" style="display: none;">
            <div class="modal-content rounded-lg shadow-lg p-6">
                <h2 class="text-lg font-semibold mb-4">Edit Product</h2>
                <form id="editForm" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" id="editProductId">
                    <div class="mb-4">
                        <label for="editProductName" class="block text-sm font-medium text-gray-700">Product Name</label>
                        <input type="text" id="editProductName" name="product_name" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>
                    <div class="mb-4">
                        <label for="editCategory" class="block text-sm font-medium text-gray-700">Category</label>
                        <input type="text" id="editCategory" name="category" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>
                    <div class="mb-4">
                        <label for="editDescription" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="editDescription" name="description" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="editPrice" class="block text-sm font-medium text-gray-700">Price</label>
                        <input type="number" id="editPrice" name="price" class="mt-1 block w-full border border-gray-300 rounded-md p-2" step="0.01" required>
                    </div>
                    <div class="mb-4">
                        <label for="editQuantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                        <input type="number" id="editQuantity" name="quantity" class="mt-1 block w-full border border-gray-300 rounded-md p-2" required>
                    </div>
                    <div class="mb-4">
                        <label for="editImage" class="block text-sm font-medium text-gray-700">Image</label>
                        <input type="file" id="editImage" name="image_file" class="mt-1 block w-full">
                    </div>
                    <div class="flex justify-end">
                        <button type="button" onclick="closeModal()" class="bg-gray-500 text-white rounded-md px-4 py-2 mr-2">Cancel</button>
                        <button type="submit" class="bg-blue-500 text-white rounded-md px-4 py-2">Update</button>
                    </div>
                </form>
            </div>
        </div>
                
        <script>

function openModal() {
    document.getElementById('editModal').style.display = 'flex';
}

// Function to close the modal
function closeModal() {
    document.getElementById('editModal').style.display = 'none';
}

            function editProduct(id, name, category, description, price, quantity, imageURL) {
                // Populate the form fields with product details
                document.getElementById('editProductId').value = id;
                document.getElementById('editProductName').value = name;
                document.getElementById('editCategory').value = category;
                document.getElementById('editDescription').value = description;
                document.getElementById('editPrice').value = price;
                document.getElementById('editQuantity').value = quantity;

                // Show the modal
                document.getElementById('editModal').style.display = 'block';
            }

            // Function to close the modal
            function closeModal() {
                document.getElementById('editModal').style.display = 'none';
            }

            // Handle form submission for updating product details
            document.getElementById('editForm').addEventListener('submit', function (event) {
                event.preventDefault();
                
                // Use FormData to capture form data
                const formData = new FormData(this);

                // Send AJAX POST request to update the product details
                fetch('', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show success alert and reload the page
                        Swal.fire('Updated!', 'Product details have been updated successfully.', 'success')
                            .then(() => {
                                location.reload();
                            });
                    } else {
                        Swal.fire('Error!', data.error || 'An error occurred while updating product details.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    Swal.fire('Error!', `An error occurred: ${error.message}`, 'error');
                });
            });

            // Function to confirm product deletion
            function confirmDelete(id) {
                // Show a SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You won\'t be able to revert this!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If the user confirms the deletion, send a request to delete the product
                        deleteProduct(id);
                    }
                });
            }

            // Function to delete the product from the database
            function deleteProduct(id) {
                // Send an AJAX request to the backend to delete the product
                fetch(`?id=${id}`, {
                    method: 'DELETE'
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Show a success alert
                        Swal.fire('Deleted!', 'The product has been deleted.', 'success')
                            .then(() => {
                                document.getElementById('editModal').style.display = 'none';
                                // Reload the page or refresh the data to reflect the deletion
                                location.reload();
                                
                            });
                    } else {
                        // Show an error alert with a custom message from the server
                        Swal.fire('Error!', data.error || 'An error occurred while deleting the product.', 'error');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    // Show an error alert with the error message
                    Swal.fire('Error!', `An error occurred: ${error.message}`, 'error');
                });
            }
        </script>
    </div>
</body>

</html>
