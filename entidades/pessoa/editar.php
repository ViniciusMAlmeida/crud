<?php

require_once '../../config/db.php';
$db = new DBClass();
$connection = $db->getConnection();

$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email');
$senha = filter_input(INPUT_POST, 'senha');
$id = filter_input(INPUT_POST, 'id');

$sql = "UPDATE usuario SET nome=?, email=?, senha=? WHERE id=?";
$stm = $connection->prepare($sql);
$stm->execute([$nome, $email, $senha, $id]);

session_start();
$_SESSION['mensagem'] = 'Usuário atualizado com sucesso!';
header("location: ../../index.php");