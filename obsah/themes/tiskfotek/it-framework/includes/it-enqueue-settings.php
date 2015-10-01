<?php
/**
 *
 * IT-RAYS Framework
 *
 * @author IT-RAYS
 * @license Commercial License
 * @link http://www.it-rays.com
 * @copyright 2014 IT-RAYS Themes
 * @package ITFramework
 * @version 1.0.0
 *
 */
 
add_action( 'wp_enqueue_scripts', 'it_enqueue_styles' );
add_action( 'wp_enqueue_scripts', 'it_enqueue_scripts' );


function it_enqueue_styles(){
    wp_enqueue_style( 'bootstrap', THEME_URI . '/assets/css/bootstrap.min.css' );
    wp_enqueue_style( 'assets', THEME_URI . '/assets/css/assets.css' );
    if  ( isset( $_SERVER['HTTP_USER_AGENT'] ) && ( false !== strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) ) && ( false === strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE 10' ) ) ) {
        wp_enqueue_style( 'ieEight', THEME_URI . '/assets/css/ie9.css' );
    }
    if  ( isset( $_SERVER['HTTP_USER_AGENT'] ) && ( false !== strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) ) && ( false === strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE 9' ) ) ) {
        wp_enqueue_style( 'ieEight', THEME_URI . '/assets/css/ie.css' );
    }
    if ( theme_option('body_font') !== 'Open Sans') {
        wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css?family='. theme_option("body_font").':400,300,700,800&amp;amp;subset=latin,latin-ext');
    }else{
        wp_enqueue_style( 'google-font', '//fonts.googleapis.com/css?family=Open+Sans:400,300,700,800&amp;amp;subset=latin,latin-ext' );
    }
    if ( theme_option('menu_font') !== 'Open Sans') {
        wp_enqueue_style( 'menu_font', '//fonts.googleapis.com/css?family='. theme_option("menu_font").':400,300,700,800&amp;amp;subset=latin,latin-ext');
    }
    if ( theme_option('sub_menu_font') !== 'Open Sans') {
        wp_enqueue_style( 'sub_menu_font', '//fonts.googleapis.com/css?family='. theme_option("sub_menu_font").':400,300,700,800&amp;amp;subset=latin,latin-ext');
    }
    if ( theme_option('logo_font') !== 'Open Sans') {
        wp_enqueue_style( 'logo-font', '//fonts.googleapis.com/css?family='. theme_option("logo_font").':400,300,700,800&amp;amp;subset=latin,latin-ext');
    }
    if ( theme_option('slogan_font') !== 'Open Sans') {
        wp_enqueue_style( 'slogan_font', '//fonts.googleapis.com/css?family='. theme_option("slogan_font").':400,300,700,800&amp;amp;subset=latin,latin-ext');
    }
    if ( theme_option('headings_font') !== 'Open Sans') {
        wp_enqueue_style( 'headings_font', '//fonts.googleapis.com/css?family='. theme_option("headings_font").':400,300,700,800&amp;amp;subset=latin,latin-ext');
    }
    if(function_exists('is_bbpress') && is_bbpress()){
        wp_enqueue_style( 'bbpress', THEME_URI . '/assets/css/plugins/bbpress.css' );
    }
    if(function_exists('bp_is_blog_page') && !bp_is_blog_page()){
        wp_enqueue_style( 'buddypress-custom', THEME_URI . '/assets/css/plugins/buddypress.css' );
    }
    
    wp_deregister_style( 'js_composer_front' );    
    if ( vc_active() ) {
        wp_enqueue_style( 'vc-css', THEME_URI . '/assets/css/plugins/js_composer.css' );
    }
    
    wp_enqueue_style( 'skin_css', THEME_URI . '/assets/css/'.theme_option("skin_css").'.css' );
    
    if ( theme_option('colors_css') != 'custom' ) {
        wp_enqueue_style( 'colors_css', THEME_URI . '/assets/css/skins/'.theme_option("colors_css").'.css' );
    }else{
        wp_enqueue_style( 'custom-colors', THEME_URI . '/assets/css/custom-colors.php','1' );
    }                   
    wp_enqueue_style( 'it_font-awesome', THEME_URI. '/assets/css/font-awesome.min.css');
    wp_enqueue_style( 'responsive', THEME_URI . '/assets/css/responsive.css' );
    wp_enqueue_style( 'custom_style', THEME_URI . '/assets/css/style.php','1' );
}
 
function it_enqueue_scripts() {
    
    if  ( isset( $_SERVER['HTTP_USER_AGENT'] ) && ( false !== strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE' ) ) && ( false === strpos( $_SERVER['HTTP_USER_AGENT'], 'MSIE 9' ) ) ) {
        wp_register_script( 'html5', THEME_URI . '/assets/js/html5.js', 'html5' );
        wp_enqueue_script( 'html5');
    }
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) == "1" ){
        wp_enqueue_script( 'comment-reply' );
    }
    wp_enqueue_script( 'jquery', THEME_URI . '/assets/js/jquery.min.js', 'jquery' );
    wp_enqueue_script( 'bootstrap', THEME_URI . '/assets/js/bootstrap/bootstrap.min.js', 'jquery' );
    wp_enqueue_script( 'assets', THEME_URI . '/assets/js/assets.js', array('jquery'),null,false);
    wp_enqueue_script( 'masonry', THEME_URI . '/assets/js/masonry.js', 'masonry',null,true);     
    if(is_rtl()){
         wp_enqueue_script( 'script', THEME_URI . '/assets/js/script-rtl.js', 'script',null,true );
    }else{
         wp_enqueue_script( 'script', THEME_URI . '/assets/js/script.js', 'script',null,true );
    }
    
    
}
