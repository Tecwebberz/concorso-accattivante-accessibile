<?php

$root = ".";
require_once($root . "/app/global.php");

$stampe_template = $template_engine->load_template("stampe.template.html");

$stampe_template ->insert("header", build_header());
$stampe_template->insert("footer", build_footer());

echo $stampe_template->build();

?>