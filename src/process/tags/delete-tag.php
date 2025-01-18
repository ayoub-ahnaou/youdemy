<?php
require_once '../../../vendor/autoload.php';
use App\model\TagModel;

$tag_id = $_GET['tag_id'];
$tagModel = new TagModel();
$tagModel->deleteTag($tag_id);

header("Location: ../../app/pages/list-tags.php");