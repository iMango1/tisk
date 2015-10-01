<?php
global $vsechny_nahrane_fotky;
$array = array(
    "foo" => "bar",
    "bar" => "foo",
);

/**
 *
 * IT-RAYS Framework
 *
 * @author IT-RAYS
 * @license Commercial License
 * @link http://www.it-rays.com
 * @copyright 2014 IT-RAYS Themes
 * @package IT-RAYS-Framework
 * @version 1.0.0
 *
 */
locate_template( 'it-framework/init.php', true );

add_action( 'init', 'my_setcookie' );
function my_setcookie() {
    global $vsechny_nahrane_fotky;

   setcookie( 'nahrane-fotky', serialize($vsechny_nahrane_fotky) , time() + 3600 * 8, COOKIEPATH, COOKIE_DOMAIN );
}

add_action( 'wp_login_failed', 'my_front_end_login_fail' );  // hook failed login

function my_front_end_login_fail( $username ) {
   $referrer = $_SERVER['HTTP_REFERER'];  // where did the post submission come from?
   // if there's a valid referrer, and it's not the default log-in screen
   if ( !empty($referrer) && !strstr($referrer,'wp-login') && !strstr($referrer,'wp-admin') ) {
      wp_redirect( $referrer . '?login=failed' );  // let's append some information (login=failed) to the URL for the theme to use
      exit;
   }
}
//Deklarace IČ A DIČ
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
// Funkce pro deklaraci a přidaní IČ A DIČ do woocomerce 
function custom_override_checkout_fields( $fields ) {
     $fields['billing']['billing_ico'] = array(
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
    
    $fields['shipping']['shipping_ico'] = array(
    'label'     => __('IČ', 'woocommerce'),
    'placeholder'   => _x('IČ', 'placeholder', 'woocommerce'),
    'required'  => false,
    'class'     => array('form-row-wide'),
    'clear'     => true
     );
 
     $fields['shipping']['shipping_dic'] = array(
    'label'     => __('DIČ', 'woocommerce'),
    'placeholder'   => _x('DIČ', 'placeholder', 'woocommerce'),
    'required'  => false,
    'class'     => array('form-row-wide'),
    'clear'     => true
     );
        
     return $fields;
}
//Deklarace a funkce pro změny pořadí poloí v košíku, aby bylo ič a dič po názvu firmy. Nejdřív seřazení pro fakturu a pak pro případnou doručovací(jinou) adresu.
add_filter("woocommerce_checkout_fields", "order_fields");
function order_fields($fields) {

    $order = array(
        "billing_first_name", 
        "billing_last_name", 
        "billing_company",
        "billing_ico",
        "billing_dic",
        "billing_address_1", 
        "billing_address_2", 
        "billing_postcode", 
        "billing_country", 
        "billing_email", 
        "billing_phone"

    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["billing"][$field];
    }

    $fields["billing"] = $ordered_fields;
/*   
    $order = array(
        "shipping_first_name", 
        "shipping_last_name", 
        "shipping_company",
        "shipping_ico",
        "shipping_dic",
        "shipping_address_1", 
        "shipping_address_2", 
        "shipping_postcode", 
        "shipping_country", 
        "shipping_email", 
        "shipping_phone"

    );
    foreach($order as $field)
    {
        $ordered_fields[$field] = $fields["shipping"][$field];
    }

    $fields["shipping"] = $ordered_fields; */
    return $fields;

}


