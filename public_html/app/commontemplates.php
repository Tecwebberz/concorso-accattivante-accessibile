<?php

function build_image(ImageDTO $img): string {
    global $root;
    global $template_engine;

    $img_template =
        $template_engine->load_template("image.template.html");
    
    $img_template->insert_all(array(
        "src" => "{$root}/assets/img/{$img->path}",
        "alt" => $img->alt
    ));
    return $img_template->build();
}

function make_error(string $message): string {
    global $template_engine;
    $error_template =
        $template_engine->load_template("error.template.html");
    $error_template->insert("error", $message);
    return $error_template->build();
}

$actions = array(
    array("index.php", "Home"),
    array("corsi.php", "Corsi"),
    array("aule.php", "Aule studio"),
    array("faq.php", "<abbr lang=\"en\"
            title=\"Frequently Asked Question\">F.A.Q.</abbr>"),
);

function build_header(): string {
    global $template_engine;
    global $page_index;
    global $actions;

    $header_template =
        $template_engine->load_template("header.template.html");

    $actions_len = count($actions);
    foreach ($actions as $i => $action) {
        $id = "action{$i}";
        $element = "";
        if ($i === $page_index) {
            $element = "<li> <a class=\"active\">{$action[1]}</a></li>";
        } else {
            $element = "<li><a href=\"{$action[0]}\">{$action[1]}</a></li>";
        }
        $header_template->insert($id, $element);
    }

    $action = " ";
    if (isset($_SESSION["logged_user"])
        && $_SESSION["logged_user"] !== null) {
        // Area personale
        if ($actions_len + 0 === $page_index) {
            $action .= "<li> <a class=\"active\">Esci</a></li>";
        } else {
            $action .= "<li><a href=\"app/logout_engine.php\">Esci</a></li>";
        }
    } else {
        // Accedi action
        if ($actions_len + 0 === $page_index) {
            $action .= "<li> <a class=\"active\">Accedi</a></li>";
        } else {
            $action .= "<li><a href=\"accedi.php\">Accedi</a></li>";
        }

        // Accedi action
        if ($actions_len + 1 === $page_index) {
            $action .= "<li> <a class=\"active\">Registrati</a></li>";
        } else {
            $action .= "<li><a href=\"registrati.php\">Registrati</a></li>";
        }
    }
    
    $header_template->insert("userlogin_action", $action);
    return $header_template->build();
}


?>