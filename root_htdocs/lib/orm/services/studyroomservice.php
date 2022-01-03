<?php

abstract class StudyRoomServiceError {
    const OK = 1;
}

class StudyRoomService {
    private DatabaseLayer $db;
    private string $table_name;

    public function __construct(DatabaseLayer $db) {
        $this->db = $db;
        $this->table_name = "Study_room";
    }

    public function replace(StudyRoomDTO $room) {
        $this->db->query(
            "REPLACE INTO {$this->table_name}
                (id_aula, name, description,
                 address, seats, reservation_required,
                 position)
             VALUES (?, ?, ?, ?, ?, ?, POINT(?,?))",
            array(
                array("i", $room->id),
                array("s", $room->name),
                array("s", $room->description),
                array("s", $room->address),
                array("i", $room->seats),
                array("i", $room->reservation_required),
                array("d", $room->latitude),
                array("d", $room->longitude),
            )
        );
        return StudyRoomServiceError::OK;
    }

    public function get_all_studyrooms(): array {
        $res = $this->db->query(
            "SELECT *, ST_X(position) as lat, ST_Y(position) as lon
             FROM {$this->table_name}"
        );
        
        $ret = array();
        while ($row = $res->fetch_assoc()) {
            $ret[] = self::parse_studyroom($row);
        }

        $res->close();
        return $ret;
    }

    private static function parse_studyroom(array $row) : StudyRoomDTO {
        $room = new StudyRoomDTO();
        $room->id = $row["id_aula"];
        $room->name = $row["name"];
        $room->description = $row["description"];
        $room->address = $row["address"];
        $room->seats = $row["seats"];
        $room->reservation_required = $row["reservation_required"];
        $room->latitude = $row["lat"];
        $room->longitude = $row["lon"];
        return $room;
    }
}

?>