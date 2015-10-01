<script>
jQuery( document ).ready(function() {
    jQuery(".chosen-select").chosen({"disable_search": true});
});
</script>
<script>
function sticky_relocate() {
    var window_top = jQuery(window).scrollTop();
    var div_top = jQuery('#sticky-anchor').offset().top;
    if (window_top > div_top) {
        jQuery('.kroky-nastaveni-blok').addClass('stick');
    } else {
        jQuery('.kroky-nastaveni-blok').removeClass('stick');
    }
}


jQuery(function () {
    jQuery(window).scroll(sticky_relocate);
    sticky_relocate();
});


jQuery( document ).ready(function() {   
    var vysledek = "";
    jQuery('.nastavit-celkem .format select').val(function() {
        jQuery(".nastavit-celkem .vyber-fotopapiru .chosen-container").addClass("chosen-disabled");
        jQuery(".nastavit-celkem .material-pro-vyber-fotopapiru").hide();
        jQuery(".nastavit-celkem .velikost-fotoobrazu").hide();
        jQuery(".nastavit-celkem .material").show();
        jQuery(".nastavit-celkem .material .chosen-container").addClass("chosen-disabled");
        jQuery(".nastavit-celkem .nalepit-na-desku .chosen-container.chosen-container-single.chosen-container-single-nosearch").addClass("chosen-disabled");
    });
    //zjištění formátu:
    jQuery('.nastavit-celkem .format select').change(function() {
        var selected = jQuery(':selected', this);
        vysledek = selected.parent().attr('label');
        if( vysledek == "Velké formáty"){
            jQuery(".nastavit-celkem .vyber-fotopapiru .chosen-container").removeClass("chosen-disabled");
            jQuery(".nastavit-celkem .material-pro-vyber-fotopapiru").hide();
            jQuery(".nastavit-celkem .material").show();
            jQuery(".nastavit-celkem .material .chosen-container").addClass("chosen-disabled");
            jQuery(".nastavit-celkem .velikost-fotoobrazu").hide();
            jQuery(".nastavit-celkem .nalepit-na-desku .chosen-container").removeClass("chosen-disabled");
        }
        else if(vysledek == "Obraz na plátně"){
            jQuery(".nastavit-celkem .vyber-fotopapiru .chosen-container").addClass("chosen-disabled");
            jQuery(".nastavit-celkem .velikost-fotoobrazu").show();
            jQuery(".nastavit-celkem .material-pro-vyber-fotopapiru").hide();
            jQuery(".nastavit-celkem .material").hide();
            jQuery(".nastavit-celkem .nalepit-na-desku .chosen-container").addClass("chosen-disabled");
        }
        else if(vysledek == "Fotografie"){
            jQuery(".nastavit-celkem .vyber-fotopapiru .chosen-container").addClass("chosen-disabled");
            jQuery(".nastavit-celkem .velikost-fotoobrazu").hide();
            jQuery(".nastavit-celkem .material-pro-vyber-fotopapiru").hide();
            jQuery(".nastavit-celkem .material").show();
            jQuery(".nastavit-celkem .material .chosen-container").removeClass("chosen-disabled");
            jQuery(".nastavit-celkem .nalepit-na-desku").show();
            jQuery(".nastavit-celkem .nalepit-na-desku .chosen-container").removeClass("chosen-disabled");
        }
        //nic není zakliknuto
        else {
            jQuery(".nastavit-celkem .vyber-fotopapiru .chosen-container").addClass("chosen-disabled");
            jQuery(".nastavit-celkem .material-pro-vyber-fotopapiru").hide();
            jQuery(".nastavit-celkem .velikost-fotoobrazu").hide();
            jQuery(".nastavit-celkem .material").show();
            jQuery(".nastavit-celkem .material .chosen-container").addClass("chosen-disabled");
            jQuery(".nastavit-celkem .nalepit-na-desku .chosen-container.chosen-container-single.chosen-container-single-nosearch").addClass("chosen-disabled");
        }
    });    
});
</script>

