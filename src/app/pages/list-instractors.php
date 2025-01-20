<?php
require_once '../../../vendor/autoload.php';
include_once "../../middlewares/access.php";
if (!isAdmin()) header("location: ./index.php");

use App\model\EnseignantModel;

$instructorModel = new EnseignantModel();
$allInstractors = $instructorModel->getAllInstructors();

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
                <h1 class="text-2xl font-bold text-gray-900">Instractors list Overview</h1>
                <!-- <p class="text-gray-600">Requests comming from users who want be instractor.</p> -->
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
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">firstname</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">lastname</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">gender</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">age</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">address</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">cin</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">phone</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">specialite</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">academic level</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">

                            <?php foreach ($allInstractors as $instractor): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900">#<?= $instractor["user_id"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $instractor["firstname"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $instractor["lastname"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $instractor["gender"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $instractor["age"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $instractor["address"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $instractor["cin"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $instractor["phone"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $instractor["email"] ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $instractor["specialite"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $instractor["academic_level"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900 <?php echo ($instractor["isActive"] ? "text-green-500" : "text-red-500"); ?>"><?php echo ($instractor["isActive"] ? "active" : "banned"); ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex gap-2">
                                            <?php if ($instractor["isActive"] == 0) { ?>
                                                <a href="../../process/users/activate-user.php?user_id=<?= $instractor["user_id"]; ?>" class="p-1 hover:text-blue-600">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                    </svg>
                                                </a>
                                            <?php } ?>

                                            <?php if ($instractor["isActive"] == 1) { ?>
                                                <a href="../../process/users/ban-user.php?user_id=<?= $instractor["user_id"]; ?>" class="p-1 hover:text-red-600">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <circle cx="12" cy="12" r="9" stroke="currentColor" stroke-width="2" />
                                                        <line x1="8" y1="12" x2="16" y2="12" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                                                    </svg>
                                                </a>
                                            <?php } ?>

                                            <a href="../../process/users/delete-user.php?user_id=<?= $instractor["user_id"]; ?>" class="p-1 hover:text-red-600">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7L5 7M10 11v6M14 11v6M6 7v12a2 2 0 002 2h8a2 2 0 002-2V7M9 7V5a2 2 0 012-2h2a2 2 0 012 2v2" />
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