(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	
	$(function() {
		
		var divWrapper = $('#calculo_mental_wrapper');
		var user_capabilities = calculo_mental_sumas_ajax_obj.user_capabilities;
		var plugin_url = calculo_mental_sumas_ajax_obj.plugin_url;

		if ($.inArray('anonimo', user_capabilities) > -1) {
			divWrapper.get(0).innerHTML = '<h1>Usuario No Registrado</h1>';
		}

		if ($.inArray('read', user_capabilities) > -1) {
			divWrapper.get(0).innerHTML = '<h1>Usuario Registrado</h1>';
		}

		if ($.inArray('ver_puntos_propios', user_capabilities) > -1) {
			divWrapper.get(0).innerHTML = '<h1>Usuario Puede Ver Puntos Propios</h1>';
		}

		if ($.inArray('ver_puntos_otros', user_capabilities) > -1) {
			divWrapper.get(0).innerHTML = '<h1>Usuario Puede Ver Puntos de Otros</h1>';
		}

		if ($.inArray('jugar_entrenamiento', user_capabilities) > -1) {
			var data = {
                action: 'get_juego_entrenamiento',
                nonce_code: calculo_mental_sumas_ajax_obj.nonce,
            };
            $.post( calculo_mental_sumas_ajax_obj.ajax_url, 
                data, 
                function(response) {
                    if (response.success) {
                        divWrapper.get(0).innerHTML = response.data.message;
                        $.getScript( plugin_url +"js/partials/juego-entrenamiento.js" )
						  .done(function( script, textStatus ) {
						    console.log( textStatus );
						  })
						  .fail(function( jqxhr, settings, exception ) {
						    $( "div.log" ).text( "Triggered ajaxError handler." );
						});
                    } else {
                        console.log( 'Error: '+response.data.message );
                    }
                }
            )
            .fail(function(xhr, textStatus, error) {
                console.log(xhr.statusText);
                console.log(textStatus);
                console.log(error);
            });
			
		}

	});
	
})( jQuery );
