<?php

$root = ".";
$page_index = 2;
require_once($root . "/app/global.php");

$servizi_template = $template_engine->load_template("servizi.template.html");

$servizi_template ->insert("header", build_header());
$servizi_template->insert("footer", build_footer());

echo $servizi_template->build();

?>