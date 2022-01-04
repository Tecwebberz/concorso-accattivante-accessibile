<?php
$root = ".";
$page_index = 2;

if (!isset($_GET["id"])) {
    echo "id not set";
    die;
}

require_once($root . "/app/global.php");

$id = $_GET["id"];
$room = $studyroom_service->get_room_by_id($id);
if ($room === StudyRoomServiceError::FAIL) {
    echo "id del casso";
    die;
}

$room_template = $template_engine->load_template(
    "aula.template.html");
$room_template->insert("header", build_header());

$room_template->insert_all(array(
    "description"  => $room->description,
    "registration" => $room->reservation_required ? "registrazione richiesta"
                                                  : "accesso libero",
    "seats"        => $room->seats,
    "wifi"         => $room->wifi ? "wifi"
                                  : "solo connessione cablata",
    "name"         => $room->name,
    "name_tit"     => $room->name,
    "short_desc"   => $room->short_description,
    "main_image"   => build_image($room->main_image),
));

$room_template->insert("recensioni", "crizzo");

echo $room_template->build();

?>