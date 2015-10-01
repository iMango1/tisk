<?php global $kolotoc; ?>
<?php foreach ( $addon['options'] as $key => $option ) :

	$price = ($option['price']>0) ? ' (' . woocommerce_price( get_product_addon_price_for_display( $option['price'] ) ) . ')' : '';

	if ( empty( $option['label'] ) ) : ?>

	<!--
		<p class="form-row form-row-wide addon-wrap-<?php// echo sanitize_title( $addon['field-name'] ); ?>">
			<input type="file" class="input-text addon" data-price="<?php// echo get_product_addon_price_for_display( $option['price'] ); ?>" name="addon-<?php//echo sanitize_title( $addon['field-name'] ); ?>-<?php //echo sanitize_title( $option['label'] ); ?>" /> <small><?php// echo sprintf( __( '(max file size %s)', 'woocommerce-product-addons' ), $max_size ) ?></small>
		</p>
	-->

	<?php else : ?>


<!--
		<p class="form-row form-row-wide addon-wrap-<?php //echo sanitize_title( $addon['field-name'] ); ?>">
			<label><?php// echo wptexturize( $option['label'] ) . ' ' . $price; ?> <input type="file" class="input-text addon" data-price="<?php// echo get_product_addon_price_for_display( $option['price'] ); ?>" name="addon-<?php// echo sanitize_title( $addon['field-name'] ); ?>-<?php// echo sanitize_title( $option['label'] ); ?>" /> <small><?php// echo sprintf( __( '(max file size %s)', 'woocommerce-product-addons' ), $max_size ) ?></small></label>
		</p>

-->

	<?php 
	/*
    $fotky = $_POST["fotky"];
  
    
    $fotka_kousek_url = array();
    $fotka_nazev = array();
 */

    $url_img = $_SESSION[$kolotoc]["url_fotky"];
    $url_min = $_SESSION[$kolotoc]["url_miniatura"];
    $url_up =  $_SESSION[$kolotoc]["url_fotky_upload"];
    
    $typ_souboru = $_SESSION[$kolotoc]["typ_souboru"];
    $nazev_slozky = $_SESSION[$kolotoc]["nazev_slozky"];
    $nazev_fotky = $_SESSION[$kolotoc]["nazev_fotky"];


    $fotka_kousek_url[$kolotoc] = explode("objednavky/", $url_img);
    $fotky_nazev[$kolotoc] = $fotka_kousek_url[$kolotoc][1];


    //foreach ($fotky as $i => $fotka) {
		echo "<img src='$url_min' style='margin-right: 10px' class='fotka_objednavka'>"; 
		echo "<input type='hidden' value='http://objednavky.skakaciatrakce.cz/".$fotky_nazev[$kolotoc]."' data-price='".get_product_addon_price_for_display( $option['price'] )."' name='fotky[]'>"; 
        echo "<input type='hidden' value='$url_up' data-price='".get_product_addon_price_for_display( $option['price'] )."' name='fotky_upload[]'>"; 

        echo "<input type='hidden' value='$kolotoc' name='cislo_f'>";

        echo "<input type='hidden' value='$nazev_fotky' name='nazev_f'>";

        echo "<input type='hidden' value='$typ_souboru' name='typ_s'>";
        
        echo "<input type='hidden' value='$nazev_slozky' name='nazev_s'>";


// $_SESSION[$kolotoc]["url_fotky_upload"];
    //    $fotka_kousek_url[$i] = explode("|/", $fotka);
//	    $fotky_nazev[$i] = $fotka_kousek_url[$i][1];

    //}
        

	?>


<?php

$loop = 0;
$current_value = isset( $_POST['addon-' . sanitize_title( $addon['field-name'] ) ] ) ? $_POST[ 'addon-' . sanitize_title( $addon['field-name'] ) ] : '';
?>









	<?php endif; ?>

    
<?php endforeach; ?>

