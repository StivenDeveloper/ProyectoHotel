<?php
    session_start();
    include('conexion_bd.php');
    $con = conexion();
    $usuario = $_POST['cedula'];
    $contrasena = $_POST['contrasena'];
    // $contrasena= hash('sha512',$contrasena);
    $validar_login = mysqli_query($con,"SELECT*FROM login_registre WHERE cedula='$usuario' AND contrasena='$contrasena'");
    $validar_cliente = mysqli_query($con,"SELECT*FROM clientes WHERE cedula_cliente = '$usuario' AND contrasena='$contrasena'");

    if(mysqli_num_rows($validar_login)>0){
        $_SESSION['usuario']=$usuario;
        Header("location:../menuPrincipal.php");
        exit;
    }else if(mysqli_num_rows($validar_cliente)>0){
        $_SESSION['usuario']=$usuario;
        Header("location:../clientes.php");
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