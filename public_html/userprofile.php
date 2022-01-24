<?php
$root = ".";
require_once($root . "/app/global.php");

$page_template = $template_engine->load_template("userprofile.template.html");
$page_template->insert("header", build_header());


echo $page_template->build();

?>