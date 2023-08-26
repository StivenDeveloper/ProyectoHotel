<?php
// Se crea una función para conectar la base de datos mysql
function conexion(){
    $host= "localhost"; // Inicializamos el nombre del servidor local
    $user= "root"; // Usuario del servidor
    $pass= ""; // contraseña, que en este caso no tiene
    $bd = "hoteles";

    $connect = mysqli_connect($host,$user,$pass,$bd); //Funcion para establecer la conexión a la base de datos
    mysqli_select_db($connect,$bd);
    return $connect;
}

?>