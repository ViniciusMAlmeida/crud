<?php

require_once '../../config/db.php';
$dbclass = new DBClass();
$connection = $dbclass->getConnection();

$nome = filter_input(INPUT_POST, 'nome');
$email = filter_input(INPUT_POST, 'email');
$senha = md5(filter_input(INPUT_POST, 'senha'));

$sql = "INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)";
$stm = $connection->prepare($sql);
$stm->execute([$nome, $email, $senha]);

session_start();
$_SESSION['mensagem'] = 'Usuário cadastrado com sucesso!';
header("location: ../../index.php");