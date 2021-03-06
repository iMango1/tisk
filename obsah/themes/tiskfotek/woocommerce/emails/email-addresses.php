<?php
/**
 * Email Addresses
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?><table cellspacing="0" cellpadding="0" style="width: 100%; vertical-align: top;" border="0">

	<tr>

		<td valign="top" width="50%" style="padding:0px;">

			<h3><?php _e( 'Billing address', 'woocommerce' ); ?></h3>

			<p><?php echo $order->get_formatted_billing_address(); ?>
			 <?php echo "<br><strong>IČO:</strong> $order->billing_ico, <strong>DIČ:</strong> $order->billing_dic"; ?>
			</p>

		</td>

		<?php if ( ! wc_ship_to_billing_address_only() && $order->needs_shipping_address() && ( $shipping = $order->get_formatted_shipping_address() ) ) : ?>

		<td valign="top" width="50%" style="padding:0px;">

			<h3><?php _e( 'Shipping address', 'woocommerce' ); ?></h3>

			<p><?php echo $shipping; ?>
            <?php echo "<br><strong>IČO:</strong> $order->shipping_ico, <strong>DIČ:</strong> $order->shipping_dic"; ?>
            </p>
		</td>

		<?php endif; ?>

	</tr>

</table>

