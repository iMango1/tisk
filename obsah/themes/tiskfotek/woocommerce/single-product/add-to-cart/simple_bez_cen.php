<?php
session_start();
global $kolotoc;
global $vsechny_nahrane_fotky;
global $wpdb;
$results = $wpdb->get_results( 'SELECT * FROM tskf_postmeta WHERE meta_key like "ceny_produktu"', OBJECT );

$_SESSION["vlastni_ceny"] = unserialize($results[0]->meta_value);
$parametry = unserialize($results[0]->meta_value);

$v = $wpdb->get_results( 'SELECT * FROM tskf_postmeta WHERE meta_key like "ceny_desky"', OBJECT );

$_SESSION["desky_ceny"] = unserialize($v[0]->meta_value);
$desky_ceny = unserialize($v[0]->meta_value);


// echo "<pre>",print_r($_SESSION["vlastni_ceny"]),"</pre>";

if(!function_exists("dalsi_klic")) {
    function dalsi_klic($pole,$searchkey) {
        $nextkey = false; 
        $foundit = false; 
        foreach($pole as $key => $value) { 
            if ($foundit) {
                $nextkey = $key; break;
            } 
            if ($key == $searchkey){
                $foundit = true;
            }
        } 
        return $nextkey; 
    }
}
?>

