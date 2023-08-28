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

    if (isset($_GET['dato1']) && isset($_GET['dato2']) && isset($_GET['dato3'])) {
        $fechaInicial = $_GET['dato1'];
        $fechaFinal = $_GET['dato2'];
        $Nhabitacion = $_GET['dato3'];
    } else {
        echo "No se han recibido los datos correctamente.";
        exit();
    }

    if(isset($_POST['cedula_validacion'])){
        $cedulaC = $_POST['cedula_validacion'];
        $query_validar = mysqli_query($con,"SELECT * FROM clientes WHERE cedula_cliente = '$cedulaC'");
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
        }else{
            $cedulaF = $cedulaC;
            echo "
                <script>
                    alert('Usuario no existe en el sistema, digite los datos en el formulario.')            
                </script>
            ";
        }

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
            <?php $link = "reserva_m.php?dato1=" . urlencode($fechaInicial) . "&dato2=" . urlencode($fechaFinal) . "&dato3=" . urlencode($Nhabitacion); ?>
            <form action="<?php echo $link ?>" method="post">
                <label for="cedula_validacion">Ingrese la cedula para validar si existe en el sistema</label>
                <input type="number" name="cedula_validacion" placeholder="Cédula" class="campo" value="<?php echo $cedulaF ?>" required>
                <input type="submit" value="Verficar Cédula" class="btn-enviar">
            </form><br><br>
            <form action="php/registro_huesped_m.php" autocomplete="off" method="post">
                <input type="hidden" name="cedula" placeholder="Cédula" class="campo" value="<?php echo $cedulaF ?>" readonly required>
                <input type="text" name="nombre" placeholder="Nombre" class="campo" value="<?php echo $nombreF ?>" readonly required>
                <input type="text" name="apellido" placeholder="Apellido" class="campo" value="<?php echo $apellidoF ?>" readonly required>
                <input type="text" name="telefono" placeholder="Telefono" class="campo" value="<?php echo $telefonoF ?>" readonly required>
                <input type="text" name="direccion" placeholder="Dirección" class="campo" value="<?php echo $direccioF ?>" readonly required>
                <input type="text" name="pais" placeholder="País" class="campo" value="<?php echo $paisF ?>" readonly required>
                <input type="text" name="departamento" placeholder="Departamento" class="campo" value="<?php echo $departamentoF ?>" readonly required>
                <input type="text" name="municipio" placeholder="Municipio" class="campo" value="<?php echo $municipioF ?>" readonly required>
                <input type="text" name="email" placeholder="Correo Electrónico" class="campo" value="<?php echo $emailF ?>" readonly required>
                <input type="hidden" name="fecha_inicial" value="<?php echo $fechaInicial ?><">
                <input type="hidden" name="fecha_final" value="<?php echo $fechaFinal ?>">
                <input type="hidden" name="habitacion" value="<?php echo $Nhabitacion ?>">

                <input type="submit" name="enviar" value="Reservar" class="btn-enviar">
                <input type="reset" value="Borrar datos" class="btn-enviar">

                <a href="reserva_fecha_m.php">Volver</button></a>
            </form>
        </div>
    </div>
</body>
</html>