<?php
require_once 'seguridad.php';
require_once 'conexion.php';

$con = conexion();
$id = $_REQUEST["id"];
$cmd = $con->prepare("DELETE FROM temas WHERE idtema=:id");
$cmd->bindValue(':id',$id);
$cmd->execute();

if($cmd->rowCount() > 0)
    echo json_encode(["resp"=>"si"]);
else
    echo json_encode(["resp"=>"no"]);