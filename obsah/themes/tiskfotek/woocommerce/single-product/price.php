<script>
jQuery( document ).ready(function() {
    jQuery(".chosen-select").chosen({"disable_search": true});
});
</script>
<script>
function sticky_relocate() {
    var window_top = jQuery(window).scrollTop();
    var div_top = jQuery('#sticky-anchor').offset().top;
    if (window_top > div_top) {
        jQuery('.kroky-nastaveni-blok').addClass('stick');
    } else {
        jQuery('.kroky-nastaveni-blok').removeClass('stick');
    }
}


jQuery(function () {
    jQuery(window).scroll(sticky_relocate);
    sticky_relocate();
});

</script>



<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
     
<div class="product-specs price-block" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
    <?php if ( $price_html = $product->get_price_html() ) : ?>

       <?php else: ?>
       <div class="box error-box">No Price Added.</div>
    <?php endif; ?>
</div>