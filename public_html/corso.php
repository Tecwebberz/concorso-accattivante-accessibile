<?php
$root = ".";
$page_index = 1;

if (!isset($_GET["id"])) {
    echo "id not set";
    die;
}

require_once($root . "/app/global.php");
/*
$id = $_GET["id"];
$db->persist();
$room = $studyroom_service->get_room_by_id($id);
if ($room === StudyRoomServiceError::FAIL) {
    $db->close();
    echo "id del casso";
    die;
}
$carousel = $studyroom_service->get_carousel($room);
$db->close();

*/

$course_template = $template_engine->load_template(
    "corso.template.html");
$course_template->insert("header", build_header());

echo $course_template->build();

?>