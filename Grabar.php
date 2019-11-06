<?php

    include ('conexion.php');

    $seleccion    =   $_POST['seleccion'];

    foreach ($seleccion as $key => $value) {
        if ($value['valor'] == 'Si') {

            $sql = " UPDATE users SET seleccion = ?, fecha_seleccion = ? WHERE id = ? ";
            $params = array( $value['valor'], $value['periodo'], $value['id'] );
            $stmt = sqlsrv_query( $conn, $sql, $params );

        }
    }

    $errores = sqlsrv_errors();

    if ($errores != '') {
        echo 0;
    } else {
        echo 1;
    }

?>