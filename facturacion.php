<?php
    date_default_timezone_set('America/Bogota');
    include('php/conexion_bd.php');
    $con = conexion();

    $fechaActual = date('Y-m-d');

    $pin = 0;
    if(isset($_POST['cedula'])){
        $cedula = $_POST['cedula'];
        $query_huesped = mysqli_query($con, "SELECT * FROM clientes WHERE cedula_cliente = $cedula");
        $query_pedidos = mysqli_query($con, "SELECT pro.nombre_producto, pro.precio, SUM(ped.cantidad) cantidad, SUM(ped.precio_total) precio_total
        FROM productos pro
        INNER JOIN pedidos ped ON pro.id_producto = ped.id_producto
        WHERE ped.cedula_cliente = $cedula
        GROUP BY pro.nombre_producto, pro.precio;");
        $query_reserva = mysqli_query($con,"SELECT * FROM reserva WHERE cedula_cliente = $cedula && checkin = 0");
    }
    // if(isset($_POST['validar'])){
    //     $pin = 1;
    // }
    // if(isset($_POST['crear'])){
    //     if(mysqli_num_rows($query_huesped)){
    //         $pin = 2;
    //     }
    // }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Contacto</title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
    <div class="container-form">
        <div class="info-form">
            <h2>FACTURACIÓN</h2>
            <p>Se consulta al Huesped que se va a facturar genera la factura electrónica.</p>
        </div>
        <form action="facturacion.php" autocomplete="off" method="post">
            <label for="cedula">Cédula</label>
            <input type="number" name="cedula" placeholder="Cédula" class="campo" value="<?php echo $cedula ?>" required>
                <?php if(isset($_POST['cedula'])){
                    if(mysqli_num_rows($query_huesped)) { 
                        $row_clientes = $query_huesped->fetch_assoc();
                        $nombre = $row_clientes['nombre']; ?>
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" value="<?php echo $row_clientes['nombre'] ?> <?php echo $row_clientes['apellido'] ?>" class="campo" readonly>
                    <?php }else{ ?>
                        <script>
                            alert('Usuario no existe en el sistema, digite los datos correctamente.')          
                        </script>
                    <?php }
                } ?>
            <input type="submit" name="validar" class="btn-enviar" value="Generar Factura">
            <a href="menuPrincipal.php">Volver</a>
        </form>
    </div>
    <?php if(isset($_POST['cedula'])) { ?>
        <?php if(mysqli_num_rows($query_pedidos)) { ?>
            <div class="factura">
                <div>
                    <p><strong>Fecha:</strong> <?php echo $fechaActual?></p>
                    <p><strong>Número de factura:</strong> En Proceso de creación</p>
                    <p><strong>Huesped:</strong> <?php echo $row_clientes['nombre']." ".$row_clientes['apellido']?></p>
                    <p><strong>Dirección:</strong> <?php echo $row_clientes['direccion'] ?> </p>
                    <p><strong>Teléfono:</strong> <?php echo $row_clientes['telefono'] ?></p>
                    <p><strong>Correo Electrónico:</strong> <?php echo $row_clientes['correo'] ?></p>
                    <hr class="divider"> 
                    <table>
                        <thead>
                            <tr>
                                <td>Nombre Producto</td>
                                <td>Cantidad</td>
                                <td>Precio Unitario</td>
                                <td>Precio Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $suma_total = 0;
                            while ($row_pedido = $query_pedidos->fetch_assoc()) { 
                                $suma_total += $row_pedido['precio_total']; ?>
                                <tr>
                                    <td><?php echo $row_pedido['nombre_producto'] ?></td>
                                    <td><?php echo $row_pedido['cantidad'] ?></td>
                                    <td>$<?php echo number_format($row_pedido['precio'],0,',','.') ?></td>
                                    <td>$<?php echo number_format($row_pedido['precio_total'],0,',','.') ?></td>
                                </tr>
                            <?php } ?>
                            <tr class="trTotal">
                                <td colspan="3">Sub Total</td>
                                <td>$<?php echo number_format($suma_total,0,',','.') ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <hr> 
                    <table>
                        <thead>
                            <tr>
                                <td>Habitación</td>
                                <td>Hora de Ingreso</td>
                                <td>Numero de días</td>
                                <td>Total</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(mysqli_num_rows($query_reserva)){
                                $row_habitacion = $query_reserva->fetch_assoc() ?>
                                <tr>
                                    <td><?php echo $row_habitacion['numero_habitacion'] ?></td>
                                    <td><?php echo $row_habitacion['fecha_inicio'] ?></td>
                                    <td><?php echo $row_habitacion['numero_noches'] ?></td>
                                    <td><strong>$<?php echo number_format($row_habitacion['precio_total'],0,',','.') ?></strong></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table> 
                    <hr class="divider">
                    <table class="trTotalFinal">
                        <tr>
                            <td colspan="3">Total pedidos y estadías</td>
                            <td>$<?php echo number_format(($row_habitacion['precio_total'] + $suma_total),0,',','.') ?></td>
                        </tr>
                    </table>
                    <hr class="divider">
                    <footer>
                        <p>Gracias por elegir nuestros servicios. Esperamos que su experiencia haya sido satisfactoria.</p>
                        <p>Para consultas o soporte, contáctenos al correo electrónico <a href="mailto:weimart24@gmail.com">weimart24@gmail.com</a> o al teléfono 314-758-7078.</p>
                        <p>Síganos en nuestras redes sociales: <a href="https://www.facebook.com/Weimart/">Facebook</a> | <a href="https://www.instagram.com/weimart24/">Instagram</a></p>
                        <p>© <?php echo date("Y") ?> PHPSoluciones S.A. Todos los derechos reservados.</p>
                    </footer>   
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</body>
</html>