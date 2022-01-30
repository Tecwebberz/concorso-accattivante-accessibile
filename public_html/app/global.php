<?php
require_once($root . "/lib/databaselayer.php");
require_once($root . "/lib/orm/services/userservice.php");
require_once($root . "/lib/orm/services/courseservice.php");
require_once($root . "/lib/orm/services/studyroomservice.php");
require_once($root . "/lib/orm/services/reviewservice.php");
require_once($root . "/lib/orm/data/userdto.php");
require_once($root . "/lib/orm/data/coursedto.php");
require_once($root . "/lib/orm/data/studyroomdto.php");
require_once($root . "/lib/orm/data/imagedto.php");
require_once($root . "/lib/orm/data/reviewdto.php");
require_once($root . "/lib/template_engine.php");

require_once($root . "/lib/commontemplates.php");

session_start();

$db = new DatabaseLayer(
    "127.0.0.1",
    "aferrari",
    "ukied8uSh6ohr5ei",
    "aferrari"
);

$user_service = new UserService($db, function(string $in): string {
    return hash("sha256", $in);
});
$course_service = new CourseService($db);
$studyroom_service = new StudyRoomService($db);
$review_service = new ReviewService($db);

$template_engine = new TemplateEngine($root . "/templates");


function safe_input(string $in): string {
    return trim(htmlentities(strip_tags($in)));
}

function build_base(): string {
    $srv = "http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}";

    $ruri = $_SERVER['REQUEST_URI'];
    $exp = explode("/", $ruri, 3);

    $uri = "";
    if (count($exp) === 3) {
        $uri = "/{$exp[1]}";
    }

    return "{$srv}{$uri}/";
}

function to500($errno, $errstr) {
    http_response_code(500);
    $base = build_base();
    header("Location: {$base}500.php");
    exit();
}

set_error_handler('to500');
set_exception_handler('to500');

?>