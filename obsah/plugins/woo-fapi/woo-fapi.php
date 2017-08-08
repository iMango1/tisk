<?php
/**
 * @package   Woo Fapi
 * @author    Vladislav Musílek
 * @license   GPL-2.0+
 * @link      Toret.cz
 * @copyright 2014 Toret.cz                             
 *
 * @wordpress-plugin
 * Plugin Name:       Woo Fapi
 * Plugin URI:        http://toret.cz/woocommerce-pluginy/woo-fapi/
 * Description:       Propojení FAPI a Woocommerce
 * Version:           1.0.8
 * Author:            Vladislav Musílek
 * Author URI:        http://toret.cz
 * Text Domain:       woo-fapi
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
define( 'FAPIDIR', plugin_dir_path( __FILE__ ) );
define( 'FAPIURL', plugin_dir_url( __FILE__ ) );


require_once( plugin_dir_path( __FILE__ ) . 'includes/plugin-update-checker-master/plugin-update-checker.php' );
$MyUpdateChecker = PucFactory::buildUpdateChecker(
    'http://update-server.toret.cz/wp-update-server-master/?action=get_metadata&slug=woo-fapi', 
    __FILE__,
    'woo-fapi' 
);

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . 'admin/includes/setting.php' );

require_once( plugin_dir_path( __FILE__ ) . 'classes/FAPIClient.php' );
require_once( plugin_dir_path( __FILE__ ) . 'classes/Fapi.php' );
require_once( plugin_dir_path( __FILE__ ) . 'classes/Fapi_Wc.php' );
require_once( plugin_dir_path( __FILE__ ) . 'public/class-woo-fapi.php' );

register_activation_hook( __FILE__, array( 'Woo_Fapi', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Woo_Fapi', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'Woo_Fapi', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-woo-fapi-admin.php' );
	add_action( 'plugins_loaded', array( 'Woo_Fapi_Admin', 'get_instance' ) );

}

/**
 * Custom endpoint
 *
 */  
add_action( 'init', 'fapi_makeplugins_add_json_endpoint' ); 
function fapi_makeplugins_add_json_endpoint() {
    add_rewrite_endpoint( 'fapi', EP_ALL );
}


/**
 *  Add template redirect
 *
 */
add_action( 'template_redirect', 'fapi_makeplugins_json_template_redirect' );   
function fapi_makeplugins_json_template_redirect() {
    global $wp_query;
 
    if ( ! isset( $wp_query->query_vars['fapi'] ) )
        return;
 
    include dirname( __FILE__ ) . '/public/views/notify.php';
    exit;
}


/**
 * Write log info
 *
 *
 */           
function fapi_log_info($info, $log){
   
    $file = FAPIDIR.'notify_log.txt';
    $current = file_get_contents($file);
    $current .= date('D, d M Y H:i:s').' '.$info.PHP_EOL;
    $current .= $log.PHP_EOL;
    file_put_contents($file, $current);
      
}