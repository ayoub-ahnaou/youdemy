<?php

use App\model\StatistiquesModel;

require_once '../../../vendor/autoload.php';
include_once "../../middlewares/access.php"; 
if(!isAdmin()) header("location: ./index.php");

$statsModel = new StatistiquesModel();
$countStudents = $statsModel->getTotalStudents();
$totalInstractors = $statsModel->getTotalInstractors();
$countCourses = $statsModel->getTotalCourses();
$topCourse = $statsModel->getTopPerformingCourse();
$topInstractors = $statsModel->getTopThreeInstarctors();
$coursesInEachCategory = $statsModel->getNumberCoursesInCategory();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Admin Dashboard</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/input.css">
</head>

<body class="bg-gray-100">
    <!-- Top Navigation Bar -->
    <?php require_once "../components/navbar.php"; ?>

    <!-- Sidebar and Main Content Container -->
    <div class="flex flex-grow">
        <!-- Sidebar -->
        <?php require_once "../components/aside.php"; ?>

        <!-- Main Content -->
        <main class="flex-1 ml-0 lg:ml-64 p-4">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Dashboard Overview</h1>
                <p class="text-gray-600">Welcome back, manage your platform here.</p>
            </div>

            <!-- Stats Cards -->
            <?php require_once "../components/admin-stats-top.php"; ?>

            <?php require_once "../components/admin-stats-bottom.php"; ?>
        </main>
    </div>
</body>

</html>