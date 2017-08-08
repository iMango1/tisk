<?php
/**
 * @package   Woo Smart Emailing
 * @author    Vladislav Musílek
 * @license   GPL-2.0+
 * @link      http://toret.cz
 * @copyright 2014 Toret.cz
 */
class Woo_Smart_Emailing_Admin {

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

		$plugin = Woo_Smart_Emailing::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );
    /*
    $licence_status = get_option('wooshop-smart-licence');
    if ( empty( $licence_status ) ) {
	     return false;
    }
    */

		add_action('admin_init', array( $this, 'smart_output_buffer' ) );
    
    
    /*
		 * Define custom functionality.
		 */
		add_action( 'add_meta_boxes', array( $this, 'product_smart' ) );
    add_action( 'save_post', array( $this, 'product_smart_meta_box_setup') );
    

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
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

				wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), Woo_Smart_Emailing::VERSION );
		
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

				wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery' ), Woo_Smart_Emailing::VERSION );
	
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
			  'manage_options',
			  'toret-plugins',
			  array( $this, 'display_toret_plugins_admin_page' ),
        SMARTURL.'assets/t-icon.png',
        58
		  );
     
     define( 'TORETMENU', true );
  }
  
  
  	
	add_submenu_page(
			'toret-plugins',
      __( 'Smart Emailing', $this->plugin_slug ),
			__( 'Smart Emailing', $this->plugin_slug ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' )
		);

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
	 * Add settings action link to the plugins page.
	 *
	 * @since    1.0.0
	 */
	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);

	}

	/**
	 * Headers allready sent fix
	 *
	 * @since    1.0.0
	 */
	public function smart_output_buffer() {
		ob_start();
  } 



  	/**
	 * Metabox for order detail 
	 *
	 * @since    1.0.0
	 */
	public function product_smart() {
		
  
    include('includes/metabox.php');
    
    add_meta_box( 'smart', 'Smart Emailing', 'product_smart_meta_box', 'product', 'side', 'high' );
    
	}
  
  /**
	 * Save metabox value for order detail 
	 *
	 * @since    1.0.0
	 */
  public function product_smart_meta_box_setup($post_id){
  
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		  return $post_id;
      
    if (isset($_POST['smart-cislo'])){ 
      $smart_cislo = sanitize_text_field($_POST['smart-cislo']);
      update_post_meta( $post_id, 'smart-cislo', $smart_cislo );    
    } 
  
  }



}
