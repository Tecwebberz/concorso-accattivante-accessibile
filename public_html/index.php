<?php
$root = ".";
$page_index = 0;
require_once($root . "/app/global.php");

$index_template = $template_engine->load_template("index.template.html");
$index_template->insert("header", build_header());

echo $index_template->build();

?>