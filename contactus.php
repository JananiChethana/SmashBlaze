<?php
// Load Composer's autoloader
require 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Database connection
$firebase = (new Factory)
    ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
    ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/')
    ->createDatabase();

$database = $firebase;

$errors = [];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    // Perform basic validation
    if (empty($name)) {
        $errors[] = 'Name is required';
    }
    if (empty($email)) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }
    if (empty($message)) {
        $errors[] = 'Message is required';
    }

    // If there are no errors, proceed to store the data in Firebase
    if (empty($errors)) {
        $formData = [
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'timestamp' => date('Y-m-d H:i:s')
        ];

        try {
            $database->getReference('contacts')->push($formData);

            // Display success alert using SweetAlert2
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Your message was sent successfully!",
                showConfirmButton: false,
                timer: 1500
            });
            </script>';
        } catch (Exception $e) {
            // Display error alert using SweetAlert2
            echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
            echo '<script>
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "There was an error sending your message.",
                showConfirmButton: true,
            });
            </script>';
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact </title>
  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-100">
  <?php include 'components/nav.php' ?>

  <div class="container mx-auto px-4 py-8">
        <!-- Main Card -->
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <!-- Flex Container -->
            <div class="flex flex-row gap-8">
                <!-- Left Section (Contact Information and Image) -->
                <div class="flex flex-col w-1/2">
                    <!-- Contact Information -->
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold mb-4">Contact Information</h2>
                        <div class="mb-4">
                            <i class="fas fa-map-marker-alt text-xl text-gray-700 mr-3"></i>
                            <p class="text-gray-700 inline">Kaduwela, Colombo, Sri Lanka</p>
                        </div>
                        <div class="mb-4">
                            <i class="fas fa-phone text-xl text-gray-700 mr-3"></i>
                            <p class="text-gray-700 inline">+94 789376764</p>
                        </div>
                        <div class="mb-4">
                            <i class="fas fa-envelope text-xl text-gray-700 mr-3"></i>
                            <p class="text-gray-700 inline">smashbblaze9@gmail.com</p>
                        </div>
                    </div>
                    
                    <!-- Image -->
                    <div class="bg-cover bg-center h-60 rounded-lg shadow-lg" style="background-image: url('https://kiddy123.com/custom/domain_1/image_files/sitemgr_photo_28815.jpg');">
                        <div class="flex items-center justify-center h-full bg-opacity-50 bg-gray-800 rounded-lg">
                            <h2 class="text-3xl font-bold text-white">Get in Touch!</h2>
                        </div>
                    </div>
                </div>

                <!-- Right Section (User Inputs) -->
                <div class="w-1/2">
                    <h2 class="text-2xl font-bold mb-4">Send us a Message</h2>
                    <form id="contact-form" method="POST" action="">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Name</label>
                            <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        </div>
                        <div class="mb-4">
                            <label for="message" class="block text-gray-700">Message</label>
                            <textarea id="message" name="message" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" rows="6" required></textarea>
                        </div>
                        <button type="submit" class="w-full py-2 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php  include 'components/footer.php' ?>
</body>
</html>