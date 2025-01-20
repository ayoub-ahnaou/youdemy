<?php
require_once '../../../vendor/autoload.php';
include_once "../../middlewares/access.php"; 
if(!isAdmin()) header("location: ./index.php"); 

use App\model\CategoryModel;

$categoryModel = new CategoryModel();
$allCategories = $categoryModel->getAllCategories();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Admin Dashboard - Requests</title>
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/input.css">
</head>

<body class="bg-gray-100">
    <!-- Top Navigation Bar -->
    <?php require_once "../components/navbar.php"; ?>

    <!-- Sidebar and Main Content Container -->
    <div class="flex flex-grow flex-col">
        <!-- Sidebar -->
        <?php require_once "../components/aside.php"; ?>

        <!-- Main Content -->
        <main class="flex-1 ml-0 lg:ml-64 p-4">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Categories list Overview</h1>
                <!-- <p class="text-gray-600">Requests comming from users who want be instractor.</p> -->
            </div>

            <div class="bg-white rounded-lg shadow-sm mb-4">
                <div class="p-4 border-b border-gray-200">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <div class="flex gap-2 text-xs">
                            <a href="../../process/categories/add-category.php" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add New
                            </a>
                        </div>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">image</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">

                            <?php foreach ($allCategories as $category): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900">#<?= $category->__get("category_id") ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $category->__get("category_name") ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900">
                                        <img src="../../../<?= $category->__get("image") ?>" class="h-10" alt="">
                                    </td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex gap-2">
                                            <a href="../../process/categories/delete-category.php?category_id=<?= $category->__get("category_id") ?>" class="p-1 hover:text-red-600">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7L5 7M10 11v6M14 11v6M6 7v12a2 2 0 002 2h8a2 2 0 002-2V7M9 7V5a2 2 0 012-2h2a2 2 0 012 2v2" />
                                                </svg>
                                            </a>

                                            <a href="../../process/categories/edit-category.php?category_id=<?= $category->__get("category_id") ?>" class="p-1 hover:text-blue-600">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 4h2m4.2 0.8l-9 9a2 2 0 00-.6 1.4v3.8a1 1 0 001 1h3.8a2 2 0 001.4-.6l9-9a2 2 0 000-2.8l-2.8-2.8a2 2 0 00-2.8 0z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>