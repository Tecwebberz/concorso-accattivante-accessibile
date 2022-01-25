<?php
$root = "..";
require_once($root . "/app/global.php");

if (!(isset($_POST["rating"]) && isset($_POST["review"])
    && $_POST["rating"] <= 6 && $_POST["rating"] >= 1
    && isset($_POST["type"]) && isset($_POST["id"])
    && ($_POST["type"] == ReviewType::STUDYROOM || $_POST["type"] == ReviewType::COURSE))) {
   
    // Better error diagnostic for non application made request
    $to = "404.php";
    if (isset($_POST["type"]) && isset($_POST["id"])) {
        $to = $_POST["type"] == ReviewType::COURSE ?
                  "corso.php?id={$_POST["id"]}&error=1"
                : "aula.php?id={$_POST["id"]}&error=1";
    }

    echo "Stai per essere reindirizzato!";
    header("Location: ../{$to}");
    exit();
}

if (!isset($_SESSION["logged_user"])) {
    echo "Stai per essere reindirizzato!";
    header("Location: ../accedi.php");
    exit();
}

$user = $_SESSION["logged_user"];
$review = new ReviewDTO();
$review->id = null;
$review->type = $_POST["type"];
$review->text = safe_input($_POST["review"]);
$review->user = $user;
$review->rating = $_POST["rating"];
$review->target_id = $_POST["id"];

// Check if is an edit
if (isset($_POST["id_comm"])) {
    $db->persist();
    $erev = $review_service->get_review($review->type, $review->id);

    if ($erev === ReviewServiceError::FAIL) {
        $db->close();
        header("Location: ../404.php");
        exit();
    }

    if ($erev->user->username !== $review->user->username) {
        $db->close();
        header("Location: ../404.php");
        exit();
    }

    $review->id = $_POST["id_comm"];
}

$review_service->replace($review);


if (isset($_POST["id_comm"])) {
    $db->close();
}

$to = $review->type == ReviewType::COURSE ?
      "corso.php?id={$review->target_id}&error=0"
    : "aula.php?id={$review->target_id}&error=0";

header("Location: ../{$to}");
?>