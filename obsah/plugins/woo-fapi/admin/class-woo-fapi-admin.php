<?php
/**
 * @package   Woo Fapi
 * @author    Vladislav Musílek
 * @license   GPL-2.0+
 * @link      Toret.cz
 * @copyright 2014 Toret.cz
 */
class Woo_Fapi_Admin {

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

		$plugin = Woo_Fapi::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_fapi_settings_tab' ), 50 );
        add_action( 'woocommerce_settings_tabs_settings_tab_fapi', array( $this, 'settings_tab' ) );
        add_action( 'woocommerce_update_options_settings_tab_fapi', array( $this, 'update_settings' ) );
        add_action( 'woocommerce_update_options_settings_tab_fapi', array( $this, 'update_payment_method' ) );
        add_action( 'woocommerce_update_options_settings_tab_fapi', array( $this, 'update_project_setting' ) );
    
        add_action( 'woocommerce_admin_field_info_text',  array( $this, 'info_text_field' ) );
        add_action( 'woocommerce_admin_field_project_setting',  array( $this, 'project_setting_field' ) );
    
    
        add_action( 'woocommerce_admin_order_data_after_billing_address', array( $this, 'display_admin_order_meta' ), 10, 1 );
    
        add_filter( 'manage_edit-shop_order_columns', array( $this, 'fapi_thumb_column' ), 99999 );
        add_action( 'manage_shop_order_posts_custom_column', array( $this, 'fapi_thumb_column_display' ), 10, 2 );
    
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

			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), Woo_Fapi::VERSION );
	
	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     1.0.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery' ), Woo_Fapi::VERSION );
		}

	}

    /**
	 *Add Fapi tab settings
	 *
	 * @since    1.0.0
	 */
	public function add_fapi_settings_tab($settings_tabs) {

        $settings_tabs['settings_tab_fapi'] = __( 'Fapi', $this->plugin_slug );
        return $settings_tabs; 
		
	}

    /**
     * Get FAPI setting
     *
     * @since 1.0.0  
     */        
    function get_fapi_settings() {
  
        $gateways = WC()->payment_gateways->payment_gateways();
        $plugin = Woo_Fapi::get_instance();
        $wc_get_order_statuses = $plugin->get_order_statuses();
        $shop_order_status = array( '0' => __( 'Negenerovat', $this->plugin_slug ) );
        $shop_order_status = array_merge( $shop_order_status, $wc_get_order_statuses );

        $it = get_option('wc_settings_tab_fapi_fapi_iterator');
        $iterator = get_option('wc_settings_tab_fapi_fapi_iterator');
        $settings = array();
  
        $settings['section_title'] = array(
            'name'     => __( 'Fapi', $this->plugin_slug ),
            'type'     => 'title',
            'desc'     => '',
            'id'       => 'wc_settings_tab_fapi_section_title'
            );
            
    
        $licence_info = get_option('wooshop-fapi-info');
        if(!empty($licence_info)){
        $settings['licence_key'] = array(
              'name' => __( 'Licenční klíč'.$it, $this->plugin_slug ),
              'type' => 'text',
              'desc' => $licence_info,
              'id'   => 'woo-fapi-licence'
              );
        }else{        
        $settings['licence_key'] = array(
              'name' => __( 'Licenční klíč', $this->plugin_slug ),
              'type' => 'text',
              'desc' => __( 'Licenční klíč jste obdrželi při zakoupení pluginu.', $this->plugin_slug ),
              'id'   => 'woo-fapi-licence'
              );
        }       
    
     
        $settings['email'] = array(
            'name' => __( 'Email uživatele', $this->plugin_slug ),
            'type' => 'text',
            'desc' => __( 'Email uživatele FAPI účtu.', $this->plugin_slug ),
            'id'   => 'wc_settings_tab_fapi_email'
        );
        $settings['password'] = array(
            'name' => __( 'Heslo uživatele', $this->plugin_slug ),
            'type' => 'text',
            'desc' => __( 'Heslo k přihlášení do FAPI.', $this->plugin_slug ),
            'id'   => 'wc_settings_tab_fapi_password'
        );
        $settings['payment_methods'] = array(
            'name' => __( 'Platební metody', $this->plugin_slug ),
            'type' => 'info_text',
            'desc' => __( 'Fapi pro druh platby používá metody, které se mohou lišit od vámi používaných. Proto je nutné spárovat vaše aktivní platební metody s metodami Fapi.', $this->plugin_slug ),
            'id'   => 'wc_settings_tab_fapi_payment_methods'
        );
        $settings['ic_dic'] = array(
            'name' => __( 'Zobrazit IČ a DIČ v objednávkovém formuláři', $this->plugin_slug ),
            'type' => 'checkbox',
            'desc' => __( 'Použít v případě, že vaše šablona, či jiný plugin neobsahují toto nastavení.', $this->plugin_slug ),
            'id'   => 'wc_settings_tab_fapi_ic_dic'
        );  
        $settings['platce'] = array(
            'name' => __( 'Jsem plátce daně', $this->plugin_slug ),
            'type' => 'checkbox',
            'desc' => __( 'Zaškrtněte, pokud jste plátci DPH.', $this->plugin_slug ),
            'id'   => 'wc_settings_tab_fapi_platce'
        ); 
        $settings['save_pdf'] = array(
            'name' => __( 'Ukládat faktury', $this->plugin_slug ),
            'type' => 'checkbox',
            'desc' => __( 'Pokud chcete ukládat faktury a odkazovat na ně v emailech zákazníkům.', $this->plugin_slug ),
            'id'   => 'wc_settings_tab_fapi_save_pdf'
        ); 
        $settings['disable_emails'] = array(
            'name' => __( 'Neodesílat emaily', $this->plugin_slug ),
            'type' => 'checkbox',
            'desc' => __( 'Neodesílat zákazníkům emaily, pokud je odesílá FAPI.', $this->plugin_slug ),
            'id'   => 'wc_settings_tab_fapi_disable_emails'
        );  
            
            
        $settings['project_setting'] = array(
            'name' => __( 'Přiřazení prodejního formuláře', $this->plugin_slug ),
            'type' => 'project_setting',
            'desc' => __( 'Fapi umožňuje přiřadit fakturu k prodejnímu formuláři. Vyberte formulář, ke kterému chcete faktury přiřazovat.', $this->plugin_slug ),
            'id'   => 'wc_settings_tab_fapi_project_setting'
        );   

        $settings[] = array(
            'type' => 'sectionend',
            'id' => 'wc_settings_tab_fapi_invoice_title'
        );

        $settings['invoice_title'] = array(
            'title' => __( 'Vytvoření faktury a odeslání do Fapi', $this->plugin_slug ),
            'type'  => 'title',
            'desc'  => __( 'Vyberte, kdy se budou vytvářet faktury, pro jednotlivé platby', $this->plugin_slug ),
            'id'    => 'wc_settings_tab_fapi_invoice_title'
        );  
            

        foreach($gateways as $gateway){
            $settings['invoice_creating_'.$gateway->id] = array(
                'title'   => $gateway->title,
                'id'      => 'wc_settings_tab_fapi_invoice_creating_'.$gateway->id,
                'default' => 0,
                'type'    => 'select',
                'options' => $shop_order_status
            );
        }

        $settings[] = array(
            'type' => 'sectionend',
            'id' => 'wc_settings_tab_fapi_invoice_title'
        );


        $settings['proforma_title'] = array(
            'title' => __( 'Vytvoření proforma faktury a odeslání do Fapi', $this->plugin_slug ),
            'type'  => 'title',
            'desc'  => __( 'Vyberte, kdy se budou vytvářet proforma faktury, pro jednotlivé platby', $this->plugin_slug ),
            'id'    => 'wc_settings_tab_fapi_proforma_title'
        );  
            

        foreach($gateways as $gateway){
            $settings['proforma_creating_'.$gateway->id] = array(
                'title'   => $gateway->title,
                'id'      => 'wc_settings_tab_fapi_proforma_creating_'.$gateway->id,
                'default' => 0,
                'type'    => 'select',
                'options' => $shop_order_status
            );
        }

        
     
        $settings['section_end'] = array(
            'type' => 'sectionend',
            'id'   => 'wc_settings_tab_fapi_section_end'
        );                                                            
        

        
        return apply_filters( 'wc_settings_tab_fapi_settings', $settings );
    }

    /**
     * Fapi project select
     *
     *
     */           
    public function project_setting_field($value){
  
        $fapi_email     = get_option('wc_settings_tab_fapi_email');
        $fapi_password  = get_option('wc_settings_tab_fapi_password');
        $fapi_form      = get_option('wc_settings_tab_fapi_project_setting');
        ?>
        <tr valign="top">
		  <th scope="row" class="titledesc">
		    <label for="<?php echo esc_attr( $value['id'] ); ?>"><?php echo esc_html( $value['title'] ); ?></label>
		  </th>
	    <td class="forminp">
		    <p><?php echo esc_html( $value['desc'] ); ?></p><br />
    
    
        <?php
     
        if(!empty($fapi_email) && !empty($fapi_password) ){
        $fapi = new FAPIClient($fapi_email, $fapi_password);
    
        try {
            $check_projects = $fapi->form->getAll();
        }catch (Exception $e) {
            var_dump($e);
        } 
    
          foreach($check_projects as $item){ 
          
          ?>
          <span style="display:inline-block;width:400px;"><?php echo $item['name']; ?></span>
          <input type="radio" name="<?php echo $value['id']; ?>" value="<?php echo $item['id']; ?>" <?php if(isset($fapi_form) && $fapi_form == $item['id']){ echo 'checked="checked"'; } ?>>
          <br />
          <br />
        <?php  
          }
     
        }else{
        ?>
        <p><?php _e('Pro načtení údajů o projektech zadejte nejprve vaš přístupové údaje k Fapi',$this->plugin_slug); ?></p>
        <?php
        } 
    ?>
        </td>
        </tr>
        <?php

    }

  /**
   * Update Fapi form
   *
   *      
   */     
  public function update_project_setting(){
  
    if(isset($_POST['wc_settings_tab_fapi_project_setting'])){
        update_option('wc_settings_tab_fapi_project_setting',$_POST['wc_settings_tab_fapi_project_setting']);
    }
    
    if(isset($_POST['woo-fapi-licence'])){
      wooshop_fapi_control_licence($_POST['woo-fapi-licence']); 
    }

  
  } 

  /**
   * Custom setting input
   *
   */       

   public function info_text_field($value){
    $fapi_payment_method = get_option('wc_settings_tab_fapi_payment_methods');
    global $woocommerce;
    $gateways = new WC_Payment_Gateways;
    $available_gateways = WC()->payment_gateways->payment_gateways();
    
    ?>
    
    <tr valign="top">
		  <th scope="row" class="titledesc">
		    <label for="<?php echo esc_attr( $value['id'] ); ?>"><?php echo esc_html( $value['title'] ); ?></label>
		  </th>
	    <td class="forminp">
		    <p><?php echo esc_html( $value['desc'] ); ?></p><br />
        
        <?php
          foreach($available_gateways as $item){ 
          if($item->enabled == 'yes'){
          ?>
          <span style="display:inline-block;width:200px;"><?php echo $item->title; ?></span>
          <select name="<?php echo esc_attr( $value['id'] ); ?>[<?php echo $item->id; ?>]">
            <option value="wire" <?php if(isset($fapi_payment_method[$item->id]) && $fapi_payment_method[$item->id] == 'wire'  ){ echo 'selected="selected"'; } ?> >Bankovní převod</option>
            <option value="credit card" <?php if(isset($fapi_payment_method[$item->id]) && $fapi_payment_method[$item->id] == 'credit card'  ){ echo 'selected="selected"'; } ?> >Kartou</option>
            <option value="cash" <?php if(isset($fapi_payment_method[$item->id]) && $fapi_payment_method[$item->id] == 'cash'  ){ echo 'selected="selected"'; } ?> >Hotově</option>
            <option value="collect on delivery" <?php if(isset($fapi_payment_method[$item->id]) && $fapi_payment_method[$item->id] == 'collect on delivery'  ){ echo 'selected="selected"'; } ?> >Dobírka</option>
            <option value="paypal" <?php if(isset($fapi_payment_method[$item->id]) && $fapi_payment_method[$item->id] == 'paypal'  ){ echo 'selected="selected"'; } ?> >PayPal</option>
            <option value="sms" <?php if(isset($fapi_payment_method[$item->id]) && $fapi_payment_method[$item->id] == 'sms'  ){ echo 'selected="selected"'; } ?> >SMS</option>
          </select>
          <br />
        <?php  
          
          }
          }
        ?>
        
          
	    </td>
	  </tr>
    
    <?php
  }


  /**
   * Update payment methods
   *
   *      
   */     
  public function update_payment_method(){
  
    if(isset($_POST['wc_settings_tab_fapi_payment_methods'])){
    
        update_option('wc_settings_tab_fapi_payment_methods',$_POST['wc_settings_tab_fapi_payment_methods']);
    
    }

  
  } 


  
  /**
   * Settings tab
   *
   * @since 1.0.0  
   */        
  public function settings_tab() {
    woocommerce_admin_fields( $this->get_fapi_settings() );
  }                                                                    

  /**
   * Update settings
   *
   * @since 1.0.0  
   */
  public function update_settings() {
    woocommerce_update_options( $this->get_fapi_settings() );
  }
  
  /**
   *
   * Display ic and dic on order edit page  
   *
   *
   */           
  public function display_admin_order_meta($order){
    $display = get_option('wc_settings_tab_fapi_ic_dic');
    if($display == 'yes'){
      $ic  = get_post_meta($order->id,'_billing_ic',true);
      $dic = get_post_meta($order->id,'_billing_dic',true);
    
      echo '
          <p><strong>'.__('IČ').':</strong> ' . $ic . '<br />
          <strong>'.__('DIČ').':</strong> ' . $dic . '</p>
          ';
    }      
}


  /**
   *
   *
   */        
  public function fapi_thumb_column($columns) {
    $new_columns = array();
    foreach($columns as $key => $item){
      $new_columns[$key] = $item;
      if($key == 'cb'){
         $new_columns['fapi'] = __('FAPI id',$this->plugin_slug);
      }
    }    
    return $new_columns;
  }

  /**
   *
   *
   */
  public function fapi_thumb_column_display($column_name, $post_id){
    global $post;
      if ( $column_name == 'fapi' ) { 
        $field = get_post_meta( $post_id,'fapi_invoice_number',true );
        echo $field;
      }
  }
    
  

	    
  

}//End class
