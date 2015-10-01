<?php
/*
Footer Style
*/
$opts_foot_bar = (theme_option('footer_top_show') == '1') ? '1' : '0';
$opts_foot_widgets = (theme_option('enable_footer_widgets') == '1') ? '1' : '0';
$opts_bot_foot = (theme_option('show_bottom_footer') == '1') ? '1' : '0';
$ht_foot_bar = (get_post_meta(c_page_ID(),'hide_top_foot_bar',true) == '1') ? '1' : '0';
$h_foot_widgets = (get_post_meta(c_page_ID(),'hide_foot_widgets',true) == '1') ? '1' : '0';
$hb_foot_bar = (get_post_meta(c_page_ID(),'hide_bottom_foot_bar',true) == '1') ? '1' : '0';  
$langcode = '';
if ( class_exists( 'SitePress' ) ) {
    $langcode = '-'.ICL_LANGUAGE_CODE;
}  
if ( $opts_foot_bar == '1' && $ht_foot_bar != '1'){
?>
<div class="footer-bar footer-bar-3">
        <div class="container">
            <div class="row">
            <div class="col-md-10">
                <?php
                    if (theme_option('footer3_top_left_txt'.$langcode)){
                        echo '<p>'.wp_filter_post_kses(theme_option("footer3_top_left_txt".$langcode)).'</p>';
                    }
                ?>
            </div>
            <div class="col-md-2 buyNow">
                <a class="btn btn-large main-bg" href="<?php echo esc_url(theme_option('footer3_top_right_button_link'.$langcode)); ?>"><?php echo wp_filter_post_kses(theme_option('footer3_top_right_button_text'.$langcode)); ?></a>
            </div>
        </div>
    </div>
</div>
<?php }?>
<footer id="footWrapper">
    <div class="footer-top footer-top-4">
        <?php if ( $opts_foot_widgets == "1" && $h_foot_widgets != '1') { ?>
        <div class="container footer-4-widgets">
            <div class="row">
                <?php if(is_active_sidebar('footer-widgets')){ ?>
                    <?php dynamic_sidebar('footer-widgets'); ?>
                <?php } ?>
            </div>
        </div>
        <?php } ?>
        <?php if ( $opts_bot_foot == "1" && $hb_foot_bar != '1') { ?>
        <div class="clearfix"></div>
        <div class="container">
        <div class="padd-vertical-30">
            <div class="col-md-5">
               <div class="row"> 
                <div class="copyrights">
                    <?php if ( theme_option('enable_copyrights') == "1" ) : ?>
                        <?php if ( theme_option('copyrights'.$langcode) ) : ?>
                            <?php echo wp_kses(theme_option('copyrights'.$langcode),it_allowed_tags()); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
               </div>
            </div>
            <div class="col-md-7">
            <div class="row">
            <?php wp_nav_menu( array( 'theme_location' => 'bottom-footer-menu', 'fallback_cb' => false, 'menu_class' => '', 'container'=>'', 'items_wrap' => '<ul class="footer-menu-inline">%3$s</ul>' ) ); ?></div>
            </div>
        </div>
        </div> 
        <?php } ?>   
    </div>
</footer>