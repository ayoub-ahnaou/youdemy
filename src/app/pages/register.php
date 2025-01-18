<?php
require_once '../../../vendor/autoload.php';
include_once "../../middlewares/access.php"; 
if(isAuth()) header("location: ./index.php"); 

use App\class\Person;
use App\helpers\Helpers;
use App\model\PersonModel;

$firstname = "";
$lastname = "";
$phone = "";
$email = "";
$password = "";
$password_repeat = "";

$firstname_err = "";
$lastname_err = "";
$phone_err = "";
$email_err = "";
$password_err = "";
$password_repeat_err = "";

$err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = Helpers::filterInput($_POST["firstname"]);
    $lastname = Helpers::filterInput($_POST["lastname"]);
    $phone = Helpers::filterInput($_POST["phone"]);
    $email = Helpers::filterInput($_POST["email"]);
    $password = Helpers::filterInput($_POST["password"]);
    $password_repeat = Helpers::filterInput($_POST["password_repeat"]);

    if(empty($firstname)) $firstname_err = "firstname should not be empty";
    if(empty($lastname)) $lastname_err = "lastname should not be empty";
    if(empty($phone)) $phone_err = "phone should not be empty";
    if(empty($email)) $email_err = "email should not be empty";
    if(empty($password)) $password_err = "password should not be empty";
    if(empty($password_repeat)) $password_repeat_err = "password confirm should not be empty";

    if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($password) && !empty($password_repeat)){
        $userModel = new PersonModel();

        if($userModel->isEmailExist($email) > 0) $email_err = "Email already exist, choose another one";
        else {
            if (!Helpers::comparePasswords($password, $password_repeat)) {
                $password_repeat_err = "Password not matchs";
            } else {
                $password_hashed = Helpers::hashPassword($password);

                $user = new Person($firstname, $lastname, $email, $phone, $password_hashed);
                $userModel->register($user);
                
                $firstname = $lastname = $phone = $email = $password = $password_repeat = "";
                $firstname_err = $lastname_err = $phone_err = $email_err = $password_err = $password_repeat_err = "";

                header("location: ./login.php");
            }
        }
    }
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
                <h1 class="p-4 border border-transparent border-l-black font-bold text-xl text-center">SIGN UP</h1>
                <div class="p-6 flex flex-col text-sm gap-2">
                    <label name="error_query" class="bg-red-50 text-red-500"><?= $err ?></label>
                    <div class="flex gap-2 w-full">
                        <div class="flex flex-col w-1/2">
                            <label class="text-gray-500" for="firstname">First Name *</label>
                            <input value="<?= $firstname ?>" type="text" name="firstname" id="firstname" placeholder="Enter your first name" class="bg-gray-100 rounded-sm p-1">
                            <label name="firstname_err" class="text-red-600"><?= $firstname_err ?></label>
                        </div>
                        <div class="flex flex-col w-1/2">
                            <label class="text-gray-500" for="lastname">Last Name *</label>
                            <input value="<?= $lastname ?>" type="text" name="lastname" id="lastname" placeholder="Enter your last name" class="bg-gray-100 rounded-sm p-1">
                            <label name="lastname_err" class="text-red-600"><?= $lastname_err ?></label>
                        </div>
                    </div>

                    <div class="flex flex-col">
                        <label class="text-gray-500" for="phone">Phone *</label>
                        <input value="<?= $phone ?>" type="phone" name="phone" id="phone" placeholder="e.g: +212-656-546523" class="bg-gray-100 rounded-sm p-1">
                        <label name="phone_err" class="text-red-600"><?= $phone_err ?></label>
                    </div>

                    <div class="flex flex-col">
                        <label class="text-gray-500" for="email">Email *</label>
                        <input value="<?= $email ?>" type="email" name="email" id="email" placeholder="e.g: example@gmail.com" class="bg-gray-100 rounded-sm p-1">
                        <label name="email_err" class="text-red-600"><?= $email_err ?></label>
                    </div>

                    <div class="flex flex-col">
                        <label class="text-gray-500" for="password">Password *</label>
                        <input value="<?= $password ?>" type="password" name="password" id="password" placeholder="password" class="bg-gray-100 rounded-sm p-1">
                        <label name="password_err" class="text-red-600"><?= $password_err ?></label>
                    </div>

                    <div class="flex flex-col">
                        <label class="text-gray-500" for="password_repeat">Confirm Password *</label>
                        <input value="<?= $password_repeat ?>" type="password" name="password_repeat" id="password_repeat" placeholder="Confirm password" class="bg-gray-100 rounded-sm p-1">
                        <label name="password_repeat_err" class="text-red-600"><?= $password_repeat_err ?></label>
                    </div>

                    <div class="flex gap-1">
                        <input onchange="handle_show_pwd()" type="checkbox" name="show-pwd" id="show-pwd">
                        <label for="show-pwd">show password</label>
                    </div>

                    <p class="text-gray-500 text-xs">*: Required fields</p>

                    <input type="submit" name="submit" id="submit" value="Sign Up" class="bg-red-500 rounded-md p-2 text-white">
                    <p class="mt-1">Already have an Account? <a class="font-bold hover:underline" href="login.php">Login</a></p>
                </div>
            </form>
        </div>
    </div>
</body>

</html>