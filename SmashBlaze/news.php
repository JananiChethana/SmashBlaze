<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmashBlaze News</title>

    <!-- Include necessary stylesheets -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/tailwind.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff; /* Dark background color */
            color: #ffffff; /* Light text color */
        }

        /* Define color palette */
        :root {
            --primary-color: #28a745; /* Green */
            --secondary-color: #007bff; /* Blue */
            --hover-color: #ff9505; /* Orange for hover effects */
            --bg-color: #101820; /* Dark background color */
        }

        /* Custom button styles */
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            transition: background-color 0.3s ease, color 0.3s ease;
            color: #ffffff;
        }

        .btn-primary:hover {
            background-color: var(--hover-color); /* Orange on hover */
            color: #ffffff;
        }

        /* Custom card styles */
        .news-card {
            background-color: #1a202c; /* Darker card background */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            color: #ffffff;
        }

        .news-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        }

        /* Footer styles */
        .footer-top {
            background-color: var(--primary-color); /* Green footer */
            color: white;
            padding: 20px 0;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
            margin-right: 15px;
            transition: color 0.3s ease;
        }

        .footer-links a:hover {
            color: var(--hover-color); /* Orange on hover */
        }
    </style>
</head>

<body>

    <!-- Include navigation -->
    <?php include 'components/nav.php'?>

    <!-- News Section -->
    <div class="container mx-auto py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
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

            // Retrieve news data from Firebase Realtime Database
            try {
                $newsReference = $database->getReference('news');
                $newsDataSnapshot = $newsReference->getSnapshot();
                $newsData = $newsDataSnapshot->getValue();
                if (!$newsData) {
                    $newsData = [];
                }
            } catch (FirebaseException $e) {
                echo '<script>Swal.fire("Error", "Failed to fetch news data: ' . $e->getMessage() . '", "error");</script>';
                $newsData = [];
            }

            // Display news cards
            if (count($newsData) > 0) {
                foreach ($newsData as $key => $news) {
                    echo '<div class="news-card p-4 hover:shadow-lg transition-shadow duration-300">';
                    echo '<img src="' . htmlspecialchars($news['image_url']) . '" alt="' . htmlspecialchars($news['title']) . '" class="w-full h-48 object-cover rounded-md">';
                    echo '<h3 class="mt-4 text-xl font-semibold">' . htmlspecialchars($news['title']) . '</h3>';
                    echo '<p class="text-gray-300 mt-2">' . htmlspecialchars($news['datetime']) . '</p>';
                    echo '<a href="view_news.php?key=' . urlencode($key) . '" class="btn btn-primary mt-4 block text-center py-2 rounded-md hover:bg-primary">View News</a>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col-span-1 text-center">No news data found.</div>';
            }
            ?>
        </div>
    </div>

    <!-- Include scripts -->
    <script src="./js/boostrap.bundle.min.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/owl.carousel.min.js"></script>
    <script src="./js/app.js"></script>
    <br><br>

    <?php include 'components/footer.php'?>

</body>

</html>