<script>
    //Nastavit hromadně - Formát
    jQuery(function(){
        jQuery(".nastavit-hromadne").click(function(){
            jQuery('.addon-wrap-3032-format select.addon-select').val( jQuery('.nastavit-celkem .addon-3032-format').val() );  
            jQuery('.addon-wrap-3032-format select.addon-select').trigger("chosen:updated");
        })
	});
    
    //Nastavit hromadně - Velké formáty
    jQuery(function(){
        jQuery(".nastavit-hromadne").click(function(){
            jQuery('.addon-wrap-3032-vyber-fotopapiru select.addon-select').val( jQuery('.nastavit-celkem .addon-3032-vyber-fotopapiru').val() );  
            jQuery('.addon-wrap-3032-vyber-fotopapiru select.addon-select').trigger("chosen:updated");
        })
	});
    
    //Nastavit hromadně - Material
    jQuery(function(){
        jQuery(".nastavit-hromadne").click(function(){

            jQuery('.addon-wrap-3032-material select.addon-select').val( jQuery('.nastavit-celkem .addon-3032-material').val() );  
            jQuery('.addon-wrap-3032-material select.addon-select').trigger("chosen:updated");
            
        })
	});

    //Nastavit hromadně - Material pro fotoobrazy
    jQuery(function(){
        jQuery(".nastavit-hromadne").click(function(){
            jQuery('.addon-wrap-3032-velikost-fotoobrazu select.addon-select').val( jQuery('.nastavit-celkem .addon-3032-velikost-fotoobrazu').val() );  
            jQuery('.addon-wrap-3032-velikost-fotoobrazu select.addon-select').trigger("chosen:updated");
        })
	});
    //Nastavit hromadně - Material pro velké formáty
    jQuery(function(){
        jQuery(".nastavit-hromadne").click(function(){
            jQuery('.addon-wrap-3032-material-pro-vyber-fotopapiru select.addon-select').val( jQuery('.nastavit-celkem .addon-3032-material-pro-vyber-fotopapiru').val() );  
            jQuery('.addon-wrap-3032-material-pro-vyber-fotopapiru select.addon-select').trigger("chosen:updated");
        })
	});
    //deska
    jQuery(function(){
        jQuery(".nastavit-hromadne").click(function(){
            jQuery('.addon-wrap-3032-nalepit-na-desku select.addon-select').val( jQuery('.nastavit-celkem .addon-3032-nalepit-na-desku').val() );  
            jQuery('.addon-wrap-3032-nalepit-na-desku select.addon-select').trigger("chosen:updated");
        })
	});
    //typ
    jQuery(function(){
        jQuery(".nastavit-hromadne").click(function(){
            jQuery('.addon-wrap-3032-typ select.addon-select').val( jQuery('.nastavit-celkem .addon-3032-typ').val() );  
            jQuery('.addon-wrap-3032-typ select.addon-select').trigger("chosen:updated");
        })
	});
