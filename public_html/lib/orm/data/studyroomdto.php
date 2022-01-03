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
}

?>