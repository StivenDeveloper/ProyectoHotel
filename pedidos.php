<?php
    include('php/conexion_bd.php');
    $con = conexion();

    $pin = 0;
    if(isset($_POST['cedula'])){
        $cedula = $_POST['cedula'];
        $query_huesped = mysqli_query($con, "SELECT * FROM clientes WHERE cedula_cliente = $cedula");
        $query_pedidos = mysqli_query($con, "SELECT pro.nombre_producto, ped.cantidad, ped.precio_total 
            FROM productos pro
            INNER JOIN pedidos ped
            ON pro.id_producto = ped.id_producto
            WHERE ped.cedula_cliente = $cedula");
    }
    if(isset($_POST['validar'])){
        $pin = 1;
    }
    if(isset($_POST['crear'])){
        if(mysqli_num_rows($query_huesped)){
            $pin = 2;
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
    <div class="container-form">
        <div class="info-form">
            <h2>PEDIDOS</h2>
            <p>Formulario para consultar e ingresar pedidos de los huespedes.</p>
        </div>
        <form action="pedidos.php" autocomplete="off" method="post">
            <label for="cedula">Cédula</label>
            <input type="number" name="cedula" placeholder="Cédula" class="campo" value="<?php echo $cedula ?>" required>
                <?php if(isset($_POST['cedula'])){
                    if(mysqli_num_rows($query_huesped)) { 
                        $row_clientes = $query_huesped->fetch_assoc();
                        $nombre = $row_clientes['nombre']; ?>
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" value="<?php echo $row_clientes['nombre'] ?>" class="campo" readonly>
                        <label for="apellido">Apellidos</label>
                        <input type="text" name="apellido" value="<?php echo $row_clientes['apellido'] ?>" class="campo" readonly>
                        <label for="telefono">Teléfonos</label>
                        <input type="text" name="telefono" value="<?php echo $row_clientes['telefono'] ?>" class="campo" readonly>
                    <?php }else{ ?>
                        <script>
                            alert('Usuario no existe en el sistema, digite los datos correctamente.')          
                        </script>
                    <?php }
                } ?>
            <input type="submit" name="validar" class="btn-enviar" value="Validar">
            <input type="submit" name="crear" class="btn-enviar" value="Crear Pedido">
        </form>
        <a href="menuPrincipal.php">Volver</a>
    </div>

    <?php if($pin == 1) { ?>
        <div class="tablas">
            <table class="tabla-intercalada">
            <?php if(isset($_POST['cedula'])) { ?>
                <?php if(mysqli_num_rows($query_pedidos)) { ?>
                    <thead>
                        <tr>
                            <td>Nombre Pedido</td>
                            <td>Cantidad</td>
                            <td>Precio</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row_pedido = $query_pedidos->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row_pedido['nombre_producto'] ?></td>
                                <td><?php echo $row_pedido['cantidad'] ?></td>
                                <td>$<?php echo number_format($row_pedido['precio_total'],0,',','.') ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                <?php } 
            }?>
            </table>
        </div>

    <?php }else if($pin == 2){?>
        <?php 
        if(isset($_POST['cedula'])) {
            $query_producto = mysqli_query($con,"SELECT * FROM productos");
            if(mysqli_num_rows($query_producto) > 0){ ?>

            <form action="php/validar_pedidos_m.php" method="post">
                <div class="tablas">
                    <table class="tabla-intercalada">
                        <thead>
                            <tr>
                                <td>Producto</td>
                                <td>Precio</td>
                                <td>Cantidad</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($row_producto = $query_producto->fetch_assoc()){ ?>
                                <tr>
                                    <td> <?php echo $row_producto['nombre_producto'] ?> </td>
                                    <td>$<?php echo number_format($row_producto['precio'],0,',','.') ?> </td>
                                    <!--<td> <input type="checkbox" name="pedidos[]" value="<?php echo $row_producto['id_producto'] ?>"></td>-->
                                    <td>
                                        <select name="pedidos[<?php echo $row_producto['id_producto'] ?>]">
                                            <option value="0">0 pedidos</option>
                                            <option value="1">1 pedido</option>
                                            <option value="2">2 pedidos</option>
                                            <option value="3">3 pedidos</option>
                                            <!-- Agrega más opciones según tus necesidades -->
                                        </select>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <input type="hidden" name="cedula" value="<?php echo $cedula ?>">
                <input type="hidden" name="nombre" value="<?php echo $nombre ?>">
                <input type="submit" value="Confirmar" class="submit">
            </form>
            <?php } ?>
    <?php }
    } ?>
</body>
</html>