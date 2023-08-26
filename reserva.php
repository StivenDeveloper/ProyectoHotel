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
            <h2>RESERVA DE HABITACIONES</h2>
            <p>Formulario para registro de los huespedes</p>
        </div>
        <form action="php/reserva_fecha.php" autocomplete="off" method="post">
            <input type="number" name="cedula" placeholder="Cédula" class="campo" required>
            <input type="text" name="nombre" placeholder="Nombre" class="campo" required>
            <input type="text" name="apellido" placeholder="Apellido" class="campo" required>
            <input type="text" name="telefono" placeholder="Telefono" class="campo" required>
            <input type="text" name="direccion" placeholder="Dirección" class="campo" required>
            <input type="text" name="pais" placeholder="País" class="campo" required>
            <input type="text" name="departamento" placeholder="Departamento" class="campo" required>
            <input type="text" name="municipio" placeholder="Municipio" class="campo" required>
            <input type="text" name="email" placeholder="Correo Electrónico" class="campo" required>

            <input type="submit" name="enviar" value="Reservar" class="btn-enviar">
            <input type="reset" value="Borrar datos" class="btn-enviar">

            <a href="menuPrincipal.php">Volver</button></a>
        </form>
    </div>
</body>
</html>