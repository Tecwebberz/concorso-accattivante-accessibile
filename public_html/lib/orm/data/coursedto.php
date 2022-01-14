<?php

class CourseDTO {
    public int $id;
    public string $name;
    public string $description;
    public int $cfu;
    public string $propedeutici;
    public int $anno;
    public int $periodo;
    public string $lingua;
    public string $responsabile;
    public string $email_resp;
}

function parse_course(array $row) : CourseDTO {
    $course = new CourseDTO();
    $course->id_corso = $row["id_corso"];
    $course->name = $row["name"];
    $course->description = $row["description"];
    $course->cfu = $row["cfu"];
    $course->propedeutici = $row["propedeutici"];
    $course->anno = $row["anno"];
    $course->periodo = $row["periodo"];
    $course->lingua = $row["lingua"];
    $course->responsabile = $row["responsabile"];
    $course->email_resp = $row["email_resp"];
    return $course;
}
?>