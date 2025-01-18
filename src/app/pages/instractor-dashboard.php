<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Dashboard</title>
    <link rel="stylesheet" href="../css/output.css">
    <link rel="stylesheet" href="../css/input.css">
</head>
<body class="bg-gray-50">
    <?php require_once "../components/navbar.php"; ?>
    <div class="min-h-screen p-4">
        <!-- Sidebar -->
        <div class="fixed left-0 top-0 h-full w-64 bg-white shadow-lg p-6">
            <div class="space-y-6">
                <h2 class="text-xl font-bold text-gray-800">Instructor Portal</h2>
                <nav class="space-y-4">
                    <a href="./instractor-dashboard.php" class="flex items-center space-x-3 text-red-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                        <span>Dashboard</span>
                    </a>
                    <a href="./instractors-courses.php" class="flex items-center space-x-3 text-gray-600 hover:text-red-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                        <span>My Courses</span>
                    </a>
                    <a href="./instractors-students.php" class="flex items-center space-x-3 text-gray-600 hover:text-red-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>Students</span>
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="ml-64">
            <!-- Header -->
            <div class="mb-4">
                <h1 class="text-2xl font-bold text-gray-800">Course Overview</h1>
                <p class="text-gray-600">Track your course performance and student engagement</p>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-500">Total Students</h3>
                        <span class="bg-red-100 p-2 rounded">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </span>
                    </div>
                    <p class="text-3xl font-bold mt-4">1,847</p>
                </div>

                <div class="bg-white rounded-lg shadow p-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-gray-500">Active Courses</h3>
                        <span class="bg-green-100 p-2 rounded">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </span>
                    </div>
                    <p class="text-3xl font-bold mt-4">4</p>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-xl font-bold">Recent Student Enrollements</h2>
                    <button class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700">View All</button>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3 px-4">Student</th>
                                <th class="text-left py-3 px-4">Course</th>
                                <th class="text-left py-3 px-4">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b">
                                <td class="py-3 px-4">
                                    <div class="flex items-center">
                                        <span>Alex Johnson</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">Advanced Machine Learning</td>
                                <td class="py-3 px-4">Jan 15, 2024</td>
                            </tr>
                            <tr class="border-b">
                                <td class="py-3 px-4">
                                    <div class="flex items-center">
                                        <span>Sarah Miller</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">Deep Learning Fundamentals</td>
                                <td class="py-3 px-4">Jan 14, 2024</td>
                            </tr>
                            <tr>
                                <td class="py-3 px-4">
                                    <div class="flex items-center">
                                        <span>Michael Smith</span>
                                    </div>
                                </td>
                                <td class="py-3 px-4">Neural Networks Workshop</td>
                                <td class="py-3 px-4">Jan 13, 2024</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>