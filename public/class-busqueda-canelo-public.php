<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.lionintel.com
 * @since      1.0.0
 *
 * @package    Busqueda_Canelo
 * @subpackage Busqueda_Canelo/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Busqueda_Canelo
 * @subpackage Busqueda_Canelo/public
 * @author     Lion Systems Solutions <soporte@lionintel.com>
 */
class Busqueda_Canelo_Public {

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
	private $marca;


	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->marca = '';

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
		 * defined in Busqueda_Canelo_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Busqueda_Canelo_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/busqueda-canelo-public.css', array(), $this->version, 'all' );

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
		 * defined in Busqueda_Canelo_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Busqueda_Canelo_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		/*-------------------------------ACTUALIZAR----------------------------------------*/
		//Registration of the ajax script
		wp_register_script($this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/busqueda-canelo-public.js', array( 'jquery' ), $this->version, false );
		//Passing the ajax admin route to the script
		wp_localize_script($this->plugin_name, 'php_vars', array( 'ajax_url' => admin_url('admin-ajax.php') ));
		//enqueueing the script
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/busqueda-canelo-public.js', array( 'jquery' ), $this->version, false );
		/*-------------------------------BUSQUEDA-------------------------------------------*/
		//Registration of the ajax script
		wp_register_script($this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/busqueda-canelo-public-submit.js', array( 'jquery' ), $this->version, false );
		//Passing the ajax admin route to the script
		wp_localize_script($this->plugin_name, 'php_vars', array( 'ajax_url' => admin_url('admin-ajax.php') ));
		//enqueueing the script
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/busqueda-canelo-public-submit.js', array( 'jquery' ), $this->version, false );

	}

	public function actualizar(){
		if(isset($_POST["buscador_marca_label"])){
			require plugin_dir_path(__FILE__).'partials/busqueda-canelo-public-update-select.php';
		}
		if(isset($_POST["marca_label"])){
			require plugin_dir_path(__FILE__).'partials/busqueda-canelo-public-submit.php';
		}
		die();
	}

	public function public_search_page(){
		ob_start();
		global $wp;
		$URL = home_url( add_query_arg( array(), $wp->request ) );
		$URL_SUBMIT = $URL.'/categoria-producto/';
		
		require plugin_dir_path(__FILE__).'partials/busqueda-canelo-public-conexion.php'; 
		require plugin_dir_path(__FILE__).'partials/busqueda-canelo-public-display.php';
		/*if( file_exists( plugin_dir_path(__FILE__).'partials/busqueda-canelo-public-display.php' )){
			//Entering if exists
			require plugin_dir_path(__FILE__).'partials/busqueda-canelo-public-display.php';
		}*/
		return ob_get_clean();
	}	
	public function add_public_shortcodes(){
		add_shortcode('elcanelo_busqueda_nueva', array($this,'public_search_page') );
	}

}
