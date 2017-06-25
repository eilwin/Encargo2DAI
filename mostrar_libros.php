<?php
    include 'Conexion.php';
    $conex = new Conexion();
    $sql = "SELECT id, titulo, autor, editorial, idioma, copias FROM libros;";
    $datos = $conex->query($sql);
?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <!-- Bootstrap -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        <title>Agregar Libro</title>
        <style>
            body{ padding-top: 70px; }
        </style>
        <script>
            function borrarLibro(){
                var idBorrado = document.getElementById('idSend').value;
                window.location = "borrar_libro.php?id="+idBorrado;
            }
        </script>
    </head>
    <body>
        <?php include 'navbar.html'; ?>
        <div class="container">
            <div class="row">
                <h1>Listado de Libros (<?= count($datos)?>)</h1>
            </div>
            <?php if(count($datos)>0): ?>
            <div class="row">
                <table class="table">
                    <tr>
                        <th>N</th>
                        <th>Titulo</th>
                        <th>Autor</th>
                        <th>Editorial</th>
                        <th>Idioma</th>
                        <th>Copias</th>
                    </tr>
                    <?php $cont=1; foreach ($datos as $libro): ?>
                    <tr>
                        <td><?=$cont++?></td>
                        <td><?=$libro["titulo"]?></td>
                        <td><?=$libro["autor"]?></td>
                        <td><?=$libro["editorial"]?></td>
                        <td><?=$libro["idioma"]?></td>
                        <td><?=$libro["copias"]?></td>
                        <td><a href="editar_libro.php?cod=stock&id=<?=$libro['id']?>" class="btn btn-default">Stock</a>
                            <a href="editar_libro.php?cod=edit&id=<?=$libro['id']?>" class="btn btn-default" aria-label="Editar">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </a>
                            <button type="button" class="btn btn-default" aria-label="Borrar" data-toggle="modal" data-target="#mdlBorrar" onclick="document.getElementById('idSend').value=<?=$libro['id']?>;document.getElementById('liTitulo').innerHTML='<?=$libro["titulo"]?>';document.getElementById('liAutor').innerHTML='<?=$libro["autor"]?>';document.getElementById('liEditorial').innerHTML='<?=$libro["editorial"]?>';">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <?php else: ?>
            <div class="row">
                <h3>Ups, nada que mostrar por aca</h3>
            </div>
            <?php endif; ?>
        </div>
        <!-- MODALS -->
        <div class="modal fade" id="mdlBorrar" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                        <h4 class="modal-title">Confirmacion</h4>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="idSend">
                        <p>Esta seguro que desea eliminar este libro?</p>
                        <ul>
                            <li><p id="liTitulo">a</p></li>
                            <li><p id="liAutor">b</p></li>
                            <li><p id="liEditorial">c</p></li>
                        </ul>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" onclick="borrarLibro()">Eliminar</button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>