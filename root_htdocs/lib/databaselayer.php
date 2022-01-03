<?php

class DatabaseLayer {

    private string $url;
    private string $user;
    private string $pass;
    private string $database;

    private ?mysqli $maybe_connection;
    private bool $is_persisting;

    public function __construct(string $url, string $user,
                                string $pass, string $database) {
        $this->url = $url;
        $this->user = $user;
        $this->pass = $pass;
        $this->database = $database;
        $this->is_persisting = false;
        $this->maybe_connection = null;
    }

    private function connection(): mysqli {
        if ($this->maybe_connection === null) {
            $this->maybe_connection = new mysqli(
                $this->url,
                $this->user,
                $this->pass,
                $this->database
            );

            if ($this->maybe_connection->connect_error) {
                throw new Exception("Connection error: 
                ({$this->maybe_connection->connect_errno}) 
                {$this->maybe_connection->connect_error}");
            }
        }
        return $this->maybe_connection;
    }

    private function non_persist_close(): void {
        if (!$this->is_persisting) {
            $this->maybe_connection->close();
        }
    }

    public function persist(): void {
        $this->is_persisting = true;
    }

    public function force_connect(): void {
        $this->connection();
    }

    public function query(string $statement,
                           array $parameters = array()) {
        $stmt = $this->connection()->prepare($statement);
        if (!$stmt) {
            throw new Exception("Cannot create statement for
                query: '{$statement}' error: '{$this->connection()->error}");
        }

        $format = "";
        $values = array();
        foreach ($parameters as $valtype) {
            $format  .= $valtype[0];
            $values[] = $valtype[1];
        }

        if ($format !== "") {
            $stmt->bind_param($format, ...$values);
        }
        $stmt->execute();

        $result = $stmt->get_result();
        if ($this->connection()->error) {
            throw new Exception("Cannot perform query: 
                '{$statement}' error: '{$this->connection()->error}");
        }

        $stmt->close();
        $this->non_persist_close();

        return $result;
    }
}

?>