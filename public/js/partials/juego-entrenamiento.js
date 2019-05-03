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

		var plugin_url = calculo_mental_sumas_ajax_obj.plugin_url;
		var cuatroUrl = plugin_url +'js/img/cuatro.png';
		var	tresUrl = plugin_url +'js/img/tres.png';
		var	dosUrl = plugin_url +'js/img/dos.png';
		var	unoUrl = plugin_url +'js/img/uno.png';
		var imgSrc, suma, count;
		var cifraLimite, velMillisec;

		var arrayNumbers = [unoUrl, dosUrl, tresUrl, cuatroUrl];



	 	$("#cifrasSld").slider({
	 		ticks: [1, 2, 3],
		    ticks_labels: ['1', '2', '3'],
		    ticks_snap_bounds: 30
	 	});

		$("#cifrasSld").on("change", function(slideEvt) {
			$("#cifrasSliderVal").text(slideEvt.value.newValue);
			console.log(slideEvt);
		});

		$("#velSld").slider({
			ticks: [4, 3, 2, 1],
		    ticks_labels: ['4 seg', '3 seg', '2 seg', '1 seg'],
		    ticks_snap_bounds: 30
		});


		$("#velSld").on("change", function(slideEvt) {
			$("#velSliderVal").text(slideEvt.value.newValue);
		});

		$.fn.countDown = function(settings,to) {
	        settings = $.extend({
	        	startFontSize: "36px",
                endFontSize: "12px",
	            duration: 1000,
                startNumber: 4,
	            endNumber: 0,
	            callBack: function() { }
	        }, settings);

        	return this.each(function() {
                
                //¿Dónde empezamos?
                if(!to && to != settings.endNumber) { to = settings.startNumber; }
                
                //Establecemos la cuenta atrás con el numero inicial
                imgSrc = '<img src="'+arrayNumbers[to-1] +'" >';
                jQuery(this).html(imgSrc);



                jQuery(this).animate({
					width: "100%"
				}, settings.duration, "", function() {
					if(to > settings.endNumber + 1) {
						imgSrc = '<img src="'+arrayNumbers[to-2] +'" >';
						jQuery(this).html(imgSrc).countDown(settings, to - 1);
					}
					else {
						settings.callBack(this);
					}
				});
                      
        	});
		};

		$("#jugarButton").on("click", function(event) {
			event.preventDefault();
			$('div#calculo_mental_wrapper').removeClass('light-background');
			var bloqueEntrenamiento = $("input[name='bloqueRadios']:checked").val();
			var cifras = $("input#cifrasSld").val();
			var velocidad = $("input#velSld").val();
			var cifraLimiteArray = [9, 99, 999];
			cifraLimite = cifraLimiteArray[cifras-1];

			velMillisec = velocidad * 1000;

			console.log("bloqueEntrenamiento: "+bloqueEntrenamiento+" cifras: "+cifras+" velocidad: "+ velocidad);
			console.log("cifra limite: "+cifraLimite+" milisegundos: "+ velMillisec);

			$('#main_container').get(0).innerHTML = '';
			//$('#main_container').get(0).innerHTML = '<img src="'+plugin_url +'js/img/cuatro.png" >';

			$("#main_container").countDown({
	        	startNumber: 4,
	        	callBack: function(me) {
	        		count = 5;
	        		suma = 0;
	        		$('div#calculo_mental_wrapper').addClass('dark-background');
	        		var number = Math.floor((Math.random() * cifraLimite) + 1);
	        		$(me).text(number).css("color", "#090");
	        		suma += number;
	        		--count;
	        		console.log("number : "+number +" suma: "+suma+" count: "+count);
	        		var timer = setInterval(function(){
	        			number = Math.floor((Math.random() * cifraLimite) + 1);
	        			$(me).text(number).css("color", "#090");
	        			suma += number;
	        			--count;
	        			console.log("number : "+number +" suma: "+suma+" count: "+count);
	        			
	        			if (count == 0) {
	        				clearInterval(timer);
	        				setTimeout(function(){
	        					$(me).text("Imprimir resultado: "+suma).css("color", "#090");
	        					$(me).get(0).innerHTML = '<form><div class="container">'+
	        					'<div class="row"><div class="resultado">'+
	        					'<input class="text-input" type="text" name="txtResultado" id="txtResultado">'+
	        					'<label class="form-check-label" for="txtResultado">'+
	        					'Escriba el resultado de la suma<br>(4 seg)</label>'+
								'</div></div>'+
								'<div class="row"><div class="col">'+
								'<button id="resultadoButton">Enviar</button>'+
								'</div></div>'+
								'</div></form>';
	        				}, 1000);
	        			}
	        		}, velMillisec);
	        	}
			});
		});

	});

})( jQuery );
