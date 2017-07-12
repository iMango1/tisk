<?php 
header("Content-type: text/css");
define('WP_USE_THEMES', false);

function wp_path() {
    if (strstr($_SERVER["SCRIPT_FILENAME"], "/wp-content/")) {
        return preg_replace("/\/wp-content\/.*/", "", $_SERVER["SCRIPT_FILENAME"]);
    }
    return preg_replace("/\/[^\/]+?\/themes\/.*/", "", $_SERVER["SCRIPT_FILENAME"]);
}

require wp_path() . "/wp-load.php";

function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}
$hexStr = theme_option("sticky_bg_color");
$rgb = hex2RGB($hexStr, true, ','); 

$hexStr2 = theme_option("soon_overlay");
$rgb2 = hex2RGB($hexStr2, true, ',');
?>
body{
    <?php if ( theme_option('body_font')) { ?>
        font-family:"<?php echo theme_option('body_font'); ?>", Arial, sans-serif;
    <?php } ?>
    <?php if ( theme_option('body_font_size')) { ?>
        font-size:<?php echo esc_attr(theme_option('body_font_size')); ?>px;
    <?php } ?>
    <?php if ( theme_option('body_font_weight')) { ?>
        font-weight:<?php echo theme_option('body_font_weight'); ?>;
    <?php } ?>
    <?php if ( theme_option('body_line_height')) { ?>
        line-height:<?php echo esc_attr(theme_option('body_line_height')); ?>px;
    <?php } ?>
}
<?php if ( theme_option('body_font_size')) { ?>
        p{
            font-size:<?php echo esc_attr(theme_option('body_font_size')); ?>px;
        }
        
    <?php } ?>
.top-nav > ul li a{
    <?php if ( theme_option('menu_font')) { ?>
        font-family:"<?php echo theme_option('menu_font'); ?>", Arial, sans-serif;
    <?php } ?>
    <?php if ( theme_option('menu_font_size')) { ?>
        font-size:<?php echo esc_attr(theme_option('menu_font_size')); ?>px;
    <?php } ?>
    <?php if ( theme_option('menu_font_weight')) { ?>
        font-weight:<?php echo theme_option('menu_font_weight'); ?>;
    <?php } ?>
    <?php if ( theme_option('menu_line_height')) { ?>
        line-height:<?php echo esc_attr(theme_option('menu_line_height')); ?>px;
    <?php } ?>
}
.top-nav li li a{
    <?php if ( theme_option('sub_menu_font')) { ?>
        font-family:"<?php echo theme_option('sub_menu_font'); ?>", Arial, sans-serif;
    <?php } ?>
    <?php if ( theme_option('sub_menu_font_size')) { ?>
        font-size:<?php echo esc_attr(theme_option('sub_menu_font_size')); ?>px;
    <?php } ?>
    <?php if ( theme_option('sub_menu_font_weight')) { ?>
        font-weight:<?php echo theme_option('sub_menu_font_weight'); ?>;
    <?php } ?>
    <?php if ( theme_option('sub_menu_line_height')) { ?>
        line-height:<?php echo esc_attr(theme_option('sub_menu_line_height')); ?>px;
    <?php } ?>
}
h1,h2,h3,h4,h5,h6{
    <?php if ( theme_option('headings_font')) { ?>
        font-family:"<?php echo theme_option('headings_font'); ?>", Arial, sans-serif !important;
    <?php } ?>
    <?php if ( theme_option('headings_font_weight')) { ?>
        font-weight:<?php echo theme_option('headings_font_weight'); ?>;
    <?php } ?>
}
header.top-head .logo a{
    <?php if ( theme_option('logo_font')) { ?>
        font-family:"<?php echo theme_option('logo_font'); ?>", Arial, sans-serif;
    <?php } ?>
    <?php if ( theme_option('logo_font_size')) { ?>
        font-size:<?php echo esc_attr(theme_option('logo_font_size')); ?>px;
    <?php } ?>
    <?php if ( theme_option('logo_font_weight')) { ?>
        font-weight:<?php echo theme_option('logo_font_weight'); ?>;
    <?php } ?> 
}
header.top-head .logo a span{
    <?php if ( theme_option('slogan_font')) { ?>
        font-family:"<?php echo theme_option('slogan_font'); ?>", Arial, sans-serif;
    <?php } ?>
    <?php if ( theme_option('slogan_font_size')) { ?>
        font-size:<?php echo esc_attr(theme_option('slogan_font_size')); ?>px;
    <?php } ?>
    <?php if ( theme_option('slogan_font_weight')) { ?>
        font-weight:<?php echo theme_option('slogan_font_weight'); ?>;
    <?php } ?> 
}
<?php if ( theme_option('bodybgcolor') ) { ?>
    body{
        background-color: <?php echo esc_attr(theme_option('bodybgcolor')); ?>;
    }
<?php } ?>
<?php if ( theme_option('bodyfontcolor') ) { ?>
    body{
        color: <?php echo esc_attr(theme_option('bodyfontcolor')); ?>;
    }
<?php } ?>
<?php if ( theme_option('bodybgimage') ) { ?>
    body{
        background-image: url("<?php echo esc_url(theme_option('bodybgimage')); ?>");
        background-repeat: <?php echo theme_option('body_bg_img_repeat'); ?>;
        <?php if ( theme_option('body_bg_full_width') == '1' ) { ?>
            background-size:100% 100%;
        <?php } ?>
        <?php if ( theme_option('body_bg_img_parallax') == '1' ) { ?>
            background-attachment:fixed;
        <?php } ?>
    }
<?php } elseif ( theme_option('usepatterns') == '1' ) {
    if ( theme_option('patterns-imgs') ) { ?>
    body{
        background-image: url("<?php echo esc_url(theme_option('patterns-imgs')); ?>");
    }
<?php } } ?>

