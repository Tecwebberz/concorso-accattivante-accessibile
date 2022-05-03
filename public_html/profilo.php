<?php
$root = ".";
$page_index = 5;
require_once($root . "/app/global.php");

$login_template = $template_engine->load_template("accedi.template.html");
$login_template->insert("header", build_header());
$login_template->insert("footer", build_footer());


echo "cruscotto";

?>