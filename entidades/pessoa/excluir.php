<?php

require_once '../../config/db.php';
$db = new DBClass();
$connection = $db->getConnection();

$id = filter_input(INPUT_POST, 'id');

$sql = "DELETE FROM usuario WHERE id=?";
$stm = $connection->prepare($sql);
$stm->execute([$id]);

session_start();
$_SESSION['mensagem'] = 'Usuário excluido com sucesso!';
header("location: ../../index.php");