<?php

/**
 * Provide a connection to the external ELCANELO database
 *
 *
 * @link       www.lionintel.com
 * @since      1.0.0
 *
 * @package    Busqueda_Canelo
 * @subpackage Busqueda_Canelo/public/partials
 */
?>
<?php
	$user = 'root';
	$pass = '';
	$db = 'elcanelo1_production';
	$host = 'localhost';
	$conexion = new mysqli( $host, $user, $pass, $db );
	if($conexion->connect_error) {
		die("Connection failed: ". $db->connect_error);
	}
?>