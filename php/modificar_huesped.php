<?php
    session_start();
    include('conexion_bd.php');
    $con = conexion();

    if (isset($_POST['cedula'])){
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $direccion = $_POST['direccion'];
        $pais = $_POST['pais'];
        $departamento = $_POST['departamento'];
        $municipio = $_POST['municipio'];
        $email = $_POST['email'];

        $query_update = mysqli_query($con, "UPDATE clientes 
            SET cedula_cliente = '$cedula',
                nombre = '$nombre',
                apellido = '$apellido',
                telefono = '$telefono',
                direccion = '$direccion',
                nombre_pais = '$pais',
                nombre_departamento = '$departamento',
                nombre_municipio = '$municipio',
                correo = '$email'
            WHERE cedula_cliente = '$cedula'");

        if($query_update){
            echo "
            <script>
                alert('Huesped modificado correctamente')            
                window.location='../gestion_huespedes.php';
            </script>
            "; 
        }else{
            echo "
                <script>
                    alert('Huesped no fue modificado correctamente.')            
                    window.location='../gestion_huespedes.php';
                </script>
                ";
        }
    }
?>