<?php
/**
 * @package   Woo Fapi
 * @author    Vladislav Musílek
 * @license   GPL-2.0+
 * @link      Toret.cz
 * @copyright 2014 Toret.cz
 */

class Woo_Fapi {

	/**
	 * Plugin version, used for cache-busting of style and script file references.
	 *
	 * @since   1.0.0
	 *
	 * @var     string
	 */
	const VERSION = '1.0.8';

	/**
	 *
	 * @since    1.0.0
	 *
	 * @var      string
	 */
	protected $plugin_slug = 'woo-fapi';

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

        $licence_status = get_option('wooshop-fapi-licence');
        if ( empty( $licence_status ) ) {
            return false;
        }

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );
    
        $wc_get_order_statuses = $this->get_order_statuses();

        foreach ( $wc_get_order_statuses as $key => $status ){
            add_action( 'woocommerce_order_status_'.$key, array( $this, 'invoice' ), 5 );
        }

        $display = get_option('wc_settings_tab_fapi_ic_dic');
        if($display == 'yes'){

            add_filter( 'woocommerce_checkout_fields', array( $this,'ic_dic_checkout_fields' ) );
            add_filter( 'woocommerce_my_account_my_address_formatted_address', array( $this, 'my_account_fields' ), 10, 3 );
            add_filter( 'woocommerce_localisation_address_formats', array( $this, 'localisation_address_formats' ) );
            add_filter( 'woocommerce_formatted_address_replacements', array( $this, 'formatted_address_replacements' ), 10, 2 );
            add_filter( 'woocommerce_order_formatted_billing_address', array( $this, 'order_formatted_billing_address' ), 10, 2 );
    
        }

        $emails = get_option( 'wc_settings_tab_fapi_disable_emails' );
        if( !empty( $emails ) && $emails == 'yes' ){
            add_action( 'woocommerce_email', array( $this, 'unhook_emails' ) );
        }
    
        $save_pdf = get_option('wc_settings_tab_fapi_save_pdf');
        if(!empty($save_pdf) && $save_pdf == 'yes'){
            add_action( 'woocommerce_email_after_order_table', array( $this, 'add_link_to_email'), 15, 2 );
        }

        add_action( 'wp_head', array( $this, 'checkout_js' ) );

        add_action( 'woocommerce_order_status_completed', array( $this, 'pay_invoice' ), 5 );
    

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
     * Check if invoice or proforma can be created
     *
     *
     */
    public function invoice( $order_id ){
        $order = new WC_Order( $order_id );

        foreach( array( 'regular', 'proforma' ) as $type ){      
            $invoice_status = $this->generate_invoice_status( $order->payment_method, $type );  
            if ( !empty( $invoice_status ) ){          

                if ( $invoice_status == $order->status ){                

                    $this->create_invoice( $order_id, $type );
                
                }
            
            }
        
        }

    }



    /**
	 * Create invoice after payment
	 *   
	 * @since    1.0.0
	 */
	public function create_invoice( $order_id, $proforma ) {
        
        //Check order status
        $my_order = new WC_Order($order_id);
        $status   = $my_order->get_status();
    
        if($status != 'failed' || $status != 'canceled'){
    
            $language = $this->get_invoice_language( $order_id );
            $country = get_post_meta( $order_id,'_billing_country',true );
     
            //If exist Fapi invoice id, return false
            $invoice_id = get_post_meta($order_id,'fapi_invoice_id');
    
            //Get fapi options
            $fapi_payment_method = get_option('wc_settings_tab_fapi_payment_methods');
            $fapi_email          = get_option('wc_settings_tab_fapi_email');
            $fapi_password       = get_option('wc_settings_tab_fapi_password');
            $fapi_form           = get_option('wc_settings_tab_fapi_project_setting');
    
    
    
            //Get FAPI Client instance
            $fapi = new FAPIClient($fapi_email, $fapi_password);
    
    
            //Invoice id not exist create new
            if(empty($invoice_id)){
     
                $order_payment_method = get_post_meta( $order_id, '_payment_method', true ); 
     
                $payment_method = $fapi_payment_method[$order_payment_method];
                update_post_meta( $order_id, 'fapi_payment_method', $payment_method );
      
                //Get all order meta  
                $order_meta = get_post_meta($order_id);

                /* Check exist user  */
                require_once( FAPIDIR . 'classes/Toret_Contact_Data.php' );
                $fapi_contact = new Toret_Contact_Data( $my_order, $order_meta, $fapi );
                $fapi_user_id = $fapi_contact->get_contact_id();
                if($fapi_user_id === false){ return false; } 
     
                /* Create products invoice data */
                require_once( FAPIDIR . 'classes/Toret_Orders_Items.php' );
                $toret_order_items = new Toret_Order_Items( $order_id );
                $items = $toret_order_items->get_invoice_lines();
     
               
     
                $data = array();

                //Set Fapi form id
                if( !empty( $fapi_form ) ){
                    $data['form']      = $fapi_form; 
                }
                
                //Set contact id
                $data['client']       = $fapi_user_id;
                
                //Set if is proforma
                if( $proforma != 'regular' ){
                    $data['proforma']     = true;
                }else{
                    $data['proforma']     = false;
                }
                
                $data['payment_type'] = $payment_method;
                $data['currency']     = $my_order->get_order_currency();
                $data['language']     = $language;
    
    
                if( $status == 'completed' ){
                    $data['paid'] = apply_filters( 'toret_fapi_paid_invoice', true, $my_order );
                }else{
                    $data['paid'] = apply_filters( 'toret_fapi_paid_invoice', false, $my_order );
                }

                
    
        
                $this->save_notify( ' Objednávka číslo: '.$order_id, 'Země :'.$country.' Jazyk :'.$language.' Měna: '.$data['currency'] );
      
    
                $display = get_option('wc_settings_tab_fapi_platce');
                if($display == 'yes'){    
                    $data['vat_date'] = date('Y-m-d');
                }
    
                $data['items'] = $items;
                
                $new_invoice = $fapi->invoice->create($data);
    
    
                //Save log
                if(false === $new_invoice){      
              
                    $this->save_notify(' Objednávka číslo: '.$order_id, 'Chyba při vytváření faktury');
              
                    return false;
              
                }   
     
                if(!empty($new_invoice['id'])){     update_post_meta($order_id,'fapi_invoice_id',$new_invoice['id']); };
                if(!empty($new_invoice['number'])){ update_post_meta($order_id,'fapi_invoice_number',$new_invoice['number']); }; 
     
    
                $save_pdf = get_option('wc_settings_tab_fapi_save_pdf');
                if(!empty($save_pdf) && $save_pdf == 'yes'){
    
                    sleep(5); 
    
                    $faktura = $fapi->invoice->getPdf($new_invoice['id']); 
                    $path = dirname(__FILE__);
                    $pdf = fopen ($path.'/invoices/'.$order_id.'.pdf','w');
                    fwrite ($pdf,$faktura);
                    fclose ($pdf);

                    sleep(2);
    
                }   
  
            }
 
        }//End control order status 
     
    }//End create invoice

   
    /**
     * Unhook emails
     *
     * @since 1.0.3   
     */           
   
    public function unhook_emails($email_class){
        remove_action( 'woocommerce_order_status_pending_to_processing_notification', array( $email_class->emails['WC_Email_New_Order'], 'trigger' ) );
		remove_action( 'woocommerce_order_status_pending_to_completed_notification', array( $email_class->emails['WC_Email_New_Order'], 'trigger' ) );
		remove_action( 'woocommerce_order_status_pending_to_on-hold_notification', array( $email_class->emails['WC_Email_New_Order'], 'trigger' ) );
        remove_action( 'woocommerce_order_status_pending_to_processing_notification', array( $email_class->emails['WC_Email_Customer_Processing_Order'], 'trigger' ) );
		remove_action( 'woocommerce_order_status_pending_to_on-hold_notification', array( $email_class->emails['WC_Email_Customer_Processing_Order'], 'trigger' ) );
    }
   
   
   
    /**
     *
     * IC and DIC fileds for checkout form
     *
     */               
    public function ic_dic_checkout_fields( $fields ) {
    
    
        $fields['billing']['billing_ic'] = array(
            'label'     => __('IČ', 'woocommerce'),
            'placeholder'   => _x('IČ', 'placeholder', 'woocommerce'),
            'required'  => false,
            'class'     => array('form-row-wide'),
            'clear'     => true
        );
 
        $fields['billing']['billing_dic'] = array(
            'label'     => __('DIČ', 'woocommerce'),
            'placeholder'   => _x('DIČ', 'placeholder', 'woocommerce'),
            'required'  => false,
            'class'     => array('form-row-wide'),
            'clear'     => true
        );

            $fields['billing']['billing_sk_dic'] = array(
               'label'       => __('SK DIČ', $this->plugin_slug),
               'placeholder' => '',
               'required'    => false,
               'class'       => array('form-row-wide'),
               'clear'       => true
            );
       
        return $fields;
    }

    /**
     * Localisation address formats
     *
     * 
     */
    public function localisation_address_formats($address_formats) {
        
        $address_formats['CZ'] .= "\n{billing_ic}\n{billing_dic}";
        $address_formats['SK'] .= "\n{billing_ic}\n{billing_dic}\n{billing_sk_dic}";
        
    return $address_formats;
    
    }
  
    /**
     * Formated address replacement
     *
     * @since 1.0.0  
     */
    public function formatted_address_replacements( $replace, $args ) {
        
        if(!empty($args['billing_ic'])){  
            $replace['{billing_ic}']       = $this->get_args_replacement($args['billing_ic'], __('IČ: ', $this->plugin_slug));
        }else{ $replace['{billing_ic}'] = ''; }  
        if(!empty($args['billing_dic'])){
            $replace['{billing_dic}']           = $this->get_args_replacement($args['billing_dic'], __('DIČ: ', $this->plugin_slug));
        }else{ $replace['{billing_dic}'] = ''; }  
        if(!empty($args['billing_sk_dic'])){  
            $replace['{billing_sk_dic}']         = $this->get_args_replacement($args['billing_sk_dic'], __('SK DIČ: ', $this->plugin_slug));
        }else{ $replace['{billing_sk_dic}'] = ''; }  
        
        if(!empty($args['billing_ic'])){  
            $replace['{billing_ic_upper}'] = strtoupper($this->get_args_replacement($args['billing_ic'], __('IČ: ', $this->plugin_slug)));
        }else{ $replace['{billing_ic}'] = ''; }  
        if(!empty($args['billing_dic'])){  
            $replace['{billing_dic_upper}']     = strtoupper($this->get_args_replacement($args['billing_dic'], __('DIČ: ', $this->plugin_slug)));
        }else{ $replace['{billing_dic}'] = ''; }  
        if(!empty($args['billing_sk_dic'])){  
            $replace['{billing_sk_dic_upper}']   = strtoupper($this->get_args_replacement($args['billing_sk_dic'], __('SK DIČ: ', $this->plugin_slug)));
        }else{ $replace['{billing_sk_dic}'] = ''; }  
        
        return $replace;
    
    }
  
  /**
   * Get args replacements
   *
   * @since 1.0.0  
   */        
  private function get_args_replacement($value, $label){
  
     return (isset( $value ) && $value != '' ) ?  __($label, $this->plugin_slug) .$value : '';
     
  } 
  
    public function order_formatted_billing_address($address, $order) { 
        
        $address['billing_ic']     = $order->billing_ic;
        $address['billing_dic']    = $order->billing_dic;
        $address['billing_sk_dic'] = $order->billing_sk_dic;
          
    return $address;
          
    }


    public function checkout_js(){

        if( is_checkout() ){
            ?>
            <script>
            jQuery( document ).ready(function() {     
                var country = jQuery('body #billing_country').val();
        
                if( country == 'SK' ){
                    jQuery('#billing_sk_dic_field').css('display','block');
                }else{
                    jQuery('#billing_sk_dic_field').css('display','none');
                }  
                    
                jQuery( 'body' ).bind( 'country_to_state_changing', function( event, country, wrapper ){

                    if(country == 'CZ'){
                        jQuery('#billing_sk_dic_field').slideUp( 'slow' );   
                    } else {  
                        if(country == 'SK'){
                            jQuery('#billing_sk_dic_field').slideDown( 'slow' );
                        }else{
                            jQuery('#billing_sk_dic_field').slideUp( 'slow' );
                        } 
                    }
                
                });
            });
            </script>
            <?php
        }

    }
  
    /**
     *
     * Add link to customer email
     *   
     */        
    public function add_link_to_email($order){
    
        global $wpdb;
    
        $pdf_link = get_bloginfo('url').'/wp-content/plugins/woo-fapi/public/invoices/'.$order->id.'.pdf';
        $html = '<a target="_blank" href="'.$pdf_link.'">Faktura ke stažení</a>';
    
        echo $html;
    }
  
  
    /**
     * Get invoice country
     * 
     *      
     * @since 1.0.3
     */
    private function get_invoice_language($order_id){         
        $country = get_post_meta( $order_id, '_billing_country', true );    
            if($country == 'CZ'){
                $language = 'cs';
            }elseif($country == 'SK'){
                $language = 'sk';
            }else{
                $language = 'en';
            }
        return $language;     
    }  
  
    
    /**
     * Save notify
     *
     * @since 1.0.3
     */           
    private function save_notify($info, $text){
  
        $file = FAPIDIR.'notify_log.txt';
        $current = file_get_contents($file);
        $current .= date('D, d M Y H:i:s').$info.PHP_EOL;
        $current .= $text.PHP_EOL;
        file_put_contents($file, $current);
  
    }
  
  
  
           
  
  
  
  /**
   * Get currency
   *
   *
   */           
  private function get_currency(){
  
      global $woocommerce_wpml;
        if(!empty($woocommerce_wpml)){
          if(property_exists($woocommerce_wpml,'multi_currency_support')){
            $data = $woocommerce_wpml->multi_currency_support->get_client_currency();
          }else{
            $data = 'CZK';
          }
        }else{
          $data = 'CZK';
        }
        return $data;
  
  }

    /**
     * Get order statuses
     *
     *
     */           
    public function get_order_statuses(){
        
        if ( function_exists( 'wc_get_order_statuses' ) ){
            
            $wc_get_order_statuses = wc_get_order_statuses();

            return $this->alter_wc_statuses( $wc_get_order_statuses );
        
        }else{
        
            $order_status_terms = get_terms('shop_order_status','hide_empty=0');

            $shop_order_statuses = array();
            if ( ! is_wp_error( $order_status_terms ) ){
                foreach ( $order_status_terms as $term ){
                    $shop_order_statuses[$term->slug] = $term->name;
                }
            }

            return $shop_order_statuses;
       }
    }

    /**
     * Alter order statuses
     *
     * remove wc_prefix from all statuses
     */           
    public function alter_wc_statuses( $array ){
        $new_array = array();
        foreach ( $array as $key => $value ){
            $new_array[substr( $key, 3 )] = $value;
        }

        return $new_array;
    }

    /**
     * Get invoice generate status
     *
     * 
     */
    private function generate_invoice_status( $payment_method, $type = 'regular' ){
        
        if( $type == 'proforma' ){
            $generate = get_option('wc_settings_tab_fapi_proforma_creating_'.$payment_method);
        }else{
            $generate = get_option('wc_settings_tab_fapi_invoice_creating_'.$payment_method);
        }
      
        return $generate;
    }

    /**
     *
     *
     */
    public function pay_invoice( $order_id ){

        //Check order status
        $my_order = new WC_Order($order_id);
        $status   = $my_order->get_status();
       
            //If exist Fapi invoice id, return false
            $invoice_id = get_post_meta( $order_id,'fapi_invoice_id', true );
    
            //Get fapi options
            $fapi_email          = get_option('wc_settings_tab_fapi_email');
            $fapi_password       = get_option('wc_settings_tab_fapi_password');

            $data = array(
              'paid' => true
            );
            //$data = json_encode( $data );
            $fapi = new FAPIClient( $fapi_email, $fapi_password );
        
            //Get invoice
            $response = $fapi->invoice->update( $invoice_id, $data );
            
            $this->save_notify( 'Zaplacení faktury číslo: '.$invoice_id, serialize( $response ) );
            
 
 
    }



}//End class
