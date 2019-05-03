<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.bexandyrodriguez.com.ve
 * @since      1.0.0
 *
 * @package    Calculo_Mental_Sumas
 * @subpackage Calculo_Mental_Sumas/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Calculo_Mental_Sumas
 * @subpackage Calculo_Mental_Sumas/includes
 * @author     Bexandy Rodriguez <developer@bexandyrodriguez.com.ve>
 */
class Calculo_Mental_Sumas_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		$role =& get_role( 'administrator' );

		if (!empty($role)) {
			$role->remove_cap('jugar_entrenamiento');
			$role->remove_cap('ver_puntos_otros');
			$role->remove_cap('ver_puntos_propios');
		}

		$roles_to_delete = array(
			'jugador_activo',
			'jugador_suspendido'
		);

		foreach ($roles_to_delete as $role) {
			$users = get_users( array('role' => $role) );
			if (count($users) <= 0) {
				remove_role( $role );
			}
		}

	}

}
