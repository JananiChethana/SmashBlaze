<nav class="bg-white sticky top-0 z-50 shadow-md">
    <div class="container mx-auto flex justify-between items-center py-4 px-6">
        <a class="text-2xl font-bold text-gray-800" href="index.php">SmashBlaze<span class="text-red-500">.</span></a>
        <button class="text-gray-800 lg:hidden focus:outline-none focus:ring-2 focus:ring-gray-800"
                aria-label="Toggle navigation"
                @click="isOpen = !isOpen">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                 xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                           d="M4 6h16M4 12h16m-7 6h7"></path></svg>
        </button>
        <div :class="{ 'hidden': !isOpen, 'lg:flex': true }" id="navbarNav">
            <ul class="flex flex-col lg:flex-row items-center lg:space-x-6 space-y-4 lg:space-y-0 text-gray-800">
                <li><a class="text-gray-800 font-semibold hover:text-gray-600" href="index.php">Home</a></li>
                <li><a class="text-gray-800 font-semibold hover:text-gray-600" href="courts.php">Courts</a></li>
                <li><a class="text-gray-800 font-semibold hover:text-gray-600" href="couches.php">Couches</a></li>
                <li><a class="text-gray-800 font-semibold hover:text-gray-600" href="Equipment.php">Equipments</a></li>
                <li><a class="text-gray-800 font-semibold hover:text-gray-600" href="tournement.php">Tournements</a></li>
                <li><a class="text-gray-800 font-semibold hover:text-gray-600" href="news.php">News</a></li>
            </ul>
        </div>
    </div>
</nav>
