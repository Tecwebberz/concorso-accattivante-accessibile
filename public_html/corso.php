<?php
$root = ".";

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    header("Location: 404.php?error=corso");
}

require_once($root . "/app/global.php");

$id = $_GET["id"];
$db->persist();
$course = $course_service->get_course_by_id($id);
if ($course === CourseServiceError::FAIL) {
    $db->close();
    header("Location: 404.php?error=corso");
}

$reviews = $review_service->get_course_reviews($course);
$db->close();

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

    function abbr_numeric(int $year) {
        switch ($year) {
            case 1:
                return "primo";
            case 2:
                return "secondo";
            case 3:
                return "terzo";
        }
    }

    function pretty_year(int $year): string{
        if ($year >= 1 && $year <= 3) {
            $abbr = abbr_numeric($year);
            return "del <abbr title='{$abbr}'>{$year}°</abbr> anno";
        } else {
            return "opzionale";
        }
    }
    function pretty_semester(int $semester): string {
        if ($semester >= 1 && $semester <= 2) {
            $abbr = abbr_numeric($semester);
            return "<abbr title='{$abbr}'>{$semester}°</abbr> semestre";
        } else {
            return "annuale";
        }
    }

    return pretty_semester($semester) . " " . pretty_year($year);
}

$course_template = $template_engine->load_template(
    "corso.template.html");

$course_template->insert_all(array(
    "header" => build_header(),
    "meta_corso" => strip_tags($course->name),
    "meta_keyword" => strip_tags($course->name),
    "name_tit" => strip_tags($course->name),
    "bc_corso" => $course->name,
    "name" => $course->name,
    "description" => $course->description,
    "cfu" => $course->cfu,
    "lingua" => pretty_language($course->language),
    "periodo" => pretty_period($course->year, $course->semester),
    "responsabile" =>$course->prof,
    "email" => make_link($course->email_resp, "mailto:{$course->email_resp}"),
    "footer" => build_footer(),
));

$stats = statistics($reviews);
$course_template->insert_all(array(
    "count" => $stats["count"],
    "rating" => $stats["rating"],
));

$msg = "";
if (isset($_GET["error"])) {
    $error = $_GET["error"];
    switch ($error) {
        case 0:
            $msg = make_success("Operazione avvenuta con successo");
            break;
        default:
            $msg = make_error("Operazione fallita per favore riprova più tardi");
            break;
    }
}
$course_template->insert("msg", $msg);

$course_template->insert("form_recensione", make_review_form(ReviewType::COURSE, $course->id, "corso.php?id={$course->id}"));
$course_template->insert("recensioni", make_reviews($reviews));

echo $course_template->build();

?>