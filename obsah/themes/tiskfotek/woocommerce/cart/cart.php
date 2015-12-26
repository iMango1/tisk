<?php
/**
 * Cart Page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.8
 */
session_start();

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

wc_print_notices();

do_action( 'woocommerce_before_cart' ); ?>

<?php 

global $woocommerce, $muj_post;
       


        $cart = WC()->instance()->cart;
        $cart_id = $cart->generate_cart_id(3032);
        $cart_item_id = $cart->find_product_in_cart($cart_id);
        /*
        if($cart_item_id){
            $cart->set_quantity($cart_item_id,0);
        }*/
    //echo"<pre>",print_r($cart),"</pre>";

//$cart->set_quantity($prvni,0);
    //echo $prvni;

    reset($cart->cart_contents);
    $prvni = key($cart->cart_contents);
    $k_vymazani = explode("kosik/",$cart->get_remove_url($prvni));
    $vymaz = $k_vymazani[1];
   /*
    if($kokos != 0){
        $cart->remove_cart_item($prvni);
        $kokos = 1;
    }
*/
        $objednavka = new WC_Order($muj_post->ID); 
    //    $id_objednavky = trim(str_replace('#', '', $objednavka->get_order_number()));
        $id_objednavky = $objednavka->get_order_number();
$_SESSION["status"] = 0;
?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

<script>
//SMAZÁNÍ PRVNÍ FOTOGRAFIE
    /*
jQuery(function () {
    $.get("<?php echo $vymaz; ?>", function() {
        console.log("ODSTRANĚNO - <?php echo $vymaz; ?>");
    });
});
*/
</script>
<div class="kroky-nastaveni-blok" style="margin-bottom:20px;">
    <div class="kroky_blok">
        <div class="krok jedna_upload aktivni"><a href="../../upload-fotografii"><span class="cislo">1</span> Upload fotografií</a></div>
        <div class="krok dva_upload aktivni"><a  href="../../nastaveni-fotografii"><span class="cislo">2</span> Nastavení parametrů tisku</a></div>
        <div class="krok dva_upload aktivni"><a><span class="cislo">3</span> Košík</a></div>
        <div class="krok dva_upload nepristupne"><a><span class="cislo">4</span> Fakturační údaje</a></div>
        <div class="krok dva_upload nepristupne"><a><span class="cislo">5</span> Dokončení objednávky</a></div>
    </div>
</div>



<form action="<?php echo esc_url( WC()->cart->get_cart_url() ); ?>" method="post">

<?php do_action( 'woocommerce_before_cart_table' ); ?>

<table class="shop_table cart" cellspacing="0">
	<thead>
		<tr>
<!--			<th class="product-remove">&nbsp;</th>
			<th class="product-thumbnail">&nbsp;</th>
			<th class="product-name"><?php _e( 'Product', 'woocommerce' ); ?></th> -->
			<th colspan="3">&nbsp;</th>
			<th class="product-price"><?php _e( 'Price', 'woocommerce' ); ?></th>
			<th class="product-quantity"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
			<th class="product-subtotal"><?php _e( 'Total', 'woocommerce' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php do_action( 'woocommerce_before_cart_contents' ); ?>

		<?php
    /*    echo "<pre>";
        print_r($_COOKIE);
        echo "</pre><br>".$_SESSION[0]["url_fotky"]; */
		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				?>
				<tr class="<?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

					<td class="product-remove">
						<?php
							echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf( '<a href="%s" class="remove" title="%s">&times;</a>', esc_url( WC()->cart->get_remove_url( $cart_item_key ) ), __( 'Remove this item', 'woocommerce' ) ), $cart_item_key );
						?>
					</td>

					<td class="product-thumbnail">
						<?php
                /*
							$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

							if ( ! $_product->is_visible() )
								echo $thumbnail;
							else
								printf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $thumbnail );
                                
                                */
                
                            echo $cart_item["addons"][0]["display"];
						?>
					</td>

					<td class="product-name">
						<?php
                           //echo "<pre>",print_r($cart_item["addons"]),"</pre>";
				/*			
                            if ( ! $_product->is_visible() )
								echo apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
							else
								echo apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', $_product->get_permalink( $cart_item ), $_product->get_title() ), $cart_item, $cart_item_key );
*/
							// Meta data
							//echo WC()->cart->get_item_data( $cart_item );
                            
                            ?>
                            <div class="row">
                               <?php 
  //  echo "<pre>",print_r($cart_item),"</pre>";
