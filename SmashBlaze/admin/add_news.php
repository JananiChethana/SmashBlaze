<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
</head>

<body class="bg-gray-100">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
</style>

    <?php include 'nav.php'; ?>

    <div class="container mx-auto py-8">
        <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold mb-6">Add New News</h2>

            <?php
            // Load Firebase dependencies and classes
            require_once '../vendor/autoload.php';
            use Kreait\Firebase\Factory;
            use Kreait\Firebase\ServiceAccount;
            use Kreait\Firebase\Exception\FirebaseException;

            // Initialize Firebase
            $firebase = (new Factory)
            ->withServiceAccount(ServiceAccount::fromJsonFile('smashblaz-1f665-firebase-adminsdk-wd70g-207648125f.json'))
            ->withDatabaseUri('https://smashblaz-1f665-default-rtdb.firebaseio.com/');
        $database = $firebase->createDatabase();
        $storage = $firebase->createStorage();
        
       
            
            // Retrieve news data from Firebase Realtime Database
            try {
                $newsReference = $database->getReference('news');
                $newsDataSnapshot = $newsReference->getSnapshot();
                $newsData = $newsDataSnapshot->getValue();
                if (!$newsData) {
                    $newsData = [];
                }
            } catch (FirebaseException $e) {
                echo '<script>Swal.fire("Error", "Failed to fetch news data: ' . $e->getMessage() . '", "error");</script>';
                $newsData = [];
            }

            // Handle form submission
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Retrieve form data
                $title = $_POST['title'];
                $datetime = $_POST['datetime'];
                $tags = $_POST['tags'];
                $content = $_POST['content'];

                // Handle image upload
                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $imageFile = $_FILES['image']['tmp_name'];
                    $imageName = $_FILES['image']['name'];

                    try {
                        // Upload the image file to Firebase Storage
                        $bucket = $storage->getBucket();
                        $imagePath = 'news_images/' . $imageName;
                        $file = fopen($imageFile, 'r');
                        $object = $bucket->upload($file, [
                            'name' => $imagePath,
                            'metadata' => [
                                'contentType' => $_FILES['image']['type'],
                            ]
                        ]);

                        $image_url = $object->signedUrl(new \DateTime('+5 years'));

                    } catch (FirebaseException $e) {
                        echo '<script>Swal.fire("Error", "Image upload failed: ' . $e->getMessage() . '", "error");</script>';
                        exit;
                    }
                } else {
                    echo '<script>Swal.fire("Error", "Image upload failed.", "error");</script>';
                    exit;
                }

                // Store data in Firebase Realtime Database
                try {
                    $data = [
                        'title' => $title,
                        'datetime' => $datetime,
                        'tags' => explode(',', $tags),
                        'content' => $content,
                        'image_url' => $image_url,
                    ];
                    $database->getReference('news')->push($data);
                    
                    echo '<script>
                    Swal.fire({
                        title: "Success",
                        text: "News Added successfully.",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 1500 // Adjust the timer as needed (1500ms = 1.5 seconds)
                    }).then(() => {
                        window.location.href = "http://localhost/SmashBlaze/admin/add_news.php"; // Replace with your desired URL
                    });
                </script>';
                } catch (FirebaseException $e) {
                    echo '<script>Swal.fire("Error", "Failed to store data: ' . $e->getMessage() . '", "error");</script>';
                    exit;
                }
            }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="grid grid-cols-2 gap-6">
                    <!-- Title -->
                    <div>
                        <label for="title" class="block text-gray-600 font-medium mb-2">Title</label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                                <i class="fas fa-edit text-gray-400"></i>
                            </span>
                            <input type="text" id="title" name="title" class="form-input w-full pl-10 pr-4 py-2 rounded-md border border-green-300 focus:border-green-500 focus:ring-2 focus:ring-green-200" placeholder="Enter post title..." required>
                        </div>
                    </div>

                    <!-- Date and Time -->
                    <div>
                        <label for="datetime" class="block text-gray-600 font-medium mb-2">Date and Time</label>
                        <div class="relative">
                            <input type="text" id="datetime" name="datetime" placeholder="Select date and time..." class="form-input w-full bg-white border border-gray-300 text-gray-700 py-3 px-4 pr-8 rounded-md focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200" required>
                            <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M10 12l-6-6h12l-6 6z"></path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Upload Image -->
                    <div>
    <label for="image" class="block text-gray-600 font-medium mb-2">Upload Image</label>
    <div class="relative border-dashed border-2 border-gray-300 rounded-md">
        <input type="file" id="image" name="image" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" accept="image/*" required onchange="displayFileName(this)">
        <div class="flex flex-col items-center justify-center h-32 text-center pointer-events-none select-none">
            <i class="fas fa-cloud-upload-alt text-gray-400 text-4xl mb-2"></i>
            <span class="text-gray-600">Click to upload or drag and drop</span>
        </div>
    </div>
    <p class="text-xs text-gray-500 mt-1">Max file size: 5MB</p>
    <p id="filenameDisplay" class="text-xs text-gray-500 mt-1">File Name: </p>
</div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-gray-600 font-medium mb-2">Content</label>
                        <textarea id="content" name="content" class="form-input w-full h-32 px-3 py-2 rounded-md border border-gray-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-200" required></textarea>
                    </div>

                    <!-- Tags -->
                    <div>
                        <label for="tags" class="block text-gray-600 font-medium mb-2">Tags</label>
                        <div class="relative">
                            <input type="text" id="tags" name="tags" class="form-input w-full pl-10 pr-4 py-2 rounded-md border border-green-300 focus:border-green-500 focus:ring-2 focus:ring-green-200" placeholder="Add tags separated by commas..." required>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-tags text-gray-400"></i>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-span-2 flex justify-center">
                        <button type="submit" class="bg-green-500 text-white py-2 px-6 rounded-md hover:bg-blue-600 flex items-center justify-center">
                            <i class="fas fa-paper-plane mr-2"></i>
                            Publish
                        </button>
                    </div>
                </div>
            </form>

            <div class="mt-10">
                <h3 class="text-2xl font-semibold mb-4">News Table</h3>
                <table class="w-full bg-white shadow rounded-lg overflow-hidden">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Title</th>
                            <th class="py-3 px-6 text-left">Date and Time</th>
                            <th class="py-3 px-6 text-left">Image</th>
                            <th class="py-3 px-6 text-left">Tags</th>
                            <th class="py-3 px-6 text-left">Content</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    <?php
if (count($newsData) > 0) {
    foreach ($newsData as $key => $news) {
        // Truncate the content to show only the first four words
        $fullContent = htmlspecialchars($news['content']);
        $words = explode(' ', $fullContent);
        $firstFourWords = implode(' ', array_slice($words, 0, 6));

        echo '<tr class="border-b border-gray-200 hover:bg-gray-100">';
        echo '<td class="py-3 px-6 text-left">' . htmlspecialchars($news['title']) . '</td>';
        echo '<td class="py-3 px-6 text-left">' . htmlspecialchars($news['datetime']) . '</td>';
        echo '<td class="py-3 px-6 text-left"><img src="' . htmlspecialchars($news['image_url']) . '" alt="' . htmlspecialchars($news['title']) . '" class="w-16 h-16 rounded-md"></td>';
        echo '<td class="py-3 px-6 text-left">' . htmlspecialchars(implode(', ', $news['tags'])) . '</td>';
        echo '<td class="py-3 px-6 text-left">' . $firstFourWords . '...</td>';
        echo '<td class="py-3 px-6 text-center">';
        echo '<a href="?delete=' . urlencode($key) . '" class="text-red-500 hover:text-red-700">';
        echo '<i class="fas fa-trash"></i>';
        echo '</a>';
        echo '</td>';
        echo '</tr>';
    }
} else {
    echo '<tr><td colspan="6" class="py-4 text-center">No news data found.</td></tr>';
}
?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Flatpickr script for date and time input -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
  
  function displayFileName(input) {
        const fileName = input.files[0].name; // Get the name of the selected file
        const fileNameDisplay = document.getElementById('filenameDisplay');
        fileNameDisplay.textContent = `File Name: ${fileName}`; // Display the file name in the specified element
    }

        flatpickr("#datetime", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
        });

        // Handle delete action
        document.querySelectorAll('.fa-trash').forEach((deleteIcon) => {
            deleteIcon.addEventListener('click', (event) => {
                event.preventDefault();
                const href = event.target.closest('a').href;
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to delete this news item?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });
    </script>

<?php
// Handle delete action
if (isset($_GET['delete'])) {
    $newsKey = $_GET['delete'];
    try {
        // Remove the news item from the database
        $database->getReference('news')->getChild($newsKey)->remove();

        // Echo the SweetAlert script
        echo '<script>
            Swal.fire({
                title: "Success",
                text: "News item deleted successfully.",
                icon: "success",
                showConfirmButton: false,
                timer: 1500 // Adjust the timer as needed (1500ms = 1.5 seconds)
            }).then(() => {
                window.location.href = "http://localhost/SmashBlaze/admin/add_news.php"; // Replace with your desired URL
            });
        </script>';
    } catch (FirebaseException $e) {
        // Handle errors
        echo '<script>Swal.fire("Error", "Failed to delete news item: ' . htmlspecialchars($e->getMessage()) . '", "error");</script>';
    }
}
?>


    <?php include 'footer.php'; ?>

</body>
</html>
