<?php

abstract class ConnectionType {
    const ONE_SHOT = "ONE_SHOT";
    const MULTIPLE = "MULTIPLE";
}

class DatabaseLayer {

    private $url;
    private $user;
    private $pass;
    private $database;

    private $maybe_connection;
    private $is_persisting;

    public function __construct(string $url, string $user,
                                string $pass, string $database) {
        $this->url = $url;
        $this->user = $user;
        $this->pass = $pass;
        $this->database = $database;
        $this->is_persisting = false;
    }

    private function connection(): mysqli {
        if (!$this->maybe_connection) {
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

    private function query(string $statement, array $parameters) {
        $stmt = $this->connection()->prepare($statement);
        foreach ($parameters as $id => $valtype) {
            $stmt->bind_param($valtype[0], $id, $valtype[1]);
        }
        $stmt->execute();
        $result = $stmt->get_result();

        $stmt->close();
        $this->non_persist_close();

        return $result;

        /*$res = array();
        while ($row = $result->fetch_assoc()) {
            $res[] = $row;
        }

        $stmt->close();
        $result->close();
        $this->non_persist_close();

        return $res;*/
    }
}

?>