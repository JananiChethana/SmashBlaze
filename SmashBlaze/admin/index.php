
<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    // Redirect to login.php
    header('Location: login.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmashBlaze</title>
    <!-- Include necessary CSS files -->
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/boostrap.min.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- Font Awesome CSS -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.compat.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">

<!-- Bootstrap JS and jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>


<body class=" bg-gray-100">
<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    
</style>


    <!-- PHP section -->
    <?php
    include 'nav.php';
    require __DIR__ . '/../vendor/autoload.php'; // Include Composer's autoloader

    use Kreait\Firebase\Factory;
    use Kreait\Firebase\ServiceAccount;

    $firebase = (new Factory)
        ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
        ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/');

    $database = $firebase->createDatabase();



    $coaches = $database->getReference('coaches')->getValue();
    $products = $database->getReference('products')->getValue();
    $con = $database->getReference('contacts')->getValue();
    $tournaments = $database->getReference('tournaments')->getValue();
    $courts = $database->getReference('courts')->getValue();
    $admin = $database->getReference('Admin')->getValue();

    $news = $database->getReference('news')->getValue();

    $pending_coaches_count = count(array_filter($coaches, function ($coach) {
        return $coach['status'] === 'pending';
    }));
    
    $approved_coaches_count = count(array_filter($coaches, function ($coach) {
        return $coach['status'] === 'approved';
    }));
    

    $approved_coaches_count = count($coaches ? array_filter($coaches, function ($coach) {
        return $coach['status'] === 'approved';
    }) : []);
    $products_count = count($products ?? []);
    $tournaments_count = count($tournaments ?? []);
    $contact_count = count($con ?? []);
    $courts_count = count($courts ?? []);
    $news_count = count($news ?? []);
    $admin_count = count($admin ?? []);
    


    ?>

<div class="container mt-2 mx-auto p-4">


<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

            <?php
            function createCard($title, $count, $iconClass)
            {
                echo '
                <div class="bg-white shadow-xl rounded-lg p-6 flex items-center justify-between animate__animated animate__fadeInUp hover:shadow-2xl transition-shadow duration-300 ease-in-out">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-700">' . $title . '</h2>
                        <p class="text-3xl font-bold text-green-500">' . $count . '</p>
                    </div>
                    <div class="text-green-500">
                        <i class="' . $iconClass . ' text-4xl"></i>
                    </div>
                </div>';
            }

            createCard('Pending Coaches', $pending_coaches_count, 'fas fa-user-clock');
            createCard('Approved Coaches', $approved_coaches_count, 'fas fa-user-check');
            createCard('Products', $products_count, 'fas fa-box');
            createCard('Tournaments', $tournaments_count, 'fas fa-trophy');
            createCard('Contacts', $contact_count, 'fas fa-message');

            createCard('Courts', $courts_count, 'fas fa-map-marked-alt');

            createCard('News', $news_count, 'fas fa-newspaper ');
            createCard('Admins', $admin_count, 'fas fa-user');

            ?>
        </div>
    </div>
<!-- Cards section -->



</div>
</div>



</body>

</html>
