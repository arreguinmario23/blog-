<?php
require_once 'seguridad.php'
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/iconfont/material-icons.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Blog</title>
    <div>Mario Alberto Arreguin Hernandez</div>
</head>
<body>
    <nav class="navbar navbar-expand-sm navbar-dark colorFondo">
        <a class="navbar-brand" href="#">
            <i class="material-icons">comment</i>
            Blog
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#menuPrincipal">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuPrincipal">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="inicio.php">Inicio</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="mensajes.php">Mensajes</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="usuarios.php">Usuarios</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.php">Salir</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="card mt-5">
                    <div class="card-header colorFondo colorTexto">
                        Agregar tema
                    </div>
                    <div class="card-body">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    Tema:
                                </div>
                            </div>
                            <input type="text" name="tema" id="tema" 
                            class="form-control" placeholder="Nombre de tema">
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-primary" onclick="agregarTema()">
                            <i class="material-icons align-middle">add_circle</i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
        <div class="row">
            <div class="col">
                <table class="table table-hover table-dark">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Tema</th>
                            <th>...</th>
                        </tr>
                    </thead>
                    <tbody id="tablaTemas">
                        <tr>
                            <td>1</td>
                            <td>Programacion</td>
                            <td>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#modificaTema">
                                    <i class="material-icons align-middle">edit</i>
                                </button>
                                <button class="btn btn-danger" data-toggle="modal" data-target="#eliminaTema">
                                    <i class="material-icons align-middle">cancel</i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Matematicas</td>
                            <td>
                                <button class="btn btn-primary">
                                    <i class="material-icons align-middle">edit</i>
                                </button>
                                <button class="btn btn-danger">
                                    <i class="material-icons align-middle">cancel</i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Es una ventana modal para editar -->
    <div class="modal fade" id="modificaTema" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Editar Tema</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            Tema:
                        </div>
                    </div>
                    <input type="text" name="temaEditar" id="temaEditar" 
                    class="form-control" placeholder="Nombre de tema">
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" onclick="guardaCambios()" class="btn btn-primary" data-dismiss="modal">Guardar</button>
            </div>
          </div>
        </div>
      </div>

<!-- Es una ventana modal para eliminar -->
<div class="modal fade" id="eliminaTema" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Eliminar Tema</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p>¿esta seguro de elimanr el tema? Se eliminaran todos los mensajes relacionados.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
          <button type="button" onclick="confirmaEliminar()" class="btn btn-primary" data-dismiss="modal">Si</button>
        </div>
      </div>
    </div>
  </div>
 <!-- Alertas -->
 <!-- <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;"> -->
  <div id="idtoast" class="toast" style="position: absolute; top: 0; right: 0;">
    <div class="toast-header">
    <i class="material-icons align-middle">cancel</i>
      <strong class="mr-auto">Error</strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      No se pudo relizar la operacion
    </div>
  </div>
<!-- </div> -->

    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/inicio.js"></script>
</body>
</html>