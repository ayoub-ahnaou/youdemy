<?php
require_once '../../../vendor/autoload.php';

use App\helpers\Helpers;

$email = "";
$password = "";
$email_err = "";
$password_err = "";
$err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = Helpers::filterInput($_POST["email"]);
    $password = Helpers::filterInput($_POST["password"]);

    if(empty($email)) $email_err = "this filed should not be empty";
    if(empty($password)) $password_err = "this filed should not be empty";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Youdemy</title>
    <link rel="stylesheet" href="../css/input.css">
    <link rel="stylesheet" href="../css/output.css">
    
</head>

<body class="">
    <div class="bg-gray-50 w-full min-h-[100vh] flex flex-col justify-between items-center">
        <div class="w-full">
            <?php require_once "../components/navbar.php"; ?>
        </div>

        <div class="flex-grow flex items-center">
            <form action="" method="post" class="bg-white w-[400px] h-auto shadow-lg rounded-md flex flex-col">
                <h1 class="p-4 border border-transparent border-l-black font-bold text-xl text-center">LOGIN</h1>
                <div class="p-6 flex flex-col text-sm gap-2">
                    <label name="error_query" class="bg-red-50 text-red-500"><?= $err ?></label>
                    <div class="flex flex-col">
                        <label class="text-gray-500" for="email">email </label>
                        <input value="<?= $email ?>" type="email" name="email" id="email" placeholder="e.g: example@gmail.com" class="bg-gray-100 rounded-sm p-1">
                        <label name="email_err" class="text-red-600"><?= $email_err ?></label>
                    </div>

                    <div class="flex flex-col gap-1">
                        <label class="text-gray-500" for="password">password </label>
                        <input value="<?= $password ?>" type="password" name="password" id="password" placeholder="password" class="bg-gray-100 rounded-sm p-1">
                        <label name="password_err" class="text-red-600"><?= $password_err ?></label>
                    </div>

                    <div class="flex gap-1">
                        <input onchange="handle_show_pwd()" type="checkbox" name="show-pwd" id="show-pwd">
                        <label for="show-pwd">show password</label>
                    </div>

                    <input type="submit" name="submit" id="submit" value="Login" class="bg-red-500 rounded-md p-2 mt-8 text-white">
                    <p class="mt-1">Don't have an Account? <a class="font-bold hover:underline" href="register.php">Register</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>