//měnění inputů při hromadném nastavení
    
    jQuery(function(){
        jQuery(".nastavit-hromadne").click(function(){
                var vysledek = jQuery('.addon-wrap-3032-format select.addon-select :selected').val();
                //Zobrazení a skrytí inputů
                if( vysledek == "10x15-2" || vysledek == "13x18-3" || vysledek == "15x20-4" || vysledek == "15x21-5" || vysledek == "15x23-6"){
                    jQuery(".pole-blok .addon-wrap-3032-vyber-fotopapiru .chosen-container").addClass("chosen-disabled");
                    jQuery(".pole-blok .addon-wrap-3032-velikost-fotoobrazu").hide();
                    jQuery(".pole-blok .addon-wrap-3032-material-pro-vyber-fotopapiru").hide();
                    jQuery(".pole-blok .addon-wrap-3032-material").show();
                    jQuery(".pole-blok .addon-wrap-3032-material .chosen-container").removeClass("chosen-disabled");
                    jQuery(".pole-blok .addon-wrap-3032-nalepit-na-desku").show();
                    jQuery(".pole-blok .addon-wrap-3032-nalepit-na-desku .chosen-container").removeClass("chosen-disabled");
                    
                }
                if(vysledek == "fotoobraz-8"){
                    jQuery(".pole-blok .addon-wrap-3032-vyber-fotopapiru .chosen-container").addClass("chosen-disabled");
                    jQuery(".pole-blok .addon-wrap-3032-velikost-fotoobrazu").show();
                    jQuery(".pole-blok .addon-wrap-3032-material-pro-vyber-fotopapiru").hide();
                    jQuery(".pole-blok .addon-wrap-3032-material").hide();
                    jQuery(".pole-blok .addon-wrap-3032-nalepit-na-desku .chosen-container").addClass("chosen-disabled");
                }
                if(vysledek == "30x40-10" ||
                   vysledek == "40x50-11" ||
                   vysledek == "50x70-12" ||
                   vysledek == "60x40-13" ||
                   vysledek == "60x80-14" ||
                   vysledek == "70x100-15" ||
                   vysledek == "80x120-16" ||
                   vysledek == "a4-17" ||
                   vysledek == "a3-18" ||
                   vysledek == "a2-19"){
                    jQuery(".pole-blok .addon-wrap-3032-vyber-fotopapiru .chosen-container").removeClass("chosen-disabled");
                    jQuery(".nastavit-celkem .material-pro-vyber-fotopapiru").hide();
                    jQuery(".nastavit-celkem .material").show();
                    jQuery(".nastavit-celkem .material .chosen-container").addClass("chosen-disabled");
                    jQuery(".pole-blok .addon-wrap-3032-velikost-fotoobrazu").hide();
                    jQuery(".pole-blok .addon-wrap-3032-nalepit-na-desku .chosen-container").removeClass("chosen-disabled");
    
                }

        });
	});
    
</script>

<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

