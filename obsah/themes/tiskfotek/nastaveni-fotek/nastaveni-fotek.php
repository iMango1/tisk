<?php
/*
 * Template Name: Nastavení fotek
 * Description: Stránka pro nastavení parametrů a "produktů" fotek
 */

get_header();

session_start();
global $kolotoc;
global $vsechny_nahrane_fotky;
global $objednavka_id;
global $wpdb;
global $_NAZEV_WEBU;

$url = $_SERVER["SERVER_NAME"];
$url_roz = explode(".", $url);
$_NAZEV_WEBU = $url_roz[1];


$diakritika = array(
    'á' => 'a',
    'é' => 'e',
    'ě' => 'e',
    'í' => 'i',
    'ý' => 'y',
    'ó' => 'o',
    'ú' => 'u',
    'ů' => 'u',
    'ž' => 'z',
    'š' => 's',
    'č' => 'c',
    'ř' => 'r',
    'ď' => 'd',
    'ť' => 't',
    'ň' => 'n',
    'Á' => 'A',
    'É' => 'E',
    'Ě' => 'E',
    'Í' => 'I',
    'Ý' => 'Y',
    'Ó' => 'O',
    'Ú' => 'U',
    'Ů' => 'U',
    'Ž' => 'Z',
    'Š' => 'S',
    'Č' => 'C',
    'Ř' => 'R',
    'Ď' => 'D',
    'Ť' => 'T',
    'Ň' => 'N',
    ' ' => '_'
);

date_default_timezone_set('Europe/Prague');

$id_objednavky = $_COOKIE["id_objednavky"];

$absolutni_cesta_objednavky = "/home/web/$_NAZEV_WEBU.cz/objednavky/$id_objednavky";
$absolutni_cesta_objednavky_thumb = "/home/web/$_NAZEV_WEBU.cz/objednavky/$id_objednavky/thumbnail";

$absolutni_cesta_tmp = "/home/web/$_NAZEV_WEBU.cz/www/obsah/themes/tiskfotek/nahrani/server/php/tmp-objednavky/$id_objednavky";
$absolutni_cesta_tmp_thumb = "/home/web/$_NAZEV_WEBU.cz/www/obsah/themes/tiskfotek/nahrani/server/php/tmp-objednavky/$id_objednavky/thumbnail";

if (!is_dir($absolutni_cesta_objednavky)) {
    mkdir($absolutni_cesta_objednavky, 0777);
    mkdir($absolutni_cesta_objednavky_thumb, 0777);
}
else{
    array_map('unlink', glob($absolutni_cesta_objednavky."/*"));
    rmdir($absolutni_cesta_objednavky);

    array_map('unlink', glob($absolutni_cesta_objednavky."/thumbnail/*"));
    rmdir($absolutni_cesta_objednavky_thumb);

    mkdir($absolutni_cesta_objednavky, 0777);
    mkdir($absolutni_cesta_objednavky_thumb, 0777);

}

// KOPIROVANI FOTEK

$fotky_v_tmp = glob($absolutni_cesta_tmp."/*");

$pocet = 0;

foreach($fotky_v_tmp as $fotka_v_tmp){
    if(!is_dir($fotka_v_tmp)) {
        $adresa_pole = explode($id_objednavky . "/", $fotka_v_tmp);
        $nazev_fotky = $adresa_pole[1];

        // ZRUSENI DIAKRITIKY
        $nazev_fotky = preg_replace('/[^A-Za-z0-9\-_.]/','', $nazev_fotky);

        copy($fotka_v_tmp, $absolutni_cesta_objednavky."/".$nazev_fotky);

        // PREJMENOVANI TMP FOTEK

        $stare_jmeno = $absolutni_cesta_tmp."/".$adresa_pole[1];
        $nove_jmeno = $absolutni_cesta_tmp."/".$nazev_fotky;

        rename($stare_jmeno,$nove_jmeno);

        $stare_jmeno = $absolutni_cesta_tmp."/thumbnail/".$adresa_pole[1];
        $nove_jmeno = $absolutni_cesta_tmp."/thumbnail/".$nazev_fotky;

        rename($stare_jmeno,$nove_jmeno);


        $_SESSION["fotky"][$pocet] = $nazev_fotky;
        $pocet++;
    }

}

// KOPIROVANI FOTEK - THUMB

$fotky_v_tmp_thumb = glob($absolutni_cesta_tmp_thumb."/*");

foreach($fotky_v_tmp_thumb as $fotka_v_tmp_thumb){
    $adresa_pole = explode($id_objednavky . "/", $fotka_v_tmp_thumb);
    $nazev_fotky = $adresa_pole[1];
    copy($fotka_v_tmp_thumb, $absolutni_cesta_objednavky."/".$nazev_fotky);
}

