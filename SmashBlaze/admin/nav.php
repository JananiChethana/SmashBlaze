<nav class="bg-gradient-to-r from-green-400 to-green-600 sticky-top shadow-lg">
    <div class="container mx-auto flex justify-between items-center p-4">
        <a class="text-2xl font-bold text-white" href="index.php">
            SmashBlaze<span class="text-yellow-400">.</span>
        </a>
        <div class="flex items-center">
            <!-- Mobile menu toggle button -->
            <button id="navbar-toggler" class="md:hidden text-white" aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 11a.5.5 0 010-1h11a.5.5 0 010 1h-11zm0-4a.5.5 0 010-1h11a.5.5 0 010 1h-11z"></path>
                </svg>
            </button>
            <!-- Navbar items -->
            <div id="navbarNav" class="hidden md:flex flex-col md:flex-row md:items-center md:justify-end md:space-x-6">
                <a class="nav-link text-white hover:text-yellow-300 transition-colors duration-300" href="show_coches.php">
                    Coaches <i class="fas fa-user ml-1"></i>
                </a>
                <a class="nav-link text-white hover:text-yellow-300 transition-colors duration-300" href="courts.php">
                    Courts <i class="fas fa-house ml-1"></i>
                </a>
                <select class="nav-select text-white border rounded p-2 bg-green-700 hover:bg-green-800 transition-colors duration-300" onchange="window.location.href=this.value;">
                    <option value="">Select Equipments</option>
                    <option value="add_products.php">Add Equipments</option>
                    <option value="products_list.php">Equipments List</option>
                </select>
                <a class="nav-link text-white hover:text-yellow-300 transition-colors duration-300" href="admintournament.php">
                    Tournaments <i class="fas fa-trophy ml-1"></i>
                </a>
                <a class="nav-link text-white hover:text-yellow-300 transition-colors duration-300" href="add_news.php">
                    News <i class="fas fa-newspaper ml-1"></i>
                </a>
                <a class="nav-link text-white hover:text-yellow-300 transition-colors duration-300" href="orders.php">
                    Orders <i class="fas fa-box ml-1"></i>
                </a>
                <a class="nav-link text-white hover:text-yellow-300 transition-colors duration-300" href="contact.php">
                    Contacts <i class="fas fa-envelope ml-1"></i>
                </a>
                <a class="nav-link text-white bg-red-600 hover:bg-red-700 transition-colors duration-300 p-2 rounded cursor-pointer" onclick="confirmLogout()">
    Logout <i class="fas fa-sign-out-alt ml-1"></i>
</a>

            </div>
        </div>
    </div>
</nav>

<script>
function confirmLogout() {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will be logged out and redirected to the login page.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, log me out!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // User clicked "Yes"
            window.location.href = "login.php";
        }
        // Otherwise, do nothing (the user canceled)
    });
}
</script>