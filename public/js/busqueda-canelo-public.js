//buscador marca : The name of the select in the html form
//buscador modelo : The name of the select in the html form where we are putting the output

(function( $ ) {
	'use strict';
$(document).ready(function(){
		$('#buscador_marca').change(function(){
			var buscador_marca_label = $(this).val();

			var data = {
				buscador_marca_label: buscador_marca_label,
				action : 'actualizar'
			};

			console.log(php_vars.ajax_url);
			$.ajax({
				type:'POST',
				url: php_vars.ajax_url,
				data: data,
				success:function(data){
					$('#buscador_modelo').html(data);
				},
				error: function ( xhr, errorType, exception ) { //Triggered if an error communicating with server
		            var errorMessage = exception || xhr.statusText; //If exception null, then default to xhr.statusText
		            console.log(xhr);
		            alert( "There was an error creating your contact: " + errorMessage );
		        }
			});
			
		});
	});	
})( jQuery );

function getFormData(){
	jQuery(document).ready(function(){
		getString(jQuery('#buscador_marca').val());
	});

}
function createURL(url, marca){
	var url_final = url+'marca/'+marca;
	return url_final.toString();
}
function getString(marca){
	var buscador_marca_label = marca;
			var data = {
				marca_label: buscador_marca_label,
				action : 'actualizar'
			};

			//console.log(php_vars.ajax_url);
			jQuery.ajax({
				type:'POST',
				url: php_vars.ajax_url,
				data: data,
				success:function(data){
					if(data != ''){
						var URL_BUSQUEDA = String(jQuery('#URL_busqueda').val());
						var buscador_modelo = jQuery('#buscador_modelo').val();

						var buscador_producto = jQuery('#buscador_producto').val();
						
						buscador_producto = String(buscador_producto);
						
						buscador_producto = buscador_producto.toUpperCase();

						var URL_FINAL = createURL(URL_BUSQUEDA,data);

						if(buscador_modelo != ''){
							URL_FINAL = URL_FINAL+'/'+buscador_modelo;
						}
						if(buscador_producto != ''){
							URL_FINAL = URL_FINAL+'/?s='+buscador_producto;
						}
					}
					else{
						var URL_FINAL = String(jQuery('#URL_busqueda_vacia').val());
					}
					
					window.location.href = URL_FINAL;
				},
				error: function ( xhr, errorType, exception ) { //Triggered if an error communicating with server
		            var errorMessage = exception || xhr.statusText; //If exception null, then default to xhr.statusText
		            console.log(xhr);
		            alert( "There was an error creating your contact: " + errorMessage );
		        }
			});
}

