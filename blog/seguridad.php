<?php
session_start();
if(!isset($_SESSION["login"])){
    echo '
    <div class="alert alert-danger" role="alert">
        Error, debes iniciar sesion.
    </div>
    ';
    exit(0);
}
if($_SESSION["login"] == "no"){
    echo '
    <div class="alert alert-danger" role="alert">
        Error, debes iniciar sesion.
    </div>
    ';
    exit(0);
}