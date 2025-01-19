<?php
require "../../middlewares/access.php";

use App\model\CoursModel;

$coursModel = new CoursModel();
$courses = $coursModel->getCoursesEnrolledOfUser($_SESSION["user_id"]);
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Cours Inscrits</title>
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/input.css">
</head>

<body class="bg-gray-100 flex flex-col min-h-screen">
    <?php require_once "../components/navbar.php"; ?>
    <div class="container mx-auto px-4 py-8 flex-grow">
        <!-- En-tête du profil -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Mes Cours Inscrits</h1>
            <p class="text-gray-600">Gérez et suivez vos cours</p>
        </div>

        <!-- Grille des cours -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
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

            <?php if(sizeof($courses) == 0) { ?>
                <div class="text-red-500">You have no courses at the moment!</div>
            <?php } ?>
        </div>
    </div>

    <?php require_once "../components/footer.php"; ?>
</body>

</html>