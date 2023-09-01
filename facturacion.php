<?php
    include('php/conexion_bd.php');
    $con = conexion();

    $pin = 0;
    if(isset($_POST['cedula'])){
        $cedula = $_POST['cedula'];
        $query_huesped = mysqli_query($con, "SELECT * FROM clientes WHERE cedula_cliente = $cedula");
        $query_pedidos = mysqli_query($con, "SELECT pro.nombre_producto, pro.precio, SUM(ped.cantidad) cantidad, SUM(ped.precio_total) precio_total
        FROM productos pro
        INNER JOIN pedidos ped ON pro.id_producto = ped.id_producto
        WHERE ped.cedula_cliente = $cedula
        GROUP BY pro.nombre_producto, pro.precio;");
        $query_reserva = mysqli_query($con,"SELECT reserva WHERE cedula_cliente = $cedula && checkin = 1");
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
            <h2>PEDIDOS</h2>
            <p>Formulario para consultar e ingresar pedidos de los huespedes.</p>
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
                            <?php while ($row_pedido = $query_pedidos->fetch_assoc()) { ?>
                                <tr>
                                    <td><?php echo $row_pedido['nombre_producto'] ?></td>
                                    <td><?php echo $row_pedido['cantidad'] ?></td>
                                    <td><?php echo $row_pedido['precio'] ?></td>
                                    <td>$<?php echo number_format($row_pedido['precio_total'],0,',','.') ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>      
                </div>
            </div>
        <?php } ?>
    <?php } ?>
</body>
</html>