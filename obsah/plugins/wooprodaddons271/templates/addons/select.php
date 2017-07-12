<?php
global $kolotoc;
$loop = 0;
$current_value = isset( $_POST['addon-' . sanitize_title( $addon['field-name'] ) ] ) ? $_POST[ 'addon-' . sanitize_title( $addon['field-name'] ) ] : '';
global $wpdb;
$results = $wpdb->get_results( 'SELECT * FROM tskf_postmeta WHERE meta_key like "ceny_produktu"', OBJECT );

$addon["vlastni_ceny"] = unserialize($results[0]->meta_value);
//echo "<pre>",print_r($addon),"</pre>";
//Přidané
/*
$current_value = array();

foreach ($_POST['addon-' . sanitize_title($addon['field-name'] ) ] as $post_jeden)
    $current_value = $post_jeden;
*/
//KONEC!

?>
<script>
//ZMĚNA INPUTŮ

jQuery( document ).ready(function() {
    var vysledek = "";

    jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-vyber-fotopapiru .chosen-container").addClass("chosen-disabled");
    jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material-pro-velke-formaty").hide();
    jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-velikost-fotoobrazu").hide();
    jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material").show();
    jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material .chosen-container").addClass("chosen-disabled");
    jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-nalepit-na-desku .chosen-container").addClass("chosen-disabled");



    //zjištění formátu:

    jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-format select').change(function() {
        if(jQuery(".nastavit-celkem .product-addon-vlastni-format input").val() == ""){
        var selected = jQuery(':selected', this);
        vysledek = selected.parent().attr('label');
            // console.log("kk " + vysledek);
        //Zobrazení a skrytí inputů
        if( vysledek == "Velké formáty"){

            //RESET ZADANÝCH HODNOT
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material select').prop('selectedIndex',0);
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-velikost-fotoobrazu select').prop('selectedIndex',0);
            //UPDATE RESETOVANÝCH INPUTŮ
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-velikost-fotoobrazu select').trigger("chosen:updated");
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material select').trigger("chosen:updated");
            //NASTAVENÍ VIDITELNOSTI
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-vyber-fotopapiru .chosen-container").removeClass("chosen-disabled");
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material-pro-velke-formaty").hide();
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material").show();
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material .chosen-container").addClass("chosen-disabled");
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-velikost-fotoobrazu").hide();
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-nalepit-na-desku .chosen-container").removeClass("chosen-disabled");
            //RESET ZELENÉ PRO LESKLÝ FOTOPAPÍR
            jQuery(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-material" ).find( "a.chosen-single" ).css( "background", "transparent", "important" );
            jQuery(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-material" ).find( "a.chosen-single" ).css( "color", "#999", "important" );
            jQuery(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-material" ).find( "span" ).removeClass( "vyborna" );
            //NASTAVENÍ POMLČEK PŘI NEVYPLNĚNÍ
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-nalepit-na-desku select").val("zadna-deska-3");
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-nalepit-na-desku select').trigger("chosen:updated");


        }
        else if(vysledek == "Obraz na plátně"){
            //RESET ZADANÝCH HODNOT
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material select').prop('selectedIndex',0);
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-vyber-fotopapiru select').prop('selectedIndex',0);
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-nalepit-na-desku select').prop('selectedIndex',0);                          //UPDATE RESETOVANÝCH INPUTŮ
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material select').trigger("chosen:updated");
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-vyber-fotopapiru select').trigger("chosen:updated");
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-nalepit-na-desku select').trigger("chosen:updated");
            //NASTAVENÍ POMLČEK PŘI NEVYPLNĚNÍ
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-nalepit-na-desku select").val("zadna-deska-3");
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-nalepit-na-desku select').trigger("chosen:updated");

            //NASTAVENÍ VIDITELNOSTI
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-vyber-fotopapiru select').trigger("chosen:updated");
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-vyber-fotopapiru .chosen-container").addClass("chosen-disabled");
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-velikost-fotoobrazu").show();
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material-pro-velke-formaty").hide();
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material").hide();
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-nalepit-na-desku .chosen-container").addClass("chosen-disabled");

        }
        else if(vysledek == "Fotografie"){
            //RESET ZADANÝCH HODNOT
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-velikost-fotoobrazu select').prop('selectedIndex',0);
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-vyber-fotopapiru select').prop('selectedIndex',0);
            //UPDATE RESETOVANÝCH INPUTŮ
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-velikost-fotoobrazu select').trigger("chosen:updated");
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-vyber-fotopapiru select').trigger("chosen:updated");
            //NASTAVENÍ VIDITELNOSTI
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-vyber-fotopapiru .chosen-container").addClass("chosen-disabled");
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-velikost-fotoobrazu").hide();
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material-pro-velke-formaty").hide();
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material").show();
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material .chosen-container").removeClass("chosen-disabled");
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-nalepit-na-desku").show();
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-nalepit-na-desku .chosen-container").removeClass("chosen-disabled");
            //NASTAVENÍ LESKLÉHO FOTOPAPÍRU
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material select").val("leskly-fotopapir-1");
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material select').trigger("chosen:updated");
            jQuery("#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-material" ).find( "a.chosen-single" ).css( "background", "#8BC34A", "important" );
            jQuery("#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-material" ).find( "a.chosen-single" ).css( "color", "#8BC34A", "important" );
            jQuery("#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-material" ).find( "span" ).addClass( "vyborna" );
            //NASTAVENÍ POMLČEK PŘI NEVYPLNĚNÍ
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-nalepit-na-desku select").val("zadna-deska-3");
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-nalepit-na-desku select').trigger("chosen:updated");



        }
        //nic nenení zakliknuto
        else{
            //RESET ZADANÝCH HODNOT
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-velikost-fotoobrazu select').prop('selectedIndex',0);
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-vyber-fotopapiru select').prop('selectedIndex',0);
            //jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material select').prop('selectedIndex',0);
            //UPDATE RESETOVANÝCH INPUTŮ
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-velikost-fotoobrazu select').trigger("chosen:updated");
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-vyber-fotopapiru select').trigger("chosen:updated");
            //jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material select').trigger("chosen:updated");
            //NASTAVENÍ VIDITELNOSTI
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-vyber-fotopapiru select').prop('selectedIndex',0);
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-vyber-fotopapiru select').trigger("chosen:updated");
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-vyber-fotopapiru .chosen-container").addClass("chosen-disabled");
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material-pro-velke-formaty").hide();
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-velikost-fotoobrazu").hide();
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material").show();
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material .chosen-container").addClass("chosen-disabled");
            jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-nalepit-na-desku .chosen-container").addClass("chosen-disabled");
        }


        //Zobrazení a skrytí inputů hromadného nastavení
            //nově v nastavení fotek
        }
    });



});

</script>

<p class="form-row form-row-wide addon-wrap-<?php echo sanitize_title( $addon['field-name'] ); ?> fotka-<?php echo $kolotoc; ?>">
	<select class="addon addon-select chosen-select select-fotka-<?php echo $kolotoc; ?>" name="addon-<?php echo sanitize_title( $addon['field-name'] ); ?>">

		<?php if ( ! isset( $addon['required'] ) ) : ?>
			<option value=""><?php _e('None', 'woocommerce-product-addons'); ?></option>
		<?php else : ?>
			<option value=""><?php echo $addon["name"]; ?></option>
		<?php endif; ?>
        
		<?php foreach ( $addon['options'] as $option ) :
			$loop ++;
			$price = $option['price'] > 0 ? ' (' . woocommerce_price( get_product_addon_price_for_display( $option['price'] ) ) . ')' : '';
			?>
            <?php if(($option["label"] == "Fotografie") || ($option["label"] == "Obraz na plátně") || ($option["label"] == "Velké formáty") || ($option["label"] == "Ostatní") )  : ?>
                <optgroup label="<?php echo $option["label"]; ?>">
            <?php else : ?>
			<option data-price="<?php echo get_product_addon_price_for_display( $option['price'] ); ?>" value="<?php echo sanitize_title( $option['label'] ) . '-' . $loop; ?>" <?php selected( $current_value, sanitize_title( $option['label'] ) . '-' . $loop ); ?>><?php echo wptexturize( $option['label'] ) ?>
            </option>
                    <?php if($option["label"] == "15x23" || $option["label"] == "Fotoobraz" || $option["label"] == "A2") {?>
                </optgroup>
        <?php } ?>
            <?php endif; ?>
		<?php endforeach; ?>

	</select>
</p>