

<table cellspacing="0" cellpadding="6" style="width: 100%; border: 0px solid #eee; margin-bottom: 20px;">
    <tr style="border-bottom: 1px solid #c9c9c9;">
        <th style="border-bottom: 1px solid #c9c9c9;">Fotografie</th>
        <th style="border-bottom: 1px solid #c9c9c9;">Formát</th>
        <th style="border-bottom: 1px solid #c9c9c9;">Materiál</th>
        <th style="border-bottom: 1px solid #c9c9c9;">Deska</th>
        <th style="border-bottom: 1px solid #c9c9c9;">Typ</th>
		<th scope="col" style="text-align:left; border-bottom: 1px solid #c9c9c9;"><?php _e( 'Quantity', 'woocommerce' ); ?></th>
		<th scope="col" style="text-align:left; border-bottom: 1px solid #c9c9c9;"><?php _e( 'Price', 'woocommerce' ); ?></th>
    </tr>
<?php
/**
 * Email Order Items
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates/Emails
 * @version     2.1.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

            

foreach ( $items as $item_id => $item ) :
	$_product     = apply_filters( 'woocommerce_order_item_product', $order->get_product_from_item( $item ), $item );
	$item_meta    = new WC_Order_Item_Meta( $item['item_meta'], $_product );

	if ( apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
		?>
			<?php
            
				// Show title/image etc
			/*	if ( $show_image ) {
					echo apply_filters( 'woocommerce_order_item_thumbnail', '<img src="' . ( $_product->get_image_id() ? current( wp_get_attachment_image_src( $_product->get_image_id(), 'thumbnail') ) : wc_placeholder_img_src() ) .'" alt="' . __( 'Product Image', 'woocommerce' ) . '" height="' . esc_attr( $image_size[1] ) . '" width="' . esc_attr( $image_size[0] ) . '" style="vertical-align:middle; margin-right: 10px;" />', $item );
				}

				// Product name
				echo apply_filters( 'woocommerce_order_item_name', $item['name'], $item );

				// SKU
				if ( $show_sku && is_object( $_product ) && $_product->get_sku() ) {
					echo ' (#' . $_product->get_sku() . ')';
				}
                */
        //        echo "<pre>",print_r($item),"</pre>";
        
				// allow other plugins to add additional product information here
			/*	
            do_action( 'woocommerce_order_item_meta_start', $item_id, $item, $order );

				// Variation
				if ( $item_meta->meta ) {
					echo '<br/><small>' . nl2br( $item_meta->display( true, true, '_', "\n" ) ) . '</small>';
				}

				// File URLs
				if ( $show_download_links && is_object( $_product ) && $_product->exists() && $_product->is_downloadable() ) {

					$download_files = $order->get_item_downloads( $item );
					$i              = 0;

					foreach ( $download_files as $download_id => $file ) {
						$i++;

						if ( count( $download_files ) > 1 ) {
							$prefix = sprintf( __( 'Download %d', 'woocommerce' ), $i );
						} elseif ( $i == 1 ) {
							$prefix = __( 'Download', 'woocommerce' );
						}

						echo '<br/><small>' . $prefix . ': <a href="' . esc_url( $file['download_url'] ) . '" target="_blank">' . esc_html( $file['name'] ) . '</a></small>';
					}
				}

				// allow other plugins to add additional product information here
				do_action( 'woocommerce_order_item_meta_end', $item_id, $item, $order );
                */
        
