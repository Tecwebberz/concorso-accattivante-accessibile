<?php

class TemplateEngine {

    private string $base_path;

    public function __construct(string $base_path = "templates") {
        $this->base_path = $base_path;
    }

    public function load_template(string $name): Template {
        $template_content = "";
        try {
            $template_content = file_get_contents("{$this->base_path}/{$name}");
        } catch (Exception $ex) {
            throw new Exception("Could not open template: \"{$name}\"
                in base {$this->base_path}");
        }
        return new Template($name, $template_content);
    }
}

class Template {

    static string $PATT_BEGIN = "%_";
    static string $PATT_END = "_%";

    private string $template_name;
    private string $state;

    public function __construct(string $template_name, string $state) {
        $this->template_name = $template_name;
        $this->state = $state;
    }

    public function insert(string $id, string $value): void {
        // Thanks PHP :)
        $patt_begin = self::$PATT_BEGIN;
        $patt_end = self::$PATT_END;

        $n_changes = 0;
        $patt = "{$patt_begin}{$id}{$patt_end}";
        $this->state = str_replace($patt, $value, $this->state, $n_changes);
        if ($n_changes !== 1) {
            throw new Exception("Error while replacing \"{$id}\" in
                                template \"{$this->template_name}\":
                                {$n_changes} maches");
        }
    }

    public function insert_all(array $parameters): void {
        foreach ($parameters as $id => $value) {
            $this->insert($id, $value);
        }
    }

    public function build(): string {
        // Thanks PHP :)
        $patt_begin = self::$PATT_BEGIN;
        $patt_end = self::$PATT_END;

        $matches = array();
        preg_match_all("{$patt_begin}([a-zA-Z0-9]+){$patt_end}",
                    $this->state, $matches);

        if (!empty($matches[1])) {
            $non_replaced = implode(", ", $matches[1]);
            throw new Exception("Cannot build template
                \"{$this->template_name}\" this placeholders
                are empty: \"{$non_replaced}\"");
        }

        return $this->state;
    }

}

?>