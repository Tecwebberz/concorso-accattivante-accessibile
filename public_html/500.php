<?php

http_response_code(500);

$root = ".";
require_once($root . "/app/global.php");

$page_template = $template_engine->load_template("500.template.html");
$page_template->insert("header", build_header());
$page_template->insert("footer", build_footer());

$page_template->insert("base", build_base());

echo $page_template->build();

?>