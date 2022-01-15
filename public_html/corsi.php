<?php

$root = ".";
$page_index = 1;
require_once($root . "/app/global.php");


$courses_template = $template_engine->load_template(
    "corsi.template.html");

$courses_template ->insert("header", build_header());

echo $courses_template->build();

?>