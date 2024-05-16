<?php
require_once 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

// Initialize Firebase
$firebase = (new Factory)
    ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
    ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/')
    ->createDatabase();

// Fetch approved tournaments
$tournaments = $firebase->getReference('tournaments')->orderByChild('status')->equalTo('approved')->getValue();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approved Tournaments</title>
    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Animate CSS CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <!-- Heroicons CDN for SVG icons -->
    <link href="https://cdn.jsdelivr.net/npm/@heroicons/react/outline.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

      <?php include 'components/nav.php'; ?>
<style>
  body
  {
    font-family: 'Poppins', sans-serif;
  }
</style>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 p-5">
        <?php foreach ($tournaments as $tournament) : ?>
            <div class="bg-white shadow-lg rounded-lg overflow-hidden animate__animated animate__fadeInUp p-4 transition-all duration-300">
    <div class="text-center mb-4">
        <h2 class="text-2xl font-semibold text-gray-800">
            <i class="fas fa-trophy mr-2 text-blue-500"></i><?= $tournament['tournamentName'] ?>
        </h2>
        <p class="text-sm text-gray-600">
            <i class="fas fa-map-marker-alt mr-1 text-gray-500"></i><?= $tournament['venue'] ?>
        </p>
    </div>
    <div class="grid grid-cols-2 gap-4">
        <div>
            <p class="flex items-center text-xs text-gray-500"><i class="far fa-clock mr-1"></i>Time</p>
            <p class="text-sm text-gray-800"><?= $tournament['time'] ?></p>
        </div>
        <div>
            <p class="flex items-center text-xs text-gray-500"><i class="fas fa-phone-alt mr-1"></i>Contact</p>
            <p class="text-sm text-gray-800"><?= $tournament['contactNumber'] ?></p>
        </div>
        <div>
            <p class="flex items-center text-xs text-gray-500"><i class="far fa-envelope mr-1"></i>Email</p>
            <p class="text-sm text-gray-800"><?= $tournament['email'] ?></p>
        </div>
        <div>
            <p class="flex items-center text-xs text-gray-500"><i class="fas fa-building mr-1"></i>Organization</p>
            <p class="text-sm text-gray-800"><?= $tournament['organizationName'] ?></p>
        </div>
    </div>
    <div class="flex justify-between items-center mt-4">
        <div>
            <span class="inline-block bg-blue-500 text-white px-2 py-1 text-xs font-semibold rounded"><?= $tournament['categories'][0] ?></span>
            <span class="inline-block bg-green-500 text-white px-2 py-1 text-xs font-semibold rounded"><?= $tournament['categories'][1] ?></span>
        </div>
        <a href="<?= $tournament['regDocumentDownloadUrl'] ?>" target="_blank" class="text-blue-500 hover:text-blue-700 transition duration-300 ease-in-out text-sm font-medium">
            View Details <i class="fas fa-external-link-alt ml-1"></i>
        </a>
    </div>
</div>

        <?php endforeach; ?>
    </div>
    <?php include 'components/footer.php'; ?>
</body>

</html>
