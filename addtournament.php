<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="./css/owl.carousel.min.css">
  <link rel="stylesheet" href="./css/owl.theme.default.min.css">
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/boostrap.min.css">
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/owl.theme.default.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/joincoach.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

<!-- Add Font Awesome CDN -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

  <link rel="stylesheet" href="./css/addtournament.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <title>SmashBlaze-Add Tournament</title>
</head>
<body data-bs-spy="scroll" data-bs-target=".navbar">
  <?php include './components/nav.php' ?>

<style>
    input {
    color: black; /* Set the text color to black */
}
</style>


  <div class="pos-tour-container">
    <h1>Post Tournament Details</h1>
    <form id="ptournamentForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" class="max-w-3xl mx-auto bg-white shadow-lg rounded-lg p-6 space-y-6">
    <!-- 2 by 2 Grid Start -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

        <!-- Tournament Name -->
        <div>
            <label for="tournamentName" class="block font-semibold text-gray-700 mb-2">Tournament Name:</label>
            <div class="relative">
                <input type="text" id="tournamentName" name="tournamentName" class="border border-gray-300 rounded-lg py-2 px-3 w-full focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Enter tournament name">
                <i class="fas fa-trophy absolute top-1/2 transform -translate-y-1/2 right-3 text-gray-400"></i>
            </div>
        </div>

        <!-- Venue -->
        <div>
            <label for="venue" class="block font-semibold text-gray-700 mb-2">Venue:</label>
            <div class="relative">
                <input type="text" id="venue" name="venue" class="border border-gray-300 rounded-lg py-2 px-3 w-full focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Enter venue">
                <i class="fas fa-map-marker-alt absolute top-1/2 transform -translate-y-1/2 right-3 text-gray-400"></i>
            </div>
        </div>

        <!-- Time -->
        <div>
            <label for="time" class="block font-semibold text-gray-700 mb-2">Time:</label>
            <div class="relative">
                <input type="time" id="time" name="time" class="border border-gray-300 rounded-lg py-2 px-3 w-full focus:outline-none focus:ring-2 focus:ring-green-500">
                <i class="fas fa-clock absolute top-1/2 transform -translate-y-1/2 right-3 text-gray-400"></i>
            </div>
        </div>

        <!-- Organization Name -->
        <div>
            <label for="organizationName" class="block font-semibold text-gray-700 mb-2">Organization Name:</label>
            <div class="relative">
                <input type="text" id="organizationName" name="organizationName" class="border border-gray-300 rounded-lg py-2 px-3 w-full focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Enter organization name">
                <i class="fas fa-building absolute top-1/2 transform -translate-y-1/2 right-3 text-gray-400"></i>
            </div>
        </div>

        <!-- Contact Number -->
        <div>
            <label for="contactNumber" class="block font-semibold text-gray-700 mb-2">Contact Number:</label>
            <div class="relative">
                <input type="tel" id="contactNumber" name="contactNumber" class="border border-gray-300 rounded-lg py-2 px-3 w-full focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Enter contact number">
                <i class="fas fa-phone absolute top-1/2 transform -translate-y-1/2 right-3 text-gray-400"></i>
            </div>
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block font-semibold text-gray-700 mb-2">Email:</label>
            <div class="relative">
                <input type="email" id="email" name="email" class="border border-gray-300 rounded-lg py-2 px-3 w-full focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Enter email">
                <i class="fas fa-envelope absolute top-1/2 transform -translate-y-1/2 right-3 text-gray-400"></i>
            </div>
        </div>

    </div>
    <!-- 2 by 2 Grid End -->

    <!-- Categories Section -->
    <div class="flex flex-col space-y-3">
        <label for="categories" class="font-semibold text-gray-700 mb-2">Categories:</label>
        <div class="flex flex-wrap justify-start gap-4">
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="category1" name="categories[]" value="MenSingles" class="form-checkbox text-green-500">
                <label for="category1" class="text-gray-700">Men Singles</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="category2" name="categories[]" value="MenDoubles" class="form-checkbox text-green-500">
                <label for="category2" class="text-gray-700">Men Doubles</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="category3" name="categories[]" value="WomenSingles" class="form-checkbox text-green-500">
                <label for="category3" class="text-gray-700">Women Singles</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="category4" name="categories[]" value="WomenDoubles" class="form-checkbox text-green-500">
                <label for="category4" class="text-gray-700">Women Doubles</label>
            </div>
            <div class="flex items-center space-x-2">
                <input type="checkbox" id="category5" name="categories[]" value="MixedDoubles" class="form-checkbox text-green-500">
                <label for="category5" class="text-gray-700">Mixed Doubles</label>
            </div>
        </div>
    </div>

    <!-- Registration Documents Section -->
    <div>
        <label for="regDocument" class="block font-semibold text-gray-700 mb-2">Registration Documents:</label>
        <div class="relative">
            <input type="file" id="regDocument" name="regDocument" accept=".pdf, .doc, .docx" class="border border-gray-300 rounded-lg py-2 px-3 w-full focus:outline-none focus:ring-2 focus:ring-green-500">
            <i class="fas fa-file-alt absolute top-1/2 transform -translate-y-1/2 right-3 text-gray-400"></i>
        </div>
    </div>

    <!-- Buttons -->
    <div class="flex justify-between">
        <button class="bg-green-500 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 hover:bg-green-600" type="submit">Submit</button>
        <button class="bg-red-500 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-300 hover:bg-red-600" type="button">Cancel</button>
    </div>

    <!-- Message Section -->
    <p id="message" class="text-red-500 mt-2"></p>
