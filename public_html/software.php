<?php

$root = ".";
require_once($root . "/app/global.php");

$software_template = $template_engine->load_template("software.template.html");

$software_template ->insert("header", build_header());
$software_template->insert("footer", build_footer());

echo $software_template->build();

?>