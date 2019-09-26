<?php
	if(isset($_POST['buscador_modelo'])){
		$IDposts = array();
		$rowCount = 0;
		$cadena = '';
		require plugin_dir_path(__FILE__).'busqueda-canelo-public-conexion.php';
		//$b_marca = $_POST['marca_label'];
		//$b_modelo = $_POST['modelo_label'];
		//$b_anio = $_POST['anio_label'];
		//$b_producto = $_POST['producto_label'];
		$b_modelo = $_POST['buscador_modelo'];
		$SQL = 'SELECT id_store FROM doli_product WHERE rowid in (SELECT fk_product FROM doli_categorie_product WHERE fk_categorie = '.$b_modelo.' )';
		$query = $conexion->query($SQL);

		$rowCount = $query->num_rows;
		if($rowCount > 0){
			$cadena = "está entrando a la consulta";
			$iterador = 0;
			while($row = $query->fetch_assoc()){
				//echo $row['id_store'].'<br>';
				$IDposts[$iterador] = (int)$row['id_store'];
				$iterador++;
			}		
		}
		$conexion->close();
		//var_dump($this->get_query_ids());
		//echo " -----  ";
		$this->set_query_ids($IDposts);
		var_dump($this->get_query_ids());
		//echo $cadena." ".$_POST['modelo_label']." ".$_POST['marca_label'];
		//echo json_encode($IDposts);
	}
	