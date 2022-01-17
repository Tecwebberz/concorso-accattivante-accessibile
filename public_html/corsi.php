<?php

$root = ".";
$page_index = 1;
require_once($root . "/app/global.php");

$courses = $course_service->get_all_courses();

$courses_template = $template_engine->load_template(
    "corsi/corsi.template.html"
);

$courses_template ->insert("header", build_header());

function build_course_component(string $name, array $courses): string {
    global $template_engine;
    $section_template = $template_engine->load_template(
        "corsi/corsisection.template.html"
    );
    $section_template->insert("sectionname", $name);

    $list = "";
    foreach ($courses as $course) {
        $list .= "<li><a href='corso.php?id={$course->id}'>{$course->name}</a></li>";
    }
    
    $section_template->insert("courses", $list);
    return $section_template->build();
}

function make_year_filter(int $year): callable {
    return function(CourseDTO $course) use($year): bool {
        return $course->year === $year;
    };
}

$fst_year = array_filter($courses, make_year_filter(1));
$snd_year = array_filter($courses, make_year_filter(2));
$trd_year = array_filter($courses, make_year_filter(3));
$opt_year = array_filter($courses, make_year_filter(4));

$courses_template->insert_all(array(
    "fstyr" => build_course_component("Primo anno", $fst_year),
    "sndyr" => build_course_component("Secondo anno", $snd_year),
    "trdyr" => build_course_component("Terzo anno", $trd_year),
    "optional" => build_course_component("Opzionali", $opt_year),
));

echo $courses_template->build();

?>