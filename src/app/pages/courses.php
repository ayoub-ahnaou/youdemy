<?php
require_once '../../../vendor/autoload.php';
include_once "../../middlewares/access.php";

use App\helpers\Helpers;
use App\model\CategoryModel;
use App\model\CoursModel;

$coursModel = new CoursModel();
$courses = $coursModel->searchForCourses("");
$search = "";

$categoryModel = new CategoryModel();
$categories = $categoryModel->getAllCategories();

if (isset($_GET["page"])) $page = $_GET["page"];
else $page = 1;

$courses = $coursModel->getCoursesFiltered($page);
$nbreCoursePerPage = CoursModel::$coursParPage;
$nbreCourses = $coursModel->nbreCourses();

$nbrePages = ceil($nbreCourses / $nbreCoursePerPage);

if(isset($_GET["category"])) {
    $category = intval($_GET["category"]);
    $courses = $coursModel->getCoursesFiltered($page, $category);
} else {
    $courses = $coursModel->getCoursesFiltered($page);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = Helpers::filterInput($_POST["search"]);
    $courses = $coursModel->searchForCourses($search);
}


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
    <form method="post" class="flex w-full container mx-auto my-4 px-4">
        <input
            type="text"
            value="<?= $search; ?>"
            name="search"
            placeholder="Search..."
            class="flex-1 px-4 py-2 text-gray-700 placeholder-gray-400 bg-gray-100 border border-gray-300 rounded-l-md" />
        <button
            type="submit"
            class="px-4 py-2 font-medium text-white bg-black rounded-r-md hover:bg-gray-800">
            Search
        </button>
    </form>

    <hr>

    <!-- Main Content -->
    <form method="GET" class="flex-1 container mx-auto px-4 py-8">
        <!-- Filters and Sort -->
        <div class="w-full mb-8 flex gap-1 flex-wrap text-gray-700">
            <a href="./courses.php" class="bg-gray-100 hover:bg-gray-200 cursor-pointer items-center px-6" value="">All</a>
            <?php foreach ($categories as $category) : ?>
                <a href="./courses.php?category=<?= $category["category_id"] ?>" class="bg-gray-100 hover:bg-gray-200 cursor-pointer items-center px-6" value=""><?= $category["category_name"] ?></a>
            <?php endforeach; ?>
        </div>

        <!-- Course Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php foreach ($courses as $cours) : ?>
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

            <?php if (sizeof($courses) == 0) { ?>
                <div class="flex-grow text-red-500">
                    <p>not result found !</p>
                </div>
            <?php } ?>
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center items-center gap-2 text-xs">
            <?php if ($page > 1) {
                $previous = $page - 1; ?>
                <a href="?page=<?= $previous; ?>" class="size-6 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-gray-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            <?php } ?>

            <?php if ($page == 1) { ?>
                <a class="size-6 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-gray-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
            <?php } ?>

            <?php for ($i = 1; $i <= $nbrePages; $i++) : ?>
                <?php if($page == $i): ?>
                    <a href="?page=<?= $i; ?>" class="size-6 rounded-lg border-gray-300 bg-red-500 text-white flex items-center justify-center"><?= $i; ?></a>
                <?php else: ?>
                        <a href="?page=<?= $i; ?>" class="size-6 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-gray-100"><?= $i; ?></a>
                <?php endif; ?>
            <?php endfor; ?>

            <!-- <span class="px-2">...</span> -->

            <?php if ($page < $nbrePages) {
                $next = $page + 1; ?>
                <a href="?page=<?= $next; ?>" class="size-6 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-gray-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            <?php } ?>

            <?php if ($page == $nbrePages) { ?>
                <a class="size-6 rounded-lg border border-gray-300 flex items-center justify-center hover:bg-gray-100">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            <?php } ?>

        </div>
    </form>

    <!-- Footer -->
    <?php require_once "../components/footer.php"; ?>
</body>

</html>