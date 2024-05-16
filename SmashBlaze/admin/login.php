<?php
// Start session at the very beginning
session_start();

// Include Firebase PHP library and other required files
require '../vendor/autoload.php';
use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Initialize Firebase
$firebase = (new Factory)
    ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
    ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/');
$database = $firebase->createDatabase();

// Check if form is submitted
$authenticated = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Fetch user data from Firebase
    $usersRef = $database->getReference('Admin'); // Replace 'users' with your Firebase user data path
    $users = $usersRef->getValue();

    // Check user credentials
    foreach ($users as $key => $user) {
        if ($user['email'] === $email && $user['password'] === $password) {
            $authenticated = true;
            $_SESSION['logged_in'] = true;
            $_SESSION['user_id'] = $key; // Assuming `$key` is a unique user ID
            // Redirect to index.php
            header('Location: index.php');
            exit;
        }
    }
    // Authentication failed, store an error message
    $_SESSION['error'] = 'Invalid email or password.';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Google Fonts - Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }
    </style>
</head>

<body class="flex items-center justify-center h-screen">
    <div class="container mx-auto px-4">
        <!-- Card with rounded corners and responsive design -->
        <div class="max-w-3xl w-full mx-auto bg-white rounded-lg shadow-lg p-8 lg:flex lg:items-center lg:gap-12 transform transition-all duration-300 ease-in-out hover:shadow-2xl">
            <!-- Left side with image and text overlaid -->
            <div class="lg:w-1/2 relative">
                <img src="./images/slide_img.jpg" alt="Admin Panel" class="w-full rounded-lg">
                <div class="absolute inset-0 flex flex-col items-center justify-center p-6 bg-black bg-opacity-50 rounded-lg">
                    <h2 class="text-4xl font-bold text-white">Welcome!</h2>
                    <p class="text-white mt-4">Welcome to the admin panel. Please log in with your credentials to access the dashboard.</p>
                </div>
            </div>

            <!-- Right side with login form -->
            <div class="lg:w-1/2 mt-6 lg:mt-0">
                <h2 class="text-center text-3xl font-bold text-green-600 mt-4">Login to Your Admin Account</h2>

                <!-- Login form -->
                <form method="POST" action="" id="login-form" class="mt-8 space-y-6">
                    <!-- Email field -->
                    <div>
                        <label for="email" class="block text-gray-800 font-semibold">Email</label>
                        <div class="relative mt-2">
                            <i class="fas fa-envelope absolute left-3 top-3 text-gray-500"></i>
                            <input type="email" name="email" id="email" placeholder="Enter your email" class="pl-10 pr-4 py-2 w-full border rounded-md focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300 ease-in-out" required>
                        </div>
                    </div>

                    <!-- Password field -->
                    <div>
                        <label for="password" class="block text-gray-800 font-semibold">Password</label>
                        <div class="relative mt-2">
                            <i class="fas fa-lock absolute left-3 top-3 text-gray-500"></i>
                            <input type="password" name="password" id="password" placeholder="Enter your password" class="pl-10 pr-4 py-2 w-full border rounded-md focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300 ease-in-out" required>
                        </div>
                    </div>

                    <!-- Remember me and forgot password -->
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <input type="checkbox" id="remember" name="remember" class="form-checkbox text-green-500">
                            <label for="remember" class="ml-2 text-gray-800">Remember me</label>
                        </div>
                        <a href="#" class="text-green-500 hover:underline">Forgot Password?</a>
                    </div>

                    <!-- Login button -->
                    <button type="submit" class="w-full py-3 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-300 ease-in-out">
                        <i class="fas fa-user"></i> Login
                    </button>
                </form>

                <!-- Display error message if any -->
                <?php
                if (isset($_SESSION['error'])) {
                    echo '<div class="mt-4 text-red-600">' . htmlspecialchars($_SESSION['error']) . '</div>';
                    unset($_SESSION['error']); // Clear error message after displaying it
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