?>
       <!--
        <div id="sticky-anchor"></div>
        
        
        <div class="kroky-nastaveni-blok">
            <div class="kroky_blok">
		    <div class="krok jedna_upload aktivni"><a href="../../upload-fotografii"><span class="cislo">1</span> Upload fotografií</a></div>
            <div class="krok dva_upload aktivni"><a><span class="cislo">2</span> Nastavení parametrů tisku</a></div>
        </div>
            
            <div class="nastavit-celkem">
                <h3>Hromadné nastavení parametrů všech fotografií</h3>
                <div class="col-md-2 format">
                    <select class="addon addon-select chosen-select addon-3032-format" name="addon-3032-format" style="display: none;">

					<option value="">Formát</option>
		        
		                            <optgroup label="Fotografie">
            		            			<option data-price="5.9" value="10x15-2">10×15 (5.90&nbsp;Kč)</option>
                                		            			<option data-price="13.9" value="13x18-3">13×18 (13.90&nbsp;Kč)</option>
                                		            			<option data-price="17.9" value="15x20-4">15×20 (17.90&nbsp;Kč)</option>
                                		            			<option data-price="17.9" value="15x21-5">15×21 (17.90&nbsp;Kč)</option>
                                		            			<option data-price="19.9" value="15x23-6">15×23 (19.90&nbsp;Kč)</option>
                                    </optgroup>
                    		                            <optgroup label="Obraz na plátně">
            		            			<option data-price="549" value="fotoobraz-8">Fotoobraz (549.00&nbsp;Kč)</option>
                                    </optgroup>
                    		                            <optgroup label="Velké formáty">
            		            			<option data-price="1100" value="30x40-10">30×40 (1,100.00&nbsp;Kč)</option>
                                		            			<option data-price="" value="40x50-11">40×50</option>
                                		            			<option data-price="" value="50x70-12">50×70</option>
                                		            			<option data-price="" value="60x40-13">60×40</option>
                                		            			<option data-price="" value="60x80-14">60×80</option>
                                		            			<option data-price="" value="70x100-15">70×100</option>
                                		            			<option data-price="" value="80x120-16">80×120</option>
                                		            			<option data-price="" value="a4-17">A4</option>
                                		            			<option data-price="" value="a3-18">A3</option>
                                		            			<option data-price="" value="a2-19">A2</option>
                                    </optgroup>
                    		
	</select>
                </div>
                               <div class="col-md-2 vyber-fotopapiru">
                   <select class="addon addon-select chosen-select addon-3032-vyber-fotopapiru" name="addon-3032-vyber-fotopapiru" style="display: none;">

					<option value="">Velké formáty</option>
		        
		            			<option data-price="145" value="lesk-glacier-1">LESK – Glacier (145.00&nbsp;Kč)</option>
                                		            			<option data-price="116" value="lesk-omnijet-2">LESK – Omnijet (116.00&nbsp;Kč)</option>
                                		            			<option data-price="168" value="lesk-photo-baryt-3">LESK – Photo Baryt (168.00&nbsp;Kč)</option>
                                		            			<option data-price="125" value="lesk-premium-glossy-4">LESK – Premium Glossy (125.00&nbsp;Kč)</option>
                                		            			<option data-price="135" value="lesk-premium-luseter-5">LESK – Premium Luseter (135.00&nbsp;Kč)</option>
                                		            			<option data-price="154" value="lesk-smooth-gloss-6">LESK – Smooth Gloss (154.00&nbsp;Kč)</option>
                                		            			<option data-price="116" value="mat-enhanced-mate-7">MAT – Enhanced Mate (116.00&nbsp;Kč)</option>
                                		            			<option data-price="145" value="mat-matte-real-8">MAT – Matte Real (145.00&nbsp;Kč)</option>
                                		            			<option data-price="207" value="mat-velvet-fine-art-9">MAT – Velvet Fine Art (207.00&nbsp;Kč)</option>
                                		            			<option data-price="250" value="pouze-platno-lesk-satin-canvas-10">POUZE PLÁTNO – LESK Satin canvas (250.00&nbsp;Kč)</option>
                                		            			<option data-price="250" value="pouze-platno-mat-exclusive-bez-ramu-11">POUZE PLÁTNO – MAT Exclusive – bez rámu (250.00&nbsp;Kč)</option>
                                		
	</select>
                    
                </div>
                <div class="col-md-2">
                   <div class="material">
                    <select class="addon addon-select chosen-select addon-3032-material" name="addon-3032-material" style="display: none;">

					<option value="">Materiál</option>
		        
		            <option data-price="" value="leskly-fotopapir-1">Lesklý fotopapír</option>
                                		
                                		
	</select>
              </div>
              <div class="velikost-fotoobrazu">
               <select class="addon addon-select chosen-select addon-3032-velikost-fotoobrazu" name="addon-3032-velikost-fotoobrazu" style="display: none;">

					<option value="">Materiál pro Fotoobrazy</option>
		        
		            			<option data-price="" value="obraz-na-platne-na-ramu-30x40-lesk-1">Obraz na plátně na rámu – 30×40 LESK</option>
                                		            			<option data-price="" value="obraz-na-platne-na-ramu-30x40-mat-2">Obraz na plátně na rámu – 30×40 MAT</option>
                                		            			<option data-price="" value="obraz-na-platne-na-ramu-40x60-mat-3">Obraz na plátně na rámu – 40×60 MAT</option>
                                		            			<option data-price="" value="obraz-na-platne-na-ramu-40x80-mat-4">Obraz na plátně na rámu – 40×80 MAT</option>
                                		            			<option data-price="" value="obraz-na-platne-na-ramu-50x70-mat-5">Obraz na plátně na rámu – 50×70 MAT</option>
                                		            			<option data-price="" value="obraz-na-platne-na-ramu-60x120-mat-6">Obraz na plátně na rámu – 60×120 MAT</option>
                                		            			<option data-price="" value="obraz-na-platne-na-ramu-60x80-mat-7">Obraz na plátně na rámu – 60×80 MAT</option>
                                		            			<option data-price="" value="obraz-na-platne-na-ramu-80x120-mat-8">Obraz na plátně na rámu – 80×120 MAT</option>
                                		
	</select>
               </div>
               <div class="material-pro-vyber-fotopapiru">
               <select class="addon addon-select chosen-select addon-3032-material-pro-vyber-fotopapiru" name="addon-3032-material-pro-vyber-fotopapiru" style="display: none;">

					<option value="">Materiál pro velké formáty</option>
		        
		            			<option data-price="279" value="lesk-glacier-1">LESK – GLACIER (279.00&nbsp;Kč)</option>
                                		            			<option data-price="221" value="lesk-omnijet-2">LESK – OMNIJET (221.00&nbsp;Kč)</option>
                                		            			<option data-price="323" value="lesk-photo-baryt-3">LESK – Photo BARYT (323.00&nbsp;Kč)</option>
                                		            			<option data-price="" value="lesk-premium-glossy-4">LESK – Premium GLOSSY</option>
                                		            			<option data-price="" value="lesk-premium-luster-5">LESK – Premium LUSTER</option>
                                		            			<option data-price="" value="lesk-smooth-gloss-6">LESK – Smooth GLOSS</option>
                                		            			<option data-price="" value="mat-enhanced-matte-7">MAT – Enhanced MATTE</option>
                                		            			<option data-price="" value="mat-matte-real-8">MAT – Matte REAL</option>
                                		            			<option data-price="" value="mat-velvet-fine-art-9">MAT – Velvet FINE ART</option>
                                		            			<option data-price="" value="pouze-platno-lesk-satin-canvas-10">POUZE PLÁTNO – LESK SATIN CANVAS</option>
                                		            			<option data-price="" value="pouze-platno-mat-exclusive-bez-ramu-11">POUZE PLÁTNO – MAT EXCLUSIVE – bez rámu</option>
                                		
	</select>
               </div>
                </div>
                <div class="col-md-2 nalepit-na-desku">
                    <select class="addon addon-select chosen-select addon-3032-nalepit-na-desku" name="addon-3032-nalepit-na-desku" style="display: none;">

					<option value="">nalepit-na-desku</option>
		        
		            			<option data-price="27.17" value="nalepit-na-desku-rayboard-5mm-1">nalepit-na-desku Rayboard 5mm (27.17&nbsp;Kč)</option>
                                		            			<option data-price="39.2" value="nalepit-na-desku-rayboard-10mm-2">nalepit-na-desku Rayboard 10mm (39.20&nbsp;Kč)</option>
                                		
	</select>
                </div>
 
                <div class="col-md-2 typ">
                    <select class="addon addon-select chosen-select addon-3032-typ" name="addon-3032-typ" style="display: none;">

					<option value="">Typ</option>
		        
		            			<option data-price="10" value="orez-1">Ořez (10.00&nbsp;Kč)</option>
                                		            			<option data-price="" value="plny-format-2">Plný formát</option>
                                		
	                </select>
                </div>
                <div class="col-md-2 potvrzeni">
                    <a style="color:#fff" class="btn nastavit-hromadne">Nastavit</a>
                </div>
            </div>
        </div>
    
        
-->
<div class="product-specs price-block" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
    <?php if ( $price_html = $product->get_price_html() ) : ?>
    <!--
        <div class="price-box">
            <span class="product-price">
                <?php echo $product->get_price_html(); ?>
                <meta itemprop="price" content="<?php echo $product->get_price(); ?>" />
                <meta itemprop="priceCurrency" content="<?php echo get_woocommerce_currency(); ?>" />
            </span>
        </div>
    -->
       <?php else: ?>
       <div class="box error-box">No Price Added.</div>
    <?php endif; ?>
</div>