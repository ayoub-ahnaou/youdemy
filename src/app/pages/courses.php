<?php
require_once '../../../vendor/autoload.php';
include_once "../../middlewares/access.php"; 

use App\model\CoursModel;

$coursModel = new CoursModel();
$courses = $coursModel->getAllCourses();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - All Courses</title>

    <link rel="stylesheet" href="../css/input.css">
    <link rel="stylesheet" href="../css/output.css">
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <?php require_once "../components/navbar.php"; ?>

    <!-- Header with Search -->
    <div class="flex w-full container mx-auto my-4 px-4">
        <input
            type="text"
            placeholder="Search..."
            class="flex-1 px-4 py-2 text-gray-700 placeholder-gray-400 bg-gray-100 border border-gray-300 rounded-l-md" />
        <button
            class="px-4 py-2 font-medium text-white bg-black rounded-r-md hover:bg-gray-800">
            Search
        </button>
    </div>

    <hr>

    <!-- Main Content -->
    <main class="flex-1 container mx-auto px-4 py-8">
        <!-- Filters and Sort -->
        <div class="flex items-center justify-between mb-8">
            <div class="flex gap-4">
                <select class="px-4 py-2 rounded-lg border border-gray-300 bg-white">
                    <option>All Categories</option>
                    <option>Development</option>
                    <option>Business</option>
                    <option>Design</option>
                    <option>Marketing</option>
                </select>
                <select class="px-4 py-2 rounded-lg border border-gray-300 bg-white">
                    <option>All Levels</option>
                    <option>Beginner</option>
                    <option>Intermediate</option>
                    <option>Advanced</option>
                </select>
            </div>
            <select class="px-4 py-2 rounded-lg border border-gray-300 bg-white">
                <option>Most Popular</option>
                <option>Highest Rated</option>
                <option>Newest</option>
                <option>Price: Low to High</option>
                <option>Price: High to Low</option>
            </select>
        </div>

        <!-- Course Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Course Cards (repeated 12 times) -->
            <!-- Card 1 -->
            <?php foreach($courses as $cours) : ?>
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow group">
                <a href="./details-cours.php?cours_id=<?= $cours["cours_id"] ?>" class="relative">
                    <img src="../../../<?= $cours["image"] ?>" alt="Course thumbnail" class="w-full h-48 object-cover rounded-t-lg">
                </a>
                <div class="p-4">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded">Bestseller</span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2"><?= $cours["title"] ?>: <?= $cours["subtitle"] ?></h3>
                    <p class="text-sm text-gray-600 mb-2"><?= $cours["gender"] == "male" ? "Mme." : "Dr." ?> <?= $cours["firstname"] ?> <?= $cours["lastname"] ?></p>
                    <div class="flex items-center justify-between mb-1">
                        <span class="text-amber-700 font-semibold text-xs"><?= $cours["created_at"] ?></span>
                        <span class="text-gray-500 text-xs">langue: <?= $cours["langues"] ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            <!-- Repeat similar cards with different content -->
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center items-center gap-2 text-sm">
            <button class="w-8 h-8 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-gray-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button class="w-8 h-8 rounded-lg bg-red-500 text-white flex items-center justify-center">1</button>
            <button class="w-8 h-8 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-gray-100">2</button>
            <button class="w-8 h-8 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-gray-100">3</button>
            <span class="px-2">...</span>
            <button class="w-8 h-8 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-gray-100">12</button>
            <button class="w-8 h-8 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-gray-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
        </div>
    </main>

    <!-- Footer -->
    <?php require_once "../components/footer.php"; ?>
</body>

</html>