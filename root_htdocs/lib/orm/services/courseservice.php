<?php

abstract class CourseServiceError {
    const OK = 1;
}

class CourseService {
    private DatabaseLayer $db;
    private string $table_name;
    private string $table_name_userrel;

    public function __construct(DatabaseLayer $db) {
        $this->db = $db;
        $this->table_name = "Corso";
        $this->table_name_userrel = "Iscrizioni_corsi";
    }

    public function replace(CourseDTO $course) {
        $res = $this->db->query(
            "REPLACE INTO {$this->table_name}
                (id_corso, nome, email_responsabile,
                 attivo, anno_attivazione)
             VALUES (?, ?, ?, ?, ?)",
            array(
                array("i", $course->id),
                array("s", $course->name),
                array("s", $course->emal_prof),
                array("i", $course->active),
                array("s", $course->activation_year),
            )
        );
        return CourseServiceError::OK;
    }

    public function get_user_courses(UserDTO $user): array {
        $res = $this->db->query(
            "SELECT * FROM {$this->table_name} as C
                JOIN {$this->table_name_userrel} AS UR
                    ON UR.corso = C.id_corso
             WHERE utente = ?",
            array(
                array("s", $user->username)
            )
        );
        
        $ret = array();
        while ($row = $res->fetch_assoc()) {
            $ret[] = self::parse_course($row);
        }

        $res->close();
        return $ret;
    }

    public function get_all_courses(): array {
        $res = $this->db->query(
            "SELECT * FROM {$this->table_name}"
        );
        
        $ret = array();
        while ($row = $res->fetch_assoc()) {
            $ret[] = self::parse_course($row);
        }

        $res->close();
        return $ret;
    }

    private static function parse_course(array $row) : CourseDTO {
        $course = new CourseDTO();
        $course->id = $row["id_corso"];
        $course->name = $row["nome"];
        $course->emal_prof = $row["email_responsabile"];
        $course->active = $row["attivo"];
        $course->activation_year = $row["anno_attivazione"];
        return $course;
    }
}

?>