<?php
require_once 'seguridad.php';
require_once 'conexion.php';

$op = $_GET['operacion'];

$con = conexion();
//CRUD Create Read Update Delete
switch($op){
    case "C":
        $idtema = $_GET['idtema'];
        $mensaje = $_GET['mensaje'];
        $user = $_SESSION["user"];
        $fecha = date("Y-m-d H:i:s");
        $cmd = $con->prepare("INSERT INTO mensajes(idtema,mensaje,user,fecha) VALUES(:id,:m,'$user','$fecha')");
        $cmd->bindValue(':id', $idtema);
        $cmd->bindValue(':m', $mensaje);
        $cmd->execute();
        $id = $con->lastInsertId();
        if($cmd->rowCount() > 0)
            echo json_encode(["resp"=>"si","id"=>$id]);
        else
            echo json_encode(["resp"=>"no"]);
    break;
    case "R":
        $idtema = $_GET['idtema'];
        $cmd = $con->prepare("SELECT idmsg AS id, idtema AS tema, mensaje, user AS usuario, fecha FROM mensajes WHERE idtema=:id");
        $cmd->bindValue(':id', $idtema);
        $cmd->setFetchMode(PDO::FETCH_ASSOC);
        $cmd->execute();
        $tabla = $cmd->fetchAll();
        echo json_encode($tabla);
    break;
    case "U":
        $id = $_REQUEST["idmsg"];
        $mensaje = $_REQUEST["mensaje"];
        $cmd = $con->prepare("UPDATE mensajes SET mensaje=:m WHERE idmsg=:id");
        $cmd->bindValue(':m',$mensaje);
        $cmd->bindValue(':id',$id);
        $cmd->execute();
        if($cmd->rowCount() > 0)
            echo json_encode(["resp"=>"si"]);
        else
            echo json_encode(["resp"=>"no"]);
    break;
    case "D":
        $id = $_REQUEST["idmsg"];
        $cmd = $con->prepare("DELETE FROM mensajes WHERE idmsg=:id");
        $cmd->bindValue(':id',$id);
        $cmd->execute();
        if($cmd->rowCount() > 0)
            echo json_encode(["resp"=>"si"]);
        else
            echo json_encode(["resp"=>"no"]);
    break;
    default:
    
}
