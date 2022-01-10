<?php
$root = "..";
require_once($root . "/app/global.php");

unset($_SESSION["logged_user"]);
header("Location: ../index.php");
?>