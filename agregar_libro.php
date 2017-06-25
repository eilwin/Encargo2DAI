<?php
    include 'Conexion.php';
    $conex = new Conexion();
    $errores = array();
    $titulo = "";
    $autor = "";
    $editorial = "";
    if(isset($_POST["btn-agregar"])){
        $titulo = strtoupper($_POST["titulo"]);
        $autor = strtoupper($_POST["autor"]);
        $editorial = strtoupper($_POST["editorial"]);
        $idioma = $_POST["idioma"];
        $copias = $_POST["copias"];
        
        if(empty($titulo)){
            array_push($errores,"Debe ingresar un Titulo");
        }
        else{
            $sql = "SELECT * FROM libros WHERE titulo='$titulo'";
            $coincidencias = $conex->query($sql);
            if(count($coincidencias) > 0){
                array_push($errores, "Titulo ya esta registrado");
            }
        }
        if(empty($autor)){
            array_push($errores,"Debe ingresar nombre de Autor");
        }
        if(empty($editorial)){
            array_push($errores,"Debe ingresar nombre de Editorial");
        }
        
        if(count($errores)==0){
            $sql = "INSERT INTO libros(titulo,autor,editorial,idioma,copias) VALUES ('$titulo','$autor','$editorial','$idioma','$copias')";
            $conex->execute($sql);
            //echo "";
            header("location:mostrar_libros.php");
            exit;
        }
    }
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
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="row">
                        <h1 class="h1">Agregar Libro</h1>
                    </div>
                    <?php if(count($errores)>0): ?>
                    <div class="text-danger">
                        Por favor solucione los siguientes problemas:
                        <ul>
                            <?php foreach($errores as $error): ?>
                            <li><?=$error?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>
                    <form method="post" action="agregar_libro.php">
                        <div class="form-group">
                            <label for="titulo">Titulo</label>
                            <input name="titulo" class="form-control" type="text" value="<?=$titulo?>" />
                        </div>
                        <div class="form-group">
                            <label for="autor">Autor</label>
                            <input name="autor" class="form-control" type="text" value="<?=$autor?>" />
                        </div>
                        <div class="form-group">
                            <label for="editorial">Editorial</label>
                            <input name="editorial" class="form-control" type="text" value="<?=$editorial?>" />
                        </div>
                        <div class="form-group">
                            <label for="idioma">Idioma</label>
                            <select name="idioma" class="form-control">
                                <option value="Español">Español</option>
                                <option value="Ingles">Ingles</option>
                                <option value="Frances">Frances</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="copias">Copias</label>
                            <input name="copias" class="form-control" type="number" value="0" min="0">
                        </div>
                        <div class="form-group">
                            <button name="btn-agregar" class="btn btn-primary" type="submit">Agregar</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
        
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>