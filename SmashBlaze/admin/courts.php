<?php
require __DIR__ . '/../vendor/autoload.php'; // Include Composer's autoloader

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$firebase = (new Factory)
    ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
    ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/');

$database = $firebase->createDatabase();

// Reference to your Firebase database node
$reference = $database->getReference('courts');

// Get data from Firebase
$data = $reference->getValue();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>courts Data</title>
    <!-- Include necessary CSS files -->
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/boostrap.min.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <!-- Font Awesome CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Poppins font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <!-- Inline styles -->
    <style>
        /* Your custom CSS styles */
        body {
            font-family: 'Poppins', sans-serif;
        }

        .table-container {
            overflow-x: auto;
        }

        .table-container::-webkit-scrollbar {
            display: none;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .table {
            border-collapse: collapse;
            width: 100%;
        }

        .table th, .table td {
            padding: 12px 8px;
            text-align: left;
            border-bottom: 1px solid #e2e8f0;
        }

        .table th {
            background-color: #f8fafc;
            text-transform: uppercase;
            font-size: 0.75rem;
            color: #4a5568;
        }

        .table td {
            font-size: 0.875rem;
            color: #4a5568;
        }

        .table tbody tr:hover {
            background-color: #f0f4f8;
        }

        .download-link i {
            margin-right: 5px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .fadeIn {
            animation: fadeIn 0.5s ease-in-out;
        }
    </style>
</head>
<body>
<?php include 'nav.php'?>
<div class="container mx-auto">
    <br>
    <h1 class="text-3xl font-semibold mb-4 text-center">courts Data</h1>
    <div class="overflow-x-auto">
    <table class="w-full table-auto bg-white text-sm text-left rounded-lg">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="py-3 px-4 font-semibold tracking-wider">Court Name</th>
                <th class="py-3 px-4 font-semibold tracking-wider">Address</th>
                <th class="py-3 px-4 font-semibold tracking-wider">Contact Number</th>
                <th class="py-3 px-4 font-semibold tracking-wider">Photo</th>
                <th class="py-3 px-4 font-semibold tracking-wider">Email </th>
                <th class="py-3 px-4 font-semibold tracking-wider">Court Size</th>
                <th class="py-3 px-4 font-semibold tracking-wider">Available Days</th>
                <th class="py-3 px-4 font-semibold tracking-wider text-center">Available Time</th>
                <th class="py-3 px-4 font-semibold tracking-wider text-center">Actions</th>
                <th class="py-3 px-4 font-semibold tracking-wider text-center">Approve</th>
                <th class="py-3 px-4 font-semibold tracking-wider text-center">Actions</th>

            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data)) : ?>
                <?php foreach ($data as $key => $courts) : ?>
                    <tr id="courts_<?php echo $key; ?>" class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4"><?php echo $courts['courtName']; ?></td>
                        <td class="py-3 px-4"><?php echo $courts['address']; ?></td>
                        <td class="py-3 px-4"><?php echo $courts['contactNumber']; ?></td>
                        <td class="py-3 px-4">
    <img src="<?php echo $courts['courtPhotoURL']; ?>" alt="Court Photo" style="max-width: 100px;">
</td>
                        <td class="py-3 px-4"><?php echo $courts['email']; ?></td>
                        <td class="py-3 px-4"><?php echo $courts['courtSize']; ?></td>
                        <td class="py-3 px-4"><?php echo $courts['availableDays']; ?></td>
                        <td class="py-3 px-4"><?php echo $courts['availableTimeFrom'] . ' - ' . $courts['availableTimeTo']; ?></td>
                        <td class="py-3 px-4 text-center">
                            <span class="py-1 px-3 rounded-full text-white font-bold <?php echo $courts['status'] === 'approved' ? 'bg-green-600' : 'bg-red-600'; ?>">
                                <?php echo ucfirst($courts['status']); ?>
                            </span>
                        </td>
                       
                        <td class="py-3 px-4 text-center">
                        <button class="approve-button bg-green-500 text-white rounded-full px-2 py-1 hover:bg-green-600 focus:outline-none focus:ring-1 focus:ring-green-400" data-courts-id="<?php echo $key; ?>">
    <i class="fa-solid fa-check text-lg"></i>
</button>

                        </td>
                        <td class="py-3 px-4 text-center">
    <button class="delete-button bg-red-500 text-white rounded-full px-2 py-1 hover:bg-red-600 focus:outline-none focus:ring-1 focus:ring-red-400" data-courts-id="<?php echo $key; ?>">
        <i class="fas fa-trash-alt text-lg"></i>
    </button>
</td>

                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr>
                    <td colspan="8" class="py-3 px-4 text-center text-gray-500">No data available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </div>
</div>

<!-- Include necessary JavaScript files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.10.0/firebase-app.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.10.0/firebase-database.js"></script>
<!-- Firebase configuration -->
<script>
    var firebaseConfig = {
        authDomain: "smashblaz-1f665.firebaseapp.com",
  databaseURL: "https://smashblaz-1f665-default-rtdb.firebaseio.com",
  projectId: "smashblaz-1f665",
  storageBucket: "smashblaz-1f665.appspot.com",
  messagingSenderId: "538251846721",
  appId: "1:538251846721:web:e6407d4f043572a4c552c0",
  measurementId: "G-WMX5E46DXH"
    };
    // Initialize Firebase
    firebase.initializeApp(firebaseConfig);

    // Reference to your Firebase database node
    var database = firebase.database();

    $(document).ready(function () {
        $('.approve-button').click(function () {
            var courtsId = $(this).data('courts-id');
            updateStatus(courtsId, 'approved');
            location.reload();

        });

        function updateStatus(courtsId, status) {
            database.ref('courts/' + courtsId).update({
                status: status
            }).then(function () {
                // Update the status in the UI
                $('#courts_' + courtsId + ' .status').text(status);
                $('#courts_' + courtsId + ' .status').removeClass().addClass('status').addClass(status);
            }).catch(function (error) {
                console.log('Error updating status:', error);
            });
        }
    });
    $(document).ready(function () {
    // Approve Button Click Handler (existing)
    $('.approve-button').click(function () {
        var courtsId = $(this).data('courts-id');
        updateStatus(courtsId, 'approved');
        location.reload();
    });

    // Delete Button Click Handler
    $('.delete-button').click(function () {
        var courtsId = $(this).data('courts-id');
        deleteCourt(courtsId);
        location.reload();
    });

    function deleteCourt(courtsId) {
        database.ref('courts/' + courtsId).remove()
            .then(function () {
                console.log('Court entry deleted successfully');
            })
            .catch(function (error) {
                console.log('Error deleting court entry:', error);
            });
    }
});

</script>
<br>
<br>
<?php include 'footer.php'?>
</body>
</html>