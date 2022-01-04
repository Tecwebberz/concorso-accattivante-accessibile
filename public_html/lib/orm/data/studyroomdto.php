<?php

class StudyRoomDTO {
    public ?int $id = null;
    public string $name;
    public string $description;
    public string $address;
    public int $seats;
    public bool $reservation_required;
    public float $latitude;
    public float $longitude;
    public bool $wifi;
    public string $short_description;
    public ImageDTO $main_image;
}

function parse_studyroom(array $row) : StudyRoomDTO {
    $room = new StudyRoomDTO();
    $room->id = $row["id_aula"];
    $room->name = $row["name"];
    $room->description = $row["description"];
    $room->address = $row["address"];
    $room->seats = $row["seats"];
    $room->reservation_required = $row["reservation_required"];
    $room->latitude = $row["lat"];
    $room->longitude = $row["lon"];
    $room->wifi = $row["haswifi"];
    $room->short_description = $row["shordesc"];
    $room->main_image = parse_image($row);
    return $room;
}

?>