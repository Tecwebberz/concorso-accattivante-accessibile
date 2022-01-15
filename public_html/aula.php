<?php
$root = ".";
$page_index = 2;

if (!isset($_GET["id"])) {
    echo "id not set";
    die;
}

require_once($root . "/app/global.php");

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

$carousel_content = "";
foreach ($carousel as $img) {
    $carousel_content .= build_image($img);
}

$room_template->insert("carousel", $carousel_content);


//Alessio da sistemare
$recensione = $template_engine->load_template(
    "recensione.template.html");

$room_template->insert("recensioni", $recensione->build().$recensione->build().$recensione->build().$recensione->build());

//-----------

echo $room_template->build();
