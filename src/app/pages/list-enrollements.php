<?php
require_once '../../../vendor/autoload.php';
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