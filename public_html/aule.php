<?php

$root = ".";
$page_index = 2;
require_once($root . "/app/global.php");

$rooms = $studyroom_service->get_all_studyrooms();

$rooms_template = $template_engine->load_template(
    "aule/aule.template.html");
$rooms_template ->insert("header", build_header());
$rooms_template->insert("footer", build_footer());

function build_card(StudyRoomDTO $room): string {
    global $template_engine;
    $room_template = $template_engine->load_template(
        "aule/aulacard.template.html"
    );
    $room_template->insert_all(array(
        "name"        => $room->name,
        "description" => $room->short_description,
        "lat"         => $room->latitude,
        "lon"         => $room->longitude,
        "seats"       => $room->seats,
        "address"     => $room->address,
        "aula_lbl"    => strip_tags($room->name),
        "url_info"    => "./aula.php?id={$room->id}",
        "image"       => build_image($room->main_image),
    ));
    return $room_template->build();
}

$cards = "";
foreach ($rooms as $room) {
    $cards .= build_card($room);
}

$rooms_template->insert("cards", $cards);
echo $rooms_template->build();

?>