<?php
/**
 * Output a single payment method
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php 
$chosen_methods = WC()->session->get( 'chosen_shipping_methods' );
$chosen_payment_methods = WC()->session->get('chosen_payment_method');
$chosen_shipping = $chosen_methods[0];
//echo "<pre>",print_r(WC()->session),"</pre>";
if($chosen_shipping == "international_delivery"){ 
    
}
?>
<li class="payment_method_<?php echo $gateway->id; ?>" style="
<?php 
if((($chosen_shipping == "international_delivery") || ($chosen_shipping == "flat_rate")) && ($gateway->id == "cheque"))
    echo "display:none;";
?>
"
>
	<input id="payment_method_<?php echo $gateway->id; ?>" type="radio" class="input-radio" name="payment_method" value="<?php echo esc_attr( $gateway->id ); ?>" <?php checked( $gateway->chosen, true ); ?> data-order_button_text="<?php echo esc_attr( $gateway->order_button_text ); ?>" />

	<label for="payment_method_<?php echo $gateway->id; ?>">
		<?php echo $gateway->get_title(); ?> <?php echo $gateway->get_icon(); ?>
	</label>
	<?php if ( $gateway->has_fields() || $gateway->get_description() ) : ?>
		<div class="payment_box payment_method_<?php echo $gateway->id; ?>" <?php if ( ! $gateway->chosen ) : ?>style="display:none;"<?php endif; ?>>
			<?php $gateway->payment_fields(); ?>
		</div>
	<?php endif; ?>
</li>
