<?php

http_response_code(404);

$root = ".";
require_once($root . "/app/global.php");

$page_template = $template_engine->load_template("404.template.html");
$page_template->insert("header", build_header());
$page_template->insert("footer", build_footer());


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