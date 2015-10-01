<?php
/**
 * theme options framework
 * 
 * @package IT-RAYS
 * @since 1.0
 */
 
 // If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

function itframework_init() {

    //  If user can't edit theme options, exit
    if ( !current_user_can( 'edit_theme_options' ) )
        return;

    // Loads the required Options Framework classes.
    require_once(  FRAMEWORK_DIR . '/classes/it-framework.class.php' );
    require_once(  FRAMEWORK_DIR . '/classes/it-options-sanitization.php' );
    
}
add_action( 'init', 'itframework_init', 20 );

if ( ! function_exists( 'theme_option' ) ){
    function theme_option( $option ) {
        $options = get_option( 'theme_options' );
        if ( isset( $options[$option] ) )
            return $options[$option];
        else
            return false;
    }
}