</form>
  </div>

  <?php
  // Include Firebase PHP SDK
  require './vendor/autoload.php';

  use Kreait\Firebase\Factory;
  use Kreait\Firebase\ServiceAccount;

  // Firebase configuration
  $serviceAccount = ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json');
  $firebase = (new Factory)
      ->withServiceAccount($serviceAccount)
        ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/');

  $database = $firebase->createDatabase();
  $storage = $firebase->createStorage();

  // Check if the form is submitted
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      try {
          // Handle form submission
          $tournamentName = $_POST["tournamentName"] ?? "";
          $venue = $_POST["venue"] ?? "";
          $time = $_POST["time"] ?? "";
          $organizationName = $_POST["organizationName"] ?? "";
          $contactNumber = $_POST["contactNumber"] ?? "";
          $email = $_POST["email"] ?? "";
          $categories = $_POST["categories"] ?? [];

        // Upload registration document to Firebase Storage
$regDocumentFile = $_FILES["regDocument"]["tmp_name"] ?? "";
$regDocumentName = $_FILES["regDocument"]["name"] ?? "";

// Check if a file is selected
if (empty($regDocumentFile)) {
    throw new Exception("Please select a registration document.");
}

// Read the contents of the file
$fileContent = file_get_contents($regDocumentFile);

// Sanitize user input
$tournamentName = htmlspecialchars($tournamentName);
$venue = htmlspecialchars($venue);
// ... (sanitize other fields as needed)

// Path to store the file in Firebase Storage
$regDocumentPath = 'tournaments_documents/' . uniqid() . '-' . $regDocumentName;

// Upload the file content
$storage->getBucket()->upload($fileContent, [
    'name' => $regDocumentPath
]);

          $expirationDate = new DateTime('+365 days'); 

          // Get the download URL for the uploaded file
          $regDocumentDownloadUrl = $storage->getBucket()->object($regDocumentPath)->signedUrl($expirationDate);

          // Store form data in Realtime Database
          $newPost = $database->getReference('tournaments')->push([
              'tournamentName' => $tournamentName,
              'venue' => $venue,
              'time' => $time,
              'organizationName' => $organizationName,
              'contactNumber' => $contactNumber,
              'email' => $email,
              'categories' => $categories,
              'status' => 'pending',
              'regDocumentDownloadUrl' => $regDocumentDownloadUrl
          ]);

          // Show success message
          echo '<script>
              Swal.fire({
                  position: "top-end",
                  icon: "success",
                  title: "Your Application Sent Successfully!",
                  showConfirmButton: false,
                  timer: 1500
              });
          </script>';
      } catch (Exception $e) {
          // Handle errors
          echo '<script>
              Swal.fire({
                  icon: "error",
                  title: "Oops...",
                  text: "An error occurred while processing your request! ' . $e->getMessage() . '",
              });
          </script>';
      }
  }
  ?>

<?php include 'components/footer.php' ?>

</body>
</html>
