<?php
    include('php/conexion_bd.php');
    $con = conexion();

    if(isset($_GET['cedula'])){
        $cedula = $_GET['cedula'];

        $query_datos = mysqli_query($con, "SELECT * FROM clientes WHERE cedula_cliente = '$cedula'");
        if(mysqli_num_rows($query_datos)>0){
            $row = $query_datos->fetch_assoc();
        }

        $query_reserva= mysqli_query($con,"SELECT r.id_reserva, r.fecha_inicio, r.fecha_final,r.numero_habitacion
            FROM reserva r  
            INNER JOIN  clientes c 
            ON c.cedula_cliente = r.cedula_cliente 
            WHERE c.cedula_cliente = '$cedula'");
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
            <h2>RESERVAS POR HUESPED</h2>
            <p>Visualización de las reservas por huesped, se muestra la fecha, la habitación y los datos mas utiles del huesped</p>
        </div>
        <form action="reserva_fecha.php" autocomplete="off" method="post">

            <h3>Datos del Huesped:<br></h3>
            <div class="checkin">
                <label for="nombre">Nombre:<br></label>
                <input type="input" name="nombre" class="campo" value="<?php echo $row['nombre']?>" readonly><br>
                <label for="apellido">Apellidos:<br></label>
                <input type="input" name="apellido" class="campo" value="<?php echo $row['apellido']?>" readonly><br>
                <label for="telefono">Teléfono:<br></label>
                <input type="input" name="telefono" class="campo" value="<?php echo $row['telefono']?>" readonly><br>
                <label for="direccion">Dirección:<br></label>
                <input type="input" name="direccion" class="campo" value="<?php echo $row['direccion']?>" readonly><br>
            </div>
            <a href="gestion_huespedes.php">Volver</button></a>
        </form>
    </div>
    <div class="tablas">
        <table class="tabla-intercalada">
            <thead>
                <tr>
                    <td>ID Reserva</td>
                    <td>Habitación</td>
                    <td>Fecha de Reserva</td>
                    <td>Dias de Estadía</td>
                    <td>Cancelar</td>
                </tr>
            </thead>
                <?php if (mysqli_num_rows($query_reserva) > 0) { 
                    while ($row_reserva = $query_reserva->fetch_assoc()) {
                        //Para saber los días que se va a quedar el huesped
                        $fecha1 = new DateTime($row_reserva['fecha_inicio']); // Tu primera fecha
                        $fecha2 = new DateTime($row_reserva['fecha_final']); // Tu segunda fecha
                        if($fecha1 == $fecha2){
                            $diferenciaDias = 1;
                        }else{
                            $intervalo = $fecha1->diff($fecha2);
                            $diferenciaDias = $intervalo->days;
                        } ?>
                    <tr>
                        <td><?php echo $row_reserva['id_reserva'] ?></td>
                        <td><?php echo $row_reserva['numero_habitacion'] ?></td>
                        <td><?php echo $row_reserva['fecha_inicio'] ?></td>
                        <td><?php echo $diferenciaDias ?></td>
                        <?php $link = "php/cancelar_reserva_m.php?habitacion=" . urlencode($row_reserva['numero_habitacion']) . "&cedula=" . urlencode($cedula) . "&fecha=" . urlencode($row_reserva['fecha_inicio']) ?>
                        <td><a href="<?php echo $link ?>" class="aEliminar" onclick="return confirm('¿Estás seguro de que deseas cancelar la reserva?')">Cancelar Reserva</a></td>
                    </tr>
                    <?php }
                }else{ ?>
                    <script>
                        if(confirm('No hay reservas para ese Huesped, ¿desea eliminarlo?')){
                            window.location='php/eliminar_huesped.php';
                        } else{
                             window.location='gestion_huespedes.php';
                        }          
                    </script>
                <?php } ?>
            <tbody>

            </tbody>
        </table>
    </div>
</body>
</html>