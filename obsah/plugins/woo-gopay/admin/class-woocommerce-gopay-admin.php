<?php
/**
 * @package   WooCommerce GoPay
 * @author    Vladislav Musílek
 * @license   GPL-2.0+
 * @link      http://toret.cz
 * @copyright 2014 Toret.cz
 */
class Woocommerce_Gopay_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		$plugin = Woocommerce_Gopay::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Load admin style sheet.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		
		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		add_action( 'admin_init', array( $this, 'output_buffer' ) );
    
	}

	/**
	 * Return an instance of this class.
	 *
	 * @since     1.0.0
	 *
	 * @return    object    A single instance of this class.
	 */
	public static function get_instance() {

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}
	/**
	 * Register and enqueue admin-specific CSS.
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

		if ( isset( $_GET['page'] ) && $_GET['page'] == 'woocommerce-gopay' ) {
			wp_enqueue_style( 'gopay-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), Woocommerce_Gopay::VERSION );
		}

	}


	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {
        if (!defined('TORETMENU')) {
     
     		add_menu_page(
				__( 'Toret plugins', $this->plugin_slug ),
				__( 'Toret plugins', $this->plugin_slug ),
				'manage_woocommerce',
				'toret-plugins',
				array( $this, 'display_toret_plugins_admin_page' ),
        		WOOGPURL.'assets/t-icon.png'
			);
     
     		define( 'TORETMENU', true );
  		}
  
  
  	
			add_submenu_page(
				'toret-plugins',
      			__( 'GoPay', $this->plugin_slug ),
				__( 'GoPay', $this->plugin_slug ),
				'manage_woocommerce',
				$this->plugin_slug,
				array( $this, 'display_plugin_admin_page' )
			);


	}
  
  	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_toret_plugins_admin_page() {
		include_once( 'views/toret.php' );
	}
  
	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}
  

	/**
	 * Headers allready sent fix
	 *
	 */        
  	public function output_buffer() {
		ob_start();
  	} 

}
