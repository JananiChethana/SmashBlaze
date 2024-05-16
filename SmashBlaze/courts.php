<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmashBlaze Courts</title>

    <!-- Include necessary stylesheets -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/tailwind.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css" integrity="sha512-UuQ/zJlbMVAw/UU8vVBhnI4op+/tFOpQZVT+FormmIEhRSCnJWyHiBbEVgM4Uztsht41f3FzVWgLuwzUqOObKw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        /* Define color palette */
        :root {
            --primary-color: #28a745; /* Green */
            --hover-color: #ff9505; /* Orange for hover effects */
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
        }

        /* Custom card styles */
        .courts-card {
            background-color: #1a202c; /* Darker card background */
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            color: #ffffff;
        }

        .courts-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 12px rgba(0, 0, 0, 0.15);
        }

        /* Center text horizontally */
        .courts-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
    </style>
</head>

<body>

    <!-- Include navigation -->
    <?php include 'components/nav.php'?>

    <!-- courts Section -->
    <div class="container mx-auto py-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            <?php
            // Load Firebase dependencies and classes
            require_once './vendor/autoload.php';
            use Kreait\Firebase\Factory;
            use Kreait\Firebase\ServiceAccount;
            use Kreait\Firebase\Exception\FirebaseException;

            try {
                // Initialize Firebase
                $firebase = (new Factory)
                    ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
                    ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/');
                $database = $firebase->createDatabase();

                $courtsReference = $database->getReference('courts');
                $courtsDataSnapshot = $courtsReference->getSnapshot();
                $courtsData = $courtsDataSnapshot->getValue();
                if (!$courtsData) {
                    $courtsData = [];
                }


                foreach ($courtsData as $key => $courts) {
                    // Check if the court status is "approved"
                    if ($courts['status'] === 'approved') {
                        echo '<div class="courts-card p-4 hover:shadow-lg transition-shadow duration-300 transition-opacity">';
                        echo '<img src="' . htmlspecialchars($courts['courtPhotoURL']) . '" alt="' . htmlspecialchars($courts['courtName']) . '" class="w-full h-48 object-cover rounded-md">';
                        echo '<h3 class="mt-4 text-xl font-semibold"> <i class="fas fa-house mr-2"></i>' . htmlspecialchars($courts['courtName']) . '</h3>';
                        echo '<p class="text-gray-300 mt-2"><i class="fas fa-map mr-2"></i>' . htmlspecialchars($courts['address']) . '</p>';
                        echo '<a href="view_court.php?key=' . urlencode($key) . '" class="btn btn-primary mt-4 block text-center  p-2 rounded-md hover:bg-primary hover:text-white transition-colors duration-300">';
                        echo '<i class="fas fa-eye mr-2"></i> View courts</a>';
                        echo '</div>';
                    }
                }
                
            } catch (FirebaseException $e) {
                echo '<div class="col-span-1 text-center">Failed to fetch courts data.</div>';
            }
            ?>
        </div>
    </div>

    <?php include 'components/footer.php'?>

    <!-- Include scripts -->
    <script src="./js/boostrap.bundle.min.js"></script>
    <script src="./js/jquery.min.js"></script>
    <script src="./js/owl.carousel.min.js"></script>
    <script src="./js/app.js"></script>

</body>

</html>
