<?php

include_once './db.php';

try {
    $dbclass = new DBClass();
    $connection = $dbclass->getConnection();
    $sql = file_get_contents("data/usuario.sql");
    $connection->exec($sql);
    echo "Database e Tabela criadas com sucesso!";
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}