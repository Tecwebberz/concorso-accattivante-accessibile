<?php

session_start();

require_once($root . "/lib/databaselayer.php");
require_once($root . "/lib/orm/services/userservice.php");
require_once($root . "/lib/orm/services/courseservice.php");
require_once($root . "/lib/orm/services/studyroomservice.php");
require_once($root . "/lib/orm/data/userdto.php");
require_once($root . "/lib/orm/data/coursedto.php");
require_once($root . "/lib/orm/data/studyroomdto.php");
require_once($root . "/lib/template_engine.php");

$db = new DatabaseLayer(
    "127.0.0.1",
    "aferrari",
    "ukied8uSh6ohr5ei",
    "aferrari"
);

$user_service = new UserService($db, function(string $in) {
    return hash("sha256", $in);
});
$course_service = new CourseService($db);
$studyroom_service = new StudyRoomService($db);

$template_engine = new TemplateEngine($root . "/templates");

$actions = array(
    array("index.php", "Home"),
    array("recensioni.php", "Recensioni corsi"),
    array("aule.php", "Aule studio"),
    array("faq.php", "<abbr lang=\"en\"
            title=\"Frequently Asked Question\">F.A.Q.</abbr>"),
);

function build_header(): string {
    global $template_engine;
    global $page_index;
    global $actions;

    $header_template =
        $template_engine->load_template("header/header.template.html");

    foreach ($actions as $i => $action) {
        $id = "action{$i}";
        $element = "";
        if ($i === $page_index) {
            $element = "<li class=\"active\">{$action[1]}</li>";
        } else {
            $element = "<li><a href=\"{$action[0]}\">{$action[1]}</a></li>";
        }
        $header_template->insert($id, $element);
    }

    $action = " ";
    if (isset($_SESSION["logged_user"])
        && $_SESSION["logged_user"] !== null) {
        $action = $template_engine->load_template("header/loggedin.template.html")
                                  ->build();
    } else {
        $action = $template_engine->load_template("header/nonloggedin.template.html")
                                  ->build();
    }
    
    $header_template->insert("userlogin_action", $action);
    return $header_template->build();
}

?>