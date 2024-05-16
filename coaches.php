<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SmashBlaze</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .coa-card {
            transition: all 0.3s ease;
        }

        .coa-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .card-title {
            font-weight: bold;
        }

        .card-icon {
            margin-right: 0.5rem;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<?php include 'components/nav.php' ?>

<!-- Coach Cards -->
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold text-center mb-8">Our Coaches</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php
        require './vendor/autoload.php';

        use Kreait\Firebase\Factory;
        use Kreait\Firebase\ServiceAccount;

        // Initialize Firebase Factory with ServiceAccount credentials for Realtime Database and Firebase Authentication
        $factory = (new Factory)
            ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
            ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/');

        // Create a Firebase Database instance
        $database = $factory->createDatabase();

        // Query approved coaches data from Firebase Realtime Database
        $approvedCoaches = $database->getReference('coaches')->orderByChild('status')->equalTo('approved')->getValue();

        // Check if there are approved coaches
        if ($approvedCoaches) {
            // Loop through each approved coach and generate HTML for coach card
            foreach ($approvedCoaches as $coachId => $coachData) {
                // Extract coach details
                $coachName = $coachData['coachName'];
                $coachPhotoUrl = $coachData['coachPhotoUrl'];
                $availableDays = $coachData['availableDays'];
                $availableTimeFrom = $coachData['availableTimeFrom'];
                $availableTimeTo = $coachData['availableTimeTo'];
                $contactNumber = $coachData['contactNumber'];
                $email = $coachData['email'];
                $qualifications = $coachData['qualifications'];

                // Generate HTML for coach card
                ?>
             <div class="bg-gary-100 rounded-lg shadow-lg overflow-hidden">
    <div class="relative">
        <img class="w-full h-64 object-cover object-center" src="<?php echo $coachPhotoUrl; ?>" alt="<?php echo $coachName; ?>">
        <div class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-75"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <h3 class="text-3xl md:text-4xl lg:text-5xl font-bold text-white tracking-wide text-center p-4"><?php echo $coachName; ?></h3>
        </div>
    </div>
    <div class="p-6">
        <div class="mb-4">
            <div class="flex items-center">
                <i class="far fa-calendar-alt text-green-500 mr-3"></i>
                <p class="text-lg font-semibold"><?php echo $availableDays; ?> | <?php echo $availableTimeFrom; ?> - <?php echo $availableTimeTo; ?></p>
            </div>
        </div>
        <div class="mb-4">
            <div class="flex items-center">
                <i class="fas fa-phone-alt text-green-500 mr-3"></i>
                <p class="text-lg font-semibold">Contact: <?php echo $contactNumber; ?></p>
            </div>
        </div>
        <div class="mb-4">
            <div class="flex items-center">
                <i class="far fa-envelope text-green-500 mr-3"></i>
                <p class="text-lg font-semibold">Email: <?php echo $email; ?></p>
            </div>
        </div>
        <div class="mb-6">
            <div class="flex items-center">
                <i class="fas fa-graduation-cap text-green-500 mr-3"></i>
                <p class="text-lg font-semibold">Qualifications: <?php echo $qualifications; ?></p>
            </div>
        </div>
    </div>
</div>

                <?php
            }
        } else {
            // If there are no approved coaches, display a message
            echo '<p class="text-center">No approved coaches found.</p>';
        }
        ?>
    </div>
</div>

<!-- Footer -->
<?php include 'components/footer.php' ?>

</body>
</html>
