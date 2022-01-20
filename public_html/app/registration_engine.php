<?php

$root = "..";
require_once($root . "/app/global.php");

if (!(isset($_POST["username"]) && isset($_POST["password"])
    && isset($_POST["name"]) && isset($_POST["surname"])
    && isset($_POST["year"]))) {

    echo "Stai per essere reindirizzato!";
    header("Location: ../registrati.php");
}

$user = new UserDTO();
$user->username = safe_input($_POST["username"]);
$user->year_of_registration = safe_input($_POST["year"]);
$user->surname = safe_input($_POST["surname"]);
$user->name = safe_input($_POST["name"]);
$password = $_POST["password"];

$res = check_user_validity($user, $password);
if ($res !== UserServiceError::OK) {
    header("Location: ../registrati.php?error={$res}");
}

$res = $user_service->register($user, $password);
if ($res === UserServiceError::OK) {
    header("Location: ../index.php");
} else {
    header("Location: ../registrati.php?error={$res}");
}

?>