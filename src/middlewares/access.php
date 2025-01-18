<?php
require_once '../../../vendor/autoload.php';
session_start();

function isAuth() {
    $user_id = $_SESSION["user_id"] ?? null;
    if($user_id) return true;
    else return false;
}

function isStudent(){
    if(isAuth()) {
        $role_id = $_SESSION["role_id"] ?? null;
        return $role_id == 3 ? true : false;
    } return false;
}

function isTeacher(){
    if(isAuth()) {
        $role_id = $_SESSION["role_id"] ?? null;
        return $role_id == 2 ? true : false;
    } return false;
}

function isAdmin(){
    if(isAuth()) {
        $role_id = $_SESSION["role_id"] ?? null;
        return $role_id == 1 ? true : false;
    } return false;
}