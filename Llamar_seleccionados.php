<?php

    include ('conexion.php');

    $periodo = $_POST['periodo'];

    $sql = " SELECT * FROM users WHERE seleccion = 'Si' AND fecha_seleccion = ? ";
    $params = array( $periodo );
    $stmt = sqlsrv_query( $conn, $sql, $params );

    $content = '';
    $idx = 1;

    while ($row = sqlsrv_fetch_array($stmt)){

        $id_user = $row['id'];

        $content .= '<tr>';
        $content .= '<td>'.utf8_encode($row['nombre']).'</td>';
        $content .= '</tr>';

        $idx++;

    } 

    echo $content;

?>
