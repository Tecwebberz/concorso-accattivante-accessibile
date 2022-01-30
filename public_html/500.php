<?php

http_response_code(500);

$root = ".";
require_once($root . "/app/global.php");

$page_template = $template_engine->load_template("500.template.html");
$page_template->insert("header", build_header());
$page_template->insert("footer", build_footer());


function build_base(): string {
    $srv = "http://{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}";

    $ruri = $_SERVER['REQUEST_URI'];
    $exp = explode("/", $ruri, 3);

    $uri = "";
    if (count($exp) === 3) {
        $uri = "/{$exp[1]}";
    }

    return "{$srv}{$uri}/";
}

$page_template->insert("base", build_base());

echo $page_template->build();

?>