<?php if ( theme_option('nav_bg_color') ) : ?>
    header.top-head{
        background-color: <?php echo esc_attr(theme_option('nav_bg_color')); ?>
    }
<?php endif; ?> 
 <?php if ( theme_option('nav_image') ) : ?>
    .top-head{
        background-image: url("<?php echo esc_url(theme_option('nav_image')); ?>");
        <?php if ( theme_option('nav_img_full_width') == '1' ) : ?>
            background-size:100% 100%;
        <?php endif; ?>
        background-repeat: <?php echo theme_option('nav_img_repeat'); ?>;
        background-position:50% 0;
    }
 <?php endif; ?>
 
 <?php if ( theme_option('foot_top_bg_color') ) : ?>
    .footer-bar{
        background-color: <?php echo esc_attr(theme_option('foot_top_bg_color')); ?>;
    }
 <?php endif; ?>
 
 <?php if ( theme_option('foot_top_image') ) : ?>
    .footer-bar{
        background-image: url("<?php echo esc_url(theme_option('foot_top_image')); ?>");
        <?php if ( theme_option('foot_top_bg_img_full_width') == '1' ) : ?>
            background-size:100% 100%;
        <?php endif; ?>
        background-repeat: <?php echo theme_option('foot_top_bg_img_repeat'); ?>;
        background-position:50% 0;
    }
 <?php endif; ?>
 
 <?php if ( theme_option('foot_bg_color') ) : ?>
    .footer-top{
        background-color: <?php echo esc_attr(theme_option('foot_bg_color')); ?>;
    }
 <?php endif; ?>
 
 <?php if ( theme_option('footer_image') ) : ?>
    .footer-top{
        background-image: url("<?php echo esc_url(theme_option('footer_image')); ?>");
        <?php if ( theme_option('footer_bg_img_full_width') == '1' ) : ?>
            background-size:100% 100%;
        <?php endif; ?>
        background-repeat: <?php echo theme_option('footer_bg_img_repeat'); ?>;
        background-position:50% 0;
    }
 <?php endif; ?>
  <?php if ( theme_option('copyright_bg_color') ) : ?>
    .footer-bottom,.footer-top-4 .copyrights,.footer-top-4 .footer-menu-inline{
        background-color: <?php echo esc_attr(theme_option('copyright_bg_color')); ?>;
    }
 <?php endif; ?>
 <?php if ( theme_option('copyright_image') ) : ?>
    .footer-bottom{
        background-image: url("<?php echo esc_url(theme_option('copyright_image')); ?>");
        <?php if ( theme_option('copyright_bg_img_full_width') == '1' ) : ?>
            background-size:100% 100%;
        <?php endif; ?>
        background-repeat: <?php echo theme_option('copyright_bg_img_repeat'); ?>;
        background-position:50% 0;
    }
 <?php endif; ?>
 <?php if ( theme_option('barbgcolor') ) : ?>
    .top-bar{
        background-color: <?php echo esc_attr(theme_option('barbgcolor')); ?>;
    }
 <?php endif; ?>
  <?php if ( theme_option('bar_image') ) : ?>
    .top-bar{
        background-image: url("<?php echo esc_url(theme_option('bar_image')); ?>");
        <?php if ( theme_option('bar_img_full_width') == '1' ) : ?>
            background-size:100% 100%;
        <?php endif; ?>
        background-repeat: <?php echo theme_option('bar_img_repeat'); ?>;
        background-position:50% 0;
    }
 <?php endif; ?>
  <?php if ( theme_option('barcolor') ) : ?>
    .top-bar,.top-bar a, .top-bar span{
        color: <?php echo esc_attr(theme_option('barcolor')); ?>;
    }
 <?php endif; ?>
 <?php if ( theme_option('bariconcolor') ) : ?>
    .top-bar i{
        color: <?php echo esc_attr(theme_option('bariconcolor')); ?>;
    }
 <?php endif; ?>   
 <?php if ( theme_option('barseparatorcolor') ) : ?>
    .top-bar li,.lft-topbar-border{
        border-left: 1px <?php echo esc_attr(theme_option('barseparatorcolor')); ?> solid;
    }
 <?php endif; ?>
 <?php if ( theme_option('singleprevnext_on') == "0" ) : ?>
 .nav-single {
    display:none;
 }
 <?php endif; ?>
