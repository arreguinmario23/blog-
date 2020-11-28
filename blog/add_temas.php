<?php
require_once 'seguridad.php';
require_once 'conexion.php';

$con = conexion();
$nombre = $_REQUEST["nombre"];
$cmd = $con->prepare("INSERT INTO temas(nombre) VALUES(:nom)");
$cmd->bindValue(':nom',$nombre);
$cmd->execute();
$id = $con->lastInsertId();
if($cmd->rowCount() > 0)
    echo json_encode(["resp"=>"si","id"=>$id]);
else
    echo json_encode(["resp"=>"no"]);