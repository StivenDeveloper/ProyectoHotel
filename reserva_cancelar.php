<?php
    include('php/conexion_bd.php');
    $con = conexion();

    $valorInput = "";
    if(isset($_POST['cedula'])){
        $cedula = $_POST['cedula'];
        $query_validar= mysqli_query($con,"SELECT c.nombre, c.apellido, r.numero_habitacion, r.fecha_inicio
            FROM clientes c  
            INNER JOIN  reserva r 
            ON c.cedula_cliente = r.cedula_cliente 
            WHERE c.cedula_cliente = '$cedula'");
        
        $query_nombre = mysqli_query($con, "SELECT nombre, apellido FROM clientes WHERE cedula_cliente = '$cedula'");
        $nombre = mysqli_fetch_assoc($query_nombre);
        
        if(mysqli_num_rows($query_validar)>0){
            $valorInput = $cedula;
        }else{
            echo "
            <script>
                alert('Usuario no existe o NO tiene reservas, por favor verifique los datos ingresados.')            
                window.location='reserva_cancelar.php';
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
            <h2>CANCELACIÓN DE UNA RESERVA</h2>
            <p>Aquí puedes cancelar una reserva</p>
        </div>
        <form action="reserva_cancelar.php" autocomplete="off" method="post">
            <input type="number" name="cedula" placeholder="Cédula" value="<?php echo $valorInput; ?>" class="campo" required>
            <?php if(isset($_POST['cedula'])){ ?>
            <input type="text" name="nombre" placeholder="" value="<?php echo $nombre['nombre'] . " " . $nombre['apellido'] ?>" class="campo" readonly required>
            <?php } ?>
            <input type="submit" name="enviar" value="Validar" class="btn-enviar">
            <input type="reset" value="Borrar datos" class="btn-enviar">

            <a href="menuPrincipal.php">Volver</button></a>
        </form>
    </div>

    <div class="tablas">
    <?php if(isset($_POST['cedula'])){ ?>
        <table class="tabla-intercalada">
            <thead>
                <tr>
                    <td>
                        Habitación
                    </td>
                    <td>
                        Fecha de la reservación
                    </td>
                    <td>
                        Acción
                    </td>
                </tr>
            </thead>
            <?php while ($row = mysqli_fetch_assoc($query_validar)) { ?>
            <tbody>
                <tr>
                    <td><?php echo $row['numero_habitacion']; ?></td>
                    <td><?php echo $row['fecha_inicio']; ?></td>
                    <?php $link = "php/cancelar_reserva.php?habitacion=" . urlencode($row['numero_habitacion']). "&fecha=" . urlencode($row['fecha_inicio']) ?>
                    <td><a href="<?php echo $link; ?>" class="aEliminar" onclick="return confirm('¿Estás seguro de que deseas cancelar la reserva?')">CANCELAR RESERVA</a></td> 
                </tr>
                <?php } ?>
            </tbody>
            </tr>
        </table>
        <?php } ?>
    </div>
</body>
</html>