<?php

class ImageDTO {
    public int $id;
    public string $path;
    public string $alt;
}

function parse_image(array $row, string $prefix = ""): ImageDTO {
    $img = new ImageDTO();
    $img->id = $row["{$prefix}id"];
    $img->path = $row["{$prefix}path"];
    $img->alt = $row["{$prefix}alt"];
    return $img;
}

?>