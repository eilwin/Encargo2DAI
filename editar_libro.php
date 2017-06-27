<?php
    include 'Conexion.php';
    $conex = new Conexion();
    $errores = array();
    $idioma_o = "";
    if(isset($_GET["cod"]) && isset($_GET["id"])){
        $id = $_GET["id"];
        $sql = "SELECT id, titulo, autor, editorial, idioma, copias FROM libros WHERE id='$id'";
        $datos = $conex->query($sql);
        $libro = $datos[0];
        $cod = $_GET["cod"];
        $titulo = $libro["titulo"];
        $autor = $libro["autor"];
        $editorial = $libro["editorial"];
        $idioma = $libro["idioma"];
        $copias = $libro["copias"];
        $idioma_o = $idioma;
    }
    
    if(isset($_POST["btn-guardar"])){
        $id = $_POST["id"];
        $cod = $_POST["cod"];
        $titulo = strtoupper($_POST["titulo"]);
        $autor = strtoupper($_POST["autor"]);
        $editorial = strtoupper($_POST["editorial"]);
        if($cod == "stock"){ $idioma = $_POST["idioma_o"]; }
        else{ $idioma = $_POST["idioma"]; }
        $copias = $_POST["copias"];
        
        if(empty($titulo)){
            array_push($errores,"Debe ingresar un Titulo");
        }
        if(empty($autor)){
            array_push($errores,"Debe ingresar nombre de Autor");
        }
        if(empty($editorial)){
            array_push($errores,"Debe ingresar nombre de Editorial");
        }
        
        if(count($errores)==0){
            $sql = "UPDATE libros SET titulo='$titulo',autor='$autor',editorial='$editorial',idioma='$idioma',copias='$copias' WHERE id='$id'";
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
        <title>Editar Libro</title>
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
                        <h1 class="h1">Editando <?=($cod=="stock"?"Stock":"Libro")?></h1>
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
                    <form method="post" action="editar_libro.php">
                        <input type="hidden" name="id" value="<?=$id?>">
                        <input type="hidden" name="cod" value="<?=$cod?>">
                        <input type="hidden" name="idioma_o" value="<?=$idioma_o?>">
                        <div class="form-group">
                            <label for="titulo">Titulo</label>
                            <input name="titulo" class="form-control" type="text" value="<?=$titulo?>" <?=($cod=="stock"?"readonly":"")?> />
                        </div>
                        <div class="form-group">
                            <label for="autor">Autor</label>
                            <input name="autor" class="form-control" type="text" value="<?=$autor?>" <?=($cod=="stock"?"readonly":"")?> />
                        </div>
                        <div class="form-group">
                            <label for="editorial">Editorial</label>
                            <input name="editorial" class="form-control" type="text" value="<?=$editorial?>" <?=($cod=="stock"?"readonly":"")?> />
                        </div>
                        <div class="form-group">
                            <label for="idioma">Idioma</label>
                            <select name="idioma" class="form-control" <?=($cod=="stock"?"disabled":"")?>>
                                <option value="Español" <?=($idioma=="Español"?"selected='selected'":"")?>>Español</option>
                                <option value="Ingles" <?=($idioma=="Ingles"?"selected='selected'":"")?>>Ingles</option>
                                <option value="Frances" <?=($idioma=="Frances"?"selected='selected'":"")?>>Frances</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label <?=($cod=="stock")?"":"hidden"?> for="copias">Copias</label>
                            <input name="copias" class="form-control" type="<?=($cod=='stock')?'number':'hidden'?>" value="<?=$copias?>" min="0" />
                        </div>
                        <div class="form-group">
                            <button type="button" class="btn btn-info" onclick="window.location='mostrar_libros.php'">Cancelar</button>
                            <button type="reset" class="btn btn-warning">Restablecer</button>
                            <button name="btn-guardar" class="btn btn-primary" type="submit">Guardar</button>
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