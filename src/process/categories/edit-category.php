<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Youdemy Admin Dashboard - Requests</title>
<link rel="stylesheet" href="../../app/css/output.css">
<link rel="stylesheet" href="../../app/css/input.css">

<body class="bg-gray-50">
    <?php require_once "../../app/components/navbar.php"; ?>

    <div class="p-6">
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">Update Category</h2>
            </div>

            <form class="p-6" action="" method="post" enctype="multipart/form-data">
                <div id="categoriesContainer">
                    <div class="category-item mb-6 bg-white rounded-lg">
                        <div class="gap-4 flex flex-col text-sm">

                            <div class="flex flex-col">
                                <label class="text-gray-500" for="category_name">Category name </label>
                                <input value="<?= $name ?>" type="text" name="category_name" id="category_name" placeholder="enter the category name" class="bg-gray-100 rounded-sm p-1">
                                <label class="text-red-600"><?= $name_err ?></label>
                            </div>

                            <div>
                                <label class="text-gray-500" for="category_image">Category image * </label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="category_image" class="relative cursor-pointer bg-white rounded-md font-medium text-red-600 hover:text-red-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-red-500">
                                                <span>Upload a file</span>
                                                <input id="category_image" name="category_image" type="file" class="sr-only" accept="image/*">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                </div>
                                <label class="text-red-600"><?= $image_err ?></label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-6">
                    <button
                        type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>