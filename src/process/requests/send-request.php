<?php
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Instructor Application</title>
    <link rel="stylesheet" href="../../app/css/input.css">
    <link rel="stylesheet" href="../../app/css/output.css">
</head>

<body class="">
    <div class="bg-gray-50 w-full min-h-[100vh] flex flex-col justify-between items-center">
        <div class="w-full">
        </div>

        <div class="flex-grow flex items-center justify-center w-full">
            <!-- TODO: add some stuffs for image submission form -->
            <form action="" method="post" class="bg-white w-1/2 max-xl:w-3/4 max-md:w-full h-auto shadow-lg rounded-md flex flex-col" enctype="multipart/form-data">
                <h1 class="py-1 px-4 border border-transparent border-l-black font-bold text-xl text-center">Instractor Forum</h1>
                <hr>
                <p class="my-1 py-1 text-center text-xs text-gray-600">
                    Submit your request to become an instructor
                </p>
                <hr>

                <div class="p-6 flex flex-col text-sm gap-2">
                    <label name="error_query" class="bg-red-50 text-red-500"><?= $err; ?></label>

                    <div class="flex max-md:flex-col gap-4">
                        <div class="flex flex-col w-1/2 max-md:w-full gap-1">
                            <div class="flex flex-col">
                                <label class="text-gray-500" for="age">Age *</label>
                                <input value="<?= $age ?>" type="number" name="age" id="age" placeholder="Enter your age" class="bg-gray-100 rounded-sm p-1">
                                <label name="age_err" class="text-red-600"><?= $age_err ?></label>
                            </div>

                            <div class="flex flex-col">
                                <label for="gender" class="text-gray-500">Gender *</label>
                                <select id="gender" name="gender" class="bg-gray-100 rounded-sm p-1">
                                    <option value="">Select gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                                <label name="gender_err" class="text-red-600"><?= $gender_err ?></label>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-gray-500" for="address">Address *</label>
                                <textarea value="" rows="4" name="address" id="address" placeholder="Enter your address" class="bg-gray-100 rounded-sm p-1"><?= $address ?></textarea>
                                <label name="address_err" class="text-red-600"><?= $address_err ?></label>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-gray-500" for="cin">CIN *</label>
                                <input value="<?= $cin ?>" type="text" name="cin" id="cin" placeholder="Enter your cin" class="bg-gray-100 rounded-sm p-1">
                                <label name="cin_err" class="text-red-600"><?= $cin_err ?></label>
                            </div>
                        </div>

                        <div class="flex flex-col w-1/2 max-md:w-full gap-1">
                            <div class="flex flex-col">
                                <label class="text-gray-500" for="specialite">Specialite *</label>
                                <input value="<?= $specialite ?>" type="text" name="specialite" id="specialite" placeholder="Enter your specialite" class="bg-gray-100 rounded-sm p-1">
                                <label name="specialite_err" class="text-red-600"><?= $specialite_err ?></label>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-gray-500" for="acad_level">Academic level *</label>
                                <select name="acad_level" id="acad_level" class="bg-gray-100 rounded-sm p-1">
                                    <option value="">Select level</option>
                                    <option value="bachelor">Bachelor's Degree</option>
                                    <option value="master">Master's Degree</option>
                                    <option value="phd">PhD</option>
                                    <option value="other">Other</option>
                                </select>
                                <label name="acad_level_err" class="text-red-600"><?= $acad_level_err ?></label>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700">Profile Picture *</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="avatar" class="relative cursor-pointer bg-white rounded-md font-medium text-red-600 hover:text-red-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-red-500">
                                                <span>Upload a file</span>
                                                <input id="avatar" name="avatar" type="file" class="sr-only" accept="image/*">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                    </div>
                                </div>
                                <label name="acad_level_err" class="text-red-600"><?= $avatar_err ?></label>
                            </div>
                        </div>
                    </div>

                    <p class="text-gray-500 text-xs">*: Required fields</p>

                    <input type="submit" name="submit" id="submit" value="Send request" class="bg-red-500 rounded-md p-2 text-white">
                </div>
            </form>
        </div>

    </div>
    <?php require_once "../../app/components/footer.php"; ?>
</body>

</html>