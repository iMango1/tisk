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
            
            jQuery(".nastavit-hromadne").click(function(){
                jQuery('.addon-wrap-3032-vyber-fotopapiru select.addon-select').trigger("chosen:updated");
                jQuery(  "div.product-addon.product-addon-vyber-fotopapiru" ).find( "a.chosen-single" ).css( "background", "#8BC34A", "important" );
                jQuery(  "div.product-addon.product-addon-vyber-fotopapiru" ).find( "a.chosen-single" ).css( "color", "#8BC34A", "important" );
                jQuery(  "div.product-addon.product-addon-vyber-fotopapiru" ).find( "span" ).addClass( "vyborna" );
            });
            
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
            
            jQuery(".pokracovat").removeClass("disabled");
            
            if(jQuery('.nastavit-celkem .product-addon-vlastni-format input').val() != ""){

                jQuery(".addon-wrap-3032-format").hide();
                jQuery(".product-addon.product-addon-vlastni-format input").attr("placeholder", "Napište zde váš rozměr");
                jQuery(".product-addon.product-addon-vlastni-format").show();
                jQuery(".product-addon.product-addon-vlastni-format").append('<i class="fa fa-times"></i>');
                
                jQuery(".product-addon.product-addon-vlastni-format input").val(jQuery('.nastavit-celkem .product-addon-vlastni-format input').val());
                
                jQuery(".product-addon-vlastni-format input").css( "background", "#8BC34A", "important" );
        jQuery(".product-addon-vlastni-format input").css( "color", "#8BC34A", "important" );
        jQuery(".product-addon-vlastni-format input").addClass( "vyborna" );
        //PARSOVÁNÍ
        var zadane_neosetrene = jQuery(this).val().replace(',', '.');
        if(jQuery(".nastavit-celkem .product-addon-vlastni-format input").val() != ""){
            zadane_neosetrene = jQuery(".nastavit-celkem .product-addon-vlastni-format input").val();
        }        
        var zadane = zadane_neosetrene.toLowerCase();
        var pole_zadane = zadane.split("x");
        var sirka = parseFloat(pole_zadane[0]);
        var vyska = parseFloat(pole_zadane[1]);
        var typ;
        //ROZDĚLENÍ
        if(sirka >= 20)
            typ = "velke";
        else
            typ = "fotografie";
        //ZOBRAZENÍ INPUTŮ
        if(typ == "fotografie"){
            //RESET ZADANÝCH HODNOT
            jQuery('.addon-wrap-3032-velikost-fotoobrazu select').prop('selectedIndex',0);
            jQuery('.addon-wrap-3032-vyber-fotopapiru select').prop('selectedIndex',0);
            //UPDATE RESETOVANÝCH INPUTŮ
            jQuery('.addon-wrap-3032-velikost-fotoobrazu select').trigger("chosen:updated");
            jQuery('.addon-wrap-3032-vyber-fotopapiru select').trigger("chosen:updated");
            //NASTAVENÍ VIDITELNOSTI
            jQuery(".addon-wrap-3032-vyber-fotopapiru .chosen-container").addClass("chosen-disabled");
            jQuery(".addon-wrap-3032-velikost-fotoobrazu").hide();
            jQuery(".addon-wrap-3032-material-pro-velke-formaty").hide();
            jQuery(".addon-wrap-3032-material").show();
            jQuery(".addon-wrap-3032-material .chosen-container").removeClass("chosen-disabled");
            jQuery(".addon-wrap-3032-nalepit-na-desku").show();
            jQuery(".addon-wrap-3032-nalepit-na-desku .chosen-container").removeClass("chosen-disabled");
            //NASTAVENÍ LESKLÉHO FOTOPAPÍRU
            jQuery(".addon-wrap-3032-material select").val("leskly-fotopapir-1");
            jQuery('.addon-wrap-3032-material select').trigger("chosen:updated");
            jQuery("div.product-addon.product-addon-material" ).find( "a.chosen-single" ).css( "background", "#8BC34A", "important" );
            jQuery("div.product-addon.product-addon-material" ).find( "a.chosen-single" ).css( "color", "#8BC34A", "important" );
            jQuery("div.product-addon.product-addon-material" ).find( "span" ).addClass( "vyborna" ); 
            //NASTAVIT POMLČKY
            jQuery(".addon-wrap-3032-nalepit-na-desku select").val("zadna-deska-3");
            jQuery('.addon-wrap-3032-nalepit-na-desku select').trigger("chosen:updated");        
        }
        if(typ == "velke"){

            //RESET ZADANÝCH HODNOT
            jQuery('.addon-wrap-3032-material select').prop('selectedIndex',0);
            jQuery('.addon-wrap-3032-velikost-fotoobrazu select').prop('selectedIndex',0);
            //UPDATE RESETOVANÝCH INPUTŮ
            jQuery('.addon-wrap-3032-velikost-fotoobrazu select').trigger("chosen:updated");
            jQuery('.addon-wrap-3032-material select').trigger("chosen:updated");
            //NASTAVENÍ VIDITELNOSTI
            jQuery(".addon-wrap-3032-vyber-fotopapiru .chosen-container").removeClass("chosen-disabled");
            jQuery(".addon-wrap-3032-material-pro-velke-formaty").hide();
            jQuery(".addon-wrap-3032-material").show();
            jQuery(".addon-wrap-3032-material .chosen-container").addClass("chosen-disabled");
            jQuery(".addon-wrap-3032-velikost-fotoobrazu").hide();
            jQuery(".addon-wrap-3032-nalepit-na-desku .chosen-container").removeClass("chosen-disabled");
            //RESET ZELENÉ PRO LESKLÝ FOTOPAPÍR
            jQuery(  "div.product-addon.product-addon-material" ).find( "a.chosen-single" ).css( "background", "transparent", "important" );
            jQuery(  "div.product-addon.product-addon-material" ).find( "a.chosen-single" ).css( "color", "#999", "important" );
            jQuery(  "div.product-addon.product-addon-material" ).find( "span" ).removeClass( "vyborna" ); 
            //NASTAVENÍ POMLČEK PŘI NEVYPLNĚNÍ
            jQuery(".addon-wrap-3032-nalepit-na-desku select").val("zadna-deska-3");
            jQuery('.addon-wrap-3032-nalepit-na-desku select').trigger("chosen:updated");
        } 
                
            }else{
                jQuery('.addon-wrap-3032-format select.addon-select').val( jQuery('.nastavit-celkem .addon-3032-format').val() );  
            }
            jQuery('.addon-wrap-3032-format select.addon-select').trigger("chosen:updated");
            jQuery('.addon-wrap-3032-format select.addon-select').change();

            
            
        });
	});
    
    //Nastavit hromadně - Velké formáty
    jQuery(function(){
        jQuery(".nastavit-hromadne").click(function(){
            jQuery('.addon-wrap-3032-vyber-fotopapiru select.addon-select').val( jQuery('.nastavit-celkem .addon-3032-vyber-fotopapiru').val() );  
            jQuery('.addon-wrap-3032-vyber-fotopapiru select.addon-select').trigger("chosen:updated");
            jQuery('.addon-wrap-3032-vyber-fotopapiru .chosen-container').trigger("chosen:updated");
            
            
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
            jQuery(  "div.product-addon.product-addon-velikost-fotoobrazu" ).find( "a.chosen-single" ).css( "background", "#8BC34A", "important" );
            jQuery(  "div.product-addon.product-addon-velikost-fotoobrazu" ).find( "a.chosen-single" ).css( "color", "#8BC34A", "important" );
            jQuery(  "div.product-addon.product-addon-velikost-fotoobrazu" ).find( "span" ).addClass( "vyborna" );
        })
	});
    //Nastavit hromadně - Material pro velké formáty
    jQuery(function(){
        jQuery(".nastavit-hromadne").click(function(){
            jQuery('.addon-wrap-3032-material-pro-vyber-fotopapiru select.addon-select').val( jQuery('.nastavit-celkem .addon-3032-material-pro-vyber-fotopapiru').val() );  
            jQuery('.addon-wrap-3032-material-pro-vyber-fotopapiru select.addon-select').trigger("chosen:updated");
        })
	});
    //deska - v nastavení fotek!
    jQuery(function(){
        jQuery(".nastavit-hromadne").click(function(){
            jQuery('.addon-wrap-3032-nalepit-na-desku select.addon-select').val( jQuery('.nastavit-celkem .nalepit-na-desku select').val() );  
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
     
<div class="product-specs price-block" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
    <?php if ( $price_html = $product->get_price_html() ) : ?>

       <?php else: ?>
       <div class="box error-box">No Price Added.</div>
    <?php endif; ?>
</div>