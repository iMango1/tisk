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
 
if ( ! function_exists('it_sidebars') ):
function it_sidebars(){
    
    /****************** Main sidebar *************************/
    register_sidebar(array(
        'name' => 'Primary SideBar',
        'id' => 'sidebar-1',
        'before_widget' => '<li class="widget fx %2$s" data-animate="fadeInRight">',
        'after_widget' => '</div></li>',
        'before_title' => '<h4 class="widget-head">',
        'after_title' => '</h4><div class="widget-content">',
    ));
    
    /****************** Main sidebar *************************/
    register_sidebar(array(
        'name' => 'Secondary SideBar',
        'id' => 'sidebar-2',
        'before_widget' => '<li class="widget fx %2$s" data-animate="fadeInRight">',
        'after_widget' => '</div></li>',
        'before_title' => '<h4 class="widget-head">',
        'after_title' => '</h4><div class="widget-content">',
    ));
    
    /****************** Shop sidebar *************************/
    register_sidebar(array(
        'name' => 'Shop SideBar',
        'id' => 'sidebar-shop',
        'before_widget' => '<li class="widget fx %2$s" data-animate="fadeInRight">',
        'after_widget' => '</div></li>',
        'before_title' => '<h4 class="widget-head">',
        'after_title' => '</h4><div class="widget-content">',
    ));
    
    /****************** bbpress sidebar *************************/
    register_sidebar(array(
        'name' => 'BBPress SideBar',
        'id' => 'sidebar-bbpress',
        'before_widget' => '<li class="widget fx %2$s" data-animate="fadeInRight">',
        'after_widget' => '</div></li>',
        'before_title' => '<h4 class="widget-head">',
        'after_title' => '</h4><div class="widget-content">',
    ));
    
    /****************** buddypress sidebar *************************/
    register_sidebar(array(
        'name' => 'BuddyPress SideBar',
        'id' => 'sidebar-buddypress',
        'before_widget' => '<li class="widget fx %2$s" data-animate="fadeInRight">',
        'after_widget' => '</div></li>',
        'before_title' => '<h4 class="widget-head">',
        'after_title' => '</h4><div class="widget-content">',
    ));
    
    /****************** Downloads sidebar *************************/
    register_sidebar(array(
        'name' => 'Downloads SideBar',
        'id' => 'sidebar-edd',
        'before_widget' => '<li class="widget fx %2$s" data-animate="fadeInRight">',
        'after_widget' => '</div></li>',
        'before_title' => '<h4 class="widget-head">',
        'after_title' => '</h4><div class="widget-content">',
    ));
    
    /****************** Footer Widgets *************************/
    register_sidebar( array(
        'name' => 'Footer Widgets',
        'id' => 'footer-widgets',
        'before_widget' => '<div class="widget %2$s col-md-'.theme_option('footer_columns_number').'">',
        'after_widget' => '</div>',
        'description' => 'Appears in the footer area',
        'before_title' => '<h4 class="block-head">',
        'after_title' => '</h4>'
    ));
    
    /****************** Custom side bar *************************/
    $vall = theme_option('sidebars');
    $arrra = explode('|-|-|-|-|-|', $vall, -1);
    foreach ($arrra as $ke => $va) {  
        register_sidebar(array(
            'name' => $va,
            'id' => 'side-'.$ke,
            'before_widget' => '<li class="widget fx %2$s" data-animate="fadeInRight">',
            'after_widget' => '</div></li>',
            'before_title' => '<h4 class="widget-head">',
            'after_title' => '</h4><div class="widget-content">',
        ));
    }
}
add_action( 'widgets_init', 'it_sidebars',11 );
endif;

// Meta Boxes part
add_action( 'add_meta_boxes', 'add_sidebar_metabox' );
add_action( 'save_post', 'save_sidebar_postdata' );
add_action( 'admin_enqueue_scripts', 'load_meta_box_scripts' );

function load_meta_box_scripts() {
    wp_enqueue_script('popup-js', FRAMEWORK_ASSETS_URI . '/js/popup.js', array('jquery'), '1.0.0', true);
    wp_enqueue_style('popup-css', FRAMEWORK_ASSETS_URI.'/css/popup.css');
} 
/* Adds side bar meta box */
function add_sidebar_metabox() {
    add_meta_box('custom_sidebar', __('Page Layout Mode', 'itrays'), 'custom_sidebar_callback', 'page', 'side');
    add_meta_box('custom_sidebar', __('Page Layout Mode', 'itrays'), 'custom_sidebar_callback', 'post', 'side');
}

function custom_sidebar_callback( $post ){
    global $wp_registered_sidebars;
    $custom = get_post_custom($post->ID);
    $post_type = isset($_GET['post_type']) ? $_GET['post_type'] : (isset($_GET['post']) ? get_post_type($_GET['post']) : null );
    if ( 'page' == $post_type ) {
        $layouts = array(
            'wide' => '100% Width',
            'sidebar-left' => 'Left SideBar',
            'sidebar-right' => 'Right SideBar',
        );
    }else{
        $layouts = array(
            'sidebar-right' => 'Right SideBar',
            'sidebar-left' => 'Left SideBar',
            'full_width' => 'Full Width',
            'wide' => '100% Width',
            'theme' => 'Theme Default Settings',
        );
    }
    $page_layout='';
    if(isset($custom['page_layout'])){
        $page_layout = $custom['page_layout'][0];
    }else{
        if ( 'page' == $post_type ) {
            $page_layout = "full_width";
        }
    }  
    if(isset($custom['custom_sidebar'])){
        $val = $custom['custom_sidebar'][0];
    }else{
        $val = "default";
    }
    wp_nonce_field( plugin_basename( __FILE__ ), 'custom_sidebar_nonce' );
    
    $output = '<p class="sidebar_imgs">';
    $output .= "<input type='radio' name='page_layout'";
    if ( 'page' == $post_type ) {
        if($page_layout == "full_width")
            $output .= " checked='checked'";
        $output .= " class='radio full_width' data-src='".FRAMEWORK_ASSETS_URI . '/images/full_width.png'."' value='full_width' />";
    }
    foreach($layouts as $layout => $assigned){
        $output .= "<input type='radio' name='page_layout'";
        if($layout == $page_layout)
            $output .= " checked='checked'";
        $output .= " class='radio ".$layout."' data-src='".FRAMEWORK_ASSETS_URI."/images/".$layout.".png' value='".$layout."' />";
    }
    $output .= "</p>";

    $output .= "<p class='custom_side'><select name='custom_sidebar'>";
    $output .= "<option";
    if($val == "default")
        $output .= " selected='selected'";
    $output .= " value='default'>".__('default', 'itrays')."</option>";
    foreach($wp_registered_sidebars as $sidebar_id => $sidebar)
    {
        $output .= "<option";
        if($sidebar_id == $val)
            $output .= " selected='selected'";
        $output .= " value='".$sidebar_id."'>".$sidebar['name']."</option>";
    }
    $output .= "</select></p>";
    echo $output;
}

function save_sidebar_postdata( $post_id ){
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
      return;
    if (empty($_POST['custom_sidebar_nonce']))
        return;
    if (!wp_verify_nonce($_POST['custom_sidebar_nonce'], plugin_basename(__FILE__)))
        return;
    if (!current_user_can('edit_page', $post_id))
        return;
    
     $fields = array(
        'custom_sidebar', 'page_layout',
    );
    foreach ($fields as $item) {
        if ( isset($_POST[$item]) && !empty($_POST[$item]) ) {
            update_post_meta($post_id, $item, $_POST[$item]);
        }
    }    
}

function it_sidebar(){
    get_sidebar();
}


