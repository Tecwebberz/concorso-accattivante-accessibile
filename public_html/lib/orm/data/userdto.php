<?php

abstract class Role {
    const USER  = 0;
    const ADMIN = 1;
}

class UserDTO {
    public string $username;
    public string $name;
    public string $surname;
    public string $year_of_registration;
    public int $role;
}

function parse_user(array $data): UserDTO {
    $user = new UserDTO();
    $user->username = $data["username"];
    $user->name = $data["nome"];
    $user->surname = $data["cognome"];
    $user->year_of_registration = $data["anno_iscrizione"];
    $user->role = $data["role"];
    return $user;
}

function check_user_validity(UserDTO $user, string $password): int {

    if (!preg_match("/^[a-zA-Z][a-zA-Z0-9-_\.]{1,25}$/", $user->username)) {
        return UserServiceError::USERNAME_NOT_OK;
    }

    if ($user->year_of_registration < 2008 || $user->year_of_registration > date("Y")) {
        return UserServiceError::YEAR_NOT_OK;
    }

    if (!preg_match("/[A-Za-z]{1,50}/", $user->name)) {
        return UserServiceError::NAME_NOT_OK;
    }

    if (!preg_match("/[A-Za-z]{1,50}/", $user->surname)) {
        return UserServiceError::SURNAME_NOT_OK;
    }

    if (!preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password)) {
        return UserServiceError::PASSWORD_NOT_OK;
    }

    return UserServiceError::OK;
}

?>