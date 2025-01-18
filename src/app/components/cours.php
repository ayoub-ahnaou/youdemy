<?php
require_once "../../../vendor/autoload.php";

use App\model\CoursModel;

$coursModel = new CoursModel();
$courses = $coursModel->getLastCoursAdded();

?>

<div class="container mx-auto p-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Last Added Courses</h2>

    <div class="relative">
        <!-- Course Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4">
            <?php foreach ($courses as $cours) : ?>
                <!-- Course Card 1 -->
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
        </div>
    </div>
</div>