<?php

abstract class StudyRoomServiceError {
    const OK   = 1;
    const FAIL = 2;
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
                 position, haswifi, shordesc, mainimage)
             VALUES (?, ?, ?, ?, ?, ?, POINT(?,?), ?, ?, ?)",
            array(
                array("i", $room->id),
                array("s", $room->name),
                array("s", $room->description),
                array("s", $room->address),
                array("i", $room->seats),
                array("i", $room->reservation_required),
                array("d", $room->latitude),
                array("d", $room->longitude),
                array("b", $room->wifi),
                array("s", $room->short_description),
                array("i", $room->main_image->id),
            )
        );
        return StudyRoomServiceError::OK;
    }

    public function get_all_studyrooms(): array {
        $res = $this->db->query(
            "SELECT *, ST_X(position) as lat, ST_Y(position) as lon
             FROM {$this->table_name}
                LEFT JOIN Image as MM ON mainimage = MM.id"
        );
        
        $ret = array();
        while ($row = $res->fetch_assoc()) {
            $ret[] = parse_studyroom($row);
        }

        $res->close();
        return $ret;
    }

    public function get_room_by_id(int $id) {
        $res = $this->db->query(
            "SELECT *, ST_X(position) as lat, ST_Y(position) as lon
             FROM {$this->table_name}
                LEFT JOIN Image as MM ON mainimage = MM.id
             WHERE id_aula = {$id}"
        );

        if (!$res || $res->num_rows !== 1) {
            return StudyRoomServiceError::FAIL;
        }

        $data = $res->fetch_assoc();
        $room = parse_studyroom($data);

        $res->close();
        return $room;
    }

}

?>