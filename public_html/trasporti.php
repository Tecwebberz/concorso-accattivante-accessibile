<?php
$root = ".";
require_once($root . "/app/global.php");

$trasporti_template = $template_engine->load_template("trasporti.template.html");
$trasporti_template->insert("header", build_header());
$trasporti_template->insert("footer", build_footer());

echo $trasporti_template->build();

?>
