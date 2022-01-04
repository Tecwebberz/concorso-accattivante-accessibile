<?php

class UserDTO {
    public string $username;
    public string $name;
    public string $surname;
    public string $year_of_registration;
}

function parse_user(array $data): UserDTO {
    $user = new UserDTO();
    $user->username = $data["username"];
    $user->name = $data["nome"];
    $user->surname = $data["cognome"];
    $user->year_of_registration = $data["anno_iscrizione"];
    return $user;
}

?>