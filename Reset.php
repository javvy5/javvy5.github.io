<?php

    include ('conexion.php');

    $sql = " UPDATE users SET seleccion = 'No', fecha_seleccion = '' ";
    $stmt = sqlsrv_query( $conn, $sql );

    $errores = sqlsrv_errors();

    if ($errores != '') {
        echo 0;
    } else {
        echo 1;
    }
    
?>