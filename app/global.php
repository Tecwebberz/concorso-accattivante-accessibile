<?php
$root = "..";

require_once($root . "/lib/databaselayer.php");
require_once($root . "/lib/orm/userservice.php");

$db = new DatabaseLayer(
    "127.0.0.1",
    "aferrari",
    "ukied8uSh6ohr5ei",
    "aferrari"
);

$user_service = new UserService($db, function(string $in) {
    return hash("sha256", $in);
});

$res = $user_service->login("alecs4", "ciao");
echo var_dump($res);

?>