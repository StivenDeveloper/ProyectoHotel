<?php
    include('conexion_bd.php');
    $con = conexion();

    if(isset($_GET['cedula'])){
        $cedula= $_GET['cedula'];
        $query_reserva = mysqli_query($con,"SELECT * FROM reserva WHERE cedula_cliente = '$cedula'");
        if(mysqli_num_rows($query_reserva)>0){
            $query_chickin = mysqli_query($con,"UPDATE reserva SET checkin = 1 WHERE cedula_cliente = '$cedula'");
            $query_consulta_clientes = mysqli_query($con,"SELECT contrasena,nombre FROM clientes Where cedula_cliente = '$cedula'");
        }else{
            echo "
            <script>
                if(confirm('No hay reservas para ese Huesped, ¿Desea realizar una reserva?')){
                  window.location='../reserva_fecha_m.php';
                } else{
                   window.location='../gestion_huespedes.php';
                }          
          </script>
            "; 
        }
         
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        if(mysqli_num_rows($query_consulta_clientes)>0){
            $row = $query_consulta_clientes->fetch_assoc();
            $ticket = $row['contrasena'];
            $nombre = $row['nombre'];
            echo "
    <script>
        var style = 'padding: 10px; background-color: #f2f2f2; border: 1px solid #ccc; border-radius: 5px; font-family: Arial, sans-serif; font-size: 18px;';
        var message = 'Número de ticket para el usuario $nombre es: $ticket';
        var alertBox = '<div style=\"' + style + '\">' + message + '</div>';
        
        var popup = document.createElement('div');
        popup.innerHTML = alertBox;
        popup.style.position = 'fixed';
        popup.style.top = '50%';
        popup.style.left = '50%';
        popup.style.transform = 'translate(-50%, -50%)';
        popup.style.zIndex = '9999';
        popup.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.5)';
        popup.style.animation = 'popupFadeIn 0.5s ease';
        popup.style.backgroundColor = '#ffffff';
        popup.style.textAlign = 'center';
        popup.style.fontWeight = 'bold';
        popup.style.fontSize = '30px';
        
        document.body.appendChild(popup);
        
        setTimeout(function() {
            popup.style.animation = 'popupFadeOut 0.5s ease';
            setTimeout(function() {
                document.body.removeChild(popup);
                window.location = '../gestion_huespedes.php';
            }, 500);
        }, 5000);
    </script>
    <style>
        @keyframes popupFadeIn {
            from {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.8);
            }
            to {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
        }
        
        @keyframes popupFadeOut {
            from {
                opacity: 1;
                transform: translate(-50%, -50%) scale(1);
            }
            to {
                opacity: 0;
                transform: translate(-50%, -50%) scale(0.8);
            }
        }
    </style>
";
 
        }
    ?>
    
<link rel="stylesheet" href="../js/script.js">
</body>

</html>