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
	private $posts_array_id = array(92428,92420,92664,90514,1486,92466,92604);//array de ids de los posts para la query
	private $post_marca;
	private $post_modelo;
	private $post_anio;
	private $post_producto;


	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->post_modelo = 926;

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

	}
/*------------------Set and Get methods for the ids array in the class-------------------*/
	public function set_query_ids($ids){
		$this->posts_array_id = $ids;
	}
	public function get_query_ids(){
		return $this->posts_array_id;
	}
/*------------------Function hooked to the woocommerce product query---------------------*/
	public function custom_advanced_search( $query ) {
		global $wpdb;
		if(isset($_POST['buscador_submit'])){
			$this->post_modelo = $_POST['buscador_modelo'];
			$this->post_marca = $_POST['buscador_marca'];
			$this->post_producto = $_POST['buscador_producto'];
			$this->post_anio = $_POST['buscador_anio'];
			$_SESSION['buscador_modelo'] = $this->post_modelo;
		}
		$wpdb->canelo_query_ids = $this->bc_query($_SESSION['buscador_modelo'], $this->post_marca, $this->post_anio, $this->post_producto);
		$post_ids = $wpdb->canelo_query_ids;
		var_dump($post_ids);
	    // don't alter search results in the admin!
	    if( $query->is_admin ) return $query;
	    if( $query->is_search ) {
	        
	        // custom query
	      	$query_string = 'SELECT * FROM '.$wpdb->posts.' WHERE ID IN ('.implode(',',array_map('intval',$post_ids)).') ';
	        // execute custom query
	        $results = $wpdb->get_results($query_string, OBJECT);

	        // map results to a simple array of post IDs
	        $posts = array_map( function($post) {
	            return $post->ID;
	        }, $results );
	        // prevent empty array
	        $posts = count($posts) ? $posts : array(-1);
	        // only get posts from our custom query!
	        $query->set( 'post__in', $posts );
	        $query->set( 'posts_per_page', 12 );
	    }

	    return $query;
	}

	public function canelo_session_start() {
	    if( ! session_id() ) {
	        session_start();
	    }
	}
	/*--------------- Funcion que se manda llamar con el post de las llamadas AJAX-------*/
	public function actualizar(){
		if(isset($_POST["buscador_marca_label"])){//aqui entra para el select dependiente
			require plugin_dir_path(__FILE__).'partials/busqueda-canelo-public-update-select.php';
		}
		if(isset($_POST["marca_label"])){//Aqui entra para obtener los id de la query
			$this->bc_query($_POST["marca_label"]);
		}
		die();
	}
/*----------------Method that makes the query with the search parameters------------------*/
	public function bc_query($modelo, $marca, $anio, $producto){
		$IDposts = array();
		$rowCount = 0;
		require plugin_dir_path(__FILE__).'partials/busqueda-canelo-public-conexion.php';

		$SQL = 'SELECT id_store FROM doli_product WHERE rowid in (SELECT fk_product FROM doli_categorie_product WHERE fk_categorie = '.$modelo.' )';
		$query = $conexion->query($SQL);

		$rowCount = $query->num_rows;
		if($rowCount > 0){
			$iterador = 0;
			while($row = $query->fetch_assoc()){
				$IDposts[$iterador] = (int)$row['id_store'];
				$iterador++;
			}		
		}
		$conexion->close();
		return $IDposts;		
	}
	/*----------------------- Main Display and functioning method ---------*/
	public function public_search_page(){
		ob_start();
		global $wp;
		$URL = home_url( add_query_arg( array(), $wp->request ) );
		$URL_BUSQUEDA = $URL.'/';
		require plugin_dir_path(__FILE__).'partials/busqueda-canelo-public-conexion.php'; 
		require plugin_dir_path(__FILE__).'partials/busqueda-canelo-public-display.php';
		return ob_get_clean();
	}	
	/*   ----Adding the shortcode -----   */
	public function add_public_shortcodes(){
		add_shortcode('elcanelo_busqueda_nueva', array($this,'public_search_page') );
	}

}
