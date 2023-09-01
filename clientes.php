<?php
    header('Content-Type: text/html; charset=utf-8');
    //Fecha actual en horario de colombia
    date_default_timezone_set('America/Bogota');
    session_start();
    include('php/conexion_bd.php');
    $con = conexion();
    $total = 0;

    if (isset($_GET['nombre']) && isset($_GET['cedula'])){
        $nombre = $_GET['nombre'];
        $cedula = $_GET['cedula'];
    }


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/styles_index.css" />
    <title>Login Huéspedes</title>
  </head>
  <body>
    <nav>
      <div class="nav__logo">Bienvenido <?php echo $nombre?></div>
      <ul class="nav__links">
        
        <li class="link"><a href="login_registre.php">CERRAR SESIÓN</a></li>
      </ul>
    </nav>
    <header class="section__container header__container">
      <div class="header__image__container">
        <div class="header__content">
          <h1>HOTEL EJE CAFETERO</h1>
          <p>DISFRUTA TUS VACACIONES EN MEDIO DE UN PAISAJE CAFETERO</p>
        </div>
        <div class="booking__container">
            <div class="navbar">
                <a href="clientes.php?nombre=<?php echo $nombre ?>&cedula=<?php echo $cedula ?>&pin=1">Pedir Productos</a>
                <a href="clientes.php?nombre=<?php echo $nombre ?>&cedula=<?php echo $cedula ?>&pin=2">Total de Pedidos</a>
                <a href="clientes.php?nombre=<?php echo $nombre ?>&cedula=<?php echo $cedula ?>&pin=3">INFORMACION</a>
            </div>
          </div>
      </div>
    </header>
    <section class='container-table'>
        <!--Aqui inicia el primer IF-->
        <?php if(isset($_GET['pin'])){ 
            $pin = $_GET['pin']; ?>
                <!-- IF PIN 1-->
                <?php if($pin == 1){ ?>
                    <!--Aquí viene el php-->
                    <?php 
                        $query_producto = mysqli_query($con,"SELECT * FROM productos");
                        if(mysqli_num_rows($query_producto) > 0){ ?>

                        <form action="php/validar_pedidos.php" method="post">
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
                <?php } ?>
                <!-- FIN IF PIN 1-->

                <!-- IF PIN 2-->
                <?php if($pin == 2){ ?>
                    <div class="tablas">
                        <table class="tabla-intercalada">
                            <thead>
                                <tr>
                                    <td>id producto</td>
                                    <td>Nombre producto</td>
                                    <td>Precio</td>
                                    <td>Cantidad</td>
                                    <td>Subtotal</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $query_lista_pedidos = mysqli_query($con, "SELECT pr.id_producto, pr.nombre_producto, pr.precio, pe.cantidad, pe.precio_total
                                                                                 FROM pedidos pe 
                                                                                 INNER JOIN productos pr ON pr.id_producto = pe.id_producto
                                                                                 WHERE pe.cedula_cliente = '$cedula'");  
                                if(mysqli_num_rows($query_lista_pedidos) > 0){ ?>
                                            <?php while($row_pedidos = $query_lista_pedidos->fetch_assoc()){ ?>
                                                <?php $total += $row_pedidos['precio_total'] ?>
                                                <tr>
                                                    <td> <?php echo $row_pedidos['id_producto'] ?> </td>
                                                    <td> <?php echo $row_pedidos['nombre_producto'] ?> </td>
                                                    <td>$<?php echo number_format($row_pedidos['precio'],0,',','.') ?> </td>
                                                    <td> <?php echo $row_pedidos['cantidad'] ?> </td>
                                                    <td>$<?php echo number_format($row_pedidos['precio_total'],0,',','.') ?> </td>
                                                </tr>
                                               
                                            <?php } ?>
                                                <tr>
                                                    <td colspan="4"><b>TOTAL</b></td>
                                                    <td>$<?php echo number_format($total,0,',','.') ?></td>
                                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
                <!-- FIN IF PIN 2-->

                <!-- IF PIN 3-->
                <?php if($pin == 3){ ?>
                    <?php $query_consulta_ticket = mysqli_query($con,"SELECT contrasena FROM clientes Where cedula_cliente = '$cedula'"); 
                    if ($query_consulta_ticket) {
                        $fila = $query_consulta_ticket->fetch_assoc();
                        $ticket = $fila['contrasena'];
                        $nombre = $_GET['nombre'];
                    }?>
                    
                    <button id="abrirModal" class='boton'>INFORMACIÓN RESERVA</button>
                    <div id="modal" class="modal">
                        <div class="modal-contenido">
                            <span class="cerrar" id="cerrarModal">&times;</span>
                            <p>Hola <?php echo $nombre ?></p>
                            <p> - MARQUE LA EXTENSIÓN 06 PARA COMUNICARSE CON RECEPCIÓN</p>
                            <p> - RECUERDA QUE SU NÚMERO DE TICKET PARA SOLICITAR PEDIDOS ES: <b><?php echo $ticket ?></b></p>
                        </div>
                    </div>
                <?php } ?>
                <!-- FIN IF PIN 3-->
                
                
        <!--Aqui termina el primer IF-->
        <?php } ?>
        
    </section>

    <footer class="footer">
      <div class="section__container footer__container">
        <div class="footer__col">
          <h4>EMPRESA</h4>
          <p>ACERCA DE NOSOTROS</p>
          <p>NUESTRO EQUIPO</p>
          <p>BLOG</p>
          <p>CONTACTENOS</p>
        </div>
        <div class="footer__col">
          <h4>Legal</h4>
          <p>PQRSD</p>
          <p>Téminos y condiciones</p>
        </div>
      </div>
      <div class="footer__bar">
        Copyright © 2023 Web Design Weimar, Dirleny and Evert. All rights reserved.
      </div>
    </footer>
    <script src="js/script.js"></script>
  </body>
</html>
