<?php
/**
 * Plugin Name:       Woo IC and DIC
 * Plugin URI:        http:/toret.cz
 * Description:       Czech and Slovak VAT checkout fields
 * Version:           1.1.2
 * Author:            Vladislav Musílek
 * Author URI:        http://toret.cz
 * Text Domain:       woo-ico-dic
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'WIDDIR', plugin_dir_path( __FILE__ ) );
define( 'WIDURL', plugin_dir_url( __FILE__ ) );

if ( !in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
	return; // Check if WooCommerce is active

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/
require_once( plugin_dir_path( __FILE__ ) . 'public/class-wid.php' );

register_activation_hook( __FILE__, array( 'Wid', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Wid', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'Wid', 'get_instance' ) );

if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-wid-admin.php' );
	add_action( 'plugins_loaded', array( 'Wid_Admin', 'get_instance' ) );

}
 
