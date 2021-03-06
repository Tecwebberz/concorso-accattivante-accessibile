<?php
$root = ".";
$page_index = 5;
require_once($root . "/app/global.php");

$login_template = $template_engine->load_template("accedi.template.html");
$login_template->insert("header", build_header());
$login_template->insert("footer", build_footer());

$error = "";
if (isset($_GET["error"]) && $_GET["error"] == UserServiceError::AUTH_FAILED) {
    $error = make_error("Credenziali errate!");
}

$login_template->insert("maybe_error", $error);

$login_template->insert("target", isset($_GET["target"]) ? 
    $_GET["target"] : "profilo.php");

echo $login_template->build();

?>