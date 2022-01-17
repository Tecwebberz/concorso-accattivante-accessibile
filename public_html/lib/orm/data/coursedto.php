<?php

class CourseDTO {
    public int $id;
    public string $name;
    public string $description;
    public int $cfu;
    public string $preparatory;
    public int $year;
    public int $semester;
    public string $language;
    public string $prof;
    public string $email_resp;
}

function parse_course(array $row) : CourseDTO {
    $course = new CourseDTO();
    $course->id = $row["id_corso"];
    $course->name = $row["name"];
    $course->description = $row["description"];
    $course->cfu = $row["cfu"];
    $course->preparatory = $row["propedeutici"];
    $course->year = $row["anno"];
    $course->semester = $row["periodo"];
    $course->language = $row["lingua"];
    $course->prof = $row["responsabile"];
    $course->email_resp = $row["email_resp"];
    return $course;
}
?>