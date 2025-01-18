<?php
require_once '../../../vendor/autoload.php';
session_start();

function isAuth() {
    $user_id = $_SESSION["user_id"] ?? null;
    if($user_id) return true;
    else return false;
}

function isStudent(){
    $role_id = $_SESSION["role_id"] ?? null;
    return $role_id == 3 ? true : false;
}

function isTeacher(){
    $role_id = $_SESSION["role_id"] ?? null;
    return $role_id == 2 ? true : false;
}