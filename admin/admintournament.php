<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tournaments</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <style>
        body{
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <?php include 'nav.php' ?>
    <div class="container mx-auto mt-8">
        <?php
        // Include the Firebase PHP SDK (assuming it's installed via Composer)
        require '../vendor/autoload.php';

        use Kreait\Firebase\Factory;
        use Kreait\Firebase\ServiceAccount;

        // Create a Firebase service account
        $serviceAccount = ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json');

        // Create a Firebase factory with the service account
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/');

        // Initialize the database
        $database = $firebase->createDatabase();

        // Handle form submissions for approve and delete actions
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Fetch POST data
            $action = $_POST['action'];
            $tournamentId = $_POST['tournamentId'];

            try {
                if ($action === 'approve') {
                    // Update the status to "approved" for the tournament
                    $database->getReference('tournaments/' . $tournamentId)
                        ->update(['status' => 'approved']);
                    echo '<div class="alert alert-success">Tournament approved successfully.</div>';
                } elseif ($action === 'delete') {
                    // Delete the tournament from the database
                    $database->getReference('tournaments/' . $tournamentId)->remove();
                    echo '<div class="alert alert-success">Tournament deleted successfully.</div>';
                }
            } catch (Exception $e) {
                // Display error message for failed action
                echo '<div class="alert alert-danger">An error occurred: ' . htmlspecialchars($e->getMessage()) . '</div>';
            }
        }

        // Fetch tournaments from the database
        try {
            $tournamentsRef = $database->getReference('tournaments');
            $tournamentsSnapshot = $tournamentsRef->getSnapshot();
            $tournamentsData = $tournamentsSnapshot->getValue();

            // Ensure tournamentsData is an array
            if ($tournamentsData === null) {
                $tournamentsData = [];
            }

            // Start HTML output
            echo '<table class="min-w-full bg-white border border-gray-200">';

            // Table header with green gradient background
            echo '<thead class="table-header" style="background: linear-gradient(to right, #2b6a4a, #1f4e1f); color: white;">';
            echo '<tr>';
            echo '<th class="py-3 px-4 text-left border-b">Tournament Name</th>';
            echo '<th class="py-3 px-4 text-left border-b">Venue</th>';
            echo '<th class="py-3 px-4 text-left border-b">Time</th>';
            echo '<th class="py-3 px-4 text-left border-b">Organization Name</th>';
            echo '<th class="py-3 px-4 text-left border-b">Contact Number</th>';
            echo '<th class="py-3 px-4 text-left border-b">Email</th>';
            echo '<th class="py-3 px-4 text-left border-b">Status</th>';
            echo '<th class="py-3 px-4 text-left border-b">Actions</th>';
            echo '</tr>';
            echo '</thead>';

            // Table body
            echo '<tbody>';
            foreach ($tournamentsData as $tournamentId => $tournament) {
                // Sanitize data to avoid XSS attacks
                $tournamentName = is_string($tournament['tournamentName']) ? htmlspecialchars($tournament['tournamentName']) : '';
                $venue = is_string($tournament['venue']) ? htmlspecialchars($tournament['venue']) : '';
                $time = is_string($tournament['time']) ? htmlspecialchars($tournament['time']) : '';
                $organizationName = is_string($tournament['organizationName']) ? htmlspecialchars($tournament['organizationName']) : '';
                $contactNumber = is_string($tournament['contactNumber']) ? htmlspecialchars($tournament['contactNumber']) : '';
                $email = isset($tournament['email']) ? htmlspecialchars($tournament['email']) : '';
                $status = is_string($tournament['status']) ? htmlspecialchars($tournament['status']) : '';

                $downloadUrl = ($tournament['regDocumentDownloadUrl'] );

                echo '<tr>';
                echo '<td class="py-2 px-4 border-b">' . $tournamentName . '</td>';
                echo '<td class="py-2 px-4 border-b">' . $venue . '</td>';
                echo '<td class="py-2 px-4 border-b">' . $time . '</td>';
                echo '<td class="py-2 px-4 border-b">' . $organizationName . '</td>';
                echo '<td class="py-2 px-4 border-b">' . $contactNumber . '</td>';
                echo '<td class="py-2 px-4 border-b">' . $email . '</td>';
                echo '<td class="py-2 px-4 border-b">' . $status . '</td>';

                // Actions
                echo '<td class="py-2 px-4 border-b flex space-x-2">';

                // Approve action
                echo '<form method="POST" action="">';
                echo '<input type="hidden" name="action" value="approve">';
                echo '<input type="hidden" name="tournamentId" value="' . urlencode($tournamentId) . '">';
                echo '<button type="submit" class="text-green-500" title="Approve">';
                echo '<i class="fas fa-check-circle"></i>';
                echo '</button>';
                echo '</form>';

                // Delete action
                echo '<form method="POST" action="">';
                echo '<input type="hidden" name="action" value="delete">';
                echo '<input type="hidden" name="tournamentId" value="' . urlencode($tournamentId) . '">';
                echo '<button type="submit" class="text-red-500" title="Delete">';
                echo '<i class="fas fa-trash-alt"></i>';
                echo '</button>';
                echo '</form>';

                // View action (for viewing the uploaded file)
                if ($downloadUrl) {
                    echo '<a href="' . $downloadUrl . '" class="text-blue-500" target="_blank" title="View Uploaded File">';
                    echo '<i class="fas fa-eye"></i> ';
                    echo '</a>';
                } else {
                    echo '<span class="text-gray-400" title="No uploaded file"><i class="fas fa-eye-slash"></i></span>';
                }
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } catch (Exception $e) {
            // Handle exceptions and errors
            echo '<div class="container mx-auto mt-8 text-red-500">';
            echo 'An error occurred: ' . $e->getMessage();
            echo '</div>';
        }
        ?>
    </div>
</body>

</html>
