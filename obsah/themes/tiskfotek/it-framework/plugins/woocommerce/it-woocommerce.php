<?php

add_theme_support('woocommerce');
/**/remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 5 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 10 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 20 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 30 );
add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_second_product_thumbnail' );
add_filter( 'post_class', 'product_has_gallery');


remove_action('woocommerce_after_shop_loop', 'woocommerce_pagination', 10);
function it_woocommerce_pagination() {
    woo_paging();
}
add_action( 'woocommerce_after_shop_loop', 'it_woocommerce_pagination', 10);


// Woocommerce styling.
add_filter( 'woocommerce_enqueue_styles', '__return_false');

add_filter( 'woocommerce_enqueue_styles', 'woc_add_style');
function woc_add_style(){
   wp_enqueue_style( 'it-woocommerce', THEME_URI . '/assets/css/plugins/woocommerce.css' ); 
}

add_filter('add_to_cart_fragments', 'it_icon_add_to_cart_fragment');
function it_icon_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <span class="cart-count">
          
        <?php echo sprintf(_n('%d fotka', '%d fotek', $woocommerce->cart->cart_contents_count, 'woocommerce'), $woocommerce->cart->cart_contents_count);?> - 
        <?php echo $woocommerce->cart->get_cart_total(); ?>
    </span>
    <?php
    $fragments['span.cart-count'] = ob_get_clean();
    return $fragments;
}

add_filter('add_to_cart_fragments', 'it_add_to_cart_fragment');
if (!function_exists('it_add_to_cart_fragment')) {
    function it_add_to_cart_fragment( $fragments ) {
        global $woocommerce;
        ob_start();
        ?>
        <div class="mini-cart">
            <ul class="cart_list mini-cart-list product_list_widget">

            <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

                <?php
                    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                        $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                        $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

                            $product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                            $thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                            $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

                            ?>
                            <li>

                            <?php if ( ! $_product->is_visible() ) { ?>
                            <?php } else { ?>
                                                                
                            <?php } ?>
                                <div class="cart-body"><?php // echo  WC()->cart->get_item_data( $cart_item ); ?>
                                
                                <?php foreach($cart_item["addons"] as $i => $cart_item_jedna){ ?>
                                    
                                    <?php 
                                        if($i == 0)
                                            echo "<img src='".$cart_item_jedna["value"]."' style='height: 30px; width: auto!important;'>";
                                        if ($cart_item_jedna["name"]== "Formát")   
                                            echo "<span class='polozka_mini_cart'>".$cart_item_jedna["value"]."</span>";
                                    ?>
                                <?php } ?>
                                <?php // echo "<pre>",print_r($cart_item),"</pre>"; ?>
                                </div>
                            </li>
                            <?php
                        }
                    }
                ?>

            <?php else : ?>

               <li class="empty"><?php _e( 'V košíku nemáte žádné fotky', 'woocommerce' ); ?></li>

            <?php endif; ?>

        </ul>

            <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
                <div class="mini-cart-total"><div class="left"><?php _e( 'Subtotal', 'woocommerce' ); ?>:</div><div class="right"> <?php echo WC()->cart->get_cart_subtotal(); ?></div></div>
                <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
                <div class="checkout">
                    <a href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" class="btn btn-default"><?php _e( 'View Cart', 'woocommerce' ); ?></a>
                    <a href="<?php echo esc_url(WC()->cart->get_checkout_url()); ?>" class="btn btn-default"><?php _e( 'Checkout', 'woocommerce' ); ?></a>
                </div>
            <?php endif; ?>
        </div>  
        <?php
        $fragments['div.mini-cart'] = ob_get_clean();
        return $fragments;
        
    }
}

// Add pif-has-gallery class to products that have a gallery
function product_has_gallery( $classes ) {
    global $product;

    $post_type = get_post_type( get_the_ID() );

    if ( ! is_admin() ) {

        if ( $post_type == 'product' ) {

            $attachment_ids = $product->get_gallery_attachment_ids();

            if ( $attachment_ids ) {
                $classes[] = 'it-has-gallery';
            }
        }

    }

    return $classes;
}

// Display the second thumbnails
function woocommerce_template_loop_second_product_thumbnail() {
    global $product, $woocommerce;

    $attachment_ids = $product->get_gallery_attachment_ids();

    if ( $attachment_ids ) {
        $secondary_image_id = $attachment_ids['0'];
        echo wp_get_attachment_image( $secondary_image_id, 'shop_catalog', '', $attr = array( 'class' => 'alt-image attachment-shop-catalog' ) );
    }
}