$_SESSION["pocet_fotek"] = $pocet;

$args = array(
	'post_type' => 'product',
	'posts_per_page' => 12
	);
$loop = new WP_Query( $args );

?>

<script>
jQuery(document).ready(function(){
    jQuery("#formular-0 #fotka-0 .addon-wrap-3032-id_objednavky input").val("<?php echo $objednavka_id; ?>");
    jQuery("select[name='addon-3032-typ']").val("orez-1");
});


</script>

<div class="section sm-padding" id="nastaveni-fotek">
	<div class="container">
        <div id="sticky-anchor"></div>
        
        
        <div class="kroky-nastaveni-blok">
            <div class="kroky_blok">
		    <div class="krok jedna_upload aktivni"><a href="../../upload-fotografii"><span class="cislo">1</span> Upload fotografií</a></div>
            <div class="krok dva_upload aktivni"><a><span class="cislo">2</span> Nastavení parametrů tisku</a></div>
            <div class="krok dva_upload nepristupne"><a><span class="cislo">3</span> Košík</a></div>
            <div class="krok dva_upload nepristupne"><a><span class="cislo">4</span> Fakturační údaje</a></div>
            <div class="krok dva_upload nepristupne"><a><span class="cislo">5</span> Dokončení objednávky</a></div>
        </div>
            
            <div class="nastavit-celkem">
                <h3>Hromadné nastavení parametrů všech fotografií</h3>
                <div class="col-md-2 format">
                   <div class="format-select">
                    <select class="addon addon-select chosen-select addon-3032-format" name="addon-3032-format" style="display: none;">
				        <option value="">Formát</option>
                        <optgroup label="Fotografie">
                            <option data-price="5.9" value="10x15-2">10×15</option>
                            <option data-price="13.9" value="13x18-3">13×18</option>
                            <option data-price="17.9" value="15x20-4">15×20</option>
                            <option data-price="17.9" value="15x21-5">15×21</option>
                            <option data-price="19.9" value="15x23-6">15×23</option>
                        </optgroup>
                        <optgroup label="Obraz na plátně">
                            <option data-price="549" value="fotoobraz-8">Fotoobraz</option>
                        </optgroup>
                        <optgroup label="Velké formáty">
                            <option data-price="" value="30x40-10">30×40</option>
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
                        <optgroup label="Ostatní">
                            <option data-price="" value="vlastni-rozmery-21">Vlastní rozměry</option>
                        </optgroup>
                    </select>
                    </div>
                    <div class="product-addon-vlastni-format">
                    <input type="text" class="input-text addon addon-custom" data-price="" name="addon-3032-vlastni-format[rozmer]" value="" placeholder="Napište zde váš rozměr">
                    <i class="fa fa-times"></i>
                    </div>
                </div>
                <div class="col-md-2 vyber-fotopapiru">                   
                    <select class="addon addon-select chosen-select addon-3032-vyber-fotopapiru" name="addon-3032-vyber-fotopapiru" style="display: none;">
    					<option value="">Výběr fotopapíru</option>
		                <option data-price="116" value="mat-enhanced-mate-1">MAT – Enhanced Mate</option>
                        <option data-price="145" value="mat-matte-real-2">MAT – Matte Real</option>
                        <option data-price="207" value="mat-velvet-fine-art-3">MAT – Velvet Fine Art</option>
                        <option data-price="145" value="lesk-glacier-4">LESK – Glacier</option>
                        <option data-price="116" value="lesk-omnijet-5">LESK – Omnijet</option>
                        <option data-price="168" value="lesk-photo-baryt-6">LESK – Photo Baryt</option>
                        <option data-price="125" value="lesk-premium-glossy-7">LESK – Premium Glossy</option>
                        <option data-price="135" value="lesk-premium-luster-8">LESK – Premium Luster</option>
                        <option data-price="154" value="lesk-smooth-gloss-9">LESK – Smooth Gloss</option>
                        <option data-price="250" value="pouze-platno-lesk-satin-canvas-10">POUZE PLÁTNO – LESK Satin canvas</option>
                        <option data-price="250" value="pouze-platno-mat-exclusive-bez-ramu-11">POUZE PLÁTNO – MAT Exclusive – bez rámu</option>          		
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
                    <select class="addon addon-select chosen-select addon-3032-velikost-fotoobrazu" name="addon-3032-material-pro-fotoobrazy" style="display: none;">
					<option value="">Velikost fotoobrazu</option>
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
                        <option data-price="279" value="lesk-glacier-1">LESK – GLACIER</option>
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
	                <select class="addon addon-select chosen-select addon-3032-nalepit-na-desku" name="addon-3032-nalepit-na-desku">
					    <option value="">Nalepit na desku?</option>
                        <option data-price="27.17" value="deska-rayboard-5mm-1">Deska Rayboard 5mm</option>
                        <option data-price="39.2" value="deska-rayboard-10mm-2">Deska Rayboard 10mm</option>
                        <option data-price="" value="zadna-deska-3">Žádná deska</option>        		
	                </select>
                </div>
                <div class="col-md-2 typ">
                    <select class="addon addon-select chosen-select addon-3032-typ" name="addon-3032-typ" style="display: none;">
					    <option value="">Typ</option>
                        <option data-price="" value="orez-1">Ořez</option>
                        <option data-price="" value="plny-format-2">Plný formát</option>        		
	                </select>
                </div>
                <div class="col-md-2 potvrzeni">
                    <a style="color:#fff" class="btn nastavit-hromadne">Nastavit</a>
                </div>
            </div>
        </div>
 <script>
     
