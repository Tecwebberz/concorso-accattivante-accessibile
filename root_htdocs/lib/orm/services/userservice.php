<?php

abstract class UserServiceError {
    const OK                      = 0;
    const USERNAME_ALREADY_IN_USE = 1;
    const AUTH_FAILED             = 2;
}

class UserService {
    private DatabaseLayer $db;
    private $hash_function;
    private string $table_name;

    public function __construct(DatabaseLayer $db,
                                callable $hash_function) {
        $this->db = $db;
        $this->hash_function = $hash_function;
        $this->table_name = "Utente";
    }

    public function register(UserDTO $user, string $password): int {
        $hfn = $this->hash_function; // Grazie PHP
        try {
            $this->db->query(
                "INSERT INTO {$this->table_name} (username, password, 
                                                  nome, cognome,
                                                  anno_iscrizione)
                VALUES (?, ?, ?, ?, ?)",
                array(
                    array("s", $user->username),
                    array("s", $hfn($password)),
                    array("s", $user->name),
                    array("s", $user->surname),
                    array("s", $user->year_of_registration),
                )
            );
            return UserServiceError::OK;
        } catch (Exception $error) {
            $msg = $error->getMessage();
            if (strpos($msg, "Duplicate entry '{$user->username}'"
                             . " for key 'PRIMARY'") !== false) {
                return UserServiceError::USERNAME_ALREADY_IN_USE;
            }
            throw $error;
        }
    }

    public function login(string $username, string $password) {
        $hfn = $this->hash_function; // Grazie PHP

        $res = $this->db->query(
            "SELECT * FROM {$this->table_name}
                WHERE username = ? AND password = ?",
            array(
                array("s", $username),
                array("s", $hfn($password))
            )
        );
       
        if (!$res || $res->num_rows !== 1) {
            return UserServiceError::AUTH_FAILED;
        }
        $data = $res->fetch_assoc();

        $user = new UserDTO();
        $user->username = $data["username"];
        $user->name = $data["nome"];
        $user->surname = $data["cognome"];
        $user->year_of_registration = $data["anno_iscrizione"];

        $res->close();
        return $user;
    }

    public function update(UserDTO $user): int {
        $res = $this->db->query(
            "UPDATE {$this->table_name}
             SET nome = ?,
                 cognome = ?,
                 anno_iscrizione = ?
             WHERE username = ?",
            array(
                array("s", $user->name),
                array("s", $user->surname),
                array("s", $user->year_of_registration),
                array("s", $user->username),
            )
        );
        return UserServiceError::OK;
    }
}

?>