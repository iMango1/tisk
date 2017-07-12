<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$col = theme_option('columns_woo');
global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes
$classes = array();
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>
<div <?php $classes[] = 'col-md-'.$col.' fx shop-item'; post_class( $classes ); ?> data-animate="fadeInUp">
    <div class="item-box">
    <a class="pro zooms" href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
    <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
    <h3 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        
        <div class="item-img">
        <?php
            /**
             * woocommerce_before_shop_loop_item_title hook
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
            do_action( 'woocommerce_before_shop_loop_item_title' );
        ?>
        </div>
        
        <div class="item-details">
        <?php echo apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ?>
        <div class="item-bottom">
            <div class="right">
                <?php
                /**
                 * woocommerce_after_shop_loop_item_title hook
                 *
                 * @hooked woocommerce_template_loop_rating - 5
                 * @hooked woocommerce_template_loop_price - 10
                 */
                do_action( 'woocommerce_after_shop_loop_item_title' );
            ?>
            </div>
            <div class="left">
                <div class="item-cart">
                     <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                </div>
            </div>
        </div>
        
        </div>
    </div>
</div>