jQuery( document ).ready(function() {  
    
    jQuery(".nastavit-celkem .product-addon-format").show();
    jQuery(".nastavit-celkem .product-addon-vlastni-format").hide();  
    
    jQuery('.nastavit-celkem .format select').change(function() {
        var selected = jQuery(this).val();
        //PŘI VÝBĚRU VLASNTÍHO FORMÁTU
        if(selected == "vlastni-rozmery-21"){
            jQuery('.nastavit-celkem .format select').val(jQuery(".nastavit-celkem .format select option:first").val());
            jQuery('.nastavit-celkem .format .chosen-container').trigger("chosen:updated");
            //ZOBRAZENÍ INPUTU
            jQuery(".nastavit-celkem .format .format-select").hide();
            jQuery(".nastavit-celkem .product-addon-vlastni-format input").attr("placeholder", "Napište zde váš rozměr");
            jQuery(".nastavit-celkem .product-addon-vlastni-format").show();
            jQuery(".nastavit-celkem .product-addon-vlastni-format").append('<i class="fa fa-times"></i>');
            
            //PO KLIKNUTÍ NA KŘÍŽEK
            jQuery(".nastavit-celkem .product-addon-vlastni-format .fa").click(function(){
                //ZOBRAZENÍ FORMÁTU A SKRYTÍ VLASTNÍHO
                jQuery(".nastavit-celkem .format-select").show();
                jQuery(".nastavit-celkem .product-addon-vlastni-format").hide();
                jQuery('.nastavit-celkem .format select').val(jQuery(".nastavit-celkem .format select option:first").val());
                jQuery('.addon-wrap-3032-format .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                //VYMAZÁNÍ INPUTU
                jQuery(".nastavit-celkem .product-addon-vlastni-format input").val("");
                
                
                jQuery('.nastavit-celkem .velikost-fotoobrazu select').prop('selectedIndex',0);
                jQuery('.nastavit-celkem .vyber-fotopapiru select').prop('selectedIndex',0);
                //UPDATE RESETOVANÝCH INPUTjQuery('.nastavit-celkem .velikost-fotoobrazu select').trigger("chosen:updated");
                jQuery('.nastavit-celkem .vyber-fotopapiru select').trigger("chosen:updated");
                //NASTAVENÍ VIDITELNOSTI
                jQuery('.nastavit-celkem .vyber-fotopapiru select').prop('selectedIndex',0);
                jQuery('.nastavit-celkem .vyber-fotopapiru select').trigger("chosen:updated");
                jQuery(".nastavit-celkem .vyber-fotopapiru .chosen-container").addClass("chosen-disabled");
                jQuery(".nastavit-celkem .material-pro-velke-formaty").hide();
                jQuery(".nastavit-celkem .velikost-fotoobrazu").hide();
                jQuery(".nastavit-celkem .material").show();
                jQuery(".nastavit-celkem .material .chosen-container").addClass("chosen-disabled");
                jQuery(".nastavit-celkem .nalepit-na-desku .chosen-container").addClass("chosen-disabled");

            });
        }
    });
    
    //POČTY
    jQuery('.nastavit-celkem .product-addon-vlastni-format input').focusout(function() {

        //PARSOVÁNÍ
        var zadane_neosetrene = jQuery(this).val().replace(',', '.');
        var zadane = zadane_neosetrene.toLowerCase();
        var pole_zadane = zadane.split("x");
        var sirka = parseFloat(pole_zadane[0]);
        var vyska = parseFloat(pole_zadane[1]);
        var typ;
        console.log(sirka+"x"+vyska);
        //ROZDĚLENÍ
        if(sirka >= 20)
            typ = "velke";
        else
            typ = "fotografie";
        //ZOBRAZENÍ INPUTŮ
        if(typ == "fotografie"){
            //RESET ZADANÝCH HODNOT
            jQuery('.nastavit-celkem .velikost-fotoobrazu select').prop('selectedIndex',0);
            jQuery('.nastavit-celkem .vyber-fotopapiru select').prop('selectedIndex',0);
            //UPDATE RESETOVANÝCH INPUTŮ
            jQuery('.nastavit-celkem .velikost-fotoobrazu select').trigger("chosen:updated");
            jQuery('.nastavit-celkem .vyber-fotopapiru select').trigger("chosen:updated");
            //NASTAVENÍ VIDITELNOSTI
            jQuery(".nastavit-celkem .vyber-fotopapiru .chosen-container").addClass("chosen-disabled");
            jQuery(".nastavit-celkem .velikost-fotoobrazu").hide();
            jQuery(".nastavit-celkem .material-pro-velke-formaty").hide();
            jQuery(".nastavit-celkem .material").show();
            jQuery(".nastavit-celkem .material .chosen-container").removeClass("chosen-disabled");
            jQuery(".nastavit-celkem .nalepit-na-desku").show();
            jQuery(".nastavit-celkem .nalepit-na-desku .chosen-container").removeClass("chosen-disabled");
            //NASTAVENÍ LESKLÉHO FOTOPAPÍRU
            jQuery(".nastavit-celkem .material select").val("leskly-fotopapir-1");
            jQuery(".nastavit-celkem .material select").trigger("chosen:updated");
            //NASTAVENÍ POMLČEK PŘI NEVYPLNĚNÍ
            jQuery(".nastavit-celkem .nalepit-na-desku select").val("zadna-deska-3");
            jQuery('.nastavit-celkem .nalepit-na-desku select').trigger("chosen:updated");        
        }
        if(typ == "velke"){
            //RESET ZADANÝCH HODNOT
            jQuery('.nastavit-celkem .material select').prop('selectedIndex',0);
            jQuery('.nastavit-celkem .velikost-fotoobrazu select').prop('selectedIndex',0);
            //UPDATE RESETOVANÝCH INPUTŮ
            jQuery('.nastavit-celkem .velikost-fotoobrazu select').trigger("chosen:updated");
            jQuery('.nastavit-celkem .material select').trigger("chosen:updated");
            //NASTAVENÍ VIDITELNOSTI
            jQuery(".nastavit-celkem .vyber-fotopapiru .chosen-container").removeClass("chosen-disabled");
            jQuery(".nastavit-celkem .material-pro-velke-formaty").hide();
            jQuery(".nastavit-celkem .material").show();
            jQuery(".nastavit-celkem .material .chosen-container").addClass("chosen-disabled");
            jQuery(".nastavit-celkem .velikost-fotoobrazu").hide();
            jQuery(".nastavit-celkem .nalepit-na-desku .chosen-container").removeClass("chosen-disabled");
            //NASTAVENÍ POMLČEK PŘI NEVYPLNĚNÍ
            jQuery(".nastavit-celkem .nalepit-na-desku select").val("zadna-deska-3");
            jQuery('.nastavit-celkem .nalepit-na-desku select').trigger("chosen:updated");
        }

    });
});
</script>
<script>
jQuery( document ).ready(function() {   
    var vysledek = "",predchozi = "";
    var celkovy_pocet = <?php echo $_SESSION["pocet_fotek"]; ?>;
    var mezipocet = 0, vys = 0;
<?php for($i = 0; $i < $_SESSION["pocet_fotek"]; $i++){ ?>
   
    
    jQuery('.product-addon-format .fotka-<?php echo $i;?> select').change(function() {
        var selected = jQuery(':selected', this);
        var vybrano = jQuery(this).val();
        vysledek = selected.parent().attr('label');
        if(vysledek == "Fotografie"){
            mezipocet++;
        }
        else if(vysledek == "Obraz na plátně"){

        }
        else if(vysledek == "Velké formáty"){

        }
        else if(vysledek == "Ostatní"){
            
        }
        //nic není zakliknuto
        else {
            mezipocet--;
        }
    });
    jQuery('.product-addon-velikost-fotoobrazu .fotka-<?php echo $i;?> select').change(function() {
        mezipocet++;
        //console.log(mezipocet);
    });
    jQuery('.product-addon-vyber-fotopapiru .fotka-<?php echo $i;?> select').change(function() {
        mezipocet++;
        //console.log(mezipocet);
     });
     jQuery("#fotka-<?php echo $i; ?> .product-addon-vlastni-format input").focusout(function(){
        var zadane_neosetrene = jQuery(this).val().replace(',', '.');
        var zadane = zadane_neosetrene.toLowerCase();
        var pole_zadane = zadane.split("x");
        var sirka = parseFloat(pole_zadane[0]);
        if(sirka < 20)
            mezipocet++;
     });
    // console.log(mezipocet);
<?php } ?>
    
    jQuery('select').change(function() {
        if(mezipocet >= celkovy_pocet)
            jQuery(".pokracovat").removeClass("disabled");
        else
            jQuery(".pokracovat").addClass("disabled");
    });
    jQuery('input').focusout(function() {
        if(mezipocet >= celkovy_pocet)
            jQuery(".pokracovat").removeClass("disabled");
        else
            jQuery(".pokracovat").addClass("disabled");
    });

});
</script>
       <div id="tabulka-fotek">
        <?php
        $kolotoc = 0;
        $pocet_fotek = $_SESSION["pocet_fotek"];
        $celkovy_pocet = 0;

/*
        $nazev_slozky = $_COOKIE["id_objednavky"];

        for($i = 0; $i < $pocet_fotek; $i++) {
            $nazev_fotky = $_SESSION["fotky"][$i];
            $url_min = "http://objednavky.skakaciatrakce.cz/$nazev_slozky/thumbnail/$nazev_fotky";
            echo "<img src='$url_min' height='100px'><br>";
        }
*/
        //echo "<pre>",print_r($_SESSION),"</pre>";

        if ( $loop->have_posts() ) {
			for($i = 0; $i < $pocet_fotek; $i++) {
                while ( $loop->have_posts() ) {
                    $loop->the_post();
                    wc_get_template_part( 'content', 'single-product' );
                    $kolotoc++;
                    $celkovy_pocet++;
                }
            }
		} else {
			echo __( 'No products found' );

		}

		wp_reset_postdata();

	?>
           <div class="pull-right celkova-cena">Celková cena: <span>0.00</span></div>
</div>
<?php $url = htmlspecialchars($_SERVER['HTTP_REFERER']); ?>
<div class="tlacitka_blok">
    <a  href="<?php echo $url; ?>" class="koko btn main-bg pull-left">Předchozí krok</a>
    <button type="submit" id="potvrzeni" class="pokracovat btn main-bg pull-right disabled">Pokračovat k objednávce</button>
    <div id="nahravani" class="pull-right">Zpracování objednávky - prosím čekejte</div>
    <!--<div id="nahravani_text" class="pull-right">Zpracování objednávky - prosím čekejte</div>-->
</div>

 <div class="footer-uploader row">
     <div class="col-md-6">
         <p>Digitální fotosběrna</p>
     </div>   
     <div class="col-md-6">
         <p class="pull-right">Multiuploader 1.0.3</p>
     </div>    
</div>

           <?php 
        global $woocommerce;
        $kosik = $woocommerce->cart; 
        reset($kosik->cart_contents);
        $prvni = key($kosik->cart_contents);
        $k_vymazani = explode("kosik/",$kosik->get_remove_url($prvni));
        
        $jednotlive =  explode("=",$k_vymazani[1]);
        
        $id_item_pole = explode("&",$jednotlive[1]);
        $id_item = $id_item_pole[0];
        
        $wpnonce = $jednotlive[2];
               
        ?>
  <script src="http://malsup.github.io/min/jquery.form.min.js"></script>
        <script>


            jQuery('#potvrzeni').click(function(){
                <?php
                $pomoc_celkovy_pocet = $celkovy_pocet - 1;
                $pocet_odeslane  = 0;
                ?>
                var celkovy_pocet = <?php echo $celkovy_pocet; ?>;
                var poc = 0;

                <?php

                for($i=0;$i<$celkovy_pocet;$i++) {

                ?>
                var myform = document.getElementById("formular-<?php echo $i; ?>");
                var fd = new FormData(myform);
                $.ajax({
                    url: "?add-to-cart=group&product_id=3032",
                    data: fd,
                    cache: false,
                    processData: false,
                    contentType: false,
                    type: 'POST',
                    success: function (dataofconfirm) {
                        poc++;
                        console.log("počet js :"+poc);
                        console.log("<?php echo "Fotka $i + 1 z $celkovy_pocet, POČET ODESLANE:" ?>"+poc);
                        if(poc == celkovy_pocet){
                            <?php if($_SESSION["pridano"] == 1){ ?>
                            $.get("?remove_item=<?php echo $id_item;?>&_wpnonce=<?php echo $wpnonce;?>", function() {
                                console.log("ODSTRANĚNO ->");
                                location.href = 'http://www.<?php echo $_NAZEV_WEBU; ?>.cz/kosik';
                            });
                            <?php }else{ ?>
                            location.href = 'http://www.<?php echo $_NAZEV_WEBU; ?>.cz/kosik';
                            <?php } ?>
                        }
                    }
                });

                <?php } ?>


            });

            jQuery(function() {
                jQuery("#nahravani").hide();
                //jQuery("#nahravani_text").hide();
                jQuery("#potvrzeni").click(function() {
                    jQuery("#potvrzeni").hide();
                    jQuery("#nahravani").fadeIn("slow");
                    //  jQuery("#nahravani_text").fadeIn("slow");
                });

                jQuery(".product-addon-format .chosen-container .chosen-single span").replaceWith( "<span>Výber formátu</span>" );

                jQuery(".format .chosen-container .chosen-single span").replaceWith( "<span>Výber formátu</span>" );

                jQuery(".product-addon-nalepit-na-desku .chosen-container .chosen-results li:first-child").remove();
                jQuery(".product-addon-nalepit-na-desku select option[value='']").remove();


                //NASTAVIT HROMADNE


                jQuery(".nastavit-hromadne").click(function(){

                    //Nastavit hromadně - Formát

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
                        jQuery("div.product-addon.product-addon-format" ).find( "a.chosen-single" ).css( "background", "#8BC34A", "important" );
                        jQuery("div.product-addon.product-addon-format" ).find( "a.chosen-single" ).css( "color", "#8BC34A", "important" );
                        jQuery("div.product-addon.product-addon-format" ).find( "span" ).addClass( "vyborna" );
                    }
                    jQuery('.addon-wrap-3032-format select.addon-select').trigger("chosen:updated");
                    jQuery('.addon-wrap-3032-format select.addon-select').change();



                    //NASTAVIT HROMADNĚ - OSTATNÍ

                    console.log("vše");
                    //velké formáty
                    jQuery(".addon-wrap-3032-vyber-fotopapiru select.addon-select").val( jQuery(".nastavit-celkem .addon-3032-vyber-fotopapiru").val() );
                    jQuery(".addon-wrap-3032-vyber-fotopapiru select.addon-select").trigger("chosen:updated");
                    jQuery(".addon-wrap-3032-vyber-fotopapiru .chosen-container").trigger("chosen:updated");

                    //material
                    if(jQuery(".nastavit-celkem .addon-3032-material").val() != "") {
                        jQuery(".addon-wrap-3032-material select.addon-select").val(jQuery(".nastavit-celkem .addon-3032-material").val());
                        jQuery(".addon-wrap-3032-material select.addon-select").trigger("chosen:updated");
                    }
                    //velikost fotoobrazu
                    jQuery(".addon-wrap-3032-velikost-fotoobrazu select").val(jQuery(".nastavit-celkem .addon-3032-velikost-fotoobrazu").val() );
                    jQuery(".addon-wrap-3032-velikost-fotoobrazu select.addon-select").trigger("chosen:updated");


                    jQuery("div.product-addon.product-addon-velikost-fotoobrazu").find( "a.chosen-single" ).css( "background", "#8BC34A", "important" );
                    jQuery("div.product-addon.product-addon-velikost-fotoobrazu").find( "a.chosen-single" ).css( "color", "#8BC34A", "important" );
                    jQuery("div.product-addon.product-addon-velikost-fotoobrazu").find( "span" ).addClass( "vyborna" );

                    //fotopapir
                    jQuery(".addon-wrap-3032-material-pro-vyber-fotopapiru select.addon-select").val( jQuery(".nastavit-celkem .addon-3032-material-pro-vyber-fotopapiru").val() );
                    jQuery(".addon-wrap-3032-material-pro-vyber-fotopapiru select.addon-select").trigger("chosen:updated");

                    //deska

                    if(jQuery(".nastavit-celkem .nalepit-na-desku select").val() != "") {
                        jQuery('.addon-wrap-3032-nalepit-na-desku select.addon-select').val(jQuery('.nastavit-celkem .nalepit-na-desku select').val());
                        jQuery('.addon-wrap-3032-nalepit-na-desku select.addon-select').trigger("chosen:updated");
                        console.log("DESKa");
                    }
                        jQuery("div.product-addon.product-addon-nalepit-na-desku").find("a.chosen-single").css("background", "#8BC34A", "important");
                        jQuery("div.product-addon.product-addon-nalepit-na-desku").find("a.chosen-single").css("color", "#8BC34A", "important");
                        jQuery("div.product-addon.product-addon-nalepit-na-desku").find("span").addClass("vyborna");



                    //typ
                    jQuery('.addon-wrap-3032-typ select.addon-select').val( jQuery('.nastavit-celkem .addon-3032-typ').val() );
                    jQuery('.addon-wrap-3032-typ select.addon-select').trigger("chosen:updated");


                    //NASTAVIT HROMADNĚ - měnění inputů při hromadném nastavení

                    var vysledek = jQuery('.addon-wrap-3032-format select.addon-select :selected');

                    var format_h = vysledek.parent().attr('label');

                    console.log(format_h);
                    //Zobrazení a skrytí inputů

                    if(format_h == "Fotografie"){
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

                        //RESET ZELENÉ PRO LESKLÝ FOTOPAPÍR
                        jQuery(  "div.product-addon.product-addon-vyber-fotopapiru" ).find( "a.chosen-single" ).css( "background", "transparent", "important" );
                        jQuery(  "div.product-addon.product-addon-vyber-fotopapiru" ).find( "a.chosen-single" ).css( "color", "#999", "important" );
                        jQuery(  "div.product-addon.product-addon-vyber-fotopapiru" ).find( "span" ).removeClass( "vyborna" );

                    }

                    if(format_h == "Obraz na plátně"){

                        jQuery('.addon-wrap-3032-material select').prop('selectedIndex',0);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru select').prop('selectedIndex',0);
                        jQuery('.addon-wrap-3032-nalepit-na-desku select').prop('selectedIndex',0);                          //UPDATE RESETOVANÝCH INPUTŮ
                        jQuery('.addon-wrap-3032-material select').trigger("chosen:updated");
                        jQuery('.addon-wrap-3032-vyber-fotopapiru select').trigger("chosen:updated");
                        jQuery('.addon-wrap-3032-nalepit-na-desku select').trigger("chosen:updated");
                        //NASTAVENÍ POMLČEK PŘI NEVYPLNĚNÍ
                        jQuery(".addon-wrap-3032-nalepit-na-desku select").val("zadna-deska-3");
                        jQuery('.addon-wrap-3032-nalepit-na-desku select').trigger("chosen:updated");
                        //NASTAVENÍ VIDITELNOSTI
                        jQuery('.addon-wrap-3032-vyber-fotopapiru select').trigger("chosen:updated");
                        jQuery(".addon-wrap-3032-vyber-fotopapiru .chosen-container").addClass("chosen-disabled");
                        jQuery(".addon-wrap-3032-velikost-fotoobrazu").show();
                        jQuery(".addon-wrap-3032-material-pro-velke-formaty").hide();
                        jQuery(".addon-wrap-3032-material").hide();
                        jQuery(".addon-wrap-3032-nalepit-na-desku .chosen-container").addClass("chosen-disabled");
                        jQuery(".addon-wrap-3032-material-pro-vyber-fotopapiru select.addon-select").trigger("chosen:updated");
                    }

                    if(format_h == "Velké formáty"){
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


                    // počítání ceny pro hromadné pro fotoobraz

                    if(jQuery(".addon-3032-velikost-fotoobrazu").val() != ""){
                        var cena = 0;
                        var fotoobraz_cena = jQuery(".addon-wrap-3032-velikost-fotoobrazu select option:selected").data("price");
                        cena = fotoobraz_cena;
                        //  console.error("fico postoupil: " + cena + ", vybrane: " + jQuery(".addon-3032-velikost-fotoobrazu").val());
                        jQuery('.cena-fotky span').html((parseFloat(cena)).toFixed(2));
                        jQuery('.cena-fotky').attr("data-soucasna-cena",(parseFloat(cena)).toFixed(2));
                        jQuery('.cena-fotky').attr("data-cena_bez_mn",(parseFloat(cena)).toFixed(2));
                    }

                    // ------------------------------------------------------------------------------
                    // počítání ceny desky pro hromadné nastavení

                    var desky_ceny = <?php echo json_encode($desky_ceny); ?>;

                    var vybrany_fotopapir = jQuery('.addon-wrap-3032-vyber-fotopapiru select').val();
                    cena_bez_mnozstvi =  jQuery('.cena-fotky').attr("data-cena_bez_mn");

                    if(jQuery(".product-addon-vlastni-format input").val() == ""){

                        var rozmer = jQuery('.addon-wrap-3032-format select').val();
                        var deska = jQuery('.addon-wrap-3032-nalepit-na-desku select').val();
                        var pro_vymazani_id = rozmer.split("-");

                        var rozmery = pro_vymazani_id[0].split("x");
                        var sirka = rozmery[0], vyska = rozmery[1], obsah = sirka*vyska;

                    }
                    else{

                    }

                    if(pro_vymazani_id[0]=="a4")
                        obsah = 623.7;
                    if(pro_vymazani_id[0]=="a3")
                        obsah = 1247.4;
                    if(pro_vymazani_id[0]=="a2")
                        obsah = 2494.8;

                    function d_zmena(d_deska,f_obsah,d_cena_bez_mn){
                        var nova_cena;
                        var i=0;
                        for(i=0;i<3;i++){
                            if(d_deska == "Žádná deska"){
                                cena_za_desku = 0;
                                var cena_bez_mnozstvi_vl = cena_bez_mnozstvi;
                                nova_cena = cena_bez_mnozstvi_vl * jQuery(".items-num").val();
                                jQuery('.cena-fotky span').html(nova_cena.toFixed(2));

                                jQuery('input.cena_deska').val(0);

                                jQuery('.cena-fotky').attr("data-soucasna-cena",nova_cena.toFixed(2));
                                jQuery('.cena-fotky').attr("data-cena_bez_mn",(parseFloat(nova_cena)).toFixed(2));
                            }
                            else{
                                if(desky_ceny[i]["nazev"] == d_deska){
                                    cena_za_desku = (parseFloat(desky_ceny[i]["cena"])) * f_obsah +parseFloat(desky_ceny[i]["prace"]);
                                    var cena_bez_mnozstvi_vl = cena_bez_mnozstvi;

                                    cena_bez_mnozstvi_vl += (parseFloat(cena_za_desku));

                                    //cena_bez_mnozstvi = cena_bez_mnozstvi_vl;
                                    nova_cena = 0.0;
                                    //nova_cena = cena_bez_mnozstvi_vl * parseInt(jQuery(".items-num").val());
                                    nova_cena = parseFloat(nova_cena) + (parseFloat(cena_bez_mnozstvi)) + (parseFloat(cena_za_desku));
                                    jQuery('.cena-fotky span').html((parseFloat(nova_cena)).toFixed(2));

                                    jQuery('input.cena_deska').val((parseFloat(cena_za_desku)).toFixed(2));

                                    jQuery('.cena-fotky').attr("data-soucasna-cena",(parseFloat(nova_cena)).toFixed(2));
                                    jQuery('.cena-fotky').attr("data-cena_bez_mn",(parseFloat(nova_cena)).toFixed(2));
                                    console.log("cena_za_desku: "+cena_za_desku+", nova cena: "+nova_cena+", cena_bez_mn: "+cena_bez_mnozstvi_vl+", deska_cena_b_m: "+d_cena_bez_mn+",f_obsah: " +f_obsah);
                                }
                            }

                        }

                    }

                    /* zak  console.log(obsah+", "+nova_cena+", "+cena_bez_mnozstvi+","+deska); */
                    var cena_bez_mnozstvi = jQuery('.cena-fotky').attr("data-cena_bez_mn");

                    if(deska == "deska-rayboard-5mm-1"){
                        d_zmena("Deska Rayboard 5mm",obsah,cena_bez_mnozstvi);
                    }
                    else if(deska == "deska-rayboard-10mm-2"){
                        d_zmena("Deska Rayboard 10mm",obsah,cena_bez_mnozstvi);
                    }

                    else{
                        d_zmena("Žádná deska",obsah,cena_bez_mnozstvi);
                    }

                });    //KONEC CLICK ON HROMADNÉ NASTAVENÍ


                //NASTAVIT HROMADNĚ - Zobrazení a skrytí inputů hromadného nastavení
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
                    console.log("Myslivec: " + vysledek);
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


            }); //KONEC DOCUMENT READY


            jQuery(function() {

                var celkem = 0.00;
                var cena_zmenene;
                var cena_jednotlive;
                <?php
                for($i=0;$i<$celkovy_pocet;$i++) {?>

                jQuery('.cena-fotka-<?php echo $i; ?>').bind("DOMSubtreeModified",function(){
                    celkem = 0;
                    cena_zmenene = parseFloat(jQuery(".cena-fotka-<?php echo $i; ?> span").text());
                    celkem = cena_zmenene;
                    <?php for($k=0;$k<$celkovy_pocet;$k++) {
                    if ($k != $i){
                    ?>
                    cena_jednotlive = parseFloat(jQuery(".cena-fotka-<?php echo $k; ?> span").text());
                    celkem = celkem + cena_jednotlive;
                    <?php }
                    }
                    ?>
                    jQuery(".celkova-cena span").html(celkem.toFixed(2));
                });

                <?php } ?>
            });

            jQuery(function(){
                jQuery(".nastavit-hromadne").click(function(){

                    jQuery(".pokracovat").removeClass("disabled");

                });
            });
        </script>
	</div>
</div>
<!--

SESSION<br>
<?php // echo "<pre>",print_r($_SESSION),"</pre>"; ?>
COOKIES<br>
<?php // echo "<pre>",print_r($_COOKIE),"</pre>"; ?>
-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/chosen.jquery.min.js"></script>
<script>
    $(".chosen-select").chosen({disable_search_threshold: 10});
</script>

<?php get_footer(); ?>