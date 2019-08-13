<?php
$sql = "SELECT * FROM usuario";
$stm = $connection->prepare($sql);
$stm->execute();
$usuarios = $stm->fetchAll();