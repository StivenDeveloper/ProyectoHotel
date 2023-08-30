<?php
    header('Content-Type: text/html; charset=utf-8');
    //Fecha actual en horario de colombia
    date_default_timezone_set('America/Bogota');
    session_start();
    include('php/conexion_bd.php');
    $con = conexion();

    if (isset($_GET['nombre'])){
        $nombre = $_GET['nombre'];
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
                <a href="clientes.php?nombre=<?php echo $nombre ?>&pin=1">Pedir Productos</a>
                <a href="clientes.php?nombre=<?php echo $nombre ?>&pin=2">Total de Pedidos</a>
                <a href="clientes.php?nombre=<?php echo $nombre ?>&pin=3">Modificar Datos</a>
                <a href="clientes.php?nombre=<?php echo $nombre ?>&pin=4">Contactos</a>
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
                            <div class="tablas">
                                <table class="tabla-intercalada">
                                    <thead>
                                        <tr>
                                            <td>Producto</td>
                                            <td>Precio</td>
                                            <td>Confirmar</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row_producto = $query_producto->fetch_assoc()){ ?>
                                            <tr>
                                                <td> <?php echo $row_producto['nombre_producto'] ?> </td>
                                                <td> <?php echo $row_producto['precio'] ?> </td>
                                                <td> <a href="">Cargar Pedido</a></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                    </div>

                        <?php } ?>
                <?php } ?>
                <!-- FIN IF PIN 1-->

                <!-- IF PIN 2-->
                <?php if($pin == 2){ ?>
                    <div class="tablas">
                        <table class="tabla-intercalada">
                            <thead>
                                <tr>
                                    <td>Producto</td>
                                    <td>Precio</td>
                                    <td>Confirmar</td>
                                </tr>
                            </thead>
                            <tbody>
                                pin 2
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
                <!-- FIN IF PIN 2-->

                <!-- IF PIN 3-->
                <?php if($pin == 3){ ?>
                    <div class="tablas">
                        <table class="tabla-intercalada">
                            <thead>
                                <tr>
                                    <td>Producto</td>
                                    <td>Precio</td>
                                    <td>Confirmar</td>
                                </tr>
                            </thead>
                            <tbody>
                                pin 3
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
                <!-- FIN IF PIN 3-->

                <!-- IF PIN 4-->
                <?php if($pin == 4){ ?>
                    <div class="tablas">
                        <table class="tabla-intercalada">
                            <thead>
                                <tr>
                                    <td>Producto</td>
                                    <td>Precio</td>
                                    <td>Confirmar</td>
                                </tr>
                            </thead>
                            <tbody>
                                pin 4
                            </tbody>
                        </table>
                    </div>
                <?php } ?>
                <!-- FIN IF PIN 4-->
                
                
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
  </body>
</html>
