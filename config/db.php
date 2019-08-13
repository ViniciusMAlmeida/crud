<?php

class DBClass {
    private $host = 'localhost:3306';
    private $username = 'root';
    private $password = '';
    private $database = 'mydb';

    public $connection;

    public function getConnection(){
        $this->connection = null;

        try {
            $this->connection = new PDO("mysql:host=".$this->host.";dbname=".$this->database, $this->username, $this->password);
            $this->connection->exec("set names utf8");
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Erro: ".$exception->getMessage();
        }

        return $this->connection;
    }
}