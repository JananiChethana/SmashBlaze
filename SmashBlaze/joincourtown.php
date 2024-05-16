<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Badminton Court Registration</title>
    <link rel="stylesheet" href="./css/boostrap.min.css">
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/owl.theme.default.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/joincoach.css">
    <!-- CSS Links -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Google Maps JavaScript API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAJooKRO813mW6b1ZwzekShJ8Cw9EdV40c&libraries=places"></script>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom styles -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }

        .btn-primary {
            background-color: #4f46e5;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #4338ca;
        }

        .btn-danger {
            background-color: #dc2626;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .btn-danger:hover {
            background-color: #b91c1c;
        }

        .form-input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #e2e8f0;
            border-radius: 0.5rem;
            transition: border-color 0.3s;
        }

        .form-input:focus {
            border-color: #4f46e5;
            box-shadow: 0 0 10px rgba(79, 70, 229, 0.3);
        }

        #map {
            border-radius: 0.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            height: 300px;
        }
    </style>
</head>

<body class="bg-gray-100">
<?php  include 'components/nav.php'?>
    <!-- Registration Form Container -->
    <div class="container mx-auto py-12 px-4">
        <div class="bg-white shadow-xl rounded-lg p-10 max-w-4xl mx-auto hover:shadow-2xl transform transition-transform duration-300 hover:scale-105">
            <h2 class="text-3xl font-bold mb-8 text-center text-green-700">Badminton Court Registration</h2>

            <!-- Registration Form -->
            <form id="registrationForm" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" class="grid grid-cols-2 gap-4 p-4 bg-white shadow-lg rounded-lg">

                <!-- Court Name -->
                <div class="col-span-1">
                    <label class="block text-green-600 font-semibold mb-2" for="courtName">
                        <i class="fas fa-building mr-2"></i> Court Name or Club Name:
                    </label>
                    <input class="form-input border-gray-300 hover:border-green-600 focus:border-green-600" id="courtName" type="text" name="courtName" required>
                </div>

                <!-- Address -->
                <div class="col-span-2">
                    <label class="block text-green-600 font-semibold mb-2" for="address">
                        <i class="fas fa-map-marker-alt mr-2"></i> Address:
                    </label>
                    <textarea class="form-input border-gray-300 hover:border-green-600 focus:border-green-600" id="address" name="address" rows="2" required></textarea>
                </div>

                <!-- Contact Number -->
                <div class="col-span-1">
                    <label class="block text-green-600 font-semibold mb-2" for="contactNumber">
                        <i class="fas fa-phone-alt mr-2"></i> Contact Number:
                    </label>
                    <input class="form-input border-gray-300 hover:border-green-600 focus:border-green-600" id="contactNumber" type="tel" name="contactNumber" required>
                </div>

                <!-- Email -->
                <div class="col-span-1">
                    <label class="block text-green-600 font-semibold mb-2" for="email">
                        <i class="fas fa-envelope mr-2"></i> Email:
                    </label>
                    <input class="form-input border-gray-300 hover:border-green-600 focus:border-green-600" id="email" type="email" name="email" required>
                </div>

                <!-- Court Photo -->
                <div class="col-span-1">
                    <label class="block text-green-600 font-semibold mb-2" for="courtPhoto">
                        <i class="fas fa-image mr-2 text-green-600"></i> Court Photo:
                    </label>
                    <input class="form-input border-gray-300 hover:border-green-600 focus:border-green-600" id="courtPhoto" type="file" name="courtPhoto" required>
                </div>

                <!-- Court Size -->
                <div class="col-span-1">
                    <label class="block text-green-600 font-semibold mb-2" for="courtSize">
                        <i class="fas fa-ruler-combined mr-2"></i> Court Size (in meters):
                    </label>
                    <input class="form-input border-gray-300 hover:border-green-600 focus:border-green-600" id="courtSize" type="number" name="courtSize" required>
                </div>

                <!-- Available Days -->
                <div class="col-span-1">
                    <label class="block text-green-600 font-semibold mb-2" for="availableDays">
                        <i class="fas fa-calendar-alt mr-2"></i> Available Days:
                    </label>
                    <select class="form-input border-gray-300 hover:border-green-600 focus:border-green-600" id="availableDays" name="availableDays" multiple required>
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
                <div class="col-span-1">
                    <label class="block text-green-600 font-semibold mb-2" for="availableTimeFrom">
                        <i class="far fa-clock mr-2"></i> Available Time From:
                    </label>
                    <input class="form-input border-gray-300 hover:border-green-600 focus:border-green-600" id="availableTimeFrom" type="time" name="availableTimeFrom" required>
                </div>

                <!-- Available Time To -->
                <div class="col-span-1">
                    <label class="block text-green-600 font-semibold mb-2" for="availableTimeTo">
                        <i class="far fa-clock mr-2"></i> Available Time To:
                    </label>
                    <input class="form-input border-gray-300 hover:border-green-600 focus:border-green-600" id="availableTimeTo" type="time" name="availableTimeTo" required>
                </div>

                <!-- Get Location Button -->
                <div class="col-span-2 text-center">
                    <button id="getLocationBtn" type="button" class="btn btn-success hover:bg-green-700 transition-colors duration-300">
                        <i class="fas fa-map-marker-alt mr-2"></i> Get Current Location
                    </button>
                </div>

                <!-- Location Input -->
                <div class="col-span-1">
                    <label class="block text-green-600 font-semibold mb-2" for="location">
                        <i class="fas fa-map-pin mr-2"></i> Select Location on Map:
                    </label>
                    <input class="form-input border-gray-300 hover:border-green-600 focus:border-green-600" id="location" type="text" name="location" placeholder="Enter location" onFocus="initAutocomplete()" required>
                </div>

                <!-- Map Container -->
                <div id="map" class="col-span-2 mb-4 rounded-lg shadow"></div>

                <!-- Geocoding Status Message -->
                <p id="message" class="col-span-2 text-gray-600"></p>

                <!-- Submit and Cancel Buttons -->
                <div class="col-span-2 flex justify-between">
                    <button class="btn btn-success hover:bg-green-700 transition-colors duration-300" type="submit">
                        <i class="fas fa-check mr-2"></i>Submit
                    </button>
                    <button class="btn btn-danger hover:bg-red-700 transition-colors duration-300" type="button" onclick="clearForm()">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- Footer (Optional) -->
    <!-- You can include your footer code here if you want. -->

    <!-- JavaScript -->
    <script>
        function initAutocomplete() {
            const input = document.getElementById('location');
            const autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.setFields(['address_components', 'geometry', 'name']);
        }

        document.getElementById('getLocationBtn').addEventListener('click', function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(successCallback, errorCallback, {
    enableHighAccuracy: true,
    timeout: 5000,
    maximumAge: 0
});        
            } else {
                document.getElementById('message').textContent = 'Geolocation is not supported by your browser.';
            }
        });

        function successCallback(position) {
            const latitude = position.coords.latitude;
            const longitude = position.coords.longitude;

            const locationInput = document.getElementById('location');
            locationInput.value = `${latitude}, ${longitude}`;

            const mapContainer = document.getElementById('map');
            const mapOptions = {
                center: new google.maps.LatLng(latitude, longitude),
                zoom: 15,
            };
            const map = new google.maps.Map(mapContainer, mapOptions);

            const marker = new google.maps.Marker({
                position: { lat: latitude, lng: longitude },
                map: map,
                title: 'Your Current Location',
                icon: 'https://maps.google.com/mapfiles/ms/icons/red-dot.png', 
            });

            document.getElementById('message').textContent = 'Location obtained successfully!';
        }

        function errorCallback(error) {
    
            let errorMessage = '';

            switch (error.code) {
                case error.PERMISSION_DENIED:
                    errorMessage = 'User denied the request for Geolocation.';
                    break;
                case error.POSITION_UNAVAILABLE:
                    errorMessage = 'Location information is unavailable.';
                    break;
                case error.TIMEOUT:
                    errorMessage = 'The request to get user location timed out.';
                    break;
                default:
                    errorMessage = 'An unknown error occurred.';
                    break;
            }

            document.getElementById('message').textContent = errorMessage;
        }

        // Function to clear the form
        function clearForm() {
            document.getElementById('registrationForm').reset();
            document.getElementById('location').value = '';
            document.getElementById('message').textContent = '';
            const mapContainer = document.getElementById('map');
            mapContainer.innerHTML = ''; // Clear map
        }
    </script>

    <?php include 'components/footer.php' ?>
