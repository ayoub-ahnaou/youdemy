<?php
require_once "../../middlewares/access.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/input.css">
    <link rel="stylesheet" href="../css/output.css">
</head>

<body>
    <div class="flex flex-col min-h-[100vh]">
        <?php require_once "../components/navbar.php"; ?>

        <div class="flex-grow">

            <?php require_once "../components/hero.php"; ?>

            <?php require_once '../components/cours.php'; ?>

            <?php require_once '../components/categories.php'; ?>

            <?php require_once '../components/why-choose-us.php'; ?>

            <?php require_once '../components/sponsors.php'; ?>

        </div>

        <?php require_once "../components/footer.php"; ?>
    </div>
</body>

</html>