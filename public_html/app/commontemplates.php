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
            $element = make_list_item($action[1], "active");
        } else {
            $element = make_list_item(make_link($action[1], $action[0]));
        }
        $header_template->insert($id, $element);
    }

    $action = " ";
    if (isset($_SESSION["logged_user"])
        && $_SESSION["logged_user"] !== null) {
        // Area personale
        if ($actions_len + 0 === $page_index) {
            $action .= make_list_item("Esci", "active");
        } else {
            $action .= make_list_item(make_link("Esci", "app/logout_engine.php"));
        }
    } else {
        // Accedi action
        if ($actions_len + 0 === $page_index) {
            $action .= make_list_item("Accedi", "active");
        } else {
            $action .= make_list_item(make_link("Accedi", "accedi.php"));
        }

        // Accedi action
        if ($actions_len + 1 === $page_index) {
            $action .= make_list_item("Registrati", "active");
        } else {
            $action .= make_list_item(make_link("Registrati", "registrati.php"));
        }
    }
    
    $header_template->insert("userlogin_action", $action);
    return $header_template->build();
}

function make_list_item(string $content, ?string $class = null): string {
    $open = "<li>";
    if ($class !== null) {
        $open = "<li class={$class}>";
    }
    return "{$open}{$content}</li>";
}

function make_link(string $content, string $ref): string {
    return "<a href='{$ref}'>{$content}</a>";
}

?>