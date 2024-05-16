<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Navbar Example</title>

  <!-- Tailwind CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">

  <!-- FontAwesome CDN -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />

  <!-- Google Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@700&display=swap">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
    }

    /* Custom gradient for the logo */
    .logo-gradient {
      background: linear-gradient(45deg, #32CD32, #2E8B57);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }

    /* Custom font for the logo */
    .custom-font {
      font-family: 'Poppins', sans-serif;
    }

    /* Hover effects for logo */
    .logo-hover {
      transition: transform 0.3s ease, color 0.3s ease;
    }

    .logo-hover:hover {
      transform: scale(1.1) rotate(-5deg);
      color: #66BB6A;
    }

    /* Dropdown styling */
    .dropdown {
      display: none;
      position: absolute;
      top: 100%;
      right: 0;
      width: 200px;
      background-color: white;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      z-index: 10;
    }

    /* Dropdown link styling */
    .dropdown a {
      display: block;
      padding: 10px 16px;
      color: #4A4A4A;
      text-decoration: none;
      font-weight: normal;
      transition: background-color 0.3s ease;
    }

    .dropdown a:hover {
      background-color: #f0f0f0;
    }

    /* Show the dropdown when hovering over the group */
    .group:hover .dropdown {
      display: block;
    }
  </style>
</head>

<body>

  <!-- Navbar -->
  <nav class="bg-white sticky top-0 z-50 shadow-md">
    <div class="container mx-auto px-4 py-4 flex justify-between items-center">

      <!-- Navbar Brand -->
      <a href="index.php" class="text-2xl font-bold custom-font logo-gradient hover:text-green-700 transition duration-300 logo-hover">
        SmashBlaze
      </a>

      <!-- Navbar Toggler -->
      <button class="text-gray-700 focus:outline-none sm:hidden" id="navbar-toggler">
        <i class="fas fa-bars text-xl"></i>
      </button>

      <!-- Navbar Links -->
      <div id="navbar-links" class="hidden sm:flex items-center space-x-6">
        <a href="index.php" class="nav-link flex items-center text-gray-700 hover:text-green-500 font-semibold transition duration-300">
          <i class="fas fa-home mr-2"></i>Home
        </a>
        <a href="courts.php" class="nav-link flex items-center text-gray-700 hover:text-green-500 font-semibold transition duration-300">
          <i class="fas fa-volleyball-ball mr-2"></i>Courts
        </a>
        <a href="coaches.php" class="nav-link flex items-center text-gray-700 hover:text-green-500 font-semibold transition duration-300">
          <i class="fas fa-chalkboard-teacher mr-2"></i>Coaches
        </a>
        <a href="equipment.php" class="nav-link flex items-center text-gray-700 hover:text-green-500 font-semibold transition duration-300">
          <i class="fas fa-dumbbell mr-2"></i>Equipment
        </a>
        <a href="tournement.php" class="nav-link flex items-center text-gray-700 hover:text-green-500 font-semibold transition duration-300">
          <i class="fas fa-trophy mr-2"></i>Tournaments
        </a>
        <a href="news.php" class="nav-link flex items-center text-gray-700 hover:text-green-500 font-semibold transition duration-300">
          <i class="fas fa-newspaper mr-2"></i>News
        </a>

        <!-- Dropdown -->
        <div class="relative group">
          <button class="bg-green-500 text-white rounded-lg px-4 py-2 font-semibold transition duration-300 flex items-center">
            Join <i class="fas fa-chevron-down ml-1"></i>
          </button>

          <div class="dropdown">
            <a href="joincourtown.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-300 flex items-center">
              <i class="fas fa-basketball-ball mr-2"></i>  Court Owner
            </a>

            <a href="joincoach.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-300 flex items-center">
              <i class="fas fa-user mr-2"></i>  Coach
            </a>

            <a href="addtournament.php" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 transition duration-300 flex items-center">
              <i class="fas fa-plus-circle mr-2"></i> Post Tournament
            </a>
           
          </div>
        </div>
      </div>
    </div>
  </nav>

  <!-- JavaScript for toggler button -->
  <script>
    document.getElementById("navbar-toggler").addEventListener("click", function() {
      var navbarLinks = document.getElementById("navbar-links");
      if (navbarLinks.classList.contains("hidden")) {
        navbarLinks.classList.remove("hidden");
      } else {
        navbarLinks.classList.add("hidden");
      }
    });
  </script>

</body>

</html>
