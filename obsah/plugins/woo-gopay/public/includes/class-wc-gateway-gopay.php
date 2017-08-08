<?php 

add_action('plugins_loaded', 'woocommerce_gateway_gopay_init', 0);

function woocommerce_gateway_gopay_init(){

  if(!class_exists('WC_Payment_Gateway')) return;
 
  class WC_Gateway_Woo_GoPay extends WC_Payment_Gateway{ 
   
    /**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
   public function __construct(){
      
        
      $licence_status = get_option('wooshop-gopay-licence');
        if ( empty( $licence_status ) ) {
	         return false;
        }
      
      $this->supports = array( 
               'products',
               'pre-orders',
               'subscriptions',
               'subscription_cancellation', 
               'subscription_suspension', 
               'subscription_reactivation',
               'subscription_amount_changes',
               'subscription_date_changes',
               'subscription_payment_method_change' 
          );
               
      
      $this->state = GopayHelper::CREATED;
      //Unique id for gateway
      $this->id = 'gopay';
      //Gateway method title
      $this->medthod_title = 'GoPay';
      //True if gateway has fields shown on checkout
      $this->has_fields = false;
      //Define form field for admin setting
      $this->init_form_fields();
      //Get settings form database
      $this->init_settings();
      
      //Payment method icon
      $this->icon = $this->settings['icon'];
      
      $this->title = $this -> settings['title'];
      
      $this->description = $this -> settings['description'];
      
      $this->goid = $this -> settings['goid'];
      //Secure key form Gopay
      $this->secure_key = $this -> settings['secure_key'];
      //Secure key form Gopay
      //$this -> test = $this -> settings['secure_key'];
      $this->test = $this -> settings['test'];
      
      if($this->test=='yes'){
        GopayConfig::init(GopayConfig::TEST);
      }else{
        GopayConfig::init(GopayConfig::PROD);
      }
      
      $this->enable_for_methods     = $this->get_option( 'enable_for_methods', array() );
      $this->enable_gopay_methods   = $this->get_option( 'enable_gopay_methods', array() );
      $this->display_single         = $this->get_option( 'display_single' );
      $this->enable_gopay_countries = $this->get_option( 'enable_gopay_countries', array() );
      $this->gopay_method_order     = get_option( 'gopay_method_order' );
  
      
    
    //Callback url
    
    //Check response and include response script
    add_action('woocommerce_api_wc_gateway_woo_gopay', array($this, 'check_gopay_response'));  
   
    
      
    //Check Woocommerce verison
    if ( version_compare( WOOCOMMERCE_VERSION, '2.0.0', '>=' ) ) {
      add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options' ) );
    } else {
      add_action( 'woocommerce_update_options_payment_gateways', array($this, 'process_admin_options' ) );
    }
    
      add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'save_methods_order' ) );
      
      
    //Add ajax url
    add_action('wp_head', array( $this, 'gopay_ajaxurl' ) );
    //Clear cart
	  add_action( 'init', array( $this, 'gopay_woocommerce_clear_cart' ) );
    
    //Thankyou page 
    add_action('woocommerce_thankyou_gopay', array( $this, 'thankyou_page' ) );
    //Receipt page
    add_action('woocommerce_receipt_gopay',  array( $this, 'receipt_page' ) );
    //Save cstom data
    add_action( 'woocommerce_checkout_update_order_meta', array( $this, 'save_custom_data' ) );
    
    
    
      
	}
	
  
  /**
   *
   *   Form Fields For Payment Gateway Setting in Admin
   *
   */      
  public function init_form_fields(){

    	$shipping_methods = array();
      $countries        = WC()->countries->get_allowed_countries();
      $payment_methods  = Toret_GoPay_Define::gopay_payment_methods();

    	if ( is_admin() ){
	    	foreach ( WC()->shipping->load_shipping_methods() as $method ) {
		    	$shipping_methods[ $method->id ] = $method->get_title();
	    	}
      }  

      $this -> form_fields = array(
                'enabled' => array(
                    'title' => __('Povolit/Zakázat', 'woocommerce-gopay'),
                    'type' => 'checkbox',
                    'label' => __('Povolit GoPay platební modul.', 'woocommerce-gopay'),
                    'default' => 'no'),
                'title' => array(
                    'title' => __('Titulek:', 'woocommerce-gopay'),
                    'type'=> 'text',
                    'description' => __('Název platební metody. Zobrazí se při výběru platební metody.', 'woocommerce-gopay'),
                    'default' => __('GoPay', 'woocommerce-gopay')),
                'description' => array(
                    'title' => __('Popis:', 'woocommerce-gopay'),
                    'type' => 'textarea',
                    'description' => __('Popis, který uživatel uvidí při výběru platební metody.', 'woocommerce-gopay'),
                    'default' => __('Zaplaťte přes GoPay nebo můžete platit kreditní kartou, pokud nemáte GoPay účet.', 'woocommerce-gopay')),
                'icon' => array(
                    'title' => __('Ikona platební metody:', 'woocommerce-gopay'),
                    'type' => 'text',
                    'description' => __('Url ikony zobrazené při výběru platební metody.', 'woocommerce-gopay'),
                    'default' => WOOGPURL.'public/assets/images/gopay-blue.png'),
                'goid' => array(
                    'title' => __('GoID', 'woocommerce-gopay'),
                    'type' => 'text',
                    'description' => __('GoID e-shopu, které vám bylo přiděleno','woocommerce-gopay')),
                'secure_key' => array(
                    'title' => __('Secure key', 'woocommerce-gopay'),
                    'type' => 'text',
                    'description' =>  __('Secure key e-shopu, které vám bylo přiděleno.', 'woocommerce-gopay')),
                'test' => array(
                    'title' => __('Test mód', 'gopay'),
                    'type' => 'checkbox',
                    'description' =>  __('Aktivace/deaktivace testovacího prostředí GoPay.', 'woocommerce-gopay'),
                    'default' => 'yes'),
                'notify' => array(
                    'title' => __('Notifikace', 'gopay'),
                    'type' => 'text',
                    'default' => esc_url( home_url( '/' ) ).'?gopay=notify',
                    'description' =>  __('URL pro zpracovávání notifikací.', 'woocommerce-gopay')),
                'display_single' => array(
                    'title' => __('Povolit výběr platebních metod', 'woocommerce-gopay'),
                    'type' => 'checkbox',
                    'description' =>  __('Pokud není aktivní, platební metoda bude zvolena karta.', 'woocommerce-gopay'),
                    'default' => 'yes'),    
                'enable_for_methods' => array(
				            'title' 		=> __( 'Povolit způsob dopravy', 'woocommerce-gopay' ),
				            'type' 			=> 'multiselect',
				            'class'			=> 'chosen_select',
				            'css'			=> 'width: 450px;',
				            'default' 		=> '',
				            'description' 	=> __( 'Pokud je platba na dobírku aktivní, zde můžete definovat způsoby dopravy. Pro povolení všech způsobů dopravy, zanechte pole prázdné.', 'woocommerce-gopay' ),
				            'options'		=> $shipping_methods,
				            'desc_tip'      => true,
			          ),
                'enable_gopay_methods' => array(
				            'title' 		=> __( 'Povolit GoPay platební metody', 'woocommerce-gopay' ),
				            'type' 			=> 'multiselect',
				            'class'			=> 'chosen_select',
				            'css'			=> 'width: 450px;',
				            'default' 		=> '',
				            'description' 	=> __( 'Vyberte, které platební metody budou dostupné.', 'woocommerce-gopay' ),
				            'options'		=> $payment_methods,
				            'desc_tip'      => true,
			          ),
                'gopay_method_order' => array(
							      'type' => 'gopay_method_order'
						    ),
                'enable_gopay_countries' => array(
				            'title' 		=> __( 'Povolit GoPay pro země', 'woocommerce-gopay' ),
				            'type' 			=> 'multiselect',
				            'class'			=> 'chosen_select',
				            'css'			=> 'width: 450px;',
				            'default' 		=> '',
				            'description' 	=> __( 'Vyberte, pro které země bude GoPay dostupná.', 'woocommerce-gopay' ),
				            'options'		=> $countries,
				            'desc_tip'      => true,
			          )
        );
    }
  
  
  /**
   * Gopay method order
   * Pořadí platebních metod na pokladně
   * @since 1.4.0 
   */      
  public function generate_gopay_method_order_html(){
    
    ob_start();
    
    $payment_methods = array(
          'eu_gp_u'   => 'Platební karta',
          'eu_psc'    => 'Paysafecard',
          'eu_paypal' => 'PayPal',
          'SUPERCASH' => 'superCash',
          'eu_pr_sms' => 'Premium SMS',
          'cz_mp'     => 'Mobilní platba – M-Platba',
          'cz_kb'     => 'Platba KB ',
          'cz_rb'     => 'Platba RB',
          'cz_mb'     => 'Platba mBank',
          'cz_fb'     => 'Platba Fio Banky',
          'cz_csas'   => 'Platba Česká spořitelna',
          'eu_bank'   => 'Bankovní převod',
          'eu_gp_w'   => 'GoPay účet'
      );
    
    ?>
    <tr valign="top">
			<th scope="row" class="titledesc"><?php _e('Řazení metod', 'woocommerce-gopay'); ?></th>
			<td class="forminp" id="morder">
				<table style="margin-bottom:20px;padding:5px;background:#ffffff;border: solid 1px #cccccc;" class="method-items">
          <thead>
            <tr>
              <th style="4px"><?php _e('Název', 'woocommerce-gopay'); ?></th>
              <th style="4px"><?php _e('Pořadí', 'woocommerce-gopay'); ?></th>
            </tr>
          </thead>
          <tbody id="dom">
            <?php 
              foreach($payment_methods as $key => $item){
            ?>
            <tr>
              <td style="padding:2px;">
                <?php echo $item; ?>
                <input style="width:100px;" type="hidden" name="method_order_key[]" value="<?php echo $key; ?>" />
              </td>
              <td style="padding:2px;"><input type="number" name="method_order[]" min="1" step="1" value="<?php if(!empty($this->gopay_method_order)){ echo $this->gopay_method_order[$key]; }else{ echo '1'; } ?>" /></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>    
			</td>
		</tr>
    <?php
    return ob_get_clean();
  }  
    
  /**
   * Save method order
   *
   * @since  
   */      
  public function save_methods_order(){
  
    if(isset($_POST['method_order'])){
      $array = array();
      foreach( $_POST['method_order'] as $key => $item){
         $array[sanitize_text_field($_POST['method_order_key'][$key])] = sanitize_text_field($_POST['method_order'][$key]);
      }
      update_option( 'gopay_method_order', $array );
    }
  
  }     

   /**
	 * Check If The Gateway Is Available For Use
	 *
	 * @access public
	 * @return bool
	 */
	public function is_available() {
		
    $enable = false;
      
    $enable  = $this->is_available_for_country();  
    
    if($enable == true){ 
        
    if ( ! empty( $this->enable_for_methods ) ) {
    
      $enable = $this->is_available_for_shipping_method();
    
    }
    
    /*
    //When customer want to pay from account
    if ( ! empty( $_GET['pay_for_order'] ) ) {
    
       if ( ! empty( $wp->query_vars['order-pay'] ) ) {
          $order_id = absint( $wp->query_vars['order-pay'] );
          $p_method = get_post_meta($order_id,'_payment_method',true);
          if(!empty($p_method) && $p_method == 'gopay' ){
             return parent::is_available();
          }
       }
    
    }*/


    /*
    //Check WooCommerce Subscriptions is active and control order
    $plugins = get_option('active_plugins');
    if(in_array('woocommerce-subscriptions/woocommerce-subscriptions.php',$plugins)){
    if ( ! empty( $wp->query_vars['order-pay'] ) ) {
      $order_id = absint( $wp->query_vars['order-pay'] );
      if ( WC_Subscriptions_Order::order_contains_subscription( $order_id ) ) {
        return parent::is_available();
      }  
    }  
    }*/

      
			
      if( $enable == false ){
        $enable = $this->is_downloadable_product_in_cart();
      }	
      if( $enable == false ){
        $enable = $this->is_virtual_product_in_cart();
      }
      
        
      }
      
    if( $enable == false ){
        return false;
    }else{
		    return parent::is_available();
    }
    
	}
 
  /**
   * Check if is downloadable product in cart
   *
   * return true or false
   */            
  public function is_downloadable_product_in_cart() {
    
    $has_downloadable_item = false;
    $cart_data = $this->get_cart_content();

    foreach($cart_data as $item){
        
		    $product = new WC_Product( $item['product_id'] );
          if ( $product->is_downloadable() ) {
				    $has_downloadable_item = true;
	        } 

    } 
	  return $has_downloadable_item;
        
  }
  
  /**
   * Check if is virtual product in cart
   *
   * return true or false
   * @since 1.4.0
   */            
  public function is_virtual_product_in_cart() {
   
    $has_virtual = true;
    $cart_data = $this->get_cart_content();
    foreach($cart_data as $item){
        
		    $product = new WC_Product( $item['product_id'] );
          if ( !$product->is_virtual() ) {
				    $has_virtual = false;
	        } 

    } 
	  return $has_virtual;
   
  }
  /**
   * Získáme obsah košíku
   *
   * @since 2.0.0
   */            
  private function get_cart_content() {
   
    if( !empty( WC()->session->cart->cart_contents ) ){
        $cart_data = WC()->session->cart->cart_contents;
    }else{
        $cart_data = WC()->session->cart;
    }
    
    return $cart_data;
   
  }
  /**
   * Check is payment method available for selected country
   *
   * return true or false
   * @since 1.4.0
   */            
  public function is_available_for_country() {
    
    $country = WC()->customer->__get('country');
    
    $available = false;
    
      if ( !empty( $this->enable_gopay_countries ) ) {  
        if( in_array( $country, $this->enable_gopay_countries ) ){ 
          return true; 
        }
      }

    return $available;    
  }
  
  
  /**
   * Check is payment method available for selected shippping
   *
   * return true or false
   */            
  public function is_available_for_shipping_method() {
 
    
      $chosen_shipping_methods = $this->get_choosen_shipping_method();
      
      $check_method = $this->check_method($chosen_shipping_methods);
      if ( ! $check_method ){ return false; }

			//Set found to false
      $found = false;

			foreach ( $this->enable_for_methods as $method_id ) {
				if ( strpos( $check_method, $method_id ) === 0 ) {
					$found = true;
					break;
				}
			}
      //If not found return false, or if found return true
			if ( ! $found ){
				return false;
      }else{
        return true;
      }
  }
  
  
  /**
   * Get choosen shipping method
   *
   * @since 5.1.4  
   */        
  private function get_choosen_shipping_method(){
    
    $chosen_shipping_methods_session = WC()->session->get( 'chosen_shipping_methods' );

			if ( isset( $chosen_shipping_methods_session ) ) {
				$chosen_shipping_methods = array_unique( $chosen_shipping_methods_session );
			} else {
				$chosen_shipping_methods = array();
			}
  
     return $chosen_shipping_methods;
  }
  
  /**
   * Check shipping method
   *
   * @since 5.1.4  
   */ 
  private function check_method($chosen_shipping_methods){
      
      $check_method = false;
      if ( is_page( wc_get_page_id( 'checkout' ) ) && ! empty( $wp->query_vars['order-pay'] ) ) {

				  $order_id = absint( $wp->query_vars['order-pay'] );
				  $order    = new WC_Order( $order_id );
        
       if ( $order->shipping_method ){ $check_method = $order->shipping_method; }
       

			} elseif ( empty( $chosen_shipping_methods ) || sizeof( $chosen_shipping_methods ) > 1 ) {
      
				$check_method = false;
			
      } elseif ( sizeof( $chosen_shipping_methods ) == 1 ) {
			
      	$check_method = $chosen_shipping_methods[0];
			
      }
      
      return $check_method;
  
  }



  /**
   * Display admin info
   * @since 1.1.0
   */              
  public function admin_options(){
        echo '<h3>'.__('GoPay platební brána', 'woocommerce-gopay').'</h3>';
        echo '<p>'.__('GoPay je platební brána pro online platby v České republice.', 'woocommerce-gopay').'</p>';
        echo '<table class="form-table">';
        $this -> generate_settings_html();
        echo '</table>';
 
    }
	
  
  /**
   *
   *  Set status for Gopay   
   *
   */        
	function setState($state) {
		$this->state = $state;
	}
	/**
   *
   *  Set status for Gopay PAID   
   *
   */
	function processPayment() {
		self::setState(GopayHelper::PAID);
		
	}

	/**
   *
   *  Set status for CANCELED   
   *
   */
	function cancelPayment() {
		self::setState(GopayHelper::CANCELED);
		
	}

	/**
   *
   *  Set status for TIMEOUTED   
   *
   */
	function timeoutPayment() {
		self::setState(GopayHelper::TIMEOUTED);
		
	}

	/**
   *
   *  Set status for Gopay AUTHORIZED   
   *
   */
	function autorizePayment() {
		self::setState(GopayHelper::AUTHORIZED);
		
	}

	/**
   *
   *  Set status for REFUNDED   
   *
   */
	function refundPayment() {
		self::setState(GopayHelper::REFUNDED);
		
	}
	

  /**
   * Receipt Page
   * @since 1.1.0   
   */
  function receipt_page($order){
      $this->generate_gopay_payment($order,'');        
  }
    
  /**
   * Generate payment
   * @since 1.1.0
   */        
 	public function generate_gopay_payment($order_id,$defaultPaymentChannel){ 
    
    
    $order = new WC_Order($order_id);
		
    $payment_method = get_post_meta($order->id,'_selected_paymentchannel',true);
    $paymentChannels = array( $payment_method );
    if(empty($defaultPaymentChannel)){
      $defaultPaymentChannel = $payment_method;
    }
    
    
    $p1 = $payment_method;
		$p2 = null;
		$p3 = null;
		$p4 = null;
    
    
    /**
     * Set language and currency for gateway
     * With WMPL and Polylang compatibility     
     *
     */ 
    $curency_lang_data = array(); 
    $curency_lang_data['currency'] = $this->get_eshop_currency();
    $curency_lang_data['lang']     = $this->get_eshop_lang(); 
    $country = Toret_GoPay_Define::set_order_country( $order->billing_country );
    $price = $this->get_gopay_payment_price( $order_id, $curency_lang_data );

    Toret_GoPay_Log::save( 'Cena objednávky '.$order_id.': '.$price , 'n', 'payment', 'Průběh platby' ); 
    
    //Save order currency
    update_post_meta( $order->id,'gopay_order_currency', $curency_lang_data['currency'] );
    update_post_meta( $order->id,'gopay_order_lang', $curency_lang_data['lang'] );
    update_post_meta( $order->id,'gopay_price', $price ); 
    
    
    
    /*-----------------------------------------------------------------
    /*
    /*  WooCommerce Subsribtions
    /*
    /*-----------------------------------------------------------------*/    
    
    $active_plugins = get_option('active_plugins');
    if(in_array('woocommerce-subscriptions/woocommerce-subscriptions.php', $active_plugins)){
      $subs = true;
    }else{
      $subs = false;
    }    
    
    if ( $subs == true && WC_Subscriptions_Order::order_contains_subscription( $order_id ) ) {
    
      $date = $this->get_subscription_date();
      $recurrenceCycle = $this->get_recurrence_cycle();
      $interval = WC_Subscriptions_Order::get_subscription_interval( $order );
    
      try {
    
        $paymentSessionId = GopaySoap::createRecurrentPayment(
                          (float)$this->goid,
										  		$order->billing_first_name.' '.$order->billing_last_name,
										 		 (int)$price,
												  $curency_lang_data['currency'],
												  $order->id,
												  GOPAY_CALLBACK_URL,
												  GOPAY_CALLBACK_URL,
										  		$date,//$recurrenceDateTo
										  		$recurrenceCycle,
										  		(int)$interval,//$recurrencePeriod
                          $paymentChannels,
										  		$defaultPaymentChannel,
										  		$this->secure_key,
                          $order->billing_first_name,
												  $order->billing_last_name,
												  $order->billing_city,
												  $order->billing_address_1,
												  $order->billing_zip,
                          $country,
												  $order->billing_email,
												  $order->billing_phone,
												  $p1,
												  $p2,
												  $p3,
												  $p4,
												  $curency_lang_data['lang']
                        );
    
                         update_option('gopay_test',$paymentChannels);
                         update_option('gopay_lang',$curency_lang_data['currency']);
    
      } catch (Exception $e) {
    
        Toret_GoPay_Log::save( 'Chyba vytvoření opakované platby' , 'n', 'payment', 'Objednávka: '.$order_id ); 
        Toret_GoPay_Log::save( serialize( $e ) , 'e', 'payment', 'Objednávka: '.$order_id );     
            
			  /**
			   *  Exeption rediretion
			   */ 
        $location = $order->get_checkout_order_received_url();
          $url_args = array(
            'order-pay'        => $order->id,
            'key'          => $order->order_key,
            'error-info'  => 'selhalo-vytvoreni-opakovane-platby',
            'sessionState' => GopayHelper::FAILED
          );
        $location = add_query_arg($url_args,$location); 
			  header("Location: " . $location );
		  	exit;
		  }   
    
    }else{

      /*-----------------------------------------------------------------
      /*
      /*  WooCommerce Normal Payment
      /*
      /*-----------------------------------------------------------------*/ 

      try {       

			
        /**
         *
         *  Create Payment for gopay_soap.php       
         *
         */                    
        $paymentSessionId = GopaySoap::createPayment(
                        (float)$this->goid,//GoId
                        $order->billing_first_name.' '.$order->billing_last_name,
										 		(int)$price,
												$curency_lang_data['currency'],
												$order->id,
												GOPAY_CALLBACK_URL,
												GOPAY_CALLBACK_URL,
												$paymentChannels,
												$defaultPaymentChannel,
												$this->secure_key,
                        $order->billing_first_name,
												$order->billing_last_name,
												$order->billing_city,
												$order->billing_address_1,
												$order->billing_zip,
                        $country,
												$order->billing_email,
												$order->billing_phone,
												$p1,
												$p2,
												$p3,
												$p4,
                        $curency_lang_data['lang']//LANG
                        );

        update_option( 'gopay_test', $paymentChannels );
        update_option( 'gopay_lang', $curency_lang_data['currency'] );
		
		  } catch (Exception $e) {
    
        Toret_GoPay_Log::save( 'Chyba vytvoření platby' , 'e', 'payment', 'Objednávka: '.$order_id );  
        Toret_GoPay_Log::save( serialize( $e ) , 'e', 'payment', 'Objednávka: '.$order_id );  
            
			  /**
			   *  Exeption rediretion
			   */ 
        $location = $order->get_checkout_order_received_url();
          $url_args = array(
            'order-pay'     => $order->id,
            'key'           => $order->order_key,
            'error-info'    => 'selhalo-vytvoreni-platby',
            'sessionState'  => GopayHelper::FAILED
          );
        $location = add_query_arg($url_args,$location); 
			  header("Location: " . $location );
			  exit;
		  }   


    }

		  /**
		   * If success - create paymentSessionId
		   */
		  $this->paymentSessionId = $paymentSessionId;
      update_post_meta( $order->id, '_paymentSessionId', esc_attr($paymentSessionId));
    
    
		  $encryptedSignature = GopayHelper::encrypt(				
                GopayHelper::hash( GopayHelper::concatPaymentSession( (float)$this->goid, (float)$paymentSessionId, $this->secure_key ) ), 
                $this->secure_key );	
      
      update_post_meta($order->id,'order_encryptedSignature',$encryptedSignature);                              		
	
  
      /*
		   * Presmerovani na platebni branu GoPay s predvybranou platebni metodou($defaultPaymentChannel)
		   */
		  header( "Location: " . GopayConfig::fullIntegrationURL() . 
      "?sessionInfo.targetGoId=" . $this->goid . 
      "&sessionInfo.paymentSessionId=" . $paymentSessionId . 
      "&sessionInfo.encryptedSignature=" . $encryptedSignature  
      );
		
      exit;
   
    }
    
    
  	/**
     * Process the payment and return the result
     * 
     * @since 1.0.0
     */
     
    function process_payment($order_id){
  
        $order = new WC_Order($order_id);
        
        // Reduce stock levels
		    $order->reduce_order_stock();
        
        return array(
            'result'    => 'success', 
            'redirect'  => add_query_arg(
                                          'order-pay',
                                          $order->id, 
                                          add_query_arg(
                                                        'key', 
                                                        $order->order_key, 
                                                        $order->get_checkout_order_received_url()   
                                          )
                          )            
        );
        
                                                 
    }
 
    
 
 	
   
   
   
  /**
   * Přidání zobrazení výběru platebních metod v popisu platební metody
   * 
   * 1.4.0
   */        
  public function payment_fields() {
		
    if ( $description = $this->get_description() ) {
			echo wpautop( wptexturize( $description ) );
		}

    echo $this->gopay_payment_channel();

		if ( $this->supports( 'default_credit_card_form' ) ) {
			$this->credit_card_form();
		}

	}
  
  /**
   * Zobrazení výběru platebních metod v popisu platební metody
   * 
   * @sincce 1.4.0
   */     
  public function gopay_payment_channel(){
   
    $payment_methods = Toret_GoPay_Define::get_gopay_payment_methods( $this->gopay_method_order );
    $html = '';
   
    $enable_gopay_methods = apply_filters( 'gopay_checkout_enabled_methods', $this-> enable_gopay_methods );

    if(!empty($this->display_single) && $this->display_single == 'yes' ){
    $i = 1;
    foreach($payment_methods as $key => $item){
      if(in_array($key,$enable_gopay_methods)){
        if($i == 1){ $checked = 'checked="checked"'; }else{ $checked = ''; }
        if($key == 'eu_gp_u'){
          $html .= '
         <div class="gopay_select">
          <input class="gopay_select_input" name="paymentchannel" type="radio" '.$checked.' id="eu_gp_kb" value="eu_gp_kb">
          <img src="'.WOOGPURL.'public/assets/images/eu_gp_u.png" /> 
          <span>'.$item.'</span>
         </div>
        ';  
        }else{      
        $html .= '
         <div class="gopay_select">
          <input class="gopay_select_input" name="paymentchannel" type="radio" '.$checked.' id="'.$key.'" value="'.$key.'">
          <img src="'.WOOGPURL.'public/assets/images/'.$key.'.png" /> 
          <span>'.$item.'</span>
         </div>
        ';
        }
       $i++;
      }
      
     }
   }else{
       $html .= '
         <div class="gopay_select" style="display:none!important;">
          <input class="gopay_select_input" name="paymentchannel" type="radio" checked="checked" id="'.$this->card_system.'" value="'.$this->card_system.'">
         </div>
        ';
   }
   
   
   
   
   return $html;
   
   }
  
  
  /**
   * Get order price for GoPay Payment Gateway
   * with Multi Currency Switcher compatibility
   *
   * @ since 1.4.0
   */
  private function get_gopay_payment_price( $order_id, $curency_lang_data ){
    
    $active_plugins = get_option('active_plugins');
    
    //Fix pro Zaokrouhlení objednávky plugin
    if(in_array('woocommerce-currency-switcher/index.php', $active_plugins)){
    
      $price = $this->get_woocs_price( $curency_lang_data );
    
    }else{
      
      if( in_array( 'toret-zaokrouhleni-objednavky.php', $active_plugins ) ){
        $sub_price = round( $this->get_order_total() );
      }else{
        $sub_price = $this->get_order_total();
      }

      $price = (int)($sub_price*100);
    
    }      

      //Return price
      return $price;

  }          

  /**
   * Get price from WOOCS plugin
   * 
   * @since 2.0.0
   */
  private function get_woocs_price( $curency_lang_data ){
    
    $woocs = get_option('woocs');
    
      $rate      = $woocs[$curency_lang_data['currency']]['rate'];
      $sub_price = $this->get_order_total();
      
      if( !empty( $rate ) ){ 
          $rate_price = $sub_price * $rate; 
      }else{ 
          $rate_price = $sub_price; 
      }
    
      $decimals   = get_option( 'woocommerce_price_num_decimals' );
      $rate_price = round( $rate_price, $decimals ); 
      $price      = (int)( $rate_price*100 );
       
      //Return price
      return $price;

  }                 
   
   
  /**
   * Define Ajax url for frontend
   * @since 1.1.0   
   */ 
  public function gopay_ajaxurl() {
    ?>
      <script type="text/javascript">
        var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
      </script>
    <?php
  } 
  

  /**
	 * Clear cart after return from GoPay 
	 * @since    1.4.0
	 */
  public function gopay_woocommerce_clear_cart() {
    
    if ( isset( $_GET['sessionState'] ) && $_GET['sessionState'] == 'CANCELED'  ) { 
    
      if(!empty(WC()->session->cart)){
        unset( WC()->session->cart ); 
      }
    
    }

  }

  /**
   * Check for valid gopay server callback and include response
   * @since 1.4.0   
   */
  public function check_gopay_response(){
    
    if( !empty( $_GET['gopay'] ) ){
      
      if($_GET['gopay']=='response'){
      
  	    require_once( WOOGPDIR.'/public/views/response.php' );
     
      }else{
	      header("HTTP/1.1 500 Internal Server Error");
	      exit(0);
      } 
    
    } 
  }


  /**
   * Display Result Message on return page 
   * @since 1.4.0         
   */
  public function thankyou_page() {
	 //$order = new WC_Order($_GET['order-received']);
	   
     
     echo	'
     <table>
				<tr>
					<td>
						<p>';
								//if (! isset($_GET["sessionSubState"])) $_GET["sessionSubState"] = null;
								//echo GopayHelper::getResultMessage($_GET["sessionState"], $_GET["sessionSubState"]);

				echo	
            '</p>
					</td>
				</tr>
			</table>';

 	}                   
                      
  
  /**
   * Save custom order data
   * Save payment channel  
   *
   * @since 1.4.0
   */
  public function save_custom_data( $order_id ){
  
    if( !empty( $_POST['paymentchannel'] ) ){
        $selected_paymentchannel = $_POST['paymentchannel'];
        update_post_meta( $order_id, '_selected_paymentchannel', $selected_paymentchannel );
    }
  
  }   
  
  
  /**
   * Get WPML selected currency
   * Check if 
   *   
   * @since 1.0.0  
   */         
  private function get_wpml_currency(){
   
      global $woocommerce_wpml;
        if(!empty($woocommerce_wpml)){
          if(property_exists($woocommerce_wpml,'multi_currency_support')){
            $selected_currency = $woocommerce_wpml->multi_currency_support->get_client_currency();
          }else{
            $selected_currency = null;
          }
        }else{
          $selected_currency = null;
        }
      
      return $selected_currency;
      
  } 
  
  /**
   * Get eshop currency
   * TODO: zkontrolovat a zkusit nahradit za get_order_currency()
   *
   * @since 1.5.6  
   */        
  private function get_eshop_currency(){
     //Get WPML Currency
     $selected_wpml_currency = $this->get_wpml_currency();
     if($selected_wpml_currency != null){
        $currency = $selected_wpml_currency;
     }else{
        $currency = get_woocommerce_currency();
     }
     
     return $currency;
     
  } 
   
  
  /**
   * Get eshop language
   *
   * @since 1.5.6
   */           
  private function get_eshop_lang(){
    
    if ( function_exists('icl_object_id') ) {
       $lang = ICL_LANGUAGE_CODE;
    }else{
       $lang = get_locale();
    }
    
    
      if( $lang == 'cs_CZ'){
        $data_lang     = 'CZ';
      }elseif( $lang == 'sk_SK'){
        $data_lang     = 'SK';
      }elseif( $lang == 'cs'){
        $data_lang     = 'CZ';
      }else{
        $data_lang     = 'EN';
      }
    
    return $data_lang;
  
  }   



  /**
   * Získání data pro předplatné
   *  
   *   
   * @since 2.0.0  
   */         
  private function get_subscription_date(){
    //Lenght
    $lenght = WC_Subscriptions_Order::get_subscription_length( $order );
    if( $lenght == 0 ){ $lenght = 300; }
    $period = WC_Subscriptions_Order::get_subscription_period( $order );
    $today = date('Y-m-d');
    switch( strtolower( $period ) ) {
      case 'day':
        $mod_date = strtotime($today.'+ '.$lenght.' days');
        break;
      case 'week':
        $weeks = $lenght * 7;
        $mod_date = strtotime($today.'+ '.$weeks.' days');        
        break;
      case 'year':
        $mod_date = strtotime($today.'+ '.$lenght.' months');
        break;
      case 'month':
      default:
        $mod_date = strtotime($today.'+ '.$lenght.' months');
        break;
    }
    
    $date = date( 'Y-m-d', $mod_date );

    return $date;
  }   

  /**
   * Získání cyklu pro předplatné
   *  
   *   
   * @since 2.0.0  
   */         
  private function get_recurrence_cycle(){
   
    $period = WC_Subscriptions_Order::get_subscription_period( $order );
   
    switch( strtolower( $period ) ) {
      case 'day':
        $recurrenceCycle = 'DAY';
        break;
      case 'week':
        $recurrenceCycle = 'WEEK';
        break;
      case 'year':
        $recurrenceCycle = 'MONTH';
        break;
      case 'month':
      default:
        $recurrenceCycle = 'MONTH';
        break;
    }
    
    return $recurrenceCycle;
  }   
   
   
   
      
}//Class end
    
    
   /**
    *  Add the Gateway to WooCommerce
    *  @since 1.1.0     
    */
                 
  function woocommerce_add_woo_gateway_gopay($methods) {
        $methods[] = 'WC_Gateway_Woo_GoPay';
        return $methods;
    }
 
    //Woocommerce payment gateways filter
    add_filter('woocommerce_payment_gateways', 'woocommerce_add_woo_gateway_gopay' );
    
    
}//woocommerce_gateway_gopay_init end

