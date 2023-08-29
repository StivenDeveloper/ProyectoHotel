<?php
    session_start();
    include('php/conexion_bd.php');
    $con = conexion();

    $cedulaF = "";
    $nombreF = "";
    $apellidoF = "";
    $telefonoF = "";
    $direccioF = "";
    $paisF = "";
    $departamentoF = "";
    $municipioF = "";
    $emailF = "";

    if (isset($_GET['cedula'])) {
        $cedula = $_GET['cedula'];
    } else {
        echo "No se han recibido los datos correctamente.";
        exit();
    }
    $query_validar = mysqli_query($con,"SELECT * FROM clientes WHERE cedula_cliente = '$cedula'");
    if(mysqli_num_rows($query_validar) > 0){
        $row = $query_validar->fetch_assoc();
        $cedulaF = $row['cedula_cliente'];
        $nombreF = $row['nombre'];
        $apellidoF = $row['apellido'];
        $telefonoF = $row['telefono'];
        $direccioF = $row['direccion'];
        $paisF = $row['nombre_pais'];
        $departamentoF = $row['nombre_departamento'];
        $municipioF = $row['nombre_municipio'];
        $emailF = $row['correo'];
    }
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
        <div>
            <form action="php/modificar_huesped.php" autocomplete="off" method="post">
                <label for="cedula_validacion">Modifique los datos deseados de esta lista</label>
                <input type="number" name="cedula" placeholder="Cédula" class="campo" value="<?php echo $cedulaF ?>" readonly required>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" placeholder="Nombre" class="campo" value="<?php echo $nombreF ?>"  required>
                <label for="apellido">Apellidos</label>
                <input type="text" name="apellido" placeholder="Apellido" class="campo" value="<?php echo $apellidoF ?>"  required>
                <label for="telefono">Teléfono</label>
                <input type="text" name="telefono" placeholder="Telefono" class="campo" value="<?php echo $telefonoF ?>"  required>
                <label for="direccion">Dirección</label>
                <input type="text" name="direccion" placeholder="Dirección" class="campo" value="<?php echo $direccioF ?>"  required>
                <label for="pais">Pais de Residencia</label>
                <input type="text" name="pais" placeholder="País" class="campo" value="<?php echo $paisF ?>"  required>
                <label for="departamento">Departamento de Residencia</label>
                <input type="text" name="departamento" placeholder="Departamento" class="campo" value="<?php echo $departamentoF ?>"  required>
                <label for="municipio">Municipio de Residencia</label>
                <input type="text" name="municipio" placeholder="Municipio" class="campo" value="<?php echo $municipioF ?>"  required>
                <label for="email">Correo Electrónico</label>
                <input type="text" name="email" placeholder="Correo Electrónico" class="campo" value="<?php echo $emailF ?>"  required>

                <input type="submit" name="enviar" value="Modificar datos" class="btn-enviar">

                <a href="gestion_huespedes.php">Volver</button></a>
            </form>
        </div>
    </div>
</body>
</html>