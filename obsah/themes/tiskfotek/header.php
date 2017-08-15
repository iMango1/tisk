<?php
/**
 *
 * EXCEPTION theme Header
 * @version 1.0.0
 *
 */		

?>

<!DOCTYPE html>
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
        <link rel="profile" href="https://gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />        
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="stylesheet" href="<?php echo esc_url(get_stylesheet_uri()); ?>" type="text/css" media="screen" />
        <?php if ( ! isset( $content_width ) ) $content_width = 960; ?>
        <?php it_title_css(); ?>
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/chosen.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/nahrani/css/style.css">
        <?php wp_head(); ?> 

        <!-- blueimp Gallery styles -->
        <link rel="stylesheet" href="https://blueimp.github.io/Gallery/css/blueimp-gallery.min.css">
        <!-- CSS to style the file input field as button and adjust the Bootstrap progress bars -->
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/nahrani/css/jquery.fileupload.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/nahrani/css/jquery.fileupload-ui.css">
        <!-- CSS adjustments for browsers with JavaScript disabled -->
        <noscript><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/nahrani/css/jquery.fileupload-noscript.css"></noscript>
        <noscript><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/nahrani/css/jquery.fileupload-ui-noscript.css"></noscript>
        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/chosen.jquery.min.js"></script>

    </head>
    <body <?php body_class(); ?>>
        <?php if ( theme_option('page-loader') ) : ?>
            <!-- site preloader start -->
            <div class="page-loader">
                <div class="loader-in"></div>
            </div>
            <!-- site preloader end -->
        <?php endif; ?>
        <div class="pageWrapper <?php echo theme_option('layout'); ?>">
        <?php it_theme_header(); ?>
        <div id="contentWrapper">
            
        