<script>
jQuery( document ).ready(function() {

    jQuery(".product-addon-nalepit-na-desku .chosen-container .chosen-results li:first-child").remove();
    jQuery(".product-addon-nalepit-na-desku select option[value='']").remove();

    var zakladni_cena = 0;
    var nova_cena = 0;
    var cena_bez_mnozstvi = 0;
    var cena_s_mnozstvim = 0;
    var celkem = 0.00;
    var cena_za_desku;
    var pusa = 0;
            
    //PŘI ZMĚNĚ SELECTU
    //jQuery(".select-fotka-<?php echo $kolotoc; ?>").change(function() {
    jQuery(document).on("change", ".select-fotka-<?php echo $kolotoc; ?>", function(){
        //pusa = 1;
   
        if(pusa == 1){
            
            
            var fotoobraz = jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-velikost-fotoobrazu select").val(); 
            if(fotoobraz != ""){
            var fotoobraz_cena = jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-velikost-fotoobrazu select option:selected").data("price");
            
            nova_cena = fotoobraz_cena;
            
            jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
            jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
            }
        }
        
        
        if(pusa == 0){
   /* zak        console.log("pusa: " + pusa); */
      //  nova_cena = zakladni_cena;
        nova_cena = 0;
        var vybr, deska, format, format_label;
        
        deska = jQuery('#fotka-<?php echo $kolotoc; ?> .product-addon-nalepit-na-desku select option:selected').val();
            /* zak console.log("deskoid: " + deska); */
        

            
        jQuery('.select-fotka-<?php echo $kolotoc; ?> option:selected').each(function() {
        
            
            
            format = jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-format select").val();
            
            var fotoobraz = jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-velikost-fotoobrazu select").val(); 
            var fotoobraz_cena = jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-velikost-fotoobrazu select option:selected").data("price");
            
            var format_vybr = jQuery(this);
            
            

            format_label = format_vybr.parent().attr('label');
            
  /* zak          console.log("čapkoid: "+format+" asd: "+format_label); */
            
            if(format_label == "Fotografie" || format_label == "Obraz na plátně" || fotoobraz != ""){

//console.error(jQuery(this).data("price"));
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-vyber-fotopapiru select').prop('selectedIndex',0);
                
            
            if( jQuery(this).data('price') == null ){
                nova_cena = nova_cena;
                if(fotoobraz_cena != ""){
                    nova_cena = fotoobraz_cena;
          
                }
            }
            else if (!(jQuery(this).data('price'))){
                nova_cena = nova_cena;
                if(fotoobraz_cena != ""){
                    nova_cena = fotoobraz_cena;
       
                    alert(fotoobraz);
                    jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
                    jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
   /* zak                 console.log("select: "+nova_cena+", "+format_label + ", deska: " + deska);  */
                }
                    
            }
            else{
             //   alert("popokatepetl"+nova_cena);
                nova_cena += jQuery(this).data('price');
                cena_bez_mnozstvi = nova_cena;
                var deska = jQuery('.addon-wrap-3032-nalepit-na-desku .select-fotka-<?php echo $kolotoc; ?>').val();
                if(deska == "zadna-deska-3"){
                    nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();    
                    
                    jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
                    jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
        /* zak            console.log("select: "+nova_cena+", "+format_label + ", deska: " + deska);   */
                }
               
            }
        
                
   /* zak         console.log("excuse me: " + nova_cena); */

                
            }
            
        });
    //    if(vybr != "deska-rayboard-5mm-1" && vybr != "deska-rayboard-10mm-2" && vybr != "zadna-deska-3"){
 /*       jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
        jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));*/
        
    //   }
        }
    });
    
    jQuery(document).on("click", ".form-row.fotka-<?php echo $kolotoc; ?>", function(){
        pusa = 0;
        //console.log("pusa: " + pusa);
    });
    

    //VÝCHOZÍ HODNOTA VÝCHOZÍHO FORMÁTU
    jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-format").show();
    jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format").hide();
    jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-format select').change(function() {
        var selected = jQuery(this).val();
        //PŘI VÝBĚRU VLASNTÍHO FORMÁTU
        if(selected == "vlastni-rozmery-21"){
            jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-format select').val(jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-format select option:first").val());
            jQuery('.addon-wrap-3032-format .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
            //ZOBRAZENÍ INPUTU
            jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-format").hide();
            jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format input").attr("placeholder", "Napište zde váš rozměr");
            jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format").show();
            jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format").é;
            
            //PO KLIKNUTÍ NA KŘÍŽEK
            jQuery('#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format').on('click','.fa' ,function(){
            //jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format .fa").click(function(){
                //ZMĚNA NA VÝCHOZÍ HODNOTU
                jQuery("#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-format").find( "a.chosen-single" ).css( "background", "");
                jQuery("#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-format").find( "a.chosen-single" ).css( "color", "");
                jQuery("#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-format").find( "span" ).removeClass( "vyborna" ); 
                //ODZELENĚNÍ INPUTU
                jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format input").css( "background", "");
                jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format input").css( "color", "");
                jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format input").removeClass( "vyborna" ); 
                //ZOBRAZENÍ FORMÁTU A SKRYTÍ VLASTNÍHO
                jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-format").show();
                jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format").hide();
                jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-format select').val(jQuery("#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-format select option:first").val());
                jQuery('.addon-wrap-3032-format .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                //VYMAZÁNÍ INPUTU
                jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format input").val("");
                
                
                jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-velikost-fotoobrazu select').prop('selectedIndex',0);
                jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-vyber-fotopapiru select').prop('selectedIndex',0);
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

            });
            
        }   
    });
    //ZOBRAZENÍ SELECTŮ PODLE ROZMĚRU
    
    jQuery('#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format input').focusout(function() {
        //ZELENÁ
        jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format input").css( "background", "#8BC34A", "important" );
        jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format input").css( "color", "#8BC34A", "important" );
        jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format input").addClass( "vyborna" );
        //PARSOVÁNÍ
        var zadane_neosetrene = jQuery(this).val().replace(',', '.');
        var zadane = zadane_neosetrene.toLowerCase();
        var pole_zadane = zadane.split("x");
        var sirka = parseFloat(pole_zadane[0]);
        var vyska = parseFloat(pole_zadane[1]);
        var typ;
   /* zak     console.log(sirka+"x"+vyska); */
      //  jQuery('#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format input').val(sirka+"x"+vyska);
        //ROZDĚLENÍ
        if(sirka >= 20)
            typ = "velke";
        else
            typ = "fotografie";
        //ZOBRAZENÍ INPUTŮ
        if(typ == "fotografie"){
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
        if(typ == "velke"){
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

        //KVALITA V ADDON-END
    });
    


    
     /*
    jQuery(".nastavit-hromadne").click(function(){
        var zakladni_cena = 0;
        var nova_cena = 0
        nova_cena = zakladni_cena;
        
        jQuery('.select-fotka-<?php echo $kolotoc; ?> option:selected').each(function() {
            if( jQuery(this).data('price') == null ){
                nova_cena = nova_cena;
            }
            else if (!(jQuery(this).data('price'))){
                nova_cena = nova_cena;
            }
            else{
                nova_cena += jQuery(this).data('price');
            }
        });
        
        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
        jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
        jQuery('.cenovka_k_secteni-<?php echo $kolotoc; ?>').html(nova_cena.toFixed(2));
        
    });

    
    
    */
        
    //PŘI ZMĚNĚ POČTU NAPSÁNÍM
    jQuery("#formular-<?php echo $kolotoc; ?> .items-num").change(function() {
        nova_cena = cena_bez_mnozstvi * jQuery(this).val();
        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
        jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
    });
    
    //PŘI ZMĚNĚ KLIKNUTÍM NA PLUSKO
    jQuery("#formular-<?php echo $kolotoc;?> .pocet-tlacitka .pridat").click(function(){
       var stara_hodnota = jQuery("#formular-<?php  echo $kolotoc; ?> .items-num").val();
        var nova_hodnota = parseInt(stara_hodnota) + 1;
        jQuery("#formular-<?php  echo $kolotoc; ?> .items-num").val(nova_hodnota);

        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php  echo $kolotoc; ?> .items-num").val();
        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
        jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
    });   
    //PŘI ZMĚNĚ KLIKNUTÍM NA MINUS
    jQuery("#formular-<?php echo $kolotoc;?> .pocet-tlacitka .odebrat").click(function(){
        var stara_hodnota = jQuery("#formular-<?php  echo $kolotoc; ?> .items-num").val();
        if(stara_hodnota>1){
            var nova_hodnota = parseInt(stara_hodnota) - 1;
            jQuery("#formular-<?php  echo $kolotoc; ?> .items-num").val(nova_hodnota);
            nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php  echo $kolotoc; ?> .items-num").val();
            jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
            jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
        }

    }); 
    jQuery(document).on('change','addon-wrap-3032-velikost-fotoobrazu',function () {
    
            jQuery(".addon-wrap-3032-nalepit-na-desku .chosen-container").addClass("chosen-disabled");
            alert("as");
        });
        
 
    });

    
jQuery(function(){
    

    
    jQuery(".nastavit-hromadne").click(function(){
        jQuery(".pokracovat").removeClass("disabled");

    });
});
</script>
<script>
function removeElement(childDiv){
 /*    if (childDiv == parentDiv) {
          alert("Fotka nemůže být odebrána.");
     }
     else if (document.getElementById(childDiv)) {     
          var child = document.getElementById(childDiv);
          var parent = document.getElementById(parentDiv);
          parent.removeChild(child);
     }
     else {
          alert("Fotka již byla odebrána nebo neexistuje.");
          return false;
     }
    
    
    var node = document.getElementById(childDiv);
    if (node.parentNode) {
        node.parentNode.removeChild(node);
    }
    */
}
    

    
</script>
<script>
function duplikace(keZkopirovani){
    var itm = document.getElementById(keZkopirovani);
    var cln = itm.cloneNode(true);
    document.getElementById("tabulka-fotek").appendChild(cln);
}    
</script>








<?php
/**
 * Simple product add to cart
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */



if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

?>


<script>
  jQuery(function() {
   
    jQuery( ".vymazat-produkt-<?php echo $kolotoc; ?>" ).click(function() {
        
        jQuery( "#cely-produkt-fotka-<?php echo $kolotoc; ?>" ).remove();
    }); 
});
</script>
<?php
	// Availability
	$availability      = $product->get_availability();
	$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';

	echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

    <?php $fotky = $_POST["fotky"]; ?>
    
    <form class="cart product-block" id="formular-<?php echo $kolotoc; ?>" method="post" enctype='multipart/form-data'>
        <input type="hidden" class="cena_fotopapir" name="cena_fotopapir" value="">
        <input type="hidden" class="cena_deska" name="cena_deska" value="">
        <?php //foreach($fotky as $kolotoc => $fotka){ ?>
      
	 	<?php 

            do_action( 'woocommerce_before_add_to_cart_button' ); ?>
            
	 	<?php
	 		if ( ! $product->is_sold_individually() )
	 			woocommerce_quantity_input( array(
	 				'min_value' => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
	 				'max_value' => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product )
	 			) );
	 	?>


	 	

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

        <?php// } ?>        	 	
        <input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />

        <?php $url = htmlspecialchars($_SERVER['HTTP_REFERER']); ?>
<!--        <a  href="<?php echo $url; ?>" class="predchozi btn btn-large main-bg pull-left">Předchozí krok</a>
        
        <button type="submit" class="single_add_to_cart_button btn btn-large add-cart main-bg pull-right"><?php echo $product->single_add_to_cart_text(); ?></button>
      -->
	</form>
    <?php //$vsechny_nahrane_fotky = $_SESSION; 
    //    print_r($vsechny_nahrane_fotky);
    ?>
	<?php //do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
