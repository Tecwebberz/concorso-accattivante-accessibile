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
                (id_recensione, utente_recensore, testo, voto,
                 {$field}) 
             VALUES (?, ?, ?, ?, ?)",
            array(
                array("i", $review->id),
                array("s", $review->user->username),
                array("s", $review->text),
                array("i", $review->rating),
                array("i", $review->target_id),
                
            )
        );
        return ReviewServiceError::OK;
    }

    public function delete(ReviewDTO $review) {
        $table_name = $review->type === ReviewType::COURSE ?
                        $this->table_course : $this->table_studyroom;
        $this->db->query(
            "DELETE FROM {$table_name}
             WHERE id_recensione = ?",
            array(
                array("i", $review->id),
            )
        );
        return ReviewServiceError::OK;
    }

    public function get_course_reviews(CourseDTO $course): array {
        $res = $this->db->query(
            "SELECT * FROM {$this->table_course} as T
                JOIN User AS U ON U.username = T.utente_recensore
             WHERE course = ?
             ORDER BY id_recensione DESC",
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
             WHERE study_room = ?
             ORDER BY id_recensione DESC",
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

    public function get_review(int $review_type, int $id) {
        $table_name = $review_type === ReviewType::COURSE ?
                        $this->table_course : $this->table_studyroom;
        $res = $this->db->query(
            "SELECT * FROM {$table_name} as T
                JOIN User AS U ON U.username = T.utente_recensore
             WHERE id_recensione = ?
             ORDER BY id_recensione DESC",
            array(
                array("i", $id)
            )
        );

        if (!$res || $res->num_rows !== 1) {
            return ReviewServiceError::FAIL;
        }

        $data = $res->fetch_assoc();
        $review = parse_review($review_type, $data);
        $res->close();
        return $review;
    }

    public function get_reviews_made_by_user(User $user) {
        $res = $this->db->query(
            "SELECT * FROM {$this->table_studyroom} as T
                JOIN User AS U ON U.username = T.utente_recensore
             WHERE U.id = ?
             ORDER BY id_recensione DESC",
            array(
                array("i", $user->id)
            )
        );

        $ret = array();
        while ($row = $res->fetch_assoc()) {
            $ret[] = parse_review(ReviewType::STUDYROOM, $row);
        }
        $res->close();

        $res = $this->db->query(
            "SELECT * FROM {$this->table_course} as T
                JOIN User AS U ON U.username = T.utente_recensore
             WHERE U.id = ?
             ORDER BY id_recensione DESC",
            array(
                array("i", $user->id)
            )
        );

        while ($row = $res->fetch_assoc()) {
            $ret[] = parse_review(ReviewType::COURSE, $row);
        }
        $res->close();

        return $ret;
    }
}

?>