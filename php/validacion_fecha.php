<?php
    include('conexion_bd.php'); 
    $con = conexion();

    $dateInicio = $_POST['date_inicio'];
    $dateFin = $_POST['date_fin'];

    $query_validar = ""
?>