<?php
    header('Content-Type: text/html; charset=utf-8');
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
            window.location='index.php';
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
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="assets/styles_index.css" />
    <title>Web Design Mastery | WDM&Co</title>
  </head>
  <body>
    <nav>
      <div class="nav__logo">HOTEL EJE CAFETERO</div>
      <ul class="nav__links">
        
        <li class="link"><a href="login_registre.php">INICIAR SESIÓN</a></li>
      </ul>
    </nav>
    <header class="section__container header__container">
      <div class="header__image__container">
        <div class="header__content">
          <h1>HOTEL EJE CAFETERO</h1>
          <p>DISFRUTA TUS VACACIONES EN MEDIO DE UN PAISAJE CAFETERO</p>
        </div>
        <div class="booking__container">
          <form action="index.php" autocomplete="off" method="post">
            <div class="form__group">
              <div class="input__group">
                <input type="date" name="date_inicio" />
                <label>FECHA INICIO</label>
              </div>
            </div>
            <div class="form__group">
              <div class="input__group">
                <input type="date" name="date_fin" />
                <label>FECHA FINAL</label>
              </div>
            </div>

            <button type="submit" name="enviar" value="Validar Habitación"><i class="ri-search-line"></i></button>
            <button type="reset" value="Borrar datos"><i class="ri-chat-delete-line"></i></button>
          </form>
          </div>
      </div>
    </header>
    <section class='container-table'>
            <?php if(isset($_POST['date_inicio']) && isset($_POST['date_fin'])){ ?>
                <table class="tabla-intercalada">
                    <thead>
                        <tr>
                            <th>
                                Número de Habitación
                            </th>
                            <th>
                                Descripción de la Habitación
                            </th>
                            <th>
                                Precio por noche
                            </th>
                        </tr>
                    </thead>
                    <?php if (mysqli_num_rows($validarFecha) > 0) { 
                        while ($row = $validarFecha->fetch_assoc()) { 
                        $link = "reserva.php?dato1=" . urlencode($fechaInicio) . "&dato2=" . urlencode($fechaFin) . "&dato3=" . $row['numero_habitacion']. "&dato4=" . $row['precio']; ?>
                        <tbody>
                            <tr>
                                <td>
                                <a href="<?php echo $link ?>"> <?php echo $row['numero_habitacion'] ?> </a>
                                </td>
                                <td>
                                    <?php echo $row['descripcion'] ?>
                                </td>
                                <td>
                                    <?php echo "$ ". number_format($row['precio'],0,',','.')?>
                                </td>
                            </tr>
                        </tbody>
              <?php }
                    }else{ ?>
                        <tbody>
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
            <?php } ?>
    </section>

    <section class="section__container popular__container">
      <h2 class="section__header">HABITACIONES</h2>
      <div class="popular__grid">
        <div class="popular__card">
          <img src="assets/img/hotel-1.jpg" alt="popular hotel" />
          <div class="popular__content">
            <div class="popular__card__header">
              <h4>HABITACIÓN SENCILLA</h4>
              <h4>$150.000</h4>
            </div>
            <p>QUINDIO</p>
          </div>
        </div>
        <div class="popular__card">
          <img src="assets/img/hotel-2.jpg" alt="popular hotel" />
          <div class="popular__content">
            <div class="popular__card__header">
              <h4>DOBLE CAMAROTE</h4>
              <h4>$170.000</h4>
            </div>
            <p>QUINDÍO</p>
          </div>
        </div>
        <div class="popular__card">
          <img src="assets/img/hotel-3.jpg" alt="popular hotel" />
          <div class="popular__content">
            <div class="popular__card__header">
              <h4>HABITACIÓN CON BALCON</h4>
              <h4>$170.000</h4>
            </div>
            <p>QUINDÍO</p>
          </div>
        </div>
        <div class="popular__card">
          <img src="assets/img/hotel-4.jpg" alt="popular hotel" />
          <div class="popular__content">
            <div class="popular__card__header">
              <h4>APARTAMENTO HOTEL</h4>
              <h4>$360.000</h4>
            </div>
            <p>QUINDÍO</p>
          </div>
        </div>
        <div class="popular__card">
          <img src="assets/img/hotel-5.jpg" alt="popular hotel" />
          <div class="popular__content">
            <div class="popular__card__header">
              <h4>HABITACIÓN MATRIMONIAL No 1</h4>
              <h4>$290.000</h4>
            </div>
            <p>QUINDÍO</p>
          </div>
        </div>
        <div class="popular__card">
          <img src="assets/img/hotel-6.jpg" alt="popular hotel" />
          <div class="popular__content">
            <div class="popular__card__header">
              <h4>HABITACIÓN MATRIMONIAL No 2</h4>
              <h4>$290.000</h4>
            </div>
            <p>QUINDÍO</p>
          </div>
        </div>
      </div>
    </section>

    <section class="client">
      <div class="section__container client__container">
        <h2 class="section__header">¿Qué dicen nuestros clientes?</h2>
        <div class="client__grid">
          <div class="client__card">
            <img src="assets/img/client-1.jpg" alt="client" />
            <p>
              LA ATENCIÓN FUE MUY CORDIAL, CON UN BUEN SERVICIO DE HOSPEDAJE Y EXCELENTES PAISAJES.
            </p>
          </div>
          <div class="client__card">
            <img src="assets/img/client-2.jpg" alt="client" />
            <p>
              UNA EXCELENTE ATENCIÓN CON VISTA A LOS MEJORES PAISAJES DEL EJE CAFETERO.
            </p>
          </div>
          <div class="client__card">
            <img src="assets/img/client-3.jpg" alt="client" />
            <p>
            Mi estadía en el Hotel Cafetero fue simplemente excepcional de principio a fin. 
            Desde el momento en que llegué, fui recibido por un personal amable y atento que me hizo 
            sentir como en casa al instante.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="section__container">
      <div class="reward__container">
        <h4>Si ya tienes una reservación y deseas CANCELAR ingrese aquí</h4>
        <a href="reserva_cancelar.php">
          <button class="reward__btn">CANCELAR RESERVACIÓN</button>
        </a>
      </div>
    </section>

    <footer class="footer">
      <div class="section__container footer__container">
        <div class="footer__col">
          <h3>HOTEL CAFETERO</h3>
          <p>
          ¿Buscas un refugio de tranquilidad rodeado de la naturaleza exuberante? 
          ¡Bienvenido al Hotel Cafetero! Ubicado en el corazón de las montañas, nuestro 
          hotel te invita a sumergirte en la belleza de la región cafetera mientras disfrutas 
          de un alojamiento de lujo y servicios excepcionales.
          </p>
          <p>
          Relájate en nuestras habitaciones elegantemente diseñadas, cada una con una vista panorámica que te dejará sin aliento. 
          Despierta cada mañana con el aroma fresco del café y el paisaje montañoso que se extiende ante ti.
          </p>
        </div>
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
        Copyright © 2023 Web Design Weima, Dirleny and Evert. All rights reserved.
      </div>
    </footer>
  </body>
</html>
