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
        	<form name = "forma_buscador" id="forma_buscador" action="?s=&post_type=product" method="POST" >
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
			    	<input type="number" name="buscador_anio" id="buscador_anio"placeholder="Opcional"/>
			    </th>
			    <th>
			<!-----------Bandera para saber cuando se usa nuestro buscador------------------->
			    	<input type="hidden" name="bandera_canelo" id="bandera_canelo" value="1" />
			    	
			    	<input type="submit" name="buscador_submit" value="Buscar" class="btn btn-color-primary btn-style-default btn-size-default"/>
			    </th>
			</form>
        </tr>
    </table>
</div>


