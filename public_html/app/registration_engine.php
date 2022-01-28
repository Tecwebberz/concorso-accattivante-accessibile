<?php

$root = "..";
require_once($root . "/app/global.php");

if (!(isset($_POST["username"]) && isset($_POST["password"])
    && isset($_POST["name"]) && isset($_POST["surname"])
    && isset($_POST["year"]))) {

    echo "Stai per essere reindirizzato!";
    header("Location: ../registrati.php");
    exit();
}

$user = new UserDTO();
$user->username = safe_input($_POST["username"]);
$user->year_of_registration = safe_input($_POST["year"]);
$user->surname = safe_input($_POST["surname"]);
$user->name = safe_input($_POST["name"]);
$user->role = Role::USER;
$password = $_POST["password"];

$res = check_user_validity($user, $password);
if ($res !== UserServiceError::OK) {
    header("Location: ../registrati.php?error={$res}");
    exit();
}

$res = $user_service->register($user, $password);
if ($res === UserServiceError::OK) {
    header("Location: ../registrationsuccess.php?user={$user->name}");
} else {
    header("Location: ../registrati.php?error={$res}");
}

?>