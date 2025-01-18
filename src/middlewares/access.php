<?php
require_once '../../../vendor/autoload.php';
session_start();

function isAuth() {
    $user_id = $_SESSION["user_id"] ?? null;
    if($user_id) return true;
    else return false;
}