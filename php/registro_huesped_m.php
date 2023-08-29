<?php
include('conexion_bd.php');
    $con = conexion();

    $cedula = $_POST['cedula'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono']; 
    $direccion = $_POST['direccion']; 
    $pais = $_POST['pais']; 
    $departamento = $_POST['departamento']; 
    $municipio = $_POST['municipio']; 
    $email = $_POST['email'];
    $contrasena = generarContrasena();
    $fechaInicial = $_POST['fecha_inicial'];
    $fechaFinal = $_POST['fecha_final'];
    $nHabitacion = $_POST['habitacion'];
    $numeroNoches = $_POST['numero_noches'];
    $totalReserva = $_POST['total_reserva'];
    
    
    $query_validarC = mysqli_query($con,"SELECT * FROM clientes WHERE cedula_cliente = '$cedula'");
    if(!(mysqli_num_rows($query_validarC) > 0)){
        $query_insert="INSERT INTO clientes VALUES ('$cedula','$nombre','$apellido','$telefono','$direccion','$pais','$departamento','$municipio','$email','$contrasena')";
        $query_reserva = "INSERT INTO reserva (fecha_inicio,fecha_final,cedula_cliente,numero_habitacion,numero_noches,precio_total) VALUES ('$fechaInicial','$fechaFinal','$cedula','$nHabitacion','$numeroNoches','$totalReserva')";
        $ejecutar = mysqli_query($con,$query_insert);
        $ejecutar_reserva = mysqli_query($con,$query_reserva);
        if($ejecutar && $ejecutar_reserva){
            echo 
            "<script>
                alert('Usuario y Reserva almacenados correctamente.')
                window.location = '../gestion_huespedes.php'
            </script>";
        }else{
            echo 
            "<script>
                alert('Usuarios y Reservas NO almacenados correctamente.')
                window.location = '../gestion_huespedes.php'
            </script>";
        }
    }else{
        $query_reserva = "INSERT INTO reserva (fecha_inicio,fecha_final,cedula_cliente,numero_habitacion,numero_noches,precio_total) VALUES ('$fechaInicial','$fechaFinal','$cedula','$nHabitacion','$numeroNoches','$totalReserva')";
        $ejecutar_reserva = mysqli_query($con,$query_reserva);
        if($ejecutar_reserva){
            echo 
            "<script>
                alert('Reserva almacenado correctamente.')
                window.location = '../gestion_huespedes.php'
            </script>";
        }else{
            echo 
            "<script>
                alert('Reserva no almacenados correctamente.')
                window.location = '../gestion_huespedes.php'
            </script>";
        }
    }
        
    //Contraseña aleatoria de cuatro digitos numericos
    function generarContrasena() {
        $longitud = 4; // Longitud de la contraseña
        $contrasena = '';
    
        // Genera un dígito aleatorio y agrega a la contraseña
        for ($i = 0; $i < $longitud; $i++) {
            $contrasena .= mt_rand(0, 9); // Genera un número aleatorio entre 0 y 9
        }
        return $contrasena;
    }
?>