<?php if ( theme_option('is_responsive') == "0" ) : ?>
<?php if ( theme_option('main_width')) : ?> 
 
 .pageWrapper.fixedPage,.container{
    width:<?php echo esc_attr(theme_option('main_width')) ?>px;
    margin:auto
 }
<?php endif; ?>
<?php endif; ?>
 <?php if ( theme_option('sticky_header_on') == '1' ) : ?>
    header.top-head.stickyHeader{
        <?php if ( theme_option('sticky_bg_color')) : ?>
            background:rgba(<?php echo esc_attr($rgb); ?>,<?php echo esc_attr(theme_option('sticky_bg_trans')); ?>);
        <?php endif; ?> 
    }
 <?php endif; ?>     
 <?php if ( theme_option('use_page_head_bg') == '1' ) : ?>
    .page-title{
        <?php if ( theme_option('page_head_bg')) : ?>
            background-image: url("<?php echo esc_url(theme_option('page_head_bg')); ?>");
        <?php endif; ?>
        <?php if ( theme_option('page_head_full_width') == '1' ) : ?>
            background-size:100% 100%;
        <?php endif; ?>
        background-repeat: <?php echo theme_option('page_head_repeat'); ?>;
        background-position:50% 0;
        <?php if ( theme_option('page_head_parallax') == '1' ) : ?>
        background-attachment:fixed;
        <?php endif; ?> 
    }
 <?php endif; ?> 
 <?php if ( theme_option('page_head_height') ) : ?>
    .page-title > .container{
        height: <?php echo esc_attr(theme_option('page_head_height')); ?>px;
    }
 <?php endif; ?>  
 <?php if ( theme_option('custom_css') ) : ?>
    <?php echo theme_option('custom_css'); ?>
 <?php endif; ?>
<?php if ( theme_option('nav_icon_color') ) : ?>
    .top-nav > ul li a i{
        color: <?php echo esc_attr(theme_option('nav_icon_color')); ?>;
    }
 <?php endif; ?>
 
 <?php if ( theme_option('soon_bgcolor') ) : ?>
    .soon_container{
        background-color: <?php echo esc_attr(theme_option('soon_bgcolor')); ?>;
    }
 <?php endif; ?>
  <?php if ( theme_option('soon_bg') ) : ?>
    .soon_container{
        background-image: url("<?php echo esc_url(theme_option('soon_bg')); ?>");
        <?php if ( theme_option('soon_bg_full_width') == '1' ) : ?>
            background-size:100% 100%;
        <?php endif; ?>
        background-repeat: <?php echo theme_option('soon_bg_repeat'); ?>;
        background-position:50% 0;
        <?php if (theme_option('soon_bg_img_parallax')) : ?>
        background-attachment:fixed;
        <?php endif; ?>
    }
 <?php endif; ?>
  <?php if ( theme_option('soon_overlay') ) : ?>
    .soon_container:before{
        background:rgba(<?php echo esc_attr($rgb2); ?>,<?php echo esc_attr(theme_option('soon_overlay_trans')); ?>) !important;
    }
 <?php endif; ?>
 <?php if ( theme_option('soon_lg_head_color') ) : ?>
    .soon_lg_head{
        color: <?php echo esc_attr(theme_option('soon_lg_head_color')); ?>;
    }
 <?php endif; ?>
 <?php if ( theme_option('soon_desc_color') ) : ?>
    .soon_desc{
        color: <?php echo esc_attr(theme_option('soon_desc_color')); ?>;
    }
 <?php endif; ?>
 <?php if ( theme_option('digits_bg') ) : ?>
    .digits span{
        background-image: url("<?php echo esc_url(theme_option('digits_bg')); ?>");
    }
 <?php endif; ?>
   <?php if ( theme_option('digits_color') ) : ?>
    .digits span{
        color: <?php echo esc_attr(theme_option('digits_color')); ?>;
    }
 <?php endif; ?>
  <?php if ( theme_option('soon_count_color') ) : ?>
    .digits li p{
        color: <?php echo esc_attr(theme_option('soon_count_color')); ?>;
    }
 <?php endif; ?>
 
   <?php if ( theme_option('soon_socials_color') ) : ?>
    .soon_container .larg-socials li a i{
        color: <?php echo esc_attr(theme_option('soon_socials_color')); ?>;
    }
 <?php endif; ?>
 <?php if ( theme_option('soon_socials_bgcolor') ) : ?>
    .larg-socials li a i{
        background-color: <?php echo esc_attr(theme_option('soon_socials_bgcolor')); ?>;
    }
 <?php endif; ?>
 <?php if ( theme_option('soon_socials_hoverbgcolor') ) : ?>
    .larg-socials li a:hover i{
        background-color: <?php echo esc_attr(theme_option('soon_socials_hoverbgcolor')); ?>;
    }
 <?php endif; ?>
 <?php if ( theme_option('soon_socials_border') ) : ?>
    .larg-socials li a,.larg-socials li a:before,.larg-socials li a:after{
        border-color: <?php echo esc_attr(theme_option('soon_socials_border')); ?>;
    }
 <?php endif; ?>