<?php
/**
 * Plugin Name:       WooCommerce GoPay
 * Plugin URI:        http://toret.cz
 * Description:       Platební brána GoPay pro WooCommerce
 * Version:           2.0.1
 * Author:            Vladislav Musílek
 * Author URI:        http://toret.cz
 * Text Domain:       woocommerce-gopay
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */


      
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

//Define
define( 'WOOGPLANG', substr(get_bloginfo('language'),0,2) );
define( 'WOOGPDIR', plugin_dir_path( __FILE__ ) );
define( 'WOOGPURL', plugin_dir_url( __FILE__ ) );
define( 'WOOGPVERSION', '2.0.0' );

define('GOPAY_CALLBACK_URL', get_site_url().'?wc-api=WC_Gateway_Woo_GoPay&gopay=response');

require_once( plugin_dir_path( __FILE__ ) . 'includes/plugin-update-checker-master/plugin-update-checker.php' );
$MyUpdateChecker = PucFactory::buildUpdateChecker(
    'http://update-server.toret.cz/wp-update-server-master/?action=get_metadata&slug=woo-gopay', 
    __FILE__,
    'woo-gopay' 
);

/**
 * Include GoPay files
 *
 */
require_once( plugin_dir_path( __FILE__ ) . 'includes/api/country_code.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/api/gopay_helper.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/api/gopay_soap.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/api/gopay_config.php');
   
/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/
require_once( plugin_dir_path( __FILE__ ) . 'includes/define.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/countries.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/helpers.php' );
require_once( plugin_dir_path( __FILE__ ) . 'admin/includes/setting.php' );
require_once( plugin_dir_path( __FILE__ ) . 'public/includes/class-wc-gateway-gopay.php');
require_once( plugin_dir_path( __FILE__ ) . 'public/class-woocommerce-gopay.php' );

  
register_activation_hook( __FILE__, array( 'Woocommerce_Gopay', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Woocommerce_Gopay', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'Woocommerce_Gopay', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-woocommerce-gopay-admin.php' );
	add_action( 'plugins_loaded', array( 'Woocommerce_Gopay_Admin', 'get_instance' ) );

}


/**
 * Custom endpoint
 *
 */  
add_action( 'init', 'makeplugins_add_json_endpoint' ); 
function makeplugins_add_json_endpoint() {
    add_rewrite_endpoint( 'gopay', EP_ALL );
}


/**
 *  Add template redirect
 *
 */
add_action( 'template_redirect', 'makeplugins_json_template_redirect' );   
function makeplugins_json_template_redirect() {
    global $wp_query;
 
    if ( ! isset( $wp_query->query_vars['gopay'] ) )
        return;
 
    if($wp_query->query_vars['gopay'] == 'notify'){
        include plugin_dir_path( __FILE__ ) . 'public/views/notify.php';
    }


    exit;
}

