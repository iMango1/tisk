<?php
global $kolotoc;
global $pizza;
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
    
    <div class="left add-items pridat" style="cursor:pointer;"><a><i class="fa fa-plus"></i></a></div>
    
    <div class="left">
        <input type="text" class="items-num" name="<?php echo esc_attr( $input_name ); ?>" value="<?php echo esc_attr( $input_value ); ?>" title="<?php _ex( 'Qty', 'Product quantity input tooltip', 'woocommerce' ) ?>" size="4" />
    </div>
    
    <div class="left add-items odebrat" style="cursor:pointer;"><a><i class="fa fa-minus"></i></a></div>
  
</div>
<script>
jQuery(document).ready(function(){
    jQuery(".shop_table.cart .fotka-<?php echo $pizza; ?> .pocet-tlacitka .pridat").click(function(){
       var stara_hodnota = jQuery(".fotka-<?php echo $pizza; ?> .items-num").val();
        var nova_hodnota = parseInt(stara_hodnota) + 1;
        jQuery(".fotka-<?php echo $pizza; ?> .items-num").val(nova_hodnota);
    });   
    //PŘI ZMĚNĚ KLIKNUTÍM NA MINUS
    jQuery(".shop_table.cart .fotka-<?php echo $pizza; ?> .pocet-tlacitka .odebrat").click(function(){
        var stara_hodnota = jQuery(".fotka-<?php echo $pizza; ?> .items-num").val();
        if(stara_hodnota>1){
            var nova_hodnota = parseInt(stara_hodnota) - 1;
            jQuery(".fotka-<?php echo $pizza; ?> .items-num").val(nova_hodnota);
        }

    }); 
});
</script>
<div class="col-md-1 blok-tlacitka-cena">
    <div class="col-md-6 ikony-druhy-krok">
    <!--    <div class="duplikace-tlacitko disabled"  onclick="duplikace('cely-produkt-fotka-<?php echo $kolotoc; ?>')">-->
           <div class="duplikace-tlacitko" style="cursor:default;">
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
