<?php
    //Fecha actual en horario de colombia
    date_default_timezone_set('America/Bogota');
    session_start();
    include('php/conexion_bd.php');
    $con = conexion();

    $fechaI = "";
    $fechaF = "";
    if(isset($_POST['date_inicio']) && isset($_POST['date_fin'])){
        $fechaInicio = $_POST['date_inicio'];
        $fechaFin = $_POST['date_fin'];
        
        //Para convertir la fecha a un formato que se pueda comparar
        $fInicio = new DateTime($fechaInicio);
        $fFin = new DateTime($fechaFin);
        //$fFin->modify('-1 day');
        $fechaActual = date('Y-m-d');
        $fActual = new DateTime($fechaActual);

        //Para cambiar fechas trocadas
        if(($fInicio > $fFin) || ($fInicio < $fActual) || empty($fechaInicio) || empty($fechaFin)){
            echo "<script>
            alert ('Ingrese las fechas correctamente')
            window.location='reserva_fecha_m.php';
            </script>";
            exit();
        }
        //$fechaFin = $fFin->format('y-m-d');
        $query = ("SELECT h.numero_habitacion, h.descripcion, h.precio
        FROM habitaciones h
        WHERE h.numero_habitacion NOT IN (
            SELECT r.numero_habitacion
            FROM reserva r
            WHERE (r.fecha_inicio < '$fechaFin' AND r.fecha_final > '$fechaInicio') -- Rango de fechas deseado
               OR (r.fecha_inicio <= '$fechaInicio' AND r.fecha_final > '$fechaInicio')
               OR (r.fecha_inicio >= '$fechaInicio' AND r.fecha_inicio < '$fechaFin')
        );");
        $validarFecha = mysqli_query($con,$query);
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
            <h2>VALIDAR LA DISPONIBILIDAD</h2>
            <p>Validar la disponibilidad de las habitaciones segun la fecha que ingresa el huesped</p>
        </div>
        <form action="reserva_fecha_m.php" autocomplete="off" method="post">

            <h3>Ingrese fecha de reservación:<br></h3>
            <div class="checkin">
                <label for="fechaR">Fecha de inicio:<br></label>
                <input type="date" name="date_inicio" class="campo"><br>
                <label for="date_fin">Fecha final</label>
                <input type="date" name="date_fin" class="campo"><br>

                    <input type="submit" name="enviar" value="Validar Habitación" class="btn-enviar">
                    <input type="reset" value="Borrar datos" class="btn-enviar">
            </div>
            
            <a href="menuPrincipal.php">Volver</button></a>
        </form>
    </div>

    <?php if(isset($_POST['date_inicio']) && isset($_POST['date_fin'])){ ?>
    <div class="tablas">
        <table class="tabla-intercalada">
            <thead>
                <tr>
                    <td>
                        Número de Habitación
                    </td>
                    <td>
                        Descripción de la Habitación
                    </td>
                </tr>
            </thead>
            <?php if (mysqli_num_rows($validarFecha) > 0) { 
                while ($row = $validarFecha->fetch_assoc()) { 
                $link = "reserva_m.php?dato1=" . urlencode($fechaInicio) . "&dato2=" . urlencode($fechaFin) . "&dato3=" . $row['numero_habitacion'] . "&dato4=" . $row['precio']; ?>
                <tbody>
                    <tr>
                        <td>
                        <a href="<?php echo $link ?>"> <?php echo $row['numero_habitacion'] ?> </a>
                        </td>
                        <td>
                            <?php echo $row['descripcion'] ?>
                        </td>
                    </tr>
                </tbody>
                <?php }
            }else{ ?>
                <thead>
                    <tr>
                        <td>
                            No hay habitaciones disponibles en esas fechas.
                        </td>
                        <td>
                            Si desea, ingrese otras fechas.
                        </td>
                    </tr>
                </tbody>
            <?php } ?>
        </table>
    </div>
    <?php } ?>
</body>
</html>