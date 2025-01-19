<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 pb-8">
    <!-- Top Performing Courses -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold">Top Performing Courses</h2>
        </div>
        <div class="p-4">
            <div class="space-y-4">
                <?php if($topCourse) { ?>
                <div class="flex items-center">
                    <span class="text-lg font-bold text-yellow-600 w-8">01</span>
                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-1">
                            <h3 class="font-medium"><?= $topCourse["title"] ?>: <?= $topCourse["subtitle"] ?></h3>
                            <div class="flex justify-between mt-1 text-sm text-gray-500">
                                <span><?= $topCourse["number_student"]; ?> students</span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php if(!$topCourse) { ?>
                <span class="text-red-500">No course Found !</span>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- Top Instructors -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold">Top Three Instructors</h2>
        </div>
        <div class="p-4">
            <div class="space-y-4">
                <?php foreach($topInstractors as $prof) : ?>
                <div class="flex items-center gap-4">
                    <img src="../assets/img/instractor.png" alt="" class="w-10 h-10 rounded-full">
                    <div class="flex-1 text-sm flex justify-between">
                        <div class="">
                            <h3 class="font-medium">Dr. <?= $prof["firstname"] ?> <?= $prof["lastname"] ?></h3>
                            <p class="text-sm text-gray-500"><?= $prof["specialite"] ?></p>
                        </div>
                        <div class="flex items-center mt-1">
                            <span class="text-xs text-gray-600"><?= $prof["total_enrollments"] ?> students</span>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- Course Engagement Metrics -->
    <div class="bg-white rounded-lg shadow-sm">
        <div class="p-4 border-b border-gray-200">
            <h2 class="text-xl font-semibold">Courses Repartition By Category</h2>
        </div>
        <div class="p-4">
            <div class="space-y-6">
                <?php foreach ($coursesInEachCategory as $item) : ?>
                <div>
                    <div class="flex justify-between mb-2">
                        <span class="text-gray-600"><?= $item["category_name"] ?></span>
                        <span class="font-medium"><?= $item["nbre_courses"]; ?> courses</span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>