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

?>