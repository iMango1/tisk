<?php
/**
 * @package   Woo Smart Emailing
 * @author    Vladislav Musílek
 * @license   GPL-2.0+
 * @link      http://toret.cz
 * @copyright 2014 Toret.cz
 *
 * Plugin Name:       Woo Smart Emailing
 * Plugin URI:        http://toret.cz
 * Description:       Smart Emailing pro WooCommerce
 * Version:           1.1.3
 * Author:            Vladislav Musílek
 * Author URI:        http://toret.cz
 * Text Domain:       woo-smart-emailing
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'SMARTDIR', plugin_dir_path( __FILE__ ) );
define( 'SMARTURL', plugin_dir_url( __FILE__ ) );

require_once( plugin_dir_path( __FILE__ ) . 'includes/plugin-update-checker-master/plugin-update-checker.php' );
$MyUpdateChecker = PucFactory::buildUpdateChecker(
    'http://update-server.toret.cz/wp-update-server-master/?action=get_metadata&slug=woo-smart-emailing', 
    __FILE__,
    'woo-smart-emailing' 
);

/*----------------------------------------------------------------------------*
 * Public-Facing Functionality
 *----------------------------------------------------------------------------*/
require_once( plugin_dir_path( __FILE__ ) . 'admin/includes/setting.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/smart-emailing/smart-emailing-library.php' );

require_once( plugin_dir_path( __FILE__ ) . 'public/class-woo-smart-emailing.php' );

register_activation_hook( __FILE__, array( 'Woo_Smart_Emailing', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Woo_Smart_Emailing', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'Woo_Smart_Emailing', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-woo-smart-emailing-admin.php' );
	add_action( 'plugins_loaded', array( 'Woo_Smart_Emailing_Admin', 'get_instance' ) );

}


