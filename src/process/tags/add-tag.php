<?php

use App\class\Tag;
use App\helpers\Helpers;
use App\model\TagModel;

include_once "../../middlewares/access.php"; 
if(!isAdmin()) header("location: ./index.php"); 
require_once '../../../vendor/autoload.php';

$tags = $tags_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tags = $_POST["tag_name"];
    var_dump($tags);
    
    if (empty($tags)) $tags_err = "Tag name is required";
    else {
        $tagModel = new TagModel();
        foreach($tags as $tag){
            $tag = Helpers::filterInput($tag);
            $tagModel->createTag(new Tag(null, $tag));
        }
        header("Location: ../../app/pages/list-tags.php");
    }
}

?>

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
                <h2 class="text-xl font-semibold text-gray-800">Add New Tags</h2>
            </div>

            <form class="p-6" action="" method="post">
                <div id="tagsContainer">
                    <div class="tag-item mb-6 bg-white rounded-lg">
                        <div class="gap-4 flex flex-col text-sm">
                            <div class="flex flex-col">
                                <label class="text-gray-500" for="tag_name[]">tag name </label>
                                <input value="" type="text" name="tag_name[]" id="tag_name[]" placeholder="enter the category name" class="bg-gray-100 rounded-sm p-1">
                                <label class="text-red-600"><?= $tags_err ?></label>
                            </div>
                        </div>

                        <div class="mt-4 flex justify-end">
                            <button
                                type="button"
                                class="remove-tag px-3 py-2 text-sm text-red-600 hover:text-red-800"
                                onclick="removeTag(this)">
                                Remove
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-6">
                    <button
                        type="button"
                        onclick="addTag()"
                        class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                        Add Another Tag
                    </button>

                    <button
                        type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-red-500 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">
                        Save Tags
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function addTag() {
            const container = document.getElementById('tagsContainer');
            const tagTemplate = document.querySelector('.tag-item').cloneNode(true);

            // Clear input values
            tagTemplate.querySelectorAll('input').forEach(input => {
                input.value = '';
            });

            container.appendChild(tagTemplate);
        }

        function removeTag(button) {
            const tagItem = button.closest('.tag-item');
            const container = document.getElementById('tagsContainer');

            // Only remove if there's more than one category
            if (container.children.length > 1) {
                tagItem.remove();
            }
        }
    </script>
</body>

</html>