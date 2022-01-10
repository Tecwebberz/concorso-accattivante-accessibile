<?php
$root = ".";
$page_index = 4;
require_once($root . "/app/global.php");

$login_template = $template_engine->load_template("accedi.template.html");
$login_template->insert("header", build_header());

$error = "";
if (isset($_GET["error"]) && $_GET["error"] == UserServiceError::AUTH_FAILED) {
    $error = make_error("Credenziali errate!");
}

$login_template->insert("maybe_error", $error);

echo $login_template->build();

?>