<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Page</title>

    <link rel="stylesheet" href="./css/admin.css">
    <link rel="stylesheet" href="./css/boostrap.min.css">
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/owl.theme.default.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Firebase -->
    <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-firestore.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-storage.js"></script>

    <!-- Firebase configuration -->
    <script src="./js/firebase.js"></script>

    <!--admin JavaScript file -->
    <script src="./js/admin.js"></script>
</head>

<body data-bs-spy="scroll" data-bs-target=".navbar">

    <!---- NAVBAR ----> 

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
       <div class="container">
        <a class="navbar-brand" href="#">SmashBlaze Demo<span>.</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav  ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="admin.html">Couches </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Courts</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Equipments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="admintournament.php">Tournements</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">News</a>
            </li>
          </ul>
          
        </div>

       </div>
    </nav>

    <!---Hero Start-->

    <footer>
      <div class="footer-top">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 mx-auto">
              <h1><a class="navbar-brand" href="#">ADMIN PAGE</a></h1>
            </div>
          </div>
        </div>
      </div>
    </footer>
    
    <!-- Display Coach Data -->
    <div id="coachData">
      
    </div>
    <!-- Add your UI elements for updating and deleting data if needed -->
   <!-- <script>
        // Initialize Firebase if not already initialized (you can move this to your firebase.js file)
        if (!firebase.apps.length) {
            firebase.initializeApp(firebaseConfig);
        }
    </script> --> 
    <script src="./js/admin.js"></script>
</body>
</html>
