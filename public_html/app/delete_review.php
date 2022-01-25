<?php

$root = "..";
require_once($root . "/app/global.php");

if (!isset($_SESSION["logged_user"])) {
    echo "Stai per essere reindirizzato!";
    header("Location: ../accedi.php");
    exit();
}

if (!isset($_GET["id"]) || !isset($_GET["type"])
   || ($_GET["type"] != ReviewType::COURSE &&
       $_GET["type"] != ReviewType::STUDYROOM)) {    
    echo "Stai per essere reindirizzato!";
    header("Location: ../404.php");
    exit();
}

$db->persist();
$review  = $review_service->get_review($_GET["type"],
                                       $_GET["id"]);

if ($review === ReviewServiceError::FAIL) {
    $db->close();
    echo "Stai per essere reindirizzato!";
    header("Location: ../404.php");
    exit();
}

$user = $_SESSION["logged_user"];
if (!($user->role === Role::ADMIN
     || $user->username === $review->user->username)) {
    $db->close();
    echo "Stai per essere reindirizzato!";
    header("Location: ../404.php");
    exit();
}

$review_service->delete($review);
$db->close();

$to = $review->type === ReviewType::COURSE ?
          "corso.php?id={$review->target_id}&error=0"
        : "aula.php?id={$review->target_id}&error=0";
header("Location: ../{$to}");
?>