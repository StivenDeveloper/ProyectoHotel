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
    
    $query_insert="INSERT INTO clientes VALUES ('$cedula','$nombre','$apellido','$telefono','$direccion','$pais','$departamento','$municipio','$email','$contrasena')";
    $query_verificacion = mysqli_query($con,"SELECT * FROM clientes WHERE cedula_cliente = $cedula");
    //$query_update = "UPDATE habitaciones SET estado = 'ocupado' WHERE numero_habitacion = $habitacion";
    $query_reserva = "INSERT INTO reserva (fecha_inicio,fecha_final,cedula_cliente,numero_habitacion) VALUES ('$fechaInicial','$fechaFinal','$cedula','$nHabitacion')";
    
    if(mysqli_num_rows($query_verificacion)>0){
        echo 
        "<script>
            alert('Este usuario ya existe, verifique si los datos estan correctos o inicie sesión')
            window.location = '../index.php'
        </script>";
        exit();
    }else{
        $ejecutar = mysqli_query($con,$query_insert);
        //$ejecutar_update = mysqli_query($con,$query_update);
        $ejecutar_reserva = mysqli_query($con,$query_reserva);
        if($ejecutar && $ejecutar_reserva){
            echo 
            "<script>
                alert('Usuario almacenado correctamente.')
                window.location = '../index.php'
            </script>"; 
        }else{
            echo 
            "<script>
                alert('Usuarios no almacenados correctamente.')
                window.location = '../index.php'
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