<?php
// En este codigo se agregan las opciones al select dinamico desde la base de datos
	require plugin_dir_path(__FILE__).'busqueda-canelo-public-conexion.php';

	$query = $conexion->query('SELECT label, rowid FROM doli_categorie WHERE fk_parent = '. $_POST['buscador_marca_label'].'');

	$rowCount = $query->num_rows;
	if($rowCount > 0){
		$cadena = '<option value="">Selecciona un modelo</option>';
		while($row = $query->fetch_assoc()){
			$cadena = $cadena. '<option value="'.$row['rowid'].'">'.$row['label'].'</option>';
		}		
	}else{
		$cadena = '<option value="">'.$_POST['buscador_marca_label'].'</option>';
	}
	$conexion->close();
	echo $cadena;
?>