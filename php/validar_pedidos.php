<?php   
    include('conexion_bd.php');
    $con = conexion();
    
    if(isset($_POST['pedidos']) && isset($_POST['cedula'])&& isset($_POST['nombre'])){
        $check = $_POST['pedidos'];
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];

        foreach ($check as $pedido) {
            $query_pedido = mysqli_query($con,"INSERT INTO pedidos (id_producto, cedula_cliente) VALUES ('$pedido','$cedula')");
            if(!$query_pedido){
                echo "
                    <script>
                        alert('***error***.')            
                        window.location='../clientes.php';
                    </script>
                ";
            } 
        }
        echo "
            <script>
                alert('Pedido cargado correctamente.')            
                window.location='../clientes.php?nombre=$nombre&cedula=$cedula';
            </script>
        ";
    }
?>