<?php
    require __DIR__ . '/../vendor/autoload.php'; // Include Composer's autoloader

    use Kreait\Firebase\Factory;
    use Kreait\Firebase\ServiceAccount;

// Initialize Firebase
$firebase = (new Factory)
    ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
    ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/');

    $database = $firebase->createDatabase();

$data = $database->getReference('contacts')->getValue();

if (isset($_POST['delete_row'])) {
    $row_to_delete = $_POST['delete_row'];
    // Perform deletion from the database
    $database->getReference('contacts')->getChild($row_to_delete)->remove();
    // Show SweetAlert success message
    echo '<script>
            Swal.fire({
                icon: "success",
                title: "Deleted!",
                text: "Your data has been deleted successfully.",
                showConfirmButton: false,
                timer: 2500
            });
          </script>';
    // Redirect to refresh the page
    header("Refresh:1; url=".$_SERVER['PHP_SELF']);
    exit();
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.compat.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.6.0/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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


    <body class="bg-gray-100">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
    </style>
    <?php include 'nav.php'; ?>
    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-8 text-center">Data Table</h1>
        <div class="overflow-x-auto">
            <table class="table-auto w-full rounded-lg overflow-hidden shadow-lg bg-white">
                <thead class="bg-green-500 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            <i class="fas fa-user mr-2"></i>Name
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            <i class="fas fa-envelope mr-2"></i>Email
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            <i class="fas fa-comment-alt mr-2"></i>Message
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">
                            <i class="fas fa-clock mr-2"></i>Timestamp
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-semibold">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <?php foreach ($data as $key => $item): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $item['name']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $item['email']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $item['message']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?php echo $item['timestamp']; ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form method="POST" action="">
                                    <input type="hidden" name="delete_row" value="<?php echo $key; ?>">
                                    <button type="submit" class="text-red-500 ml-5 hover:text-red-700">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>