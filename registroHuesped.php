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
            <h2>REGISTRO DE HUESPEDES</h2>
            <p>Formulario para registro de los huespedes</p>
        </div>
        <form action="post" autocomplete="off" method="post">
            <input type="number" name="cedula" placeholder="Cédula" class="campo" required>
            <input type="text" name="nombre" placeholder="Nombre" class="campo" required>
            <input type="text" name="apellido" placeholder="Apellido" class="campo" required>
            <input type="text" name="telefono" placeholder="Telefono" class="campo" required>
            <input type="text" name="origen" placeholder="Origen" class="campo" required>
            <input type="text" name="e_mail" placeholder="Correo Electrónico" class="campo" required>
           
            <input type="submit" name="enviar" value="Registrar Huesped" class="btn-enviar">
            <input type="reset" value="Borrar datos" class="btn-enviar">
            <a href="menuPrincipal.php">Volver</button></a>
        </form>
    </div>
</body>
</html>