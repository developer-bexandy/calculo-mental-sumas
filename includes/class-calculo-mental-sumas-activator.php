<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.bexandyrodriguez.com.ve
 * @since      1.0.0
 *
 * @package    Calculo_Mental_Sumas
 * @subpackage Calculo_Mental_Sumas/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Calculo_Mental_Sumas
 * @subpackage Calculo_Mental_Sumas/includes
 * @author     Bexandy Rodriguez <developer@bexandyrodriguez.com.ve>
 */
class Calculo_Mental_Sumas_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$role =& get_role( 'administrator' );

		if (!empty($role)) {
			$role->add_cap('jugar_entrenamiento');
			$role->add_cap('ver_puntos_otros');
			$role->add_cap('ver_puntos_propios');
		}

		$result = add_role(
		    'jugador_activo',
		    __( 'Jugador Activo' ),
		    array(
		        'jugar_entrenamiento' => true,  // true allows this capability
		        'ver_puntos_otros' => true,
		        'ver_puntos_propios' => true // Use false to explicitly deny
		    )
		);

		$result = add_role(
		    'jugador_suspendido',
		    __( 'Jugador Suspendido' ),
		    array(

		        'ver_puntos_propios' => true // Use false to explicitly deny
		    )
		);


	}

}
