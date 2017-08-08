<?php
/**
 * @package   Woo Smart Emailing
 * @author    Vladislav Musílek
 * @license   GPL-2.0+
 * @link      http://toret.cz
 * @copyright 2014 Toret.cz
 */
class Woo_Smart_Emailing {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '1.1.3';

	/**
	 * Unique identifier for your plugin.
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'woo-smart-emailing';

	/**
	 * Instance of this class.
	 *
	 * @since    1.0.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Initialize the plugin by setting localization and loading public scripts
	 * and styles.
	 *
	 * @since     1.0.0
	 */
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

    $licence_status = get_option('wooshop-smart-licence');
    if ( empty( $licence_status ) ) {
	     return false;
    }

		add_action('woocommerce_checkout_update_order_meta', array($this,'save_accept') );
    add_action( 'woocommerce_thankyou', array($this,'create_contact'), 100 );
    add_action( 'woocommerce_review_order_after_submit', array($this,'show_accept') );
    
	}

	/**
	 * Return the plugin slug.
	 *
	 * @since    1.0.0
	 *
	 * @return    Plugin slug variable.
	 */
	public function get_plugin_slug() {
		return $this->plugin_slug;
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
	 * Fired when the plugin is activated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Activate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       activated on an individual blog.
	 */
	public static function activate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide  ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_activate();
				}

				restore_current_blog();

			} else {
				self::single_activate();
			}

		} else {
			self::single_activate();
		}

	}

	/**
	 * Fired when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 *
	 * @param    boolean    $network_wide    True if WPMU superadmin uses
	 *                                       "Network Deactivate" action, false if
	 *                                       WPMU is disabled or plugin is
	 *                                       deactivated on an individual blog.
	 */
	public static function deactivate( $network_wide ) {

		if ( function_exists( 'is_multisite' ) && is_multisite() ) {

			if ( $network_wide ) {

				// Get all blog ids
				$blog_ids = self::get_blog_ids();

				foreach ( $blog_ids as $blog_id ) {

					switch_to_blog( $blog_id );
					self::single_deactivate();

				}

				restore_current_blog();

			} else {
				self::single_deactivate();
			}

		} else {
			self::single_deactivate();
		}

	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since    1.0.0
	 *
	 * @param    int    $blog_id    ID of the new blog.
	 */
	public function activate_new_site( $blog_id ) {

		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		self::single_activate();
		restore_current_blog();

	}

	/**
	 * Get all blog ids of blogs in the current network that are:
	 * - not archived
	 * - not spam
	 * - not deleted
	 *
	 * @since    1.0.0
	 *
	 * @return   array|false    The blog ids, false if no matches.
	 */
	private static function get_blog_ids() {

		global $wpdb;

		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );

	}

	/**
	 * Fired for each blog when the plugin is activated.
	 *
	 * @since    1.0.0
	 */
	private static function single_activate() {
	}

	/**
	 * Fired for each blog when the plugin is deactivated.
	 *
	 * @since    1.0.0
	 */
	private static function single_deactivate() {
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
  public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );

	}

	/**
	 * Create contact
	 *
	 * @since 1.0.0  
	 */        
  public function create_contact($order_id){
  
  
    $accept = get_post_meta($order_id,'_smart_accept',true);
    $option = get_option('smart_emailing_option');
    
    if(!empty($option['checkout_display']) && $option['checkout_display'] == 'yes'){
       if(empty($accept)){ return false; }
    }
   
    
  
    //If not exist login data, return false
    if(empty($option)){ return false; }
    if(empty($option['token'])){   return false; }
    if(empty($option['user'])){    return false; }
    
    if(!empty($option['use_product_list']) && $option['use_product_list'] == 'yes'){  
    
      $order = new WC_Order($order_id);
      $items = $order->get_items();
        $has_list = false;
        foreach($items as $item){
          $product_list = get_post_meta($item['product_id'],'smart-cislo',true);
           if(!empty($product_list)){
              $has_list = true;
           }
        }
        
        if(!$has_list){ return false; }else{
         $smart_list = $product_list;
        }
    
    }else{
        if(empty($option['list_id'])){ return false; }else{
         $smart_list = $option['list_id'];
        }
    }
    
    
    //Get all order meta  
    $order_meta = get_post_meta($order_id);
    //If not exist email, return false
    if(empty($order_meta['_billing_email'][0])){ return false; }
  
    
    if($order_meta['_billing_country'][0] == 'CZ'){ $country = 'Česká Republika'; }
    elseif($order_meta['_billing_country'][0] == 'SK'){ $country = 'Slovenská Republika'; }
    else{ $country = 'Jiný stát'; }
  
    $args = array();
  
    $args['email']      = $order_meta['_billing_email'][0];
    $args['language']   = $option['language'];
    $args['name']       = $order_meta['_billing_first_name'][0];
    $args['surname']    = $order_meta['_billing_last_name'][0];
    $args['street']     = $order_meta['_billing_address_1'][0];
    $args['town']       = $order_meta['_billing_city'][0];
    $args['country']    = $country;
    $args['postalcode'] = $order_meta['_billing_postcode'][0];
    $args['phone']      = $order_meta['_billing_phone'][0];
    $args['list_id']    = $smart_list;
    
    
    
    
    
    $smart = new Smart_Emailing($option['token'],$option['user']);
    $result = $smart->createContact($args);
    
    $line     = $result->saveXML();
		$file     = SMARTDIR.'notify_log.txt';
    $current  = file_get_contents($file);
    $current .= 'Date: '.date('Y m d').PHP_EOL;
    $current .= 'Odpověď: '.PHP_EOL;
    $current .= $line.PHP_EOL;
    file_put_contents($file, $current);  
    
    
  
  }
  
  /**
   * Show accept with newsletter sending
   *
   * @sinde 1.0.0  
   */        
   public function show_accept(){
   
    $option = get_option('smart_emailing_option');
    
      if(!empty($option['checkout_display']) && $option['checkout_display'] == 'yes'){
        if(!empty($option['checkout_display'])){
          $label = $option['checkout_text'];
        }else{
          $label = 'Souhlasím s odběrem novinek.';
        }
        
        if(!empty($option['checkout_yes'])){
        if($option['checkout_yes'] == 'yes'){
          $checked = 'checked="checked"';
        }else{
          $checked = '';
        }
        }else{
          $checked = '';
        }
          echo '
            <p>
              <label for="checkout_yes" class="checkbox">'.$label.'</label>
              <input type="checkbox" class="input-checkbox" name="checkout_yes" '.$checked.' id="checkout_yes" value="yes" />
            </p>
          ';
        }
   }
   
   
   /**
    * Save acceptation
    *
    * @since 1.0.0   
    */               
   public function save_accept($order_id){
   
          if ( ! empty( $_POST['checkout_yes'] ) && $_POST['checkout_yes'] == 'yes' ) {
              update_post_meta( $order_id, '_smart_accept', 'yes' );
          }
   
   }

}//End class
