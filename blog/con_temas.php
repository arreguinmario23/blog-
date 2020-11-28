<?php
require_once 'seguridad.php';
require_once 'conexion.php';

$con = conexion();

$cmd = $con->prepare("SELECT idtema as id, nombre as tema FROM temas");
$cmd->setFetchMode(PDO::FETCH_ASSOC);
$cmd->execute();
$tabla = $cmd->fetchAll();
echo json_encode($tabla);