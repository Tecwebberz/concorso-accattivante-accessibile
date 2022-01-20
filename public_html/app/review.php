<?php
$root = "..";
require_once($root . "/app/global.php");

if (!(isset($_POST["rating"]) && isset($_POST["review"])
    && $_POST["rating"] <= 6 && $_POST["rating"] >= 1
    && isset($_POST["type"]) && isset($_POST["id"])
    && ($_POST["type"] == ReviewType::STUDYROOM || $_POST["type"] == ReviewType::COURSE))) {

    echo "Stai per essere reindirizzato!";
    header("Location: ../404.php");
}

if (!isset($_SESSION["logged_user"])) {
    header("Location: ../accedi.php");
}
$user = $_SESSION["logged_user"];
$review = new ReviewDTO();
$review->id = null;
$review->type = $_POST["type"];
$review->text = safe_input($_POST["review"]);
$review->user = $user;
$review->rating = $_POST["rating"];
$review->target_id = $_POST["id"];
$review_service->replace($review);

$to = $review->type == ReviewType::COURSE ?
      "corso.php?id={$review->target_id}&error=0"
    : "aula.php?id={$review->target_id}&error=0";

header("Location: ../{$to}");
?>