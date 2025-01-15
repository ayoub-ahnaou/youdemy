<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/input.css">
</head>

<body class="bg-gray-900 flex flex-col min-h-[100vh]">
    <?php require_once "../components/navbar.php"; ?>

    <div class="flex flex-col flex-grow items-center justify-center bg-white w-full relative pb-20">
        <img src="../assets/img/poor-broken-robot-drawing-frank-ramspott.jpg" alt="not found page" class="h-[400px] object-cover">
        <div class="flex flex-col absolute bottom-0 bg-gradient-to-b from-transparent via-gray-200 to-gray-400 pb-6 w-full">
            <p class="text-4xl font-bold text-center">We can’t find the page you’re looking for</p>
            <p class="text-center">Visit our <a class="underline font-bold" href="">Contact Page</a> from further assistance</p>
        </div>
    </div>

    <?php require_once "../components/footer.php"; ?>
</body>

</html>