<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Court</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7fafc;
            color: #2d3748;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: flex-start;
        }

        .image-container {
            flex-basis: 50%;
            max-width: 50%;
        }

        .image-container img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .details-container {
            flex-basis: 50%;
            max-width: 50%;
            padding-left: 20px;
        }

        .card {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
        }

        .card-title {
            font-size: 24px;
            font-weight: 600;
            color: #4caf50;
            margin-bottom: 10px;
        }

        .card-details {
            font-size: 16px;
            color: #333;
            margin-bottom: 10px;
        }

        .map-card {
            width: 100%;
            margin-top: 20px;
        }

        .map-container {
            position: relative;
            width: 100%;
            height: 400px;
            border-radius: 10px;
            overflow: hidden;
        }

        .map {
            width: 100%;
            height: 100%;
            border: 0;
        }

        .map-title {
            font-size: 20px;
            font-weight: 600;
            color: #4caf50;
            margin-bottom: 10px;
        }

        .map-icons {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 10px;
        }

        .map-icons i {
            font-size: 24px;
            color: #4caf50;
            margin-right: 10px;
        }
    </style>
</head>

<body>

<?php include 'components/nav.php'; ?>

<div class="container">
    <?php
    // Load Firebase dependencies and classes
    require_once './vendor/autoload.php';
    use Kreait\Firebase\Factory;
    use Kreait\Firebase\ServiceAccount;
    use Kreait\Firebase\Exception\FirebaseException;

    // Check if the key is provided in the URL
    if (isset($_GET['key'])) {
        // Retrieve the courts key from the URL parameter
        $courtsKey = $_GET['key'];

        // Retrieve the courts item data from Firebase Realtime Database
        try {
            // Initialize Firebase
            $firebase = (new Factory)
                ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
                ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/');
            $database = $firebase->createDatabase();

            // Retrieve the court data
            $courtsItemReference = $database->getReference('courts/' . $courtsKey);
            $courtsItemSnapshot = $courtsItemReference->getSnapshot();
            $courtsItem = $courtsItemSnapshot->getValue();

            // Check if court data exists
            if ($courtsItem) {
                echo '<div class="image-container">';
                echo '<img src="' . htmlspecialchars($courtsItem['courtPhotoURL']) . '" alt="' . htmlspecialchars($courtsItem['courtName']) . '">';
                echo '</div>';

                echo '<div class="details-container">';
                echo '<div class="card">';
                echo '<h1 class="card-title">' . htmlspecialchars($courtsItem['courtName']) . '</h1>';
                echo '<p class="card-details"><i class="fas fa-map-marker-alt" style="color:#4caf50;"></i> Address: ' . htmlspecialchars($courtsItem['address']) . '</p>';
                echo '<p class="card-details"><i class="fas fa-phone-alt" style="color:#4caf50;"></i> Contact Number: ' . htmlspecialchars($courtsItem['contactNumber']) . '</p>';
                echo '<p class="card-details"><i class="far fa-calendar-alt" style="color:#4caf50;"></i> Available Days: ' . htmlspecialchars($courtsItem['availableDays']) . '</p>';
                echo '<p class="card-details"><i class="far fa-clock" style="color:#4caf50;"></i> Available Time: ' . htmlspecialchars($courtsItem['availableTimeFrom']) . ' - ' . htmlspecialchars($courtsItem['availableTimeTo']) . '</p>';
                echo '<p class="card-details"><i class="fas fa-ruler" style="color:#4caf50;"></i> Court Size: ' . htmlspecialchars($courtsItem['courtSize']) . '</p>';
                echo '</div>';

                // Display the map using Google Maps API in a separate card
                echo '<div class="map-card">';
                echo '<h2 class="map-title">Location</h2>';
                echo '<div class="map-container">';
                echo '<iframe class="map" src="https://www.google.com/maps/embed/v1/place?q=' . urlencode($courtsItem['location']) . '&key=AIzaSyAJooKRO813mW6b1ZwzekShJ8Cw9EdV40c" allowfullscreen></iframe>';
                echo '</div>';
                echo '<div class="map-icons">';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            } else {
                echo '<p class="card-details">Court item not found.</p>';
            }
        } catch (FirebaseException $e) {
            echo '<p class="card-details">Failed to fetch court item data: ' . $e->getMessage() . '</p>';
        }
    } else {
        echo '<p class="card-details">No court key provided.</p>';
    }
    ?>
</div>
<?php include 'components/footer.php'; ?>

</body>

</html>
