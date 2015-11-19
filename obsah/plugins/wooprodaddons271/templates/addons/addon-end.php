	<?php do_action( 'wc_product_addon_end', $addon ); ?>

	<div class="clear"></div>
    
    </div>

<?php if(($addon["field-name"] == "3032-nahled") || ($addon["field-name"] == "3032-vyber-fotopapiru") || ($addon["field-name"] == "3032-nalepit-na-desku")){ ?>
    </div>
<?php } ?>
<?php if(($addon["field-name"] == "3032-typ")){ 
//Deklarace fotky, ulozeni sirky a vysky do promennych
global $kolotoc;
$url_img = $_SESSION[$kolotoc]["url_fotky"];

$typ_souboru = pathinfo($url_img, PATHINFO_EXTENSION);

if($typ_souboru == "zip" || $typ_souboru == "rar"){
    $sizex=-1; 
    $sizey=-1; 

}
else{ 
    $image=new imagick($url_img);
    $geo=$image->getImageGeometry(); 

    $sizex=$geo['width']; 
    $sizey=$geo['height'];   
}
?>     
<script>
jQuery( document ).ready(function() {
    jQuery(".nastavit-hromadne").click(function(){
        jQuery('.addon-wrap-3032-format select.addon-select').change();
    });
});
    
    
jQuery( document ).ready(function() {
//Deklarace promenny pro JS
    var vysledek<?php echo $kolotoc; ?> = '';
    var fotkaS<?php echo $kolotoc; ?> = "<?php echo $sizex; ?>";
    var formatS<?php echo $kolotoc; ?> = '';
    var html = '<div class="kvalita neaktivni"> Kvalita fotografie<'+'/div>';
 
//zjištění formátu:   
jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-format select').change(function() {
    var selected<?php echo $kolotoc; ?> = jQuery(':selected', this);
    vysledek<?php echo $kolotoc; ?> = selected<?php echo $kolotoc; ?>.attr('value');
    formatS<?php echo $kolotoc; ?> = vysledek<?php echo $kolotoc; ?>.substr(0, 2);

//Kontrola formaty zda není zadán A4,A3,A2 apod.
    if (formatS<?php echo $kolotoc; ?> == "a4"){ formatS<?php echo $kolotoc; ?> = 21;}
    else if (formatS<?php echo $kolotoc; ?> == "a3"){ formatS<?php echo $kolotoc; ?> = 29.7;}
    else if (formatS<?php echo $kolotoc; ?> == "a2"){ formatS<?php echo $kolotoc; ?> = 42;}    
     else if (formatS<?php echo $kolotoc; ?> == "fo"){     html = '<div class="kvalita neaktivni"> Vyberte materiál<'+'/div>' }
//vypocet
var dpi<?php echo $kolotoc; ?> = 2.54 * fotkaS<?php echo $kolotoc; ?> / formatS<?php echo $kolotoc; ?>;


// kontrola kvality podle dpi
if (isFinite(dpi<?php echo $kolotoc; ?>)) {
    
if (dpi<?php echo $kolotoc; ?> < 70 && dpi<?php echo $kolotoc; ?> >= 0)
               html = '<div class="kvalita spatna"> Nedostačující kvalita<'+'/div>'
else if (dpi<?php echo $kolotoc; ?> >= 70 && dpi<?php echo $kolotoc; ?> < 150)
               html = '<div class="kvalita prumerna">Průměrná kvalita<'+'/div>'
else if (dpi<?php echo $kolotoc; ?> >= 150) 
               html = '<div class="kvalita vyborna"> Výborná kvalita<'+'/div>' 
else
    html = '<div class="kvalita vyborna"> Soubor je <?php echo $typ_souboru ?><'+'/div>'
} 
    
    
    //Odeslaní výstupu do HTML           
    document.getElementById("obal_kvalita-<?php echo $kolotoc; ?>").innerHTML = html; 
    
});
    
    document.getElementById("obal_kvalita-<?php echo $kolotoc; ?>").innerHTML = html; 
  
    
jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-velikost-fotoobrazu select').change(function() {
    var selected<?php echo $kolotoc; ?> = jQuery(':selected', this);
    vysledek<?php echo $kolotoc; ?> = selected<?php echo $kolotoc; ?>.attr('value');
    formatS<?php echo $kolotoc; ?> = vysledek<?php echo $kolotoc; ?>.substr(24, 2);
  
//vypocet
var dpi<?php echo $kolotoc; ?> = 2.54 * fotkaS<?php echo $kolotoc; ?> / formatS<?php echo $kolotoc; ?>;
              

// kontrola kvality podle dpi
if (isFinite(dpi<?php echo $kolotoc; ?>)) {
    
if (dpi<?php echo $kolotoc; ?> < 70)
               html = '<div class="kvalita spatna"> Nedostačující kvalita<'+'/div>'
else if (dpi<?php echo $kolotoc; ?> >= 70 && dpi<?php echo $kolotoc; ?> < 150)
               html = '<div class="kvalita prumerna">Průměrná kvalita<'+'/div>'
else if (dpi<?php echo $kolotoc; ?> >= 150) 
               html = '<div class="kvalita vyborna"> Výborná kvalita<'+'/div>' 
 } 

    //Odeslaní výstupu do HTML           
    document.getElementById("obal_kvalita-<?php echo $kolotoc; ?>").innerHTML = html; 

    });
 

