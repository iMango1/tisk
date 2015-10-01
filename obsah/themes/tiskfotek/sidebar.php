<?php
global $woocommerce; 
$woo=null;$is_cart=null;$is_chk=null;$bbp=null;$buddy=null;
if(function_exists('is_woocommerce') && is_woocommerce()) $woo = 'is_woocommerce';
if(function_exists('is_cart') && is_cart()) $is_cart = 'is_cart';
if(function_exists('is_checkout') && is_checkout()) $is_chk = 'is_checkout';
if(function_exists('is_bbpress') && is_bbpress()) $bbp = 'is_bbpress';
if(function_exists('is_buddypress') && is_buddypress()) $buddy = 'is_buddypress';
$lay = theme_option('blog_sidebar');
$dir ='';
if($lay == 'right'){
   $dir ='rit'; 
}else if($lay == 'left'){
   $dir ='lft'; 
}  
if($woo || is_tax( 'product_cat' ) || is_tax( 'product_tag' ) || is_singular( 'product' ) || $is_cart || $is_chk){
    ?>
    <aside class="sidebar col-md-3 <?php echo $dir; ?>">
        <ul class="sidebar_widgets">
            <?php dynamic_sidebar( 'sidebar-shop' ); ?>
        </ul>
    </aside>
    <?php
}else if( $bbp ) {
    ?>
    <aside class="sidebar col-md-3 <?php echo $dir; ?>">
        <ul class="sidebar_widgets">
            <?php dynamic_sidebar( 'sidebar-bbpress' ); ?>
        </ul>
    </aside>
    <?php
}else if( $buddy ) {
    ?>
    <aside class="sidebar col-md-3 <?php echo $dir; ?>">
        <ul class="sidebar_widgets">
            <?php dynamic_sidebar( 'sidebar-buddypress' ); ?>
        </ul>
    </aside>
    <?php
}else{
    ?>
    <aside class="sidebar col-md-3 <?php echo $dir; ?>">
        <ul class="sidebar_widgets">
            <?php 
            
            $options = get_post_custom(get_the_ID());
 
            if(isset($options['custom_sidebar'])){
                $sidebar_choice = $options['custom_sidebar'][0];
            }
            else{
                $sidebar_choice = "default";
            }
            
            if($sidebar_choice && $sidebar_choice != "default"){
                dynamic_sidebar($sidebar_choice);
            }
            else{
                if(is_active_sidebar('sidebar-2')){
                    dynamic_sidebar('sidebar-2');
                } else{
                    dynamic_sidebar('sidebar-1');
                }
            }
            
            ?>
        </ul>
    </aside>
    <?php
}






