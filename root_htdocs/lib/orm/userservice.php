<?php

class UserInfoDTO {
    public $id;
    public $username;
}

abstract class UserServiceError {
    const OK                      = 0;
    const USERNAME_ALREADY_IN_USE = 1;
    const AUTH_FAILED             = 2;
}

class UserService {
    private $db;
    private $hash_function;

    public function __construct(DatabaseLayer $db,
                                callable $hash_function) {
        $this->db = $db;
        $this->hash_function = $hash_function;
    }

    public function register(string $username, string $password) {
        $hfn = $this->hash_function; // Grazie PHP
        try {
            $this->db->query(
                "INSERT INTO user (username, password)
                VALUES (?, ?)",
                array(
                    array("s", $username),
                    array("s", $hfn($password))
                )
            );
            return UserServiceError::OK;
        } catch (Exception $error) {
            $msg = $error->getMessage();
            if (strpos($msg, "Duplicate entry '{$username}'"
                             . " for key 'username'") !== false) {
                return UserServiceError::USERNAME_ALREADY_IN_USE;
            }
            throw $error;
        }
    }

    public function login(string $username, string $password) {
        $hfn = $this->hash_function; // Grazie PHP

        $res = $this->db->query(
            "SELECT * FROM user
                WHERE username = ? AND password = ?",
            array(
                array("s", $username),
                array("s", $hfn($password))
            )
        );
        
        if (!$res || $res->num_rows === 0) {
            return UserServiceError::AUTH_FAILED;
        }

        $data = $res->fetch_assoc();
        $user = new UserInfoDTO();
        $user->id = $data["id"];
        $user->username = $data["username"];

        $res->close();
        return $user;
    }
}

?>