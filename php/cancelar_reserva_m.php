<?php
    include('conexion_bd.php');
    $con = conexion();

    if(isset($_GET['habitacion']) && isset($_GET['fecha']) && isset($_GET['cedula'])){
        $habitacion = $_GET['habitacion'];
        $fecha = $_GET['fecha'];
        $cedula = $_GET['cedula'];

        $query_eliminar = mysqli_query($con, "DELETE FROM reserva WHERE numero_habitacion = '$habitacion' AND fecha_inicio = '$fecha'");

        if($query_eliminar){
            echo "
            <script>
                alert('Reserva eliminada correctamente')            
                window.location='../mostrar_reservas.php?cedula=" . urlencode($cedula) . "';
            </script>
            "; 
        }else{
            echo "
                <script>
                    alert('Reserva no fue eliminada correctamente.')            
                    window.location='../mostrar_reservas.php?cedula=" . urlencode($cedula) . "';
                </script>
                ";
        }
    }
?>