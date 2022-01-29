<?php
$root = ".";
$page_index = 5;
require_once($root . "/app/global.php");

$page_template = $template_engine->load_template("registrati.template.html");
$page_template->insert("header", build_header());
$page_template->insert("footer", build_footer());

$error = "";
if (isset($_GET["error"]) && $_GET["error"] == UserServiceError::USERNAME_ALREADY_IN_USE) {
    $error = make_error("Username già in uso");
}
$page_template->insert("maybe_error", $error);

echo $page_template->build();

?>