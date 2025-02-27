<?php
require_once "../../../vendor/autoload.php";
include_once "../../middlewares/access.php"; 
if(!isAuth()) header("location: ./login.php"); 

use App\model\CoursModel;
use App\model\EnrollementModel;
use App\model\TagsCoursesModel;

$cours_id = isset($_GET["cours_id"]) ? $_GET["cours_id"] : '';
$coursModel = new CoursModel();
$cours = $coursModel->getCourseById($cours_id);

$tagModel = new TagsCoursesModel();
$tags = $tagModel->getTagsByCoursID($cours_id);

$enrollModel = new EnrollementModel();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Details cours</title>
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/input.css">
</head>

<body class="flex flex-col min-h-screen">
    <?php 
    require_once "../components/navbar.php";
    $user_id = $_SESSION["user_id"];
    $isEnroll = $enrollModel->isUserEnrolledInCours($cours_id, $user_id);
    ?>

    <?php if ($cours != null) { ?>
        <!-- Navigation Breadcrumb -->
        <nav class=" px-4 text-gray-300 bg-gray-900 py-2 w-full">
            <div class="flex gap-2 items-center text-sm container mx-auto px-4 max-md:px-1">
                <span>Category</span>
                <span>›</span>
                <span class="text-red-500"><?= $cours["category_name"]; ?></span>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="container mx-auto px-4 flex flex-col lg:flex-row gap-8 py-4">

            <!-- Left Column -->
            <div class="lg:w-2/3">

                <!-- Tags section -->
                <div class="flex gap-3 flex-wrap mt-4 mb-6 text-xs">
                    <?php foreach ($tags as $tag) : ?>
                        <span class="px-4 py-2 bg-gray-100 rounded-full hover:bg-gray-200 cursor-pointer"><?= $tag["tag_name"]; ?></span>
                    <?php endforeach; ?>
                </div>

                <h1 class="text-4xl font-bold mb-4"><?php echo ($cours["title"] . ": " . $cours["subtitle"]);  ?></h1>
                <!-- <p class="text-gray-600 text-sm mb-6"><?= $cours["description"]; ?>.</p> -->
                <p class="text-gray-600 text-sm mb-6">"<?= $cours["description"] ?>".</p>

                <!-- Creator Info -->
                <div class="mb-8">
                    <p class="text-sm text-black">Created by <span class="text-red-500 hover:underline cursor-pointer"><?php echo ("Prof. " . $cours["firstname"] . $cours["lastname"] . ", " . $cours["specialite"]); ?></span></p>
                    <div class="flex flex-col gap-1 mt-2 text-sm text-gray-400">
                        <div class="flex items-center gap-4">
                            <span>Created at: <?= $cours["created_at"] ?? "N/A" ?></span>
                            <span>Last updated: <?= $cours["updated_at"] ?? "N/A" ?></span>
                        </div>
                        <span>Langues: <?= $cours["langues"] ?></span>
                    </div>
                </div>

                <?php if($isEnroll > 0 || isAdmin() || isTeacher()) { ?>
                <div class="w-full">
                    <?php if($cours["type"] == "video") { ?>
                    <!-- Conteneur principal de la vidéo -->
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <div class="relative w-full h-0 pb-[56.25%]">
                            <iframe class="w-full" height="500px" src="<?= $cours["content"] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        </div>
                    </div>
                    <?php } ?>

                    <?php if($cours["type"] == "document") { ?>
                    <div class="bg-gray-50 text-gray-700 p-4">
                        Click <a target="_blank" href="../../../<?= $cours["content"]; ?>" class="text-red-500 font-bold hover:underline">here</a> to read the cours document.
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>

                <?php if($isEnroll == 0 && (!isAdmin() && !isTeacher())) { ?>
                <div class="bg-red-50 p-2 text-red-600">Enroll to see the content of course</div>
                <?php } ?>
            </div>

            <!-- implemntation of student's enrollements -->
            <div class="lg:w-1/3">
                <div class="bg-gray-100 rounded-lg p-6 sticky top-16">
                    <div class="aspect-video bg-gray-700 rounded-lg mb-6 flex items-center justify-center">
                        <img src="../../../<?= $cours["image"] ?>" alt="Course Preview" class="rounded-lg" />
                    </div>
                    <?php if($isEnroll == 0) { ?>
                        <?php if(!isTeacher() && !isAdmin()) { ?>
                        <a href="../../process/enrollements/enroll.php?user_id=<?= $user_id ?>&cours_id=<?= $cours_id ?>" class="">
                            <button class="w-full bg-black text-white py-3 rounded-lg mb-2">Enroll now - <span class="text-yellow-400 text-xs">Free</span></button>
                        </a>
                        <?php } ?>
                    <?php } ?>

                    <?php if($isEnroll > 0) { ?>
                    <div class="text-green-600 p-1">
                        You enrolled in this Course
                    </div>
                    <?php } ?>
                </div>
            </div>
        </main>
    <?php } ?>

    <?php if ($cours == null) {  ?>
        <div class="container mx-auto p-4 flex-grow">
            <p class="text-red-500">Cours not found!</p>
        </div>
    <?php } ?>

    <?php require_once "../components/footer.php"; ?>
</body>

</html>