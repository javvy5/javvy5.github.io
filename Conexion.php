<?php

	$serverName = "IDIAZB-02";
	$connOptions = array("Database"=>"ingenieros");
	$conn = sqlsrv_connect( $serverName, $connOptions );

	if( $conn === false ) {
		die( print_r( sqlsrv_errors(), true));
	}

	return $conn;

?>
