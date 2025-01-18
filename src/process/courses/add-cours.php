<?php
require_once '../../../vendor/autoload.php';
session_start();

use App\class\Cours;
use App\helpers\FileUploader;
use App\helpers\Helpers;
use App\model\CategoryModel;
use App\model\DocumentCours;
use App\model\TagModel;
use App\model\TagsCoursesModel;
use App\model\VideoCours;

$title = $subtitle = $langues = $description = $type = $category = $image = $tags = $video = $document = "";
$title_err = $subtitle_err = $langues_err = $description_err = $type_err = $category_err = $image_err = $tags_err = $video_err = $document_err = $err = "";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Youdemy - Instructor Application</title>
    <link rel="stylesheet" href="../../app/css/output.css">
    <link rel="stylesheet" href="../../app/css/input.css">
</head>

<body class="">
    <div class="bg-gray-50 w-full min-h-[100vh] flex flex-col justify-between items-center">
        <div class="w-full">
        </div>

        <div class="flex-grow flex items-center justify-center w-full py-8">
            <form action="" method="post" class="bg-white w-1/2 max-xl:w-3/4 max-md:w-full h-auto shadow-lg rounded-md flex flex-col" enctype="multipart/form-data">
                <h1 class="py-1 px-4 border border-transparent border-l-black font-bold text-xl text-center">Creation of new course</h1>
                <hr>

                <div class="p-6 flex flex-col text-sm gap-2">
                    <label name="error_query" class="bg-red-50 text-red-500"><?= $err; ?></label>

                    <div class="flex max-md:flex-col gap-4">
                        <div class="flex flex-col w-1/2 max-md:w-full gap-1">
                            <div class="flex flex-col">
                                <label class="text-gray-500" for="title">Title *</label>
                                <input value="<?= $title ?>" type="text" name="title" id="title" placeholder="Enter the title" class="bg-gray-100 rounded-sm p-1">
                                <label name="title_err" class="text-red-600"><?= $title_err ?></label>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-gray-500" for="subtitle">subtitle *</label>
                                <input value="<?= $subtitle ?>" type="text" name="subtitle" id="subtitle" placeholder="Enter the subtitle" class="bg-gray-100 rounded-sm p-1">
                                <label name="subtitle_err" class="text-red-600"><?= $subtitle_err ?></label>
                            </div>

                            <div class="flex flex-col">
                                <label for="langues" class="text-gray-500">Langues *</label>
                                <select id="langues" name="langues" class="bg-gray-100 rounded-sm p-1">
                                    <option value="">Select langue</option>
                                    <option value="english">english</option>
                                    <option value="frnech">french</option>
                                    <option value="arabe">arabe</option>
                                </select>
                                <label name="langue_err" class="text-red-600"><?= $langues_err ?></label>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-gray-500" for="description">Description *</label>
                                <textarea value="<?= $description ?>" rows="7" name="description" id="description" placeholder="Enter the description" class="bg-gray-100 rounded-sm p-1"><?= $description ?></textarea>
                                <label name="description_err" class="text-red-600"><?= $description_err ?></label>
                            </div>
                        </div>

                        <div class="flex flex-col w-1/2 max-md:w-full gap-1">
                            <div class="flex flex-col">
                                <label for="type" class="text-gray-500">Type of piece joint *</label>
                                <select onchange="handleTypeChange(this.value)" id="type" name="type" class="bg-gray-100 rounded-sm p-1">
                                    <option value="" selected disabled>Select a type</option>
                                    <option value="document">document</option>
                                    <option value="video">video</option>
                                </select>
                                <label name="type_err" class="text-red-600"><?= $type_err ?></label>
                            </div>

                            <div class="flex flex-col">
                                <label class="text-gray-500" for="category">Category *</label>
                                <select name="category" id="category" class="bg-gray-100 rounded-sm p-1">
                                    <option value="">Select a category</option>
                                    <?php foreach ($categories as $category) : ?>
                                        <option value="<?= $category["category_id"] ?>"><?= $category["category_name"] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label name="category_err" class="text-red-600"><?= $category_err ?></label>
                            </div>

                            <div>
                                <label for="thumbnails" class="text-sm text-gray-500">Cours Thumbnail *</label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="thumbnails" class="relative cursor-pointer bg-white rounded-md font-medium text-red-600 hover:text-red-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-red-500">
                                                <span>Upload a file</span>
                                                <input id="thumbnails" name="thumbnails" type="file" class="sr-only" accept="image/*">
                                            </label>
                                            <p class="pl-1">here</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 2MB</p>
                                    </div>
                                </div>
                                <label name="acad_level_err" class="text-red-600"><?= $image_err ?></label>
                            </div>

                        </div>
                    </div>

                    <!-- Video input section -->
                    <div id="video-input" class="hidden">
                        <div class="flex flex-col">
                            <label class="text-gray-500" for="video">Course Video Link *</label>
                            <textarea value="<?= $video ?>" rows="2" name="video" id="video" placeholder="Enter the video link" class="bg-gray-100 rounded-sm p-1"><?= $video ?></textarea>
                            <label name="video_err" class="text-red-600"><?= $video_err ?></label>
                        </div>
                    </div>

                    <!-- Document input section -->
                    <div id="document-input" class="hidden">
                        <label for="document" class="text-sm text-gray-500">Course Document *</label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="document" class="relative cursor-pointer bg-white rounded-md font-medium text-red-600 hover:text-red-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-red-500">
                                        <span>Upload a document</span>
                                        <input id="document" name="document" type="file" class="sr-only" accept=".pdf">
                                    </label>
                                    <p class="pl-1">here</p>
                                </div>
                                <p class="text-xs text-gray-500">PDF files only</p>
                            </div>
                        </div>
                        <div id="document-preview" class="hidden mt-2">
                            <p class="text-sm text-gray-600">Selected file: <span id="document-name"></span></p>
                        </div>
                        <label name="document_err" class="text-red-600"><?= $document_err ?></label>
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