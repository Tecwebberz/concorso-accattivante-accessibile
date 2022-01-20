<?php

abstract class ReviewServiceError {
    const OK   = 1;
    const FAIL = 2;
}

class ReviewService {
    private DatabaseLayer $db;
    private string $table_studyroom;
    private string $table_course;

    public function __construct(DatabaseLayer $db) {
        $this->db = $db;
        $this->table_course = "Review_course";
        $this->table_studyroom = "Review_studyroom";
    }

    public function replace(ReviewDTO $review) {
        $table_name = $review->type === ReviewType::COURSE ?
                        $this->table_course : $this->table_studyroom;
        $field = $review->type === ReviewType::COURSE ?
                        "course" : "study_room";
        $res = $this->db->query(
            "REPLACE INTO {$table_name}
                (id_recensione, utente_recensione, testo, voto,
                 {$field}) 
             VALUES (?, ?, ?, ?, ?)",
            array(
                array("i", $review->id),
                array("i", $review->user->id),
                array("s", $review->text),
                array("i", $review->rating),
                array("i", $review->target_id),
                
            )
        );
        return ReviewServiceError::OK;
    }

    public function get_course_reviews(CourseDTO $course): array {
        $res = $this->db->query(
            "SELECT * FROM {$this->table_course} as T
                JOIN User AS U ON U.username = T.utente_recensore
             WHERE course = ?",
            array(
                array("i", $course->id)
            )
        );


        $ret = array();
        while ($row = $res->fetch_assoc()) {
            $ret[] = parse_review(ReviewType::COURSE, $row);
        }

        $res->close();
        return $ret;

    }

    public function get_studyroom_reviews(StudyRoomDTO $room): array {
        $res = $this->db->query(
            "SELECT * FROM {$this->table_studyroom} as T
                JOIN User AS U ON U.username = T.utente_recensore
             WHERE study_room = ?",
            array(
                array("i", $room->id)
            )
        );


        $ret = array();
        while ($row = $res->fetch_assoc()) {
            $ret[] = parse_review(ReviewType::STUDYROOM, $row);
        }

        $res->close();
        return $ret;
    }

}

?>