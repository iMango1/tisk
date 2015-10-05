<?php
global $kolotoc;
session_start();

/**
 * Product quantity inputs
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>

<div class="col-md-1 pocet-tlacitka">
    
    <div class="left add-items pridat"><a href="#"><i class="fa fa-plus"></i></a></div>
    
    <div class="left">
        <input type="text" class="items-num" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php _ex( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) ?>" size="4" />
    </div>
    
    <div class="left add-items odebrat"><a href="#"><i class="fa fa-minus"></i></a></div>
  
</div>
<div class="col-md-1 blok-tlacitka-cena">
    <div class="col-md-6 ikony-druhy-krok">
        <div class="duplikace-tlacitko"  onclick="duplikace('cely-produkt-fotka-<?php echo $kolotoc; ?>')">
            <i class="fa fa-files-o"></i>
        </div>
     <!--   <div class="vymazani-tlacitko" onClick="removeElement('cely-produkt-<?php echo $kolotoc; ?>');"> -->
        <div class="vymazani-tlacitko vymazat-produkt-<?php echo $kolotoc; ?>">
            <i class="fa fa-trash-o"></i>
        </div>
    </div>
    <div class="col-md-6 cena-fotky cena-fotka-<?php echo $kolotoc; ?>" id="cena-<?php echo $kolotoc; ?>" data-soucasna-cena="0.00">
        <span>0.00</span>
    </div>
</div>
</div> <!-- Ukončení pole-blok -->
