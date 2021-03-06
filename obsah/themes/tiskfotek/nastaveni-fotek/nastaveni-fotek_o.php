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
$url = $_SERVER["SERVER_NAME"];
$url_roz = explode(".", $url);
$_NAZEV_WEBU = $url_roz[1] . '.' . $url_roz[2];



$fotky_pred_kop = $_POST["fotky"]; 
$fotky_miniatury = $_POST["fotky_miniatury"];

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

    
if(get_current_user_id() == "0"){
    $rand_id_uzivatele = rand(1000,99999);

    
    $slozky = scandir("/home/web/$_NAZEV_WEBU/objednavky");
    foreach($slozky as $slozka){
        while (strpos($slozka,$rand_id_uzivatele."---") !== false) {
            $rand_id_uzivatele = rand(1000,99999);
            if(strpos($slozka,$rand_id_uzivatele."---") !== false)
                $rand_id_uzivatele = $rand_id_uzivatele + rand(4200,999999);
        }
    }
    
    $objednavka_id = $rand_id_uzivatele."---".date("d_m_Y--H-i-s");
}
else {
    $objednavka_id = get_current_user_id()."---".date("d_m_Y--H-i-s");
}

$_SESSION["nazev_slozky"] = $objednavka_id;
$_SESSION["status"] = 1;

mkdir("/home/web/$_NAZEV_WEBU/objednavky/$objednavka_id", 0777);

    foreach ($fotky_pred_kop as $i => $fotka_pred_kop) {
        $fotka_kousek_url[$i] = explode("|/", $fotka_pred_kop);
        $fotky_nazev_pred_kop[$i] = $fotka_kousek_url[$i][1];
    }
$fotky = array();
    $pocet = 0;
    foreach($fotky_nazev_pred_kop as $kolotoc => $fotka_nazev_pred_kop){
        
        $s_dia = $fotka_nazev_pred_kop;
        
        $bez_diakritiky = strtr( $s_dia, $diakritika );
        $fotka_nazev_pred_kop = $bez_diakritiky;
        
        $stare_jmeno = "/home/web/$_NAZEV_WEBU/www/obsah/themes/tiskfotek/nahrani/server/php/files|/$s_dia";
        $nove_jmeno = "/home/web/$_NAZEV_WEBU/www/obsah/themes/tiskfotek/nahrani/server/php/files|/$bez_diakritiky";
        
        rename($stare_jmeno,$nove_jmeno);
        
        $co = "http://www.$_NAZEV_WEBU/obsah/themes/tiskfotek/nahrani/server/php/files|/$fotka_nazev_pred_kop";
        $kam = "/home/web/$_NAZEV_WEBU/objednavky/$objednavka_id/$fotka_nazev_pred_kop";
        copy($co,$kam);  

        $fotky[$kolotoc] = $kam;
        $_SESSION[$kolotoc]["id_fotky"] = $kolotoc;
        $_SESSION[$kolotoc]["nazev_slozky"] = $objednavka_id;
        $_SESSION[$kolotoc]["nazev_fotky"] = $fotka_nazev_pred_kop;
        $_SESSION[$kolotoc]["nazev_bez_formatu"] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $fotka_nazev_pred_kop);
        $_SESSION[$kolotoc]["typ_souboru"] = pathinfo($fotka_nazev_pred_kop, PATHINFO_EXTENSION);
        $_SESSION[$kolotoc]["url_fotky"] = $fotky[$kolotoc]; 
        $_SESSION[$kolotoc]["url_fotky_upload"] = $co;
        $_SESSION[$kolotoc]["status"] = 1;
        $_SESSION["pocet_fotek"] = 0;
        
    }



        
        foreach($fotky_miniatury as $kolotoc => $fotka_miniatura){
            $_SESSION[$kolotoc]["url_miniatura"] = $fotka_miniatura;
        }

        $vsechny_nahrane_fotky = $_SESSION;
$_SESSION["pocet_fotek"] = count($fotky);

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
                //UPDATE RESETOVANÝCH INPUTŮ
                jQuery('.nastavit-celkem .velikost-fotoobrazu select').trigger("chosen:updated");
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
        mezipocet++;console.log(mezipocet);
    });
    jQuery('.product-addon-vyber-fotopapiru .fotka-<?php echo $i;?> select').change(function() {
        mezipocet++;console.log(mezipocet);
     });
     jQuery("#fotka-<?php echo $i; ?> .product-addon-vlastni-format input").focusout(function(){
        var zadane_neosetrene = jQuery(this).val().replace(',', '.');
        var zadane = zadane_neosetrene.toLowerCase();
        var pole_zadane = zadane.split("x");
        var sirka = parseFloat(pole_zadane[0]);
        if(sirka < 20)
            mezipocet++;
     });
    console.log(mezipocet);
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
        $pocet_fotek = count($fotky);
        $celkovy_pocet = 0;
        /* 
        echo "Počet fotek: $pocet_fotek <br><br>";
        for($i = 0; $i < $pocet_fotek; $i++)   
            for($k = 0; $k < count($loop->posts); $k++) 
                if($loop->posts[$k]->ID == 3032)
                    echo "<br>Produkt ID: ".$loop->posts[$k]->ID;

        */
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

        
/*
		if ( $loop->have_posts() ) {
			
            while ( $loop->have_posts() ) {

                $loop->the_post();
				wc_get_template_part( 'content', 'single-product' );
                $kolotoc++;
                $celkovy_pocet++;
            }
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
        */
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
                                    location.href = 'http://www.<?php echo $_NAZEV_WEBU; ?>/kosik'; 
                                });
                            <?php }else{ ?>
                                location.href = 'http://www.<?php echo $_NAZEV_WEBU; ?>/kosik'; 
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
    }); 

    jQuery(function() {
        jQuery(".product-addon-format .chosen-container .chosen-single span").replaceWith( "<span>Výber formátu</span>" );
    });

    jQuery(function() {
        jQuery(".format .chosen-container .chosen-single span").replaceWith( "<span>Výber formátu</span>" );
    });
       
    //NASTAVIT HROMADNĚ - desky
    jQuery(function(){
        jQuery(".nastavit-hromadne").click(function(){
            jQuery('.addon-wrap-3032-nalepit-na-desku select.addon-select').val( jQuery('.nastavit-celkem .nalepit-na-desku select').val() );  
            jQuery('.addon-wrap-3032-nalepit-na-desku select.addon-select').trigger("chosen:updated");
            jQuery(  "div.product-addon.product-addon-nalepit-na-desku" ).find( "a.chosen-single" ).css( "background", "#8BC34A", "important" );
            jQuery(  "div.product-addon.product-addon-nalepit-na-desku" ).find( "a.chosen-single" ).css( "color", "#8BC34A", "important" );
            jQuery(  "div.product-addon.product-addon-nalepit-na-desku" ).find( "span" ).addClass( "vyborna" );
        })
	});

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
<?php echo "<pre>",print_r($_SESSION),"</pre>"; ?>
COOKIES<br>
<?php echo "<pre>",print_r($_COOKIE),"</pre>"; ?>
-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/chosen.jquery.min.js"></script>


<?php get_footer(); ?>