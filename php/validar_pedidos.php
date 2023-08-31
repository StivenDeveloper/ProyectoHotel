<?php   
    include('conexion_bd.php');
    $con = conexion();    
    $cedula= $_POST['cedula'];
    $nombre= $_POST['nombre'];
    if(isset($_POST['pedidos'])){
        $pedidos = $_POST['pedidos'];

        foreach ($pedidos as $productoId => $cantidad) {
            if($cantidad > 0){
                $query_consulta = mysqli_query($con,"SELECT precio FROM productos WHERE id_producto = '$productoId'");
                if($row = $query_consulta->fetch_assoc()){
                    $total = $row['precio'] * $cantidad;
                }
            
                $query_pedido = mysqli_query($con,"INSERT INTO pedidos (id_producto, cedula_cliente, cantidad, precio_total) VALUES ('$productoId','$cedula','$cantidad','$total')");
                if(!$query_pedido){
                      echo "
                          <script>
                              alert('***error***.')            
                              window.location='../clientes.php?nombre=$nombre&cedula=$cedula';
                          </script>
                      ";
                } 
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