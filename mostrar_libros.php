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
    </head>
    <body>
        <?php include 'navbar.html'; ?>
        <div class="container">
            <div class="row">
                <h1>Listado de Libros (<?= count($datos)?>)</h1>
            </div>
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
                        <td><button type="submit" class="btn btn-default" aria-label="Editar">
                                <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                            </button>
                            <button type="submit" class="btn btn-default" aria-label="Borrar">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>