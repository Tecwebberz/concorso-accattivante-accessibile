<?php

$root = ".";
require_once($root . "/app/global.php");

$page_template = $template_engine->load_template("404.template.html");
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

if (isset($_GET["error"]) && $_GET["error"] === "corso") {
    $page_template->insert_all(array(
        "from" => "stavi cercando un corso?",
        "base" => build_base(),
        "to"   => "Vedi tutti i " . make_link("corsi", "corsi.php") .
                  " oppure torna alla " . make_link("pagina principale", "index.php") . ".",
    ));
} else if (isset($_GET["error"]) && $_GET["error"] === "aula") {
    $page_template->insert_all(array(
        "from" => "stavi cercando un' aula?",
        "base" => build_base(),
        "to"   => "Vedi tutte le " . make_link("aule", "aule.php") .
                  " oppure torna alla " . make_link("pagina principale", "index.php") . ".",
    ));
} else {
    $page_template->insert_all(array(
        "from" => "puoi tornare alla",
        "base" => build_base(),
        "to"   => make_link("pagina principale", "index.php") . ".",
    ));
}

echo $page_template->build();

?>