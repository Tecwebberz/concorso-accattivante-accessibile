<?php
$root = ".";
$page_index = 3;
require_once($root . "/app/global.php");

$faq_template = $template_engine->load_template("faq.template.html");
$faq_template->insert("header", build_header());

echo $faq_template->build();

?>
