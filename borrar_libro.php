<?php
    include 'Conexion.php';
    $conex = new Conexion();
    if(isset($_GET["id"])){
        $id = $_GET["id"];
        $sql = "DELETE FROM libros WHERE id=$id";
        $conex->execute($sql);
        header("location:mostrar_libros.php");
        exit;
    }
    header("location:index.php");