</body>
<?php
require_once 'vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Exception\FirebaseException;


    $serviceAccount = ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json');
    $firebaseFactory = (new Factory)
        ->withServiceAccount($serviceAccount)
          ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/');
  

$database = $firebaseFactory->createDatabase();
$storage = $firebaseFactory->createStorage();

// Function to handle form submission
function handleFormSubmission($database, $storage)
{
    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            // Fetch form data
            $courtName = $_POST['courtName'];
            $address = $_POST['address'];
            $contactNumber = $_POST['contactNumber'];
            $email = $_POST['email'];
            $courtSize = $_POST['courtSize'];
            $availableDays = $_POST['availableDays'];
            $availableTimeFrom = $_POST['availableTimeFrom'];
            $availableTimeTo = $_POST['availableTimeTo'];
            $location = $_POST['location'];
            
            // Check if court photo file is provided
            if (isset($_FILES['courtPhoto']) && $_FILES['courtPhoto']['error'] === UPLOAD_ERR_OK) {
                $courtPhotoFile = $_FILES['courtPhoto']['tmp_name'];
                $courtPhotoName = $_FILES['courtPhoto']['name'];

                // Upload file to Firebase Storage
                $bucket = $storage->getBucket();
                $file = fopen($courtPhotoFile, 'r');
                
                // Upload the file
                $storageObject = $bucket->upload(
                    $file,
                    [
                        'name' => 'courtPhotos/' . $courtPhotoName,
                        'metadata' => ['contentType' => $_FILES['courtPhoto']['type']],
                    ]
                );

                // Make the file publicly accessible
                $storageObject->acl()->add('allUsers', 'READER');
                $expirationDate = new DateTime('+365 days'); 

                // Get public URL for the uploaded file
                $courtPhotoURL = $storageObject->signedUrl(new DateTime('+365 days'));

            } else {
                // Handle case when file is not uploaded properly
                echo "<script>Swal.fire('Error', 'Court photo file is missing or invalid.', 'error');</script>";
                return;
            }

            // Prepare data for the database
            $courtData = [
                'courtName' => $courtName,
                'address' => $address,
                'contactNumber' => $contactNumber,
                'email' => $email,
                'courtPhotoURL' => $courtPhotoURL,
                'courtSize' => $courtSize,
                'availableDays' => $availableDays,
                'availableTimeFrom' => $availableTimeFrom,
                'availableTimeTo' => $availableTimeTo,
                'location' => $location,
                'status' => 'pending',
                        ];

            // Store data in Firebase Realtime Database
            $database->getReference('courts')->push($courtData);

            // Show success message
            echo "<script>Swal.fire('Success!', 'Court  data has been stored successfully!', 'success');</script>";
        } catch (FirebaseException $e) {
            // Handle Firebase SDK errors
            echo "<script>Swal.fire('Error', 'A Firebase error occurred: " . htmlspecialchars($e->getMessage()) . "', 'error');</script>";
        } catch (Exception $e) {
            // Handle other errors
            echo "<script>Swal.fire('Error', 'An error occurred: " . htmlspecialchars($e->getMessage()) . "', 'error');</script>";
        }
    }
}

// Call the form submission handler function
handleFormSubmission($database, $storage);
?>

</html>
