<?php 
get_header();  
$sinlebar = theme_option('show_sidebar_single_woo');
$wid;
if ( theme_option('show_sidebar_woo') == "1" ){
    $wid = 9;
}else{
    $wid = 12;
}
if ( $sinlebar == "1" ){
    $widsingle = 9;
}else{
    $widsingle = 12;
}
// page title function.
it_title_style();
?>


<div class="md-padding">
    <div class="container">
        <div class="row">
            <?php if ( is_singular( 'product' ) ) { ?>
            
                <?php if ( $widsingle == 9 && theme_option('single_sidebar_position_woo') == "left" ) : ?>
                    <?php get_sidebar( 'shop' ); ?>
                <?php endif; ?> 
                
                <div class="col-md-<?php echo $widsingle; ?>">
                    <?php woocommerce_content(); ?>
                </div>
                
                <?php if ( $widsingle == 9 && theme_option('single_sidebar_position_woo') == "right" ) : ?>
                    <?php get_sidebar( 'shop' ); ?>
                <?php endif; ?>
            
            <?php }else{ ?>
            
                <?php if ( $wid == 9 && theme_option('sidebar_position_woo') == "left" ) : ?>
                    <?php get_sidebar( 'shop' ); ?>
                <?php endif; ?> 
                
                <div class="col-md-<?php echo $wid; ?>">
                    <?php woocommerce_get_template( 'archive-product.php' ); ?>
                </div>
                
                <?php if ( $wid == 9 && theme_option('sidebar_position_woo') == "right" ) : ?>
                    <?php get_sidebar( 'shop' ); ?>
                <?php endif; ?>
            
            <?php } ?>
            
            
        </div>
    </div>
</div>
 <div class="clearfix"></div>
<?php

get_footer();