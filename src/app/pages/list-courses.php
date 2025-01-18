<?php
require_once '../../../vendor/autoload.php';
include_once "../../middlewares/access.php"; 
if(!isAdmin()) header("location: ./index.php"); 

use App\helpers\Helpers;
use App\model\CoursModel;

$coursModel = new CoursModel();
$allCourses = $coursModel->getAllCourses();

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
                <h1 class="text-2xl font-bold text-gray-900">Courses list Overview</h1>
            </div>

            <div class="bg-white rounded-lg shadow-sm mb-4">
                <!-- <div class="p-4 border-b border-gray-200">
                    <div class="flex flex-wrap items-center justify-between gap-4">
                        <h2 class="text-xl font-semibold">Recent Enrollments</h2>
                        <div class="flex gap-2">
                            <div class="relative">
                                <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Add New
                            </button>
                        </div>
                    </div>
                </div> -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">title</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">subtitle</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">description</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">created at</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">updated at</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">langues</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">type</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">created by</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">

                            <?php foreach ($allCourses as $cours): ?>
                                <?php
                                $created_at = Helpers::formatTimestamp($cours["created_at"]);
                                $updated_at = Helpers::formatTimestamp($cours["updated_at"]);
                                ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900">#<?= $cours["cours_id"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $cours["title"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $cours["subtitle"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $cours["description"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $created_at; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $updated_at ?? "N/A"; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $cours["langues"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $cours["type"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $cours["category_name"] ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex items-center gap-3">
                                            <!-- <img src="/api/placeholder/32/32" alt="" class="w-8 h-8 rounded-full"> -->
                                            <div>
                                                <div class="text-sm font-medium text-gray-900"> <?= $cours["gender"] == "male" ? "Mr," : "Mme" ?> <?= $cours["firstname"] ?> <?= $cours["lastname"] ?></div>
                                                <div class="text-sm text-gray-500"><?= $cours["email"] ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex gap-2">
                                            <a href="../../process/requests/accept-request.php?user_id=<?= $cours["user_id"]; ?>" class="p-1 hover:text-blue-600">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </a>
                                            <a href="../../process/requests/decline-request.php?user_id=<?= $cours["user_id"]; ?>" class="p-1 hover:text-red-600">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" />
                                                    <line x1="8" y1="12" x2="16" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
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