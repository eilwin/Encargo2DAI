<?php 
    include 'Conexion.php';
    $conex = new Conexion();
    $sql = "SELECT * FROM libros";
    if(isset($_POST["btn-buscar"])){
        $dato = $_POST["datoLibro"];
        $criterio = $_POST["criterio"];
        if(empty($dato)){
            header('location:buscar_libro.php');
            exit;
        }
        if($criterio == "titulo"){
            $sql = "SELECT titulo, autor, editorial, idioma FROM libros WHERE titulo LIKE '%$dato%'";
        }
        elseif ($criterio == "autor") {
            $sql = "SELECT titulo, autor, editorial, idioma FROM libros WHERE autor LIKE '%$dato%'";
        }
        elseif ($criterio == "editorial") {
            $sql = "SELECT titulo, autor, editorial, idioma FROM libros WHERE editorial LIKE '%$dato%'";
        }
    }
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
                <h1>Busqueda de Libros</h1>
            </div>
            <div class="row">
                <form method="post" action="buscar_libro.php">
                    <div class="col-xs-12 col-sm-3">
                        <select name="criterio" class="form-control">
                            <option value="titulo">Titulo</option>
                            <option value="autor">Autor</option>
                            <option value="editorial">Editorial</option>
                        </select>
                    </div>
                    <div class="col-xs-12 col-sm-9">
                        <div class="input-group">
                            <input name="datoLibro" type="text" class="form-control" placeholder="Buscar...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit" name="btn-buscar">Buscar</button>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <?php if(isset($_POST["btn-buscar"])): ?>
            <div class="row">
                <h3>Resultados (<?= count($datos)?>)</h3>
                <?php if(count($datos)>0): ?>
                <div>
                    <table class="table">
                        <tr>
                            <th>Titulo</th>
                            <th>Autor</th>
                            <th>Editorial</th>
                            <th>Idioma</th>
                        </tr>
                        <?php foreach($datos as $libro): ?>
                        <tr>
                            <td><?=$libro["titulo"]?></td>
                            <td><?=$libro["autor"]?></td>
                            <td><?=$libro["editorial"]?></td>
                            <td><?=$libro["idioma"]?></td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else: ?>
                <div>
                    <p>No se han encontrado libros.</p>
                </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>