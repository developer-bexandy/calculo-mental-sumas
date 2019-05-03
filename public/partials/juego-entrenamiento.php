<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://www.bexandyrodriguez.com.ve
 * @since      1.0.0
 *
 * @package    Calculo_Mental_Sumas
 * @subpackage Calculo_Mental_Sumas/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="juego_entrenamiento_wrapper" >
	<div id="main_container">
		<form>
			<div class="container">
				<div class="row">
				    <div class="col">
				    	<div id="bloquesEntrenamiento">
				    		<div class="form-check">
							  <input class="form-check-input" type="radio" name="bloqueRadios" id="bloqueRadios1" value="elemental" checked>
							  <label class="form-check-label" for="bloqueRadios1">
							    Elemental
							  </label>
							</div>
							<div class="form-check">
							  <input class="form-check-input" type="radio" name="bloqueRadios" id="bloqueRadios2" value="basico" disabled>
							  <label class="form-check-label" for="bloqueRadios2">
							    Basico
							  </label>
							</div>
							<div class="form-check">
							  <input class="form-check-input" type="radio" name="bloqueRadios" id="bloqueRadios3" value="super-cerebro" disabled>
							  <label class="form-check-label" for="bloqueRadios3">
							    Super-Cerebro
							  </label>
							</div>
							<div class="form-check">
							  <input class="form-check-input" type="radio" name="bloqueRadios" id="bloqueRadios4" value="super-cerebro-experto" disabled>
							  <label class="form-check-label" for="bloqueRadios4">
							    Super-Cerebro-Experto
							  </label>
							</div>
				    	</div>
				    </div>
				    <div class="col">
				    	<div id="cifrasSliderDiv" class="slider slider-horizontal div-slider">
							<input id="cifrasSld" type="text" data-slider-ticks="[1, 2, 3]" data-slider-ticks-snap-bounds="30" data-slider-ticks-labels='["1", "2", "3"]' data-slider-value="1"/>
							<span id="cifrasCurrentSliderValLabel">Cifras: <span id="cifrasSliderVal">1</span></span>
						</div>
				    </div>
				    <div class="col">
				    	<div id="velSliderDiv" class="slider slider-horizontal div-slider" >
							<input id="velSld" type="text" data-slider-ticks="[4, 3, 2, 1]" data-slider-ticks-snap-bounds="30" data-slider-ticks-labels='["4 seg", "3 seg", "2 seg", "1 seg"]' data-slider-value="4" data-slider-rtl="true"/>
							<span id="velCurrentSliderValLabel">Velocidad: <span id="velSliderVal">4</span>  seg</span>
						</div>
				    </div>
				</div>
				<br>
				<div class="row">
					<div class="col">
						<button id="jugarButton">Jugar</button>
					</div>		    	
				</div>
			</div>
		</form>
	</div>
	

	<div id="countdown"></div>

	<div id="movie-countdown"></div>

</div>