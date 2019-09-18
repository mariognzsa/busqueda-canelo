<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       www.lionintel.com
 * @since      1.0.0
 *
 * @package    Busqueda_Canelo
 * @subpackage Busqueda_Canelo/public/partials
 */
?>
<div>
	<table style="width:100%;">
        <tr>
        	<th>Articulo</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Año</th>
        </tr>
        <tr>
        	<form name = "forma_buscador" id="forma_buscador" action="" method="POST" >
        		<th>
			    	<input type="text" name="buscador_producto" id="buscador_producto"placeholder="Ej... Faro"/>
			    </th>
            	<th>
            		<?php
            		
	    			$query = $conexion->query("SELECT rowid, label FROM doli_categorie WHERE fk_parent = 1");
            		$rowCount = $query->num_rows;
	    			?> 
			      	<select name="buscador_marca" id="buscador_marca" required>
			      		<option value="">Selecciona Marca</option>
			      		<?php
			      		if($rowCount > 0){
			      			while($row = $query->fetch_assoc()){
			      				echo '<option value="'.$row['rowid'].'" title="'.$row['label'].'">'.$row['label'].'</option>';		    
			      			}
			      		}else{
			      			echo '<option value="">Marca no disponible</option>';
			      		}
			      		$conexion->close();
			      		?>
			      	</select>
			    </th>
			    <th>
			    	<select name="buscador_modelo" id="buscador_modelo">
			        	<option value="">Selecciona marca primero</option>		        	
			        </select>
			    </th>
			    <th>
			    	<input type="text" name="buscador_anio">
			    </th>
			    <th><!-----------Paso de variables PHP con las URL generadas para su uso posterior en JS----------------------------------------->
			    	<input type="hidden" name="URL_busqueda" id="URL_busqueda" value="<?php echo $URL_SUBMIT; ?>" />
			    	<input type="hidden" name="URL_busqueda_vacia" id="URL_busqueda_vacia" value="<?php echo $URL_VACIA; ?>" />
			    	<input type="button" name="buscador_submit" value="Buscar" onclick="getFormData();" class="btn btn-color-primary btn-style-default btn-size-default"/>
			    </th>
			</form>
        </tr>
    </table>
</div>



