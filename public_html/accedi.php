<?php
$root = ".";
$page_index = 4;
require_once($root . "/app/global.php");

$login_template = $template_engine->load_template("login.template.html");
$login_template->insert("header", build_header());

$error = "";
if (isset($_GET["error"]) && $_GET["error"] == UserServiceError::AUTH_FAILED) {
    $error = "Errore di accesso";
}

$login_template->insert("maybe_error", $error);

echo $login_template->build();

?>