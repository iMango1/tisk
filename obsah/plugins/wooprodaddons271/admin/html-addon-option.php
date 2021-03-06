<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>
<tr class="parametr-<?php echo $loop; ?>">
	<td><input type="text" name="product_addon_option_label[<?php echo $loop; ?>][]" value="<?php echo esc_attr($option['label']) ?>" placeholder="<?php _e('Label', 'woocommerce-product-addons'); ?>" /></td>
    <td class="price_column">
	    <input type="text" name="product_addon_option_price[<?php echo $loop; ?>][]" value="<?php echo esc_attr( wc_format_localized_price( $option['price'] ) ); ?>" placeholder="0.00" class="wc_input_price" />
    </td>

	<td class="minmax_column"><input type="number" name="product_addon_option_min[<?php echo $loop; ?>][]" value="<?php echo esc_attr( $option['min'] ) ?>" placeholder="N/A" min="0" step="any" /></td>

	<td class="minmax_column"><input type="number" name="product_addon_option_max[<?php echo $loop; ?>][]" value="<?php echo esc_attr( $option['max'] ) ?>" placeholder="N/A" min="0" step="any" /></td>
   
    <td class="actions" width="1%"><button type="button" class="pridat_addon_cenu button">+</button></td>
	<td class="actions" width="1%"><button type="button" class="remove_addon_option button">x</button></td>

    <script>
    /*    jQuery(function() {
            jQuery(".parametr-<?php echo $loop; ?> .pridat_addon_cenu").click(function(){
                jQuery(".parametr-<?php echo $loop; ?> .price_column").append('<input type="text" name="kokos[<?php echo $loop; ?>][]" value="" placeholder="0.00" class="wc_input_price" />'); 
            });
        }); */
    </script>

</tr>