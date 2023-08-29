<?php
    include('conexion_bd.php');
    $con = conexion();

    if(isset($_GET['cedula'])){
        $cedula = $_GET['cedula'];

        $query_modificar = mysqli_query($con, "DELETE FROM reserva WHERE numero_habitacion = '$habitacion' AND fecha_inicio = '$fecha'");

        if($query_eliminar){
            echo "
            <script>
                alert('Reserva eliminada correctamente')            
                window.location='../index.php';
            </script>
            "; 
        }else{
            echo "
                <script>
                    alert('Reserva no fue eliminada correctamente.')            
                    window.location='../reserva_cancelar.php';
                </script>
                ";
        }
    }
?>