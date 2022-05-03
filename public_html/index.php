<?php
$root = ".";
$page_index = 0;
require_once($root . "/app/global.php");

$index_template = $template_engine->load_template("index.template.html");
$index_template->insert("header", build_header());
$index_template->insert("footer", build_footer());

// $db->persist();
// echo make_reviews($review_service->get_reviews_made_by_user($_SESSION["logged_user"]));

echo $index_template->build();

?>