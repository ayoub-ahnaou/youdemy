<?php
require_once '../../../vendor/autoload.php';
use App\model\CategoryModel;

$category_id = $_GET["category_id"];
$categoryModel = new CategoryModel();
$categoryModel->deleteCategory($category_id);

header("Location: ../../app/pages/list-categories.php");