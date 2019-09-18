<?php 
// En este codigo se obtiene el label de la DB por medio de su rowid
	require plugin_dir_path(__FILE__).'busqueda-canelo-public-conexion.php';

	$query = $conexion->query('SELECT label FROM doli_categorie WHERE rowid = '. $_POST['marca_label'].'');
	$cadena = '';
	$rowCount = $query->num_rows;
	if($rowCount > 0){
		while($row = $query->fetch_assoc()){
			$cadena = $row['label'];
		}		
	}else{
		$cadena = '';
	}
	$conexion->close();
	echo $cadena;
?>