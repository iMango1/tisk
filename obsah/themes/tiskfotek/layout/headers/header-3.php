<?php
$clsticky = '';
$effect = 'effect-'.theme_option('menu_effect');
$show_bar = theme_option("show_top_bar");
$ht_bar = get_post_meta(c_page_ID(),'hide_top_bar',true);
$h_menu = get_post_meta(c_page_ID(),'hide_menu',true);
if ( theme_option('sticky_header_on') == '1'){
    $clsticky = 'data-sticky="true"';
}
if ( $user_ID ) {
    global $user_identity;
}else{
    get_template_part( 'layout/headers/login-out');
} 
$langcode = '';
if ( class_exists( 'SitePress' ) ) {
    $langcode = '-'.ICL_LANGUAGE_CODE;
}
?>
<?php
    $cls='';
    if (theme_option("show_top_bar") == "0"){
        $cls = 'margin-top-0';
    }
?>
<div id="headWrapper" class="head-style3 clearfix">
<?php 
if ( $show_bar == '1') {
    if($ht_bar == '' || $ht_bar == '0'){
    ?>
    <div class="container">
        <div class="row">
            <?php get_template_part( 'layout/headers/top-bar'); ?>
        </div>
    </div>
    <?php
    } 
} 
?>
<?php if ( !$h_menu == '1') { ?>
<header class="top-head <?php echo $cls; ?>" <?php echo $clsticky; ?>>
    <div class="logo col-md-2 main-bg">
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
    <div class="top-nav-style3">
        <div class="container">
            <div class="row">
              <div class="col-md-12">
                   <div class="top-menu">
                    <?php if(theme_option("show_search")){ ?>
                <div class="top-search">
                    <a href="#"><span class="fa fa-search"></span></a>
                    <div class="search-box">
                        <?php get_search_form(); ?>
                    </div>
                </div>
                <?php } ?>
                    <nav class="top-nav">
                        <div id="mnu-eft" class="<?php echo esc_attr($effect); ?>"> 
                            <?php
                            if ( has_nav_menu( 'global-menu' ) ) {
                                it_nav_menu( array( 'theme_location' => 'global-menu') ); 
                            }else{
                                echo '<span class="menu-message">'.__('Please go to admin panel > Menus > select Global menu and add items to it.','itrays').'</span>';
                            }
                            ?>
                        </div>
                   </nav>
                </div>
            </div>  
            </div>
        </div>        
    </div>
</header>
<?php } ?>
<?php if ( get_header_image() ) : ?>
<div class="custom-header">
    <img src="<?php esc_attr(header_image()); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
</div>
<?php endif; ?>
</div>
