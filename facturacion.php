<?php
session_start();
include('php/conexion_bd.php');
    $con = conexion();
  

?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Contacto</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <h1 class="titulo">EMPRESA HOTELERA EJE CAFETERO</h1>
    <div class="container-form">
        <div class="info-form">
            <h2>FACTURACION DEL HUESPEDES</h2>
            <p>Generación de la factura del huesped</p>
        </div>
        <form action="post" autocomplete="off" method="post">
            <input type="number" name="cedula" placeholder="Cédula" class="campo" required> <a href="">Validar</a>
            <input type="text" name="nombre" placeholder="Nombre" class="campo" required>
            <input type="text" name="fecha" placeholder="Fecha de la facturación" class="campo" required>
            <input type="number" name="costo" placeholder="Costo Total" class="campo" required>
           
            <input type="submit" name="enviar" value="Facturar Huesped" class="btn-enviar">
            <input type="reset" value="Borrar datos" class="btn-enviar">
            <a href="menuPrincipal.php">Volver</button></a>
        </form>
    </div>
</body>
</html>