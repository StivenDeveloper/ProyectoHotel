<?php
    include('conexion_bd.php');
    $con = conexion();

    if(isset($_GET['cedula'])){
        $cedula = $_GET['cedula'];
        $query_validar_reserva = mysqli_query($con,"SELECT * FROM reserva  WHERE cedula_cliente='$cedula'");
        if(mysqli_num_rows($query_validar_reserva)>0){
            $query_eliminar_r = mysqli_query($con,"DELETE FROM reserva  WHERE cedula_cliente='$cedula'");
            $query_eliminar_c = mysqli_query($con,"DELETE FROM clientes  WHERE cedula_cliente = '$cedula'");
        }else{
            $query_eliminar_c = mysqli_query($con,"DELETE FROM clientes  WHERE cedula_cliente = '$cedula'"); 
        };
        
        if($query_eliminar_c){
            echo "
            <script>
                alert('Cliente eliminado correctamente')            
                window.location='../gestion_huespedes.php'
            </script>
            "; 
        }else{
            echo "
                <script>
                    alert('Reserva no fue eliminada correctamente.')            
                    window.location='../gestion_huespedes.php'
                </script>
                ";
        }
    }
?>