//FOTOOBRAZY - PŘIDÁNÍ POMLČKY!!
       /*
                foreach($item as $klic => $jedna_polozka) {
                    if(( $jedna_polozka == "Fotoobraz" )){
                        end($item);
                        prev($item) = "-";
                   }
                }
  */
    ?>
			
			
                
                <tr>
                    <td style="text-align:center; border-bottom: 1px solid #c9c9c9; background: #f3f3f3;"><img src="<?php echo $item["item_meta"]["Fotky"][0]; ?>" style="width:95px;"></td>
                   <?php 
                    $k = 0;
                    foreach($item as $klic => $jedna_polozka) {
                        if(( $klic != "name" ) &&
                        ( $klic != "type" ) &&
                        ( $klic != "item_meta" ) &&
                        ( $klic != "qty" ) &&
                        ( $klic != "tax_class" ) &&
                        ( $klic != "product_id" ) &&
                        ( $klic != "variation_id" ) &&
                        ( $klic != "line_subtotal" ) &&
                        ( $klic != "line_total" ) &&
                        ( $klic != "line_subtotal_tax" ) &&
                        ( $klic != "line_tax" ) &&
                        ( $klic != "Fotky" ) &&
                        ( $klic != "id_objednavky - id" ) &&
                        ( $klic != "item_meta_array" ) && 
                        ( $klic != "line_tax_data" ) ){   
                            

                    
                            
                            if($jedna_polozka == "Fotoobraz"){
                            echo "<td style='border-bottom: 1px solid #c9c9c9; background: #f3f3f3;'>$jedna_polozka</td>";
                            echo "<td style='border-bottom: 1px solid #c9c9c9; background: #f3f3f3;'>".$item["Velikost fotoobrazu"]."</td>";
                            echo "<td style='border-bottom: 1px solid #c9c9c9; background: #f3f3f3;'>-</td>";
                            echo "<td style='border-bottom: 1px solid #c9c9c9; background: #f3f3f3;'>".$item["Typ"]."</td>";
                            break;
                            }

                            else 
                                echo "<td style='border-bottom: 1px solid #c9c9c9; background: #f3f3f3;'>".
                                ($jedna_polozka == "Žádná deska" ? "-" : $jedna_polozka)."</td>";    
            
                      //  $k++;
                        
                    
                            
                            
                        } 
                    } 
                    
                    ?>
                    <td style="background: #f3f3f3; text-align:left; vertical-align:middle; border-bottom: 1px solid #c9c9c9; border-bottom: 1px solid #c9c9c9;"><?php echo $item['qty']; ?></td>
			        <td style="background: #f3f3f3; text-align:left; vertical-align:middle; border-bottom: 1px solid #c9c9c9;"><?php echo $order->get_formatted_line_subtotal( $item ); ?></td>
                </tr>
			
			

		<?php
	// echo "<pre>",print_r($item),"</pre>";	
    }

	if ( $show_purchase_note && is_object( $_product ) && ( $purchase_note = get_post_meta( $_product->id, '_purchase_note', true ) ) ) : ?>

	<?php endif; ?>

<?php endforeach; ?>
<?php 

$totals = $order->get_order_item_totals()
?>
    <tr>
        <td style="border-bottom: 1px solid #c9c9c9;border-top: 3px solid #c9c9c9; background:#fafafa; padding-top:30px;">
            <strong>Mezisoučet</strong>
        </td>
         <td colspan="6" style="border-bottom: 1px solid #c9c9c9; border-top: 3px solid #c9c9c9; background:#fafafa; text-align:right;">
             <?php echo $totals["cart_subtotal"]["value"]; ?>
        </td>
    </tr>
    <tr>
        <td style="border-bottom: 1px solid #c9c9c9; background:#fafafa;">
            <strong>Doručení</strong>
        </td>
         <td colspan="6" style="border-bottom: 1px solid #c9c9c9; text-align:right; background:#fafafa;">
             <?php echo $totals["shipping"]["value"]; ?>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="border-bottom: 1px solid #c9c9c9; background:#fafafa;"><strong>Platební metoda</strong></td>
        <td colspan="6" style="border-bottom: 1px solid #c9c9c9; text-align:right; background:#fafafa;"><?php echo $totals["payment_method"]["value"]; ?></td>
    </tr>
    <tr>
        <td colspan="2" style="border-bottom: 1px solid #c9c9c9; background:#f8edff;"><strong>Cena celkem</strong></td>
     <td colspan="6" style="border-bottom: 1px solid #c9c9c9; background:#f8edff; text-align:right;"><?php echo $totals["order_total"]["value"]; ?></td>
    </tr>
    
</table>
