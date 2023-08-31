<?php
    include('php/conexion_bd.php');
    $con = conexion();

    if(isset($_POST['buscar'])){
        if(isset($_POST['cedula'])){
            $buscarCedula = $_POST['cedula'];
            $query_huesped = mysqli_query($con, "SELECT * FROM clientes WHERE cedula_cliente = '$buscarCedula'");
        }else{
            echo "
                <script>
                    alert('Ingrese una Cédula.')            
                </script>
            ";
        }
    }else if(isset($_POST['todos'])){
        $query_huesped = mysqli_query($con, "SELECT * FROM clientes");
    }else{
        $query_huesped = mysqli_query($con, "SELECT * FROM clientes");
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
            <h2>GESTIONAR RESERVAS Y HUESPEDES</h2>
            <p>Gestionar tareas como registrar nuevas reservas, consultar y modificar las existentes, asignar y liberar habitaciones, así como llevar un registro detallado de los datos personales y preferencias de los huéspedes.</p>
        </div>
        <div>
            <form action="gestion_huespedes.php" autocomplete="off" method="post">

                <h3>Campo de Busqueda:<br></h3>
                <div class="checkin">
                    <label for="cedula">Ingrese la Cedula del Huesped:<br></label>
                    <input type="input" name="cedula" class="campo" placeholder="Cédula"><br>

                    <input type="submit" name="buscar" value="Buscar" class="btn-enviar">
                    <input type="reset" value="Borrar datos" class="btn-enviar">
                    <input type="submit" name="todos" value="Mostrar Todos" class="btn-enviar">
                    <input type="submit" name="checkin" value="CHECKIN" class="btn-enviar">
                    </form>
                </div>
                <a href="menuPrincipal.php">Volver</a>
        </div>
    </div>
    <div class="tablas">
        <table class="tabla-intercalada">
            <thead>
                <tr>
                    <td>Cédula</td>
                    <td>Nombres</td>
                    <td>Apellidos</td>
                    <td>Teléfono</td>
                    <td>Dirección</td>
                    <td>País</td>
                    <td>Departamento</td>
                    <td>Municipio</td>
                    <td>Correo</td>
                    <td>Reservas</td>
                    <td>Modificar</td>
                    <td>Eliminar</td>
                    <td>Check-in</td>
                </tr>
            </thead>
            <tbody>
                <?php if (mysqli_num_rows($query_huesped) > 0) { 
                    while ($row = $query_huesped->fetch_assoc()) { ?>
                    <tr>
                        <td> <?php echo $row['cedula_cliente'] ?></td>
                        <td> <?php echo $row['nombre'] ?></td>
                        <td> <?php echo $row['apellido'] ?></td>
                        <td> <?php echo $row['telefono'] ?></td>
                        <td> <?php echo $row['direccion'] ?></td>
                        <td> <?php echo $row['nombre_pais'] ?></td>
                        <td> <?php echo $row['nombre_departamento'] ?></td>
                        <td> <?php echo $row['nombre_municipio'] ?></td>
                        <td> <?php echo $row['correo'] ?></td>
                        <?php $link = "?cedula=" . urlencode($row['cedula_cliente']) ?>
                        <td> <a href="mostrar_reservas.php<?php echo $link ?>" class="aReserva">Reservas</a></td>
                        <td> <a href="modificar_huespedes.php<?php echo $link ?>" class="aModificar">Modificar</a></td>
                        <td> <a href="php/eliminar_huespedes.php<?php echo $link ?>" onclick="return confirm('¿Estás seguro de eliminar el huesped y sus reservas?')" class="aEliminar">Eliminar</a></td>
                        <td> <a href="php/validar_checkin.php<?php echo $link ?>" class="aEliminar">Check-in</a></td>
                    </tr>
                    <?php }
                } ?>
            </tbody>
        </table>
    </div>
</body>
</html>