?>
                                <div class="col-md-6">
                                   <dl class="variation">
                                    <?php if($cart_item["addons"][1]["name"] != "id_objednavky - id"){ ?>
                                    <dt><?php echo $cart_item["addons"][1]["name"]; ?></dt>
                                    <dd><p><?php echo $cart_item["addons"][1]["value"]; ?></p></dd>
                                    <?php } ?>
                                    
                                    <?php if($cart_item["addons"][2]["name"] != "id_objednavky - id"){ ?>
                                    <dt><?php echo $cart_item["addons"][2]["name"]; ?></dt>
                                    <dd><p><?php echo $cart_item["addons"][2]["value"]; ?></p></dd>
                                    <?php } ?>
                                    </dl>
                                </div>
                                <div class="col-md-6">
                                       <?php if($cart_item["addons"][3]["name"] != "id_objednavky - id"){ ?>
                                        <dt><?php echo $cart_item["addons"][3]["name"]; ?></dt>
                                        <dd><p><?php echo $cart_item["addons"][3]["value"]; ?></p></dd>
                                        <?php } ?>
                                        <?php if($cart_item["addons"][4]["name"] != "id_objednavky - id"){ ?>
                                        <dt><?php echo $cart_item["addons"][4]["name"]; ?></dt>
                                        <dd><p><?php echo $cart_item["addons"][4]["value"]; ?></p></dd>
                                        <?php } ?>
                                </div>
                            </div>
                            <?php
                
               				// Backorder notification
               				if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) )
               					echo '<p class="backorder_notification">' . __( 'Available on backorder', 'woocommerce' ) . '</p>';
						?>
					</td>

					<td class="product-price">
						<?php
							echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
						?>
					</td>

					<td class="product-quantity">
						<?php
							if ( $_product->is_sold_individually() ) {
								$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
							} else {
								$product_quantity = woocommerce_quantity_input( array(
									'input_name'  => "cart[{$cart_item_key}][qty]",
									'input_value' => $cart_item['quantity'],
									'max_value'   => $_product->backorders_allowed() ? '' : $_product->get_stock_quantity(),
									'min_value'   => '0'
								), $_product, false );
							}

							echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key );
						?>
					</td>

					<td class="product-subtotal">
						<?php
							echo apply_filters( 'woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal( $_product, $cart_item['quantity'] ), $cart_item, $cart_item_key );
						?>
					</td>
				</tr>
				<?php
			}
		}

		do_action( 'woocommerce_cart_contents' );
		?>
<?php /*		<tr>
			<td colspan="6" class="actions">

			</td>
		</tr> */ ?>

		<?php do_action( 'woocommerce_after_cart_contents' ); ?>
	</tbody>
</table>

<?php do_action( 'woocommerce_after_cart_table' ); ?>
<div class="kupony-obal" style="margin-bottom:30px;">
                    <div class="coupon left">

						<label for="coupon_code" class="left-lbl"><?php _e( 'Coupon', 'woocommerce' ); ?>:</label> <input type="text" name="coupon_code" class="small-txt" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" /> <input type="submit" class="btn btn-default" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />

						<?php do_action( 'woocommerce_cart_coupon' ); ?>

					</div>

    
                <div class="right">
				<input type="submit" class="btn btn-default" name="update_cart" value="<?php _e( 'Update Cart', 'woocommerce' ); ?>" /> 
                <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
				<?php do_action( 'woocommerce_cart_actions' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
                </div>
    
    </div>    


<div class="celkem-obal">

	<?php do_action( 'woocommerce_cart_collaterals' ); ?>

	<?php woocommerce_cart_totals(); ?>

    
    	<?php if ( WC()->cart->coupons_enabled() ) { ?>
	<div class="kupony-obal">
      <!--              <div class="coupon left">

						<label for="coupon_code" class="left-lbl"><?php _e( 'Coupon', 'woocommerce' ); ?>:</label> <input type="text" name="coupon_code" class="small-txt" id="coupon_code" value="" placeholder="<?php _e( 'Coupon code', 'woocommerce' ); ?>" /> <input type="submit" class="btn btn-default" name="apply_coupon" value="<?php _e( 'Apply Coupon', 'woocommerce' ); ?>" />

						<?php do_action( 'woocommerce_cart_coupon' ); ?>

					</div>-->
				<?php } ?>
    
                <div class="right">
<!--				<input type="submit" class="btn btn-default" name="update_cart" value="<?php _e( 'Update Cart', 'woocommerce' ); ?> /> --> <input type="submit" class="btn main-bg" name="proceed" value="Přejít na další krok<?php // _e( 'Proceed to Checkout', 'woocommerce' ); ?>" />
                <?php do_action( 'woocommerce_proceed_to_checkout' ); ?>
				<?php do_action( 'woocommerce_cart_actions' ); ?>

				<?php wp_nonce_field( 'woocommerce-cart' ); ?>
                </div>
    
    </div>    
</div>
</form>
 <div class="footer-uploader">
            <div class="col-md-6">
                <p>Digitální fotosběrna</p>
            </div>   
            <div class="col-md-6">
                <p class="pull-right">Multiuploader 1.0.3</p>
            </div>    
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
