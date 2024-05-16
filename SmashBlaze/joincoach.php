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
      <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

      <link rel="stylesheet" href="./css/joincoach.css">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
      <link rel="stylesheet" href="./css/addtournament.css">
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

      <title>SmashBlaze</title>

  </head>
  <body data-bs-spy="scroll" data-bs-target=".navbar">
  <style>
    /* Optional: Additional CSS for styling */
    .flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .label-upload {
        display: flex;
        align-items: center;
        padding: 8px;
        background-color: #6abf6d;
        color: white;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .label-upload:hover {
        background-color: #55a359;
    }
</style>
    <!---- NAVBAR ---->
 <?php include  'components/nav.php'?>

    <!----Register Form-->
    <div class="coa-reg-container max-w-3xl mx-auto p-8 bg-white rounded-lg shadow-lg">
    <h1 class="text-3xl font-semibold text-center text-green-600 mb-6">Badminton Coach Registration</h1>
    <form id="coachForm" method="post" enctype="multipart/form-data">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Coach Name -->
            <div class="flex flex-col items-start">
                <label for="coachName" class="text-lg font-medium text-gray-800 mb-1">Coach Name:</label>
                <div class="flex items-center w-full border border-gray-300 rounded-lg focus-within:border-green-500">
                    <i class="fa fa-user text-green-500 px-2"></i>
                    <input type="text" id="coachName" name="coachName" class="w-full py-2 px-3 outline-none bg-transparent rounded-r-lg" placeholder="Enter Coach Name">
                </div>
            </div>
            
            <!-- Contact Number -->
            <div class="flex flex-col items-start">
                <label for="contactNumber" class="text-lg font-medium text-gray-800 mb-1">Contact Number:</label>
                <div class="flex items-center w-full border border-gray-300 rounded-lg focus-within:border-green-500">
                    <i class="fa fa-phone text-green-500 px-2"></i>
                    <input type="tel" id="contactNumber" name="contactNumber" class="w-full py-2 px-3 outline-none bg-transparent rounded-r-lg" placeholder="Enter Contact Number">
                </div>
            </div>
            
            <!-- Email -->
            <div class="flex flex-col items-start">
                <label for="email" class="text-lg font-medium text-gray-800 mb-1">Email:</label>
                <div class="flex items-center w-full border border-gray-300 rounded-lg focus-within:border-green-500">
                    <i class="fa fa-envelope text-green-500 px-2"></i>
                    <input type="email" id="email" name="email" class="w-full py-2 px-3 outline-none bg-transparent rounded-r-lg" placeholder="Enter Email Address">
                </div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Qualifications -->
            <div class="flex flex-col items-start">
                <label for="qualifications" class="text-lg font-medium text-gray-800 mb-1">Qualifications:</label>
                <textarea id="qualifications" rows="4" name="qualifications" class="w-full p-3 border border-gray-300 rounded-lg focus:border-green-500" placeholder="List your qualifications here"></textarea>
            </div>
            
            <!-- Qualifications Proof Documents -->
            <div class="flex flex-col items-start">
    <label for="qualificationsProof" class="text-lg font-medium text-gray-800 mb-1">Qualifications Proof:</label>
    <div class="flex items-center">
        <label class="bg-green-500 text-white py-2 px-3 rounded-lg cursor-pointer hover:bg-green-600 transition duration-300 ease-in-out">
            <span class="text-sm">Upload</span>
            <input type="file" id="qualificationsProof" name="qualificationsProof" accept=".pdf, .doc, .docx" class="hidden" onchange="displayFileName(this)" />
        </label>
        <p id="fileNameParagraph" class="ml-3 text-sm text-gray-700"></p>
    </div>
</div>
            
            <!-- Coach Photograph -->
            <div class="flex flex-col items-start">
                <label for="coachPhoto" class="text-lg font-medium text-gray-800 mb-1">Coach Photograph:</label>
                <label class="flex items-center bg-green-500 text-white py-2 px-3 rounded-lg cursor-pointer hover:bg-green-600 transition duration-300 ease-in-out">
                    <span class="text-sm">Upload</span>
                    <input type="file" id="coachPhoto" name="coachPhoto" accept="image/*" class="hidden"  onchange="displayImageName(this)" />
                </label>
                <p id="imageNameParagraph" class="ml-3 text-sm text-gray-700"></p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <!-- Available Days -->
            <div class="flex flex-col items-start">
                <label for="availableDays" class="text-lg font-medium text-gray-800 mb-1">Available Days:</label>
                <select id="availableDays" multiple size="7" name="availableDays[]" class="w-full p-3 border border-gray-300 rounded-lg focus:border-green-500">
                    <option value="monday">Monday</option>
                    <option value="tuesday">Tuesday</option>
                    <option value="wednesday">Wednesday</option>
                    <option value="thursday">Thursday</option>
                    <option value="friday">Friday</option>
                    <option value="saturday">Saturday</option>
                    <option value="sunday">Sunday</option>
                </select>
            </div>

            <!-- Available Time From -->
            <div class="flex flex-col items-start">
                <label for="availableTimeFrom" class="text-lg font-medium text-gray-800 mb-1">Available Time From:</label>
                <div class="flex items-center w-full border border-gray-300 rounded-lg focus-within:border-green-500">
                    <i class="fa fa-clock text-green-500 px-2"></i>
                    <input type="time" id="availableTimeFrom" name="availableTimeFrom" class="w-full py-2 px-3 outline-none bg-transparent rounded-r-lg">
                </div>
            </div>

            <!-- Available Time To -->
            <div class="flex flex-col items-start">
                <label for="availableTimeTo" class="text-lg font-medium text-gray-800 mb-1">Available Time To:</label>
                <div class="flex items-center w-full border border-gray-300 rounded-lg focus-within:border-green-500">
                    <i class="fa fa-clock text-green-500 px-2"></i>
                    <input type="time" id="availableTimeTo" name="availableTimeTo" class="w-full py-2 px-3 outline-none bg-transparent rounded-r-lg">
                </div>
            </div>
        </div>

        <!-- Message Display -->
        <p id="message" class="text-red-500 text-center mb-4"></p>

        <!-- Submit and Cancel Buttons -->
        <div class="flex justify-between">
            <button class="btn-sub bg-green-500 text-white py-2 px-4 rounded-lg hover:bg-green-600 focus:outline-none transition duration-300 ease-in-out" type="submit" name="submit">Submit</button>
            <button class="btn-del bg-gray-300 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-400 focus:outline-none transition duration-300 ease-in-out" type="button">Cancel</button>
        </div>
    </form>
</div>
<script>
    function displayFileName(input) {
        // Get the selected file from the input element
        const file = input.files[0];

        if (file) {
            // Update the paragraph text with the file name
            document.getElementById('fileNameParagraph').textContent = `File selected: ${file.name}`;
        } else {
            // If no file is selected (should not happen in this context)
            document.getElementById('fileNameParagraph').textContent = 'No file selected';
        }
    }
    function displayImageName(input) {
        // Get the selected file from the input element
        const file = input.files[0];

        if (file) {
            // Update the paragraph text with the file name
            document.getElementById('imageNameParagraph').textContent = `File selected: ${file.name}`;
        } else {
            // If no file is selected (should not happen in this context)
            document.getElementById('imageNameParagraph').textContent = 'No file selected';
        }
    }
</script>

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

    // Create a Firebase Storage instance
    $storage = $factory->createStorage();

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
        // Handle form submission
        $coachName = $_POST["coachName"];
        $contactNumber = $_POST["contactNumber"];
        $email = $_POST["email"];
        $qualifications = $_POST["qualifications"];
        $availableDays = implode(", ", $_POST["availableDays"]);
        $availableTimeFrom = $_POST["availableTimeFrom"];
        $availableTimeTo = $_POST["availableTimeTo"];

        // Upload coach photograph to Firebase Storage
      // Upload coach photograph to Firebase Storage
$coachPhoto = $_FILES["coachPhoto"]["tmp_name"];
$coachPhotoPath = 'coach_photos/' . $_FILES["coachPhoto"]["name"];
$storage->getBucket()->upload(file_get_contents($coachPhoto), [
    'name' => $coachPhotoPath
]);


$expirationDate = new DateTime('+365 days'); 
        // Get download URL for coach photograph
        $coachPhotoUrl = $storage->getBucket()->object($coachPhotoPath)->signedUrl($expirationDate);

        // Upload qualifications proof document to Firebase Storage
     // Upload qualifications proof document to Firebase Storage
$qualificationsProof = $_FILES["qualificationsProof"]["tmp_name"];
$qualificationsProofPath = 'qualification_proofs/' . $_FILES["qualificationsProof"]["name"];
$storage->getBucket()->upload(file_get_contents($qualificationsProof), [
    'name' => $qualificationsProofPath
]);

        // Get download URL for qualifications proof document
        $qualificationsProofUrl = $storage->getBucket()->object($qualificationsProofPath)->signedUrl($expirationDate);

        // Store form data along with download URLs in Firebase Realtime Database
        $newCoachRef = $database->getReference('coaches')->push([
            'coachName' => $coachName,
            'contactNumber' => $contactNumber,
            'email' => $email,
            'qualifications' => $qualifications,
            'availableDays' => $availableDays,
            'availableTimeFrom' => $availableTimeFrom,
            'availableTimeTo' => $availableTimeTo,
            'status' => 'pending',
            'coachPhotoUrl' => $coachPhotoUrl,
            'qualificationsProofUrl' => $qualificationsProofUrl
        ]);

        if ($newCoachRef->getKey()) {
            echo '<script>
Swal.fire({
  position: "top-end",
  icon: "success",
  title: "Your Application Send Success!",
  showConfirmButton: false,
  timer: 1500
});
</script>';
        } else {
            echo '<script>
Swal.fire({
  position: "top-end",
  icon: "error",
  title: "Your Application Send Not Success!",
  showConfirmButton: false,
  timer: 1500
});
</script>';
        }
    }
    ?>
    <?php include'components/footer.php'?>
  </body>
</html>
