<?php
require_once "../../../vendor/autoload.php";
use App\model\EnrollementModel;

$enroll_id = $_GET["enroll_id"];
$enrollModel = new EnrollementModel();
$enrollModel->deleteEnrollement($enroll_id);

header("location: ../../app/pages/list-enrollements.php");