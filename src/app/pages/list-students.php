<?php
require_once '../../../vendor/autoload.php';
include_once "../../middlewares/access.php"; 
if(!isAdmin()) header("location: ./index.php"); 

use App\model\EtudiantModel;

$studentModel = new EtudiantModel();
$allStudents = $studentModel->getAllStudents();

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
                <h1 class="text-2xl font-bold text-gray-900">Students list Overview</h1>
                <!-- <p class="text-gray-600">Requests comming from users who want be instractor.</p> -->
            </div>

            <div class="bg-white rounded-lg shadow-sm mb-4">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">firstname</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">lastname</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">phone</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">

                            <?php foreach ($allStudents as $student): ?>
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900">#<?= $student["user_id"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $student["firstname"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $student["lastname"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $student["phone"]; ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900"><?= $student["email"] ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-900 <?php echo ($student["isActive"] ? "text-green-500" : "text-red-500"); ?>"><?php echo ($student["isActive"] ? "active" : "pended"); ?></td>
                                    <td class="px-6 py-1 whitespace-nowrap text-sm text-gray-500">
                                        <div class="flex gap-2">
                                            <a href="../../process/requests/accept-request.php?user_id=<?= $student["user_id"]; ?>" class="p-1 hover:text-blue-600">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                            </a>
                                            <a href="../../process/requests/decline-request.php?user_id=<?= $student["user_id"]; ?>" class="p-1 hover:text-red-600">
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