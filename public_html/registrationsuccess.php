<?php

$root = ".";
require_once($root . "/app/global.php");

$page_template = $template_engine->load_template("registrationsuccess.template.html");
$page_template->insert("header", build_header());

$page_template->insert("nome", "Mario");

echo $page_template->build();

?>