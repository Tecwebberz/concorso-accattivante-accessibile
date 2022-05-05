<?php
$root = ".";
$page_index = 5;
require_once($root . "/app/global.php");

$profilo_template = $template_engine->load_template("profilo.template.html");
$profilo_template->insert("header", build_header());

$db->persist();
$user = $_SESSION["logged_user"];

$profilo_template->insert("username", $user->name . ' ' .  $user->surname );

var_dump($review_service->get_reviews_made_by_user($user));

$reviews = make_user_reviews($review_service->get_reviews_made_by_user($user));
$profilo_template->insert("reviews", $reviews);

$profilo_template->insert("footer", build_footer());

echo $profilo_template->build();

?>