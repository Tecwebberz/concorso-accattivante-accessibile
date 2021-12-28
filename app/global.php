<?php
$root = "..";

require_once($root . "/lib/databaselayer.php");
require_once($root . "/lib/orm/services/userservice.php");
require_once($root . "/lib/orm/services/courseservice.php");
require_once($root . "/lib/orm/data/userdto.php");
require_once($root . "/lib/orm/data/coursedto.php");

$db = new DatabaseLayer(
    "127.0.0.1",
    "aferrari",
    "ukied8uSh6ohr5ei",
    "aferrari"
);

$user_service = new UserService($db, function(string $in) {
    return hash("sha256", $in);
});

$course_service = new CourseService($db);
var_dump($course_service->get_all_courses());
/*$user = new UserDTO();
$user->username = "mario@lol.it";
$user->name = "alessio";
$user->surname = "based2";
$user->year_of_registration = "22021";

var_dump($course_service->get_user_courses($user));*/
/*$course = new CourseDTO();
$course->id = 2;
$course->name = "narcotraffico";
$course->emal_prof = "pablo@escobar.com";
$course->active = 2;
$course->activation_year = "2017";
var_dump($course_service->replace($course));
*/
/*
$user = new UserDTO();
$user->username = "alecs69999";
$user->name = "alessio";
$user->surname = "based2";
$user->year_of_registration = "22021";
var_dump($user_service->update($user));

$res = $user_service->register($user, "cocaina");
var_dump($res);

$res = $user_service->login("alecs69", "cocaina");
var_dump($res);
*/
?>