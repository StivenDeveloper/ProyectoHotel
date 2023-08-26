<?php
    include('conexion_bd.php');
    $con = conexion();
    $cedula = $_POST['cedula'];
    $nombreCliente = $_POST['nombre_cliente'];
    $tipoPedido = $_POST['tipo_pedido'];
    $fechaPedido = $_POST['fecha_pedido'];
    $query_insert="INSERT INTO pedidos(cedula,nombre_cliente,tipo_pedido,fecha_pedido) VALUES ('$cedula','$nombreCliente','$tipoPedido','$fechaPedido')";
    $ejecutar = mysqli_query($con,$query_insert);
    if(mysqli_num_rows($validar_login)>0){
        $_SESSION['usuario']=$usuario;
        Header("location:../menuPrincipal.php");
        exit;
    }else{
        echo "
        <script>
            alert('Usuario no existe, por favor verifique los datos ingresados.')            
            window.location='../index.php';
        </script>
        ";
        exit;
    }
?>