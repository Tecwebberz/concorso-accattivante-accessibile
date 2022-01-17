<?php
$root = ".";

if (!isset($_GET["id"])) {
    echo "id not set";
    die;
}

require_once($root . "/app/global.php");

$id = $_GET["id"];
$course = $course_service->get_course_by_id($id);
if ($course === CourseServiceError::FAIL) {
    echo "id del casso";
    die;
}

function pretty_language(string $lang): string {
    switch ($lang) {
        case 'ITA':
            return "Il corso è tenuto in lingua italiana";
        case 'ENG':
            return "Il corso è tenuto in lingua inglese";
        default:
            return "Non è specificata la lingua del corso";
    }
}

function pretty_period(int $year, int $semester): string {
    function pretty_year(int $year): string{
        if ($year >= 1 && $year <= 3) {
            return "del {$year}° anno";
        } else {
            return "opzionale";
        }
    }
    function pretty_semester(int $semester): string {
        return "{$semester}° semestre";
    }

    return pretty_semester($semester) . " " . pretty_year($year);
}

function pretty_prof(string $prof_name, string $prof_mail): string {
    return make_link("$prof_name (e-mail)", "mailto:{$prof_mail}");
}

$course_template = $template_engine->load_template(
    "corso.template.html");

$course_template->insert_all(array(
    "header" => build_header(),
    "name_tit" => strip_tags($course->name),
    "name" => $course->name,
    "description" => $course->description,
    "cfu" => $course->cfu,
    "lingua" => pretty_language($course->language),
    "periodo" => pretty_period($course->year, $course->semester),
    "responsabile" => pretty_prof($course->prof, $course->email_resp),
));

$course_template->insert("recensioni", "crizzo");

echo $course_template->build();

?>