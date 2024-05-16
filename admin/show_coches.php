<?php
require __DIR__ . '/../vendor/autoload.php'; // Include Composer's autoloader

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

$firebase = (new Factory)
    ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
    ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/');

$database = $firebase->createDatabase();

// Reference to your Firebase database node
$reference = $database->getReference('coaches');

// Get data from Firebase
$data = $reference->getValue();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Data</title>
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
    <h1 class="text-3xl font-semibold mb-4 text-center">Coach Data</h1>
    <div class="overflow-x-auto">
    <table class="w-full table-auto bg-white text-sm text-left rounded-lg">
        <thead class="bg-gray-800 text-white">
            <tr>
                <th class="py-3 px-4 font-semibold tracking-wider">Coach Name</th>
                <th class="py-3 px-4 font-semibold tracking-wider">Contact Number</th>
                <th class="py-3 px-4 font-semibold tracking-wider">Email</th>
                <th class="py-3 px-4 font-semibold tracking-wider">Available Days</th>
                <th class="py-3 px-4 font-semibold tracking-wider">Available Time</th>
                <th class="py-3 px-4 font-semibold tracking-wider">Status</th>
                <th class="py-3 px-4 font-semibold tracking-wider text-center">Documents</th>
                <th class="py-3 px-4 font-semibold tracking-wider text-center">Approve</th>
                <th class="py-3 px-4 font-semibold tracking-wider text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($data)) : ?>
                <?php foreach ($data as $key => $coach) : ?>
                    <tr id="coach_<?php echo $key; ?>" class="border-b hover:bg-gray-50">
                        <td class="py-3 px-4"><?php echo $coach['coachName']; ?></td>
                        <td class="py-3 px-4"><?php echo $coach['contactNumber']; ?></td>
                        <td class="py-3 px-4"><?php echo $coach['email']; ?></td>
                        <td class="py-3 px-4"><?php echo $coach['availableDays']; ?></td>
                        <td class="py-3 px-4"><?php echo $coach['availableTimeFrom'] . ' - ' . $coach['availableTimeTo']; ?></td>
                        <td class="py-3 px-4 text-center">
                            <span class="py-1 px-3 rounded-full text-white font-bold <?php echo $coach['status'] === 'approved' ? 'bg-green-600' : 'bg-red-600'; ?>">
                                <?php echo ucfirst($coach['status']); ?>
                            </span>
                        </td>
                        <td class="py-3 px-4 flex justify-center items-center space-x-2">
                            <a href="<?php echo $coach['qualificationsProofUrl']; ?>" download class="text-blue-500 hover:text-blue-700">
                                <i class="fa-solid fa-file-alt text-lg"></i>
                            </a>
                            <a href="<?php echo $coach['coachPhotoUrl']; ?>" download class="text-green-500 hover:text-green-700">
                                <i class="fa-solid fa-image text-lg"></i>
                            </a>
                        </td>
                        <td class="py-3 px-4 text-center">
                        <button class="approve-button bg-green-500 text-white rounded-full px-2 py-1 hover:bg-green-600 focus:outline-none focus:ring-1 focus:ring-green-400" data-coach-id="<?php echo $key; ?>">
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
        apiKey: "AIzaSyDwmg0g4J5Lk6s4MvkOP2iRiFsNrbrdRNo",
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
            var coachId = $(this).data('coach-id');
            updateStatus(coachId, 'approved');
            location.reload();

        });

        function updateStatus(coachId, status) {
            database.ref('coaches/' + coachId).update({
                status: status
            }).then(function () {
                // Update the status in the UI
                $('#coach_' + coachId + ' .status').text(status);
                $('#coach_' + coachId + ' .status').removeClass().addClass('status').addClass(status);
            }).catch(function (error) {
                console.log('Error updating status:', error);
            });
        }
    });
    $(document).ready(function () {
    $('.delete-button').click(function () {
        var coachId = $(this).data('courts-id'); // Retrieve the coachId from data-courts-id attribute
        
        // Confirm deletion (optional)
        if (confirm('Are you sure you want to delete this coach?')) {
            // Get a reference to the coach node in Firebase
            var coachRef = database.ref('coaches/' + coachId);
            
            // Remove the coach data from Firebase
            coachRef.remove()
                .then(function () {
                    // On successful deletion
                    alert('Coach deleted successfully');
                    
                    // Optionally update the UI (remove the row)
                    $('#coach_' + coachId).remove();
                })
                .catch(function (error) {
                    // Handle deletion error
                    console.error('Error deleting coach:', error);
                    alert('Failed to delete coach');
                });
        }
    });
});


</script>
<br>
<br>
<?php include 'footer.php'?>
</body>
</html>