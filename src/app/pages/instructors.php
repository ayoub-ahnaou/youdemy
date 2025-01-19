<?php
require_once '../../../vendor/autoload.php';
include_once "../../middlewares/access.php";

use App\model\EnseignantModel;

$instructorModel = new EnseignantModel();
$allInstractors = $instructorModel->getAllInstructors();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Instructors</title>
    <link rel="stylesheet" href="../css/input.css">
    <link rel="stylesheet" href="../css/output.css">
</head>

<body class="flex flex-col min-h-screen">
    <?php require_once "../components/navbar.php"; ?>
    <div class="flex flex-col flex-grow container mx-auto">
        <h2 class="text-2xl font-bold text-gray-900 p-4">Instractors</h2>

        <div class="grid grid-cols-2 max-md:grid-cols-1 w-full h-full mb-6">
            <?php foreach ($allInstractors as $instractor) : ?>
                <div class="p-1 w-full">
                    <div class="bg-white rounded-lg shadow-lg p-2">
                        <div class="flex items-start">
                            <!-- Instructor Image -->
                            <div class="w-12 flex-shrink-0">
                                <img
                                    src="../assets/img/<?= $instractor["gender"] == "male" ? "instractor" : "instractrice" ?>.png"
                                    alt="Instructor"
                                    class="w-full h-full rounded-lg object-cover" />
                            </div>

                            <!-- Instructor Information -->
                            <div class="ml-6 flex-grow">
                                <!-- Name and Academic Level -->
                                <div class="flex justify-between items-start ">
                                    <h3 class="text-md font-semibold text-gray-800"><?= $instractor["gender"] == "male" ? "Mr." : "Mme." ?> <?= $instractor["firstname"] ?> <?= $instractor["lastname"] ?></h3>
                                    <span class="px-3 py-1 bg-red-100 text-red-800 text-xs font-medium rounded-full">
                                        <?= $instractor["academic_level"] ?>
                                    </span>
                                </div>

                                <div class="flex justify-between ">
                                    <!-- Specialization -->
                                    <p class="text-gray-600 font-medium h-full text-sm mb-4"><?= $instractor["specialite"] ?></p>
    
                                    <!-- Stats Grid -->
                                    <div class="grid grid-cols-1 gap-4 h-full">
                                        <!-- Age -->
                                        <div class="flex items-center">
                                            <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                            <span class="text-sm text-gray-600">Age: <span class="font-medium"><?= $instractor["age"] ?></span></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php require_once "../components/footer.php"; ?>
</body>

</html>