//KVALITA PŘI HROMADNÉM NASTAVENÍ
jQuery( document ).ready(function() {
    jQuery(".nastavit-hromadne").click(function(){
        jQuery('.addon-wrap-3032-format select.addon-select').change();
    });
});
    
    
// Pri vybrani se změni input na zeleny s fajfkou
//Orez a leskly fotopapir je defaultne
       $(  "div.product-addon.product-addon-typ" ).find( "a.chosen-single" ).css( "background", "#8BC34A", "important" );
       $(  "div.product-addon.product-addon-typ" ).find( "a.chosen-single" ).css( "color", "#8BC34A", "important" );
       $(  "div.product-addon.product-addon-typ" ).find( "span" ).addClass( "vyborna" ); 

    
    jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-format select').change(function() {
        hodnota = $(this).val();
        if (hodnota) {   
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-format" ).find( "a.chosen-single" ).css( "background", "#8BC34A", "important" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-format" ).find( "a.chosen-single" ).css( "color", "#8BC34A", "important" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-format" ).find( "span" ).addClass( "vyborna" );
            hodnota = 0;
        }
        else {
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-format" ).find( "a.chosen-single" ).css( "background", "");
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-format" ).find( "a.chosen-single" ).css( "color", "");
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-format" ).find( "span" ).removeClass( "vyborna" );
        }    
    });
    
    
    
    jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-vyber-fotopapiru select').change(function() {
        hodnota = $(this).val();
        if (hodnota) { 
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-vyber-fotopapiru" ).find( "a.chosen-single" ).css( "background", "#8BC34A", "important" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-vyber-fotopapiru" ).find( "a.chosen-single" ).css( "color", "#8BC34A", "important" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-vyber-fotopapiru" ).find( "span" ).addClass( "vyborna" );   
             hodnota = 0;
        }
        else {
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-vyber-fotopapiru" ).find( "a.chosen-single" ).css( "background", "" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-vyber-fotopapiru" ).find( "a.chosen-single" ).css( "color", "" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-vyber-fotopapiru" ).find( "span" ).removeClass( "vyborna" ); 
        }
    });

        
        
    jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material select').change(function() {
        hodnota = $(this).val();
        if (hodnota) { 
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-material" ).find( "a.chosen-single" ).css( "background", "#8BC34A", "important" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-material" ).find( "a.chosen-single" ).css( "color", "#8BC34A", "important" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-material" ).find( "span" ).addClass( "vyborna" );
            hodnota = 0;
        }
        else {
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-material" ).find( "a.chosen-single" ).css( "background", "" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-material" ).find( "a.chosen-single" ).css( "color", "" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-material" ).find( "span" ).removeClass( "vyborna" );
        }
    });
    
     jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-material-pro-velke-formaty select').change(function() {
        hodnota = $(this).val();
        if (hodnota) { 
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-material-pro-velke-formaty" ).find( "a.chosen-single" ).css( "background", "#8BC34A", "important" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-material-pro-velke-formaty" ).find( "a.chosen-single" ).css( "color", "#8BC34A", "important" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-material-pro-velke-formaty" ).find( "span" ).addClass( "vyborna" );
            hodnota = 0;
        }
        else {
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-material-pro-velke-formaty" ).find( "a.chosen-single" ).css( "background", "" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-material-pro-velke-formaty" ).find( "a.chosen-single" ).css( "color", "" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-material-pro-velke-formaty" ).find( "span" ).removeClass( "vyborna" );
        }
    });
    
     jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-velikost-fotoobrazu select').change(function() {
        hodnota = $(this).val();
        if (hodnota) { 
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-velikost-fotoobrazu" ).find( "a.chosen-single" ).css( "background", "#8BC34A", "important" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-velikost-fotoobrazu" ).find( "a.chosen-single" ).css( "color", "#8BC34A", "important" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-velikost-fotoobrazu" ).find( "span" ).addClass( "vyborna" );
            hodnota = 0;
        }
        else {   
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-velikost-fotoobrazu" ).find( "a.chosen-single" ).css( "background", "" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-velikost-fotoobrazu" ).find( "a.chosen-single" ).css( "color", "" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-velikost-fotoobrazu" ).find( "span" ).removeClass( "vyborna" );
        }
    });
    
    jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-nalepit-na-desku select').change(function() {
        hodnota = $(this).val();
        if (hodnota) { 
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-nalepit-na-desku" ).find( "a.chosen-single" ).css( "background", "#8BC34A", "important" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-nalepit-na-desku" ).find( "a.chosen-single" ).css( "color", "#8BC34A", "important" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-nalepit-na-desku" ).find( "span" ).addClass( "vyborna" );
            hodnota = 0;
        }
        else {  
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-nalepit-na-desku" ).find( "a.chosen-single" ).css( "background", "" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-nalepit-na-desku" ).find( "a.chosen-single" ).css( "color", "" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-nalepit-na-desku" ).find( "span" ).removeClass( "vyborna" );
        }
    });
    
    jQuery('#fotka-<?php echo $kolotoc; ?> .addon-wrap-3032-typ select').change(function() {
        hodnota = $(this).val();
        if (hodnota) { 
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-typ" ).find( "a.chosen-single" ).css( "background", "#8BC34A", "important" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-typ" ).find( "a.chosen-single" ).css( "color", "#8BC34A", "important" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-typ" ).find( "span" ).addClass( "vyborna" ); 
            hodnota = 0;
        }
        else {
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-typ" ).find( "a.chosen-single" ).css( "background", "" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-typ" ).find( "a.chosen-single" ).css( "color", "" );
            $(  "#fotka-<?php echo $kolotoc; ?> div.product-addon.product-addon-typ" ).find( "span" ).removeClass( "vyborna" ); 
        }
    });
    
  // KONEC -> Pri vybrani se změni input na zeleny s fajfkou    
    
    
});
</script>

<?php // HTML výstup 
    for($i = 0, $size = count($kolotoc); $i < $size; ++$i){ ?>
<div id="obal_kvalita-<?php echo $kolotoc; ?>"></div>
<?php } ?>
</div>
    </div>  
<?php } ?>
