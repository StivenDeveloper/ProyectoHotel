<?php   
    include('conexion_bd.php');
    $con = conexion();    
    $cedula= $_POST['cedula'];
    $nombre= $_POST['nombre'];
    if(isset($_POST['pedidos'])){
        $check = $_POST['pedidos'];
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
    }else{
        echo"
            <script>
                alert('Seleccione un pedido.')            
                window.location='../clientes.php?nombre=$nombre&cedula=$cedula';
            </script>
        ";
    }
?>