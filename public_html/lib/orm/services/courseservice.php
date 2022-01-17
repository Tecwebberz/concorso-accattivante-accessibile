<?php

abstract class CourseServiceError {
    const OK   = 1;
    const FAIL = 2;
}

class CourseService {
    private DatabaseLayer $db;
    private string $table_name;
    private string $table_name_userrel;

    public function __construct(DatabaseLayer $db) {
        $this->db = $db;
        $this->table_name = "Course";
        $this->table_name_userrel = "Iscrizioni_corsi";
    }

    public function replace(CourseDTO $course) {
        $res = $this->db->query(
            "REPLACE INTO {$this->table_name}
                ('id_corso', 'name', 'description', 'cfu',
                 'propedeutici', 'anno', 'periodo', 'lingua',
                 'responsabile', 'email_resp') 
             VALUES (?, ?, ?, ?, ?)",
            array(
                array("i", $course->id),
                array("s", $course->name),
                array("s", $course->description),
                array("i", $course->cfu),
                array("s", $course->preparatory),
                array("i", $course->year),
                array("i", $course->semester),
                array("s", $course->language),
                array("s", $course->prof),
                array("s", $course->email_resp)
            )
        );
        return CourseServiceError::OK;
    }

    public function get_course_by_id(int $id) {
        $res = $this->db->query(
            "SELECT * FROM {$this->table_name}
             WHERE id_corso = ?",
            array(
                array("i", $id)
            )
        );

        if (!$res || $res->num_rows !== 1) {
            return CourseServiceError::FAIL;
        }

        $data = $res->fetch_assoc();
        $course = parse_course($data);

        $res->close();
        return $course;
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
            $ret[] = parse_course($row);
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
            $ret[] = parse_course($row);
        }

        $res->close();
        return $ret;
    }

}

?>