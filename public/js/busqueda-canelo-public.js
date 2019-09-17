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

	getString(jQuery('#buscador_marca').val());

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

			console.log(php_vars.ajax_url);
			jQuery.ajax({
				type:'POST',
				url: php_vars.ajax_url,
				data: data,
				success:function(data){
					var URL_BUSQUEDA = String(jQuery('#URL_busqueda').val());
					var buscador_modelo = jQuery('#buscador_modelo').val();
					var URL_FINAL = createURL(URL_BUSQUEDA,data);

					if(buscador_modelo != ''){
						URL_FINAL = URL_FINAL+'/'+buscador_modelo;
					}
					console.log(URL_FINAL);
					window.location.href = URL_FINAL;
				},
				error: function ( xhr, errorType, exception ) { //Triggered if an error communicating with server
		            var errorMessage = exception || xhr.statusText; //If exception null, then default to xhr.statusText
		            console.log(xhr);
		            alert( "There was an error creating your contact: " + errorMessage );
		        }
			});
}

