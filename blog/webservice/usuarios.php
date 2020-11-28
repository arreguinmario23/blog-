<?php
//PERMISOS PARA CORS (Cross-Origin Resource Sharing)
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Authorization, Access-Control-Allow-Methods, Access-Control-Allow-Headers, Allow, Access-Control-Allow-Origin");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS, HEAD");
header("Allow: GET, POST, PUT, DELETE, OPTIONS, HEAD");

require_once '../seguridad.php';
require_once '../conexion.php';

//WEB SERVICE TIPO REST  PARA LA TABLA USUARIOS DE LA BD
$op = $_SERVER['REQUEST_METHOD'];
if($op == "OPTIONS"){
    exit(0);
}
$con = conexion();

switch($op){
    case "POST":
        //codigo para la alta CREATE
        if(isset($_POST['user']) && isset($_POST['pass']) 
        && isset($_POST['tipo']) && isset($_POST['nombre'])){

            $u = $_POST['user'];
            $p = $_POST['pass'];
            $t = $_POST["tipo"];
            $n = $_POST["nombre"];

            $cmd = $con->prepare("INSERT INTO usuarios VALUES(:u,:p,:t,:n)");
            $cmd->bindValue(':u', $u);
            $cmd->bindValue(':p', $p);
            $cmd->bindValue(':t', $t);
            $cmd->bindValue(':n', $n);
            $cmd->execute();
            $id = $con->lastInsertId();

            header("HTTP/1.1 200 OK");
            if($cmd->rowCount() > 0)
                echo json_encode(["resp"=>"si","id"=>$id]);
            else
                echo json_encode(["resp"=>"no"]);
        }else{
            header("HTTP/1.1 400 Bad Request");
        }
        break;
    case "GET":
        //codigo para la consulta READ
        if(isset($_GET['user'])){
            $sql = "SELECT * FROM usuarios WHERE user=:user";
            $cmd = $con->prepare($sql);
            $cmd->bindValue(':user', $_GET['user']);
            $cmd->setFetchMode(PDO::FETCH_ASSOC);
            $cmd->execute();
            $tabla = $cmd->fetch();
        }else{
            $sql = "SELECT * FROM usuarios";
            $cmd = $con->prepare($sql);
            $cmd->setFetchMode(PDO::FETCH_ASSOC);
            $cmd->execute();
            $tabla = $cmd->fetchAll();
        }
        header("HTTP/1.1 200 OK");
        echo json_encode($tabla);
        break;
    case "PUT":
        //codigo para la actualizacion UPDATE
        if(isset($_GET['user']) && isset($_GET['pass']) 
        && isset($_GET['tipo']) && isset($_GET['nombre'])){

            $u = $_GET['user'];
            $p = $_GET['pass'];
            $t = $_GET["tipo"];
            $n = $_GET["nombre"];

            $cmd = $con->prepare("UPDATE usuarios SET pass=:p, tipo=:t, nombre=:n WHERE user=:u");
            $cmd->bindValue(':u', $u);
            $cmd->bindValue(':p', $p);
            $cmd->bindValue(':t', $t);
            $cmd->bindValue(':n', $n);
            $cmd->execute();

            header("HTTP/1.1 200 OK");
            if($cmd->rowCount() > 0)
                echo json_encode(["resp"=>"si"]);
            else
                echo json_encode(["resp"=>"no"]);
        }else{
            header("HTTP/1.1 400 Bad Request");
        }
        break;
    case "DELETE":
        //codigo para la eliminacion DELETE
        if(isset($_GET['user'])){

            $u = $_GET['user'];

            $cmd = $con->prepare("DELETE FROM usuarios WHERE user=:u");
            $cmd->bindValue(':u', $u);
            $cmd->execute();

            header("HTTP/1.1 200 OK");
            if($cmd->rowCount() > 0)
                echo json_encode(["resp"=>"si"]);
            else
                echo json_encode(["resp"=>"no"]);
        }else{
            header("HTTP/1.1 400 Bad Request");
        }
        break;
    default:
        header("HTTP/1.1 400 Bad Request");
}