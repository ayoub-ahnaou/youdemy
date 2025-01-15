<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - All Courses</title>

    <link rel="stylesheet" href="../css/input.css">
    <link rel="stylesheet" href="../css/output.css">
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">
    <?php require_once "../components/navbar.php"; ?>


    <!-- Main Content -->
    <main class="flex-1 container mx-auto px-4 py-8">

        <!-- Course Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <!-- Course Cards (repeated 12 times) -->
            <!-- Card 1 -->
            <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow group">
                <div class="relative">
                    <img src="https://static1.squarespace.com/static/638f10c47f505a72c6c86073/t/66c5ec8861178e3b80258865/1724247179114/React+-+Small.jpg?format=1500w" alt="Course thumbnail" class="w-full h-48 object-cover rounded-t-lg">
                </div>
                <div class="p-4">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="bg-green-100 text-green-600 text-xs px-2 py-1 rounded">Bestseller</span>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1 line-clamp-2">Complete Python Bootcamp: From Zero to Hero</h3>
                    <p class="text-sm text-gray-600 mb-2">Dr. Angela Yu</p>
                    <div class="flex items-center mb-1">
                        <span class="text-amber-700 font-semibold">4.8</span>
                        <div class="flex text-amber-400 ml-1">★★★★★</div>
                        <span class="text-gray-500 text-sm ml-1">(92,403)</span>
                    </div>
                </div>
            </div>
            <!-- Repeat similar cards with different content -->
        </div>
    </main>

    <!-- Footer -->
    <?php require_once "../components/footer.php"; ?>
</body>

</html>