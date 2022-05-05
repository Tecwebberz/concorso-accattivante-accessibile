<?php
$root = ".";
$page_index = 5;
require_once($root . "/app/global.php");

$profilo_template = $template_engine->load_template("profilo.template.html");
$profilo_template->insert("header", build_header());

$db->persist();
$user = $_SESSION["logged_user"];

$profilo_template->insert("username", $user->name . ' ' .  $user->surname );

$review_list = $review_service->get_reviews_made_by_user($user);

$review_locations = [];
foreach ($review_list as $review) {
   $location = "";
   if ($review->type == 0) $location = $studyroom_service->get_room_by_id($review->target_id);
   else $location = $course_service->get_course_by_id($review->target_id);
   array_push($review_locations, $location->name);
}

$reviews = make_user_reviews($review_list, $review_locations);

$profilo_template->insert("reviews", $reviews);

$profilo_template->insert("footer", build_footer());

echo $profilo_template->build();

?>