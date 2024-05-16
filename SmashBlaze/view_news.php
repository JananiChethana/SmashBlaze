<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View News</title>
    <link rel="stylesheet" href="../css/tailwind.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>

<body class="bg-gray-100 font-poppins">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
</style>
    <!-- Include navigation bar -->
    <?php include 'components/nav.php'; ?>

    <div class="container mx-auto py-8 px-4 lg:px-8">
        <?php
        // Load Firebase dependencies and classes
        require_once './vendor/autoload.php';
        use Kreait\Firebase\Factory;
        use Kreait\Firebase\ServiceAccount;
        use Kreait\Firebase\Exception\FirebaseException;

        // Initialize Firebase
        $firebase = (new Factory)
            ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
            ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/');
        $database = $firebase->createDatabase();

        // Retrieve the news key from the URL parameter
        if (isset($_GET['key'])) {
            $newsKey = $_GET['key'];

            // Retrieve the news item data from Firebase Realtime Database
            try {
                $newsItemReference = $database->getReference('news/' . $newsKey);
                $newsItemSnapshot = $newsItemReference->getSnapshot();
                $newsItem = $newsItemSnapshot->getValue();

                if ($newsItem) {
                    // Display the news item details
                    echo '<div class="bg-white rounded-lg shadow-lg p-8 transition duration-300 transform hover:shadow-2xl hover:-translate-y-1">';
                    echo '<h1 class="text-3xl font-semibold mb-4 text-indigo-600">' . htmlspecialchars($newsItem['title']) . '</h1>';
                    echo '<p class="text-gray-500 mb-4">' . htmlspecialchars($newsItem['datetime']) . '</p>';
                    
                    echo '<div class="rounded-md overflow-hidden mb-6">';
                    echo '<img src="' . htmlspecialchars($newsItem['image_url']) . '" alt="' . htmlspecialchars($newsItem['title']) . '" class="w-full h-64 object-cover transform hover:scale-105 transition duration-300">';
                    echo '</div>';
                    
                    echo '<p class="text-gray-800 leading-relaxed mb-4">' . nl2br(htmlspecialchars($newsItem['content'])) . '</p>';
                    
                    // Add social media sharing icons
                    echo '<div class="flex space-x-4 text-indigo-600">';
                    echo '<a href="#" class="transition duration-300 transform hover:scale-110">';
                    echo '<i class="fab fa-facebook-f"></i>';
                    echo '</a>';
                    echo '<a href="#" class="transition duration-300 transform hover:scale-110">';
                    echo '<i class="fab fa-twitter"></i>';
                    echo '</a>';
                    echo '<a href="#" class="transition duration-300 transform hover:scale-110">';
                    echo '<i class="fab fa-linkedin"></i>';
                    echo '</a>';
                    echo '</div>';
                    
                    echo '</div>';
                } else {
                    echo '<div class="text-center text-red-500">News item not found.</div>';
                }
            } catch (FirebaseException $e) {
                echo '<script>Swal.fire("Error", "Failed to fetch news item data: ' . $e->getMessage() . '", "error");</script>';
            }
        } else {
            echo '<div class="text-center text-red-500">No news key provided.</div>';
        }
        ?>
    </div>

    <!-- Include footer -->
    <?php include 'components/footer.php'; ?>

</body>

</html>
