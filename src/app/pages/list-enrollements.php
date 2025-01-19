<?php
require_once '../../../vendor/autoload.php';
include_once "../../middlewares/access.php";
if (!isAdmin()) header("location: ./index.php");

use App\model\EnrollementModel;

$enrollModel = new EnrollementModel();
$enrollements = $enrollModel->getAllEnrollements();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy Admin Dashboard - Enrollements</title>
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
                <h1 class="text-2xl font-bold text-gray-900">Enrollements list Overview</h1>
                <!-- <p class="text-gray-600">Requests comming from users who want be instractor.</p> -->
            </div>

            <div class="bg-white rounded-lg shadow-sm mb-4">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">student</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">course</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">date enrollements</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">options</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">

                            <?php foreach ($enrollements as $enroll): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900">#<?= $enroll["enroll_id"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $enroll["lastname"]; ?> <?= $enroll["firstname"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $enroll["email"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900">
                                        <div class="flex gap-1">
                                            <a href="./details-cours.php?cours_id=<?= $enroll["cours_id"]; ?>">
                                                <img class="h-12" src="../../../<?= $enroll["image"]; ?>" alt="<?= $enroll["title"]; ?>">
                                            </a>
                                            <div class="flex flex-col">
                                                <p class="h-full font-bold"><?= $enroll["title"]; ?></p>
                                                <p class="h-full text-xs"><?= $enroll["subtitle"]; ?></p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $enroll["created_at"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-xs text-gray-500">
                                        <div class="flex gap-2">
                                            <a href="../../process/enrollements/delete-enrollement.php?enroll_id=<?= $enroll["enroll_id"]; ?>" class="p-1 hover:text-red-600 flex items-center">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7L5 7M10 11v6M14 11v6M6 7v12a2 2 0 002 2h8a2 2 0 002-2V7M9 7V5a2 2 0 012-2h2a2 2 0 012 2v2" />
                                                </svg>
                                                <span>Delete</span>
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