<?php

$root = ".";
require_once($root . "/app/global.php");

if (!isset($_GET["user"])) {
    header("Location: ./registrati.php");
    exit();
}

$page_template = $template_engine->load_template("registrationsuccess.template.html");
$page_template->insert("header", build_header());
$page_template->insert("user", safe_input($_GET["user"]));

echo $page_template->build();

?>