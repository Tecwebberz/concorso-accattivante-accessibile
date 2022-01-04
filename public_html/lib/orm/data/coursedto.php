<?php

class CourseDTO {
    public int $id;
    public string $name;
    public string $emal_prof;
    public int $active;
    public string $activation_year;
}

function parse_course(array $row) : CourseDTO {
    $course = new CourseDTO();
    $course->id = $row["id_corso"];
    $course->name = $row["nome"];
    $course->emal_prof = $row["email_responsabile"];
    $course->active = $row["attivo"];
    $course->activation_year = $row["anno_attivazione"];
    return $course;
}
?>