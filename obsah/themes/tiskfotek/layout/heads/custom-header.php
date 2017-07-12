<?php
/**
 *
 * EXCEPTION theme Header
 * @version 1.0.0
 *
 */
function re(){
    $before = strstr(theme_option('patterns-imgs'), 'bg');
    $after = substr($before, 0, strpos( $before, '.jpg'));
    return $after;
}
$clsticky = '';
if ( theme_option('sticky_header_on') == '1'){
    $clsticky = 'data-sticky="true"';
} 
$langcode = '';
if ( class_exists( 'SitePress' ) ) {
    $langcode = '-'.ICL_LANGUAGE_CODE;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>" />
        <?php
        if ( ! function_exists( '_wp_render_title_tag' ) ) :
            function theme_slug_render_title() {
        ?>
        <title><?php wp_title( ' | ', true, 'right' ); ?></title>
        <?php
            }
            add_action( 'wp_head', 'theme_slug_render_title' );
        endif;
        ?>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />        
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="<?php echo esc_url(get_stylesheet_uri()); ?>" type="text/css" media="screen" />
        <?php if ( ! isset( $content_width ) ) $content_width = 960; ?>
         <?php wp_head(); ?>
    </head>
    <body <?php body_class('one-page'); ?>>
        <div class="hidden" id="bloginfoname"><?php echo bloginfo( 'name' ); ?></div>
        <div class="pageWrapper <?php echo theme_option('layout'); ?>">
        <div id="headWrapper" class="clearfix one-pg">
                
                <!-- Logo, global navigation menu and search start -->
                <header class="top-head"<?php echo $clsticky; ?>>
                    <div class="container">
                        <div class="row">
                            <div class="logo left">
                                <?php if(theme_option("header_logo_image")){ ?>
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                        <img alt="" src="<?php echo esc_url(theme_option('header_logo_image')); ?>">
                                    </a>
                                <?php } else if(theme_option("site_title".$langcode)){ ?>
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                                        <i class="logo-txt"><?php echo esc_html(theme_option("site_title".$langcode)); ?></i>
                                        <span><?php echo esc_html(theme_option("site_slogan".$langcode)); ?></span>
                                    </a>
                                <?php } else { ?>
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">     
                                        <i class="logo-txt"><?php bloginfo( 'name' ); ?></i>
                                        <span><?php bloginfo('description'); ?></span>
                                    </a>
                               <?php } ?>
                            </div>
                            <div class="right top-menu one-page">
                                <?php
                                    if ( has_nav_menu( 'one-page' ) ) {
                                        it_nav_menu( array( 'theme_location' => 'one-page') ); 
                                    }else{
                                        echo '<span class="menu-message">'.__('Please go to admin panel > Menus > select top- menu and add items to it.','itrays').'</span>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Logo, Global navigation menu and search end -->
                
            </div>
        <div id="contentWrapper">
            
        