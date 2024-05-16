<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Advanced Footer</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Include Animate.css for animations -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
</head>


    <footer class="bg-gray-800 py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About Us -->
                <div class="flex flex-col animate__animated animate__fadeInUp">
                    <h3 class="text-xl font-semibold mb-4 text-green-400">About Us</h3>
                    <p class="mb-4 text-gray-300">
                        We are a company passionate about providing the best services to our customers. Our goal is to innovate and excel in everything we do.
                    </p>
                    <a href="#" class="text-green-400 hover:underline transition-transform duration-300">Learn More</a>
                </div>

                <!-- Quick Links -->
                <div class="flex flex-col animate__animated animate__fadeInUp animate__delay-1s">
                    <h3 class="text-xl font-semibold mb-4 text-green-400">Quick Links</h3>
                    <ul class="space-y-2 text-slate-50	">
                        <li><a href="index.php" class=" text-slate-50	hover:text-green-400 hover:underline transition-transform duration-300">Home</a></li>
                        <li><a href="show_coches.php" class=" text-slate-50	 hover:text-green-400 hover:underline transition-transform duration-300">Coaches</a></li>
                        <li><a href="courts.php" class="text-slate-50	 hover:text-green-400 hover:underline transition-transform duration-300">Courts</a></li>
                        <li><a href="admintournament.php" class="text-slate-50	hover:text-green-400 hover:underline transition-transform duration-300">Tournaments</a></li>
                        <li><a href="add_news.php" class="text-slate-50	hover:text-green-400 hover:underline transition-transform duration-300">News</a></li>
                        <li><a href="orders.php" class="text-slate-50	hover:text-green-400 hover:underline transition-transform duration-300">Orders</a></li>
                        <li><a href="contact.php" class="text-slate-50	hover:text-green-400 hover:underline transition-transform duration-300">Contact</a></li>
                    </ul>
                </div>

                <!-- Newsletter Subscription -->
                <div class="flex flex-col animate__animated animate__fadeInUp animate__delay-2s">
                    <h3 class="text-xl font-semibold mb-4 text-green-400">Newsletter</h3>
                    <p class="mb-4 text-gray-300">Stay updated with our latest news and promotions.</p>
                    <div class="relative">
                        <input type="email" placeholder="Enter your email" class="bg-gray-700 text-white py-2 px-4 w-full rounded-md focus:outline-none focus:ring focus:ring-green-400">
                        <button class="absolute right-0 top-0 bg-green-400 text-gray-900 py-2 px-4 rounded-md hover:bg-green-500 transition duration-300">Subscribe</button>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="flex flex-col animate__animated animate__fadeInUp animate__delay-3s items-center">
                    <h3 class="text-xl font-semibold mb-4 text-green-400">Follow Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="text-2xl text-green-400 hover:scale-110 transition-transform duration-300" title="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-2xl text-green-400 hover:scale-110 transition-transform duration-300" title="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-2xl text-green-400 hover:scale-110 transition-transform duration-300" title="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-2xl text-green-400 hover:scale-110 transition-transform duration-300" title="LinkedIn">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Copyright Section -->
            <div class="mt-12 border-t border-gray-700 pt-4 text-center">
                <p class="text-gray-400">&copy; <?php echo date('Y'); ?> SmashBlaze. All rights reserved.</p>
            </div>
        </div>
    </footer>


</html>
