<?php

$root = ".";
require_once($root . "/app/global.php");

$servizi_template = $template_engine->load_template("software.template.html");

$servizi_template ->insert("header", build_header());
$servizi_template->insert("footer", build_footer());

echo $servizi_template->build();

?>