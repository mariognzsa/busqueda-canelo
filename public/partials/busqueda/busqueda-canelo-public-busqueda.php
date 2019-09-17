<?php
	$producto = $_POST['buscador_producto'];
	$marca = $_POST['buscador_marca'];
	$modelo = $_POST['buscador_modelo'];
	$anio = $_POST['buscador_anio'];
	$url = '/?s='+$producto;
	wp_redirect((home_url().$url));
?>