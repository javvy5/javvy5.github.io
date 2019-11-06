<?php

    include ('conexion.php');

    $sql = "SELECT * FROM users WHERE seleccion = 'No' ORDER BY newid()";
    $stmt = sqlsrv_query( $conn, $sql );

    $content = '';
    $idx = 1;

    while ($row = sqlsrv_fetch_array($stmt)){

        $id_user = $row['id'];

        $content .= '<tr>';
        $content .= '<td>'.$idx.'</td>';
        $content .= '<td>'.utf8_encode($row['nombre']).'</td>';
        $content .= '<td><select class="custom-select opciones" id="seleccionado_'.$id_user.'"><option value="Si">Si</option><option value="No" selected>No</option></select></td>';
        $content .= '</tr>';

        $idx++;

    } 

    echo $content;

?>
