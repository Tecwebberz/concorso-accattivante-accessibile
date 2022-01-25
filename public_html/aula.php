<?php
$root = ".";

if (!isset($_GET["id"])) {
    header("Location: 404.php?error=aula");
}

require_once($root . "/app/global.php");

$id = $_GET["id"];
$db->persist();
$room = $studyroom_service->get_room_by_id($id);
if ($room === StudyRoomServiceError::FAIL) {
    $db->close();
    header("Location: 404.php?error=aula");
}
$carousel = $studyroom_service->get_carousel($room);
$reviews = $review_service->get_studyroom_reviews($room);
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
    "name_tit"     => strip_tags($room->name),
    "short_desc"   => $room->short_description,
    "main_image"   => build_image($room->main_image),
));

$carousel_content = "";
foreach ($carousel as $img) {
    $carousel_content .= build_image($img);
}

$room_template->insert("carousel", $carousel_content);

$stats = statistics($reviews);
$room_template->insert_all(array(
    "count" => $stats["count"],
    "rating" => $stats["rating"],
));

$msg = "";
if (isset($_GET["error"])) {
    $error = $_GET["error"];
    switch ($error) {
        case 0:
            $msg = make_success("Operazione avvenuta con successo");
            break;
        default:
            $msg = make_error("Operazione fallita per favore riprova più tardi");
            break;
    }
}
$room_template->insert("msg", $msg);

$room_template->insert("form_recensione", make_review_form(ReviewType::STUDYROOM, $room->id, "aula.php?id={$room->id}"));
$room_template->insert("recensioni", make_reviews($reviews));

echo $room_template->build();
