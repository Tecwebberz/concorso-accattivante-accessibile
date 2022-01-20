<?php

abstract class ReviewType {
    const STUDYROOM = 0;
    const COURSE    = 1;
}

class ReviewDTO {
    public ?int $id;
    public int $type;
    public UserDTO $user;
    public string $text;
    public int $rating;
    public int $target_id;
}

function parse_review(int $type, array $in): ReviewDTO {
    $res = new ReviewDTO();
    $res->id = $in["id_recensione"];
    $res->type = $type;
    $res->user = parse_user($in);
    $res->text = $in["testo"];
    $res->rating = $in["voto"];
    $field = $type === ReviewType::COURSE ?
                "course" : "study_room";
    $res->target_id = $in[$field];
    return $res;
}

?>