<nav class="bg-gray-800 text-white shadow-md sticky top-0 z-10">
    <div class="container mx-auto px-4 flex items-center justify-between h-16">
        <!-- Left Section: Logo -->
        <div class="flex items-center">
            <a href="http://localhost/youdemy/src/app/pages/index.php" class="text-red-500 text-lg font-bold">Youdemy</a>
            <span class="text-gray-300 ml-2 text-xs">Your eLearning Platform</span>
        </div>

        <!-- Center Section: Navigation Links -->
        <div class="flex max-md:hidden space-x-6">
            <a href="./courses.php" class="hover:text-red-500 text-gray-300 px-3 py-2 rounded-md text-xs">Courses</a>
            <a href="./instructors.php" class="hover:text-red-500 text-gray-300 px-3 py-2 rounded-md text-xs">Instructors</a>
            <a href="./about.php" class="hover:text-red-500 text-gray-300 px-3 py-2 rounded-md text-xs">About Us</a>
            <a href="./contact.php" class="hover:text-red-500 text-gray-300 px-3 py-2 rounded-md text-xs">Contact</a>
        </div>

        <!-- Right Section: Icons -->
        <div class="flex max-md:hidden items-center space-x-4">
            <!-- login Icon -->
            <a href="./login.php" class="flex items-center gap-2">
                <img src="../assets/svgs/login.svg" class="h-5" alt="">
                <span class="text-xs">Login</span>
            </a>

            <!-- logout icon -->
            <a href="./login.php" class="flex items-center gap-2">
                <img src="../assets/svgs/logout.svg" class="h-5" alt="">
                <span class="text-xs">Logout</span>
            </a>

            <!-- profile icon -->
            <a href="./login.php" class="flex items-center gap-2">
                <img src="../assets/svgs/profile.svg" class="h-4" alt="">
                <span class="text-xs">Profile</span>
            </a>

            <!-- profile icon -->
            <a href="./login.php" class="flex items-center gap-2">
                <img src="../assets/svgs/dashboard.svg" class="h-5" alt="">
                <span class="text-xs">Dashboard</span>
            </a>

            <!-- notification icon -->
            <a href="./login.php" class="flex items-center gap-2 relative">
                <img src="../assets/svgs/notification.svg" class="h-4" alt="">
                <span class="text-sm">Notifications</span>
                <span class="bg-pink-500 rounded-full px-1 absolute -top-1 -right-1 text-[10px]">0</span>
            </a>
        </div>
    </div>
</nav>