


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
            <p>Formulario para ingresar pedidos de los clientes del hotel eje cafetero.</p>
            <a href="#"><i class="fa fa-phone"></i> 123-456-789</a>
            <a href="#"><i class="fa fa-envelope"></i> email@hotel.com</a>
            <a href="#"><i class="fa fa-map-marked"></i> Armenia, Quindio</a>
        </div>
        <form action="php/validacion_pedidos.php" autocomplete="off" method="post">
            <input type="number" name="cedula" placeholder="Cédula" class="campo">
            <input type="text" name="nombre_cliente" placeholder="Nombre cliente" class="campo">
            <input type="text" name="tipo_pedido" placeholder="Tipo de pedido" class="campo">
            <label for="fecha_pedido">Fecha pedido</label>
            <input type="date" name="fecha_pedido"  class="campo">
            <input type="submit" name="enviar" class="btn_enviar" >
        </form>
    </div>
</body>
</html>