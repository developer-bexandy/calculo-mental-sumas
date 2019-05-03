<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.bexandyrodriguez.com.ve
 * @since      1.0.0
 *
 * @package    Calculo_Mental_Sumas
 * @subpackage Calculo_Mental_Sumas/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Calculo_Mental_Sumas
 * @subpackage Calculo_Mental_Sumas/public
 * @author     Bexandy Rodriguez <developer@bexandyrodriguez.com.ve>
 */
class Calculo_Mental_Sumas_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Calculo_Mental_Sumas_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Calculo_Mental_Sumas_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name.'-public-css', plugin_dir_url( __FILE__ ) . 'css/calculo-mental-sumas-public.css', array(), $this->version, 'all' );

		wp_enqueue_style( 'bootstrap_css', 
  					'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css', 
  					array(), 
  					'4.1.3'
  					); 
		wp_enqueue_style( 'bootstrap-slider_css', 
  					'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.1/css/bootstrap-slider.min.css',
  					array('bootstrap_css'), 
  					'10.6.1'
  					); 
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Calculo_Mental_Sumas_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Calculo_Mental_Sumas_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_register_script( $this->plugin_name.'-public-js', plugin_dir_url( __FILE__ ) . 'js/calculo-mental-sumas-public.js', array( 'jquery' ), $this->version, false);

		wp_enqueue_script( $this->plugin_name.'-public-js');
  
		$userCapabilities = array();
		$pluginUrl = plugin_dir_url( __FILE__ );

		if (is_user_logged_in()) {
			array_push($userCapabilities, 'read');
			if (current_user_can( 'jugar_entrenamiento' )) {
				array_push($userCapabilities, 'jugar_entrenamiento');
			}
			if (current_user_can( 'ver_puntos_otros' )) {
				array_push($userCapabilities, 'ver_puntos_otros');
			}
			if (current_user_can( 'ver_puntos_propios' )) {
				array_push($userCapabilities, 'ver_puntos_propios');
			}
			
		} else {
			array_push($userCapabilities, 'anonimo');
		}
		
		$title_nonce = wp_create_nonce('calculo_mental_sumas_public');

		
		wp_localize_script($this->plugin_name.'-public-js', 'calculo_mental_sumas_ajax_obj', array(
	        'ajax_url' => admin_url( 'admin-ajax.php' ),
	        'user_capabilities'    => $userCapabilities,
	        'plugin_url' => $pluginUrl, 
	        'nonce'    => $title_nonce

	    ));

	    wp_enqueue_script( 'popper_js', 
  					'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js', 
  					array(), 
  					'1.14.3', 
  					true); 
	    wp_enqueue_script( 'bootstrap_js', 
  					'https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js', 
  					array('jquery','popper_js'), 
  					'4.1.3', 
  					true); 
	    wp_enqueue_script( 'bootstrap-slider_js', 
  					'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/10.6.1/bootstrap-slider.min.js', 
  					array('jquery','bootstrap_js'), 
  					'10.6.1', 
  					true); 

	    
	    wp_enqueue_script( 'tweenmax_js', 
  					'https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js', 
  					array(), 
  					'2.1.2', 
  					true);

	}

	/**
	 * Definir el shortcode para mostrar el formulario.
	 *
	 **/
	public function shortcode_calculo_mental_sumas($atts, $content = null){

		$template_file = dirname(__FILE__) .'/partials/calculo-mental-sumas-public-display.php';
		$html = file_get_contents($template_file);
		ob_start();
		?>
		<?php echo $html;?>
	    <?php
	    $data = ob_get_clean();
	    return $data;
	}

	/**
	 * Displays Error Notices
	 *
	 * @since    1.0.0
	 * @access   private
	 **/
	public function DisplayError($message = "Aww!, there was an error.") {
		wp_send_json_error(
		    array( 
            		'message' => $message
            	)
		  );
	}

	/**
	 * Displays Success Notices
	 *
	 * @since    1.0.0
	 * @since    1.0.0
	 **/
	public function DisplaySuccess($message ) { 
		wp_send_json_success(
			    array( 
            		'message' => $message            	)
			 );
	}

	/**
	 * Definir el shortcode para mostrar el formulario.
	 *
	 **/
	public function loadJuegoEntrenamiento($atts, $content = null){

		$template_file = dirname(__FILE__) .'/partials/juego-entrenamiento.php';
		$html = file_get_contents($template_file);
		ob_start();
		?>
		<?php echo $html;?>
	    <?php
	    $data = ob_get_clean();
	    self::DisplaySuccess($data);
	}

}
