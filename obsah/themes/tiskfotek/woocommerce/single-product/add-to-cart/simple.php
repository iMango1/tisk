<?php
session_start();
global $kolotoc;
global $vsechny_nahrane_fotky;
global $wpdb;
$results = $wpdb->get_results( 'SELECT * FROM tskf_postmeta WHERE meta_key like "ceny_produktu"', OBJECT );

$_SESSION["vlastni_ceny"] = unserialize($results[0]->meta_value);
//echo "<pre>",print_r($_SESSION),"</pre>";
?>
<script>
//ÚPRAVA CEN!!!
    jQuery( document ).ready(function() {   
        
        //ÚPRAVA KDYŽ JE ZAKLIKNUTÝ FORMÁT A VYBÍRÁ SE FOTOPAPÍR
        
        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').change(function() {
            
            var vybrany_fotopapir = jQuery(this).val();            
            
            var vysledek = jQuery('.addon-wrap-3032-format .select-fotka-<?php echo $kolotoc; ?>').val();
            var pro_vymazani_id = vysledek.split("-");
            
            var rozmery = pro_vymazani_id[0].split("x");
            var sirka = rozmery[0], vyska = rozmery[1], obsah = sirka*vyska;
            var cena_bez_mnozstvi = 0, nova_cena = 0.00;
            
            var fotopapiry_ceny = <?php echo json_encode(unserialize($results[0]->meta_value)); ?>;
            
            if(pro_vymazani_id[0]=="a4")
                obsah = 623.7;
            if(pro_vymazani_id[0]=="a3")
                obsah = 1247.4;
            if(pro_vymazani_id[0]=="a2")
                obsah = 2494.8;
            
            function cena(nazev_papir,obsah_blok,obsah_fotky){
                return (Math.round(fotopapiry_ceny[nazev_papir][obsah_blok]*obsah_fotky));
            }
            
            function zmena(nazev_papir,blok_obsah,fotka_obsah){
                    jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",cena(nazev_papir,blok_obsah,obsah));
                    jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                    cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                    nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                    jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
                    jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));    
            }
            
            var text = jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> :selected').text();

            if(obsah>=384 && obsah < 623.7){
            
            }

            if(obsah >= 623.7 && obsah < 1247.4){
                var blok = "623,7";
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-enhanced-mate-1"){
                    zmena("MAT - Enhanced MATTE",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-matte-real-2"){
                    zmena("MAT - Matte REAL",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-velvet-fine-art-3"){
                    zmena("MAT - Velvet FINE ART",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-glacier-4"){
                    zmena("LESK - GLACIER",blok,obsah);  
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-omnijet-5"){
                    zmena("LESK - OMNIJET",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-photo-baryt-6"){
                    zmena("LESK - Photo BARYT",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-glossy-7"){
                    zmena("LESK - Premium GLOSSY",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-luster-8"){
                    zmena("LESK - Premium LUSTER",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-smooth-gloss-9"){
                    zmena("LESK - Smooth GLOSS",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-lesk-satin-canvas-10"){
                    zmena("POUZE PLÁTNO - LESK SATIN CANVAS",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-mat-exclusive-bez-ramu-11"){
                    zmena("POUZE PLÁTNO - MAT EXCLUSIVE - bez rámu",blok,obsah);
                }
            }

            if(obsah >= 1247.4 && obsah < 2494.8){
                var blok = "1247,4";
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-enhanced-mate-1"){
                    zmena("MAT - Enhanced MATTE",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-matte-real-2"){
                    zmena("MAT - Matte REAL",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-velvet-fine-art-3"){
                    zmena("MAT - Velvet FINE ART",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-glacier-4"){
                    zmena("LESK - GLACIER",blok,obsah);  
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-omnijet-5"){
                    zmena("LESK - OMNIJET",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-photo-baryt-6"){
                    zmena("LESK - Photo BARYT",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-glossy-7"){
                    zmena("LESK - Premium GLOSSY",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-luster-8"){
                    zmena("LESK - Premium LUSTER",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-smooth-gloss-9"){
                    zmena("LESK - Smooth GLOSS",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-lesk-satin-canvas-10"){
                    zmena("POUZE PLÁTNO - LESK SATIN CANVAS",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-mat-exclusive-bez-ramu-11"){
                    zmena("POUZE PLÁTNO - MAT EXCLUSIVE - bez rámu",blok,obsah);
                }
            }
            if(obsah >= 2494.8){
                var blok = "2494,8";
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-enhanced-mate-1"){
                    zmena("MAT - Enhanced MATTE",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-matte-real-2"){
                    zmena("MAT - Matte REAL",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-velvet-fine-art-3"){
                    zmena("MAT - Velvet FINE ART",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-glacier-4"){
                    zmena("LESK - GLACIER",blok,obsah);  
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-omnijet-5"){
                    zmena("LESK - OMNIJET",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-photo-baryt-6"){
                    zmena("LESK - Photo BARYT",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-glossy-7"){
                    zmena("LESK - Premium GLOSSY",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-luster-8"){
                    zmena("LESK - Premium LUSTER",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-smooth-gloss-9"){
                    zmena("LESK - Smooth GLOSS",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-lesk-satin-canvas-10"){
                    zmena("POUZE PLÁTNO - LESK SATIN CANVAS",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-mat-exclusive-bez-ramu-11"){
                    zmena("POUZE PLÁTNO - MAT EXCLUSIVE - bez rámu",blok,obsah);
                }
            }
            if(obsah >= 623.7){
                var blok = "623,7";
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-velvet-fine-art-3"){
                    zmena("MAT - Velvet FINE ART",blok,obsah);
                }
            }
        });
        
        //ÚPRAVA KDYŽ JE ZAKLIKNUTÝ FOTOPAPÍR A ZMĚNÍ SE FORMÁT
         jQuery('.addon-wrap-3032-format .select-fotka-<?php echo $kolotoc; ?>').change(function() {
            
            var vybrany_fotopapir = jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val();            

            if(vybrany_fotopapir =! ""){
            var vysledek = jQuery('.addon-wrap-3032-format .select-fotka-<?php echo $kolotoc; ?>').val();
            var pro_vymazani_id = vysledek.split("-");
            
            var rozmery = pro_vymazani_id[0].split("x");
            var sirka = rozmery[0], vyska = rozmery[1], obsah = sirka*vyska;
            var cena_bez_mnozstvi = 0, nova_cena = 0.00;
            
            var fotopapiry_ceny = <?php echo json_encode(unserialize($results[0]->meta_value)); ?>;

            
            if(pro_vymazani_id[0]=="a4")
                obsah = 623.7;
            if(pro_vymazani_id[0]=="a3")
                obsah = 1247.4;
            if(pro_vymazani_id[0]=="a2")
                obsah = 2494.8;

            function cena(nazev_papir,obsah_blok,obsah_fotky){
                return (Math.round(fotopapiry_ceny[nazev_papir][obsah_blok]*obsah_fotky));
            }
            
            function zmena(nazev_papir,blok_obsah,fotka_obsah){
                    jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",cena(nazev_papir,blok_obsah,obsah));
                    jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                    cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                    nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                    jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
                    jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));    
            }
            
            var text = jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> :selected').text();
            console.log(text);
            if(obsah>=384 && obsah < 623.7){
            
            }

            if(obsah >= 623.7 && obsah < 1247.4){
                var blok = "623,7";
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-enhanced-mate-1"){
                    zmena("MAT - Enhanced MATTE",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-matte-real-2"){
                    zmena("MAT - Matte REAL",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-velvet-fine-art-3"){
                    zmena("MAT - Velvet FINE ART",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-glacier-4"){
                    zmena("LESK - GLACIER",blok,obsah);  
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-omnijet-5"){
                    zmena("LESK - OMNIJET",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-photo-baryt-6"){
                    zmena("LESK - Photo BARYT",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-glossy-7"){
                    zmena("LESK - Premium GLOSSY",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-luster-8"){
                    zmena("LESK - Premium LUSTER",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-smooth-gloss-9"){
                    zmena("LESK - Smooth GLOSS",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-lesk-satin-canvas-10"){
                    zmena("POUZE PLÁTNO - LESK SATIN CANVAS",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-mat-exclusive-bez-ramu-11"){
                    zmena("POUZE PLÁTNO - MAT EXCLUSIVE - bez rámu",blok,obsah);
                }
            }

            if(obsah >= 1247.4 && obsah < 2494.8){
                var blok = "1247,4";
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-enhanced-mate-1"){
                    zmena("MAT - Enhanced MATTE",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-matte-real-2"){
                    zmena("MAT - Matte REAL",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-velvet-fine-art-3"){
                    zmena("MAT - Velvet FINE ART",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-glacier-4"){
                    zmena("LESK - GLACIER",blok,obsah);  
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-omnijet-5"){
                    zmena("LESK - OMNIJET",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-photo-baryt-6"){
                    zmena("LESK - Photo BARYT",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-glossy-7"){
                    zmena("LESK - Premium GLOSSY",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-luster-8"){
                    zmena("LESK - Premium LUSTER",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-smooth-gloss-9"){
                    zmena("LESK - Smooth GLOSS",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-lesk-satin-canvas-10"){
                    zmena("POUZE PLÁTNO - LESK SATIN CANVAS",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-mat-exclusive-bez-ramu-11"){
                    zmena("POUZE PLÁTNO - MAT EXCLUSIVE - bez rámu",blok,obsah);
                }
            }
            if(obsah >= 2494.8){
                var blok = "2494,8";
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-enhanced-mate-1"){
                    zmena("MAT - Enhanced MATTE",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-matte-real-2"){
                    zmena("MAT - Matte REAL",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-velvet-fine-art-3"){
                    zmena("MAT - Velvet FINE ART",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-glacier-4"){
                    zmena("LESK - GLACIER",blok,obsah);  
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-omnijet-5"){
                    zmena("LESK - OMNIJET",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-photo-baryt-6"){
                    zmena("LESK - Photo BARYT",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-glossy-7"){
                    zmena("LESK - Premium GLOSSY",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-luster-8"){
                    zmena("LESK - Premium LUSTER",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-smooth-gloss-9"){
                    zmena("LESK - Smooth GLOSS",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-lesk-satin-canvas-10"){
                    zmena("POUZE PLÁTNO - LESK SATIN CANVAS",blok,obsah);
                }
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-mat-exclusive-bez-ramu-11"){
                    zmena("POUZE PLÁTNO - MAT EXCLUSIVE - bez rámu",blok,obsah);
                }
            }
            if(obsah >= 623.7){
                var blok = "623,7";
                if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-velvet-fine-art-3"){
                    zmena("MAT - Velvet FINE ART",blok,obsah);
                }
            }
            }
        });
        
                //ÚPRAVA PŘI HROMADNÉM NASTAVENÍ
        
        jQuery('.nastavit-hromadne').click(function() {
            
            var vybrany_fotopapir = jQuery(".nastavit-celkem .vyber-fotopapiru select").val();            
            
            var vysledek = jQuery('.nastavit-celkem .format select').val();
            var pro_vymazani_id = vysledek.split("-");
            
            var rozmery = pro_vymazani_id[0].split("x");
            var sirka = rozmery[0], vyska = rozmery[1], obsah = sirka*vyska;
            var cena_bez_mnozstvi = 0, nova_cena = 0.00;
            
            var fotopapiry_ceny = <?php echo json_encode(unserialize($results[0]->meta_value)); ?>;
            
            if(pro_vymazani_id[0]=="a4")
                obsah = 623.7;
            if(pro_vymazani_id[0]=="a3")
                obsah = 1247.4;
            if(pro_vymazani_id[0]=="a2")
                obsah = 2494.8;
            
            function cena(nazev_papir,obsah_blok,obsah_fotky){
                return (Math.round(fotopapiry_ceny[nazev_papir][obsah_blok]*obsah_fotky));
            }
            
            function zmena_h(nazev_papir,blok_obsah,fotka_obsah){
                    jQuery('.addon-wrap-3032-vyber-fotopapiru select option:selected').attr("data-price",cena(nazev_papir,blok_obsah,obsah));
                    jQuery('.addon-wrap-3032-vyber-fotopapiru select').trigger("chosen:updated");
                    cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru select").data('price');
                    nova_cena = cena_bez_mnozstvi * jQuery(".product-block .items-num").val();
                    jQuery('.cena-fotky span').html(nova_cena.toFixed(2));
                    jQuery('.cena-fotky').attr("data-soucasna-cena",nova_cena.toFixed(2));    
            }
            
            var text = jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> :selected').text();

            if(obsah>=384 && obsah < 623.7){
            
            }

            if(obsah >= 623.7 && obsah < 1247.4){
                var blok = "623,7";
                if(vybrany_fotopapir == "mat-enhanced-mate-1"){
                    zmena_h("MAT - Enhanced MATTE",blok,obsah);
                }
                if(vybrany_fotopapir == "mat-matte-real-2"){
                    zmena_h("MAT - Matte REAL",blok,obsah);
                }
                if(vybrany_fotopapir == "mat-velvet-fine-art-3"){
                    zmena_h("MAT - Velvet FINE ART",blok,obsah);
                }
                if(vybrany_fotopapir == "lesk-glacier-4"){
                    zmena_h("LESK - GLACIER",blok,obsah);  
                }
                if(vybrany_fotopapir == "lesk-omnijet-5"){
                    zmena_h("LESK - OMNIJET",blok,obsah);
                }
                if(vybrany_fotopapir == "lesk-photo-baryt-6"){
                    zmena_h("LESK - Photo BARYT",blok,obsah);
                }
                if(vybrany_fotopapir == "lesk-premium-glossy-7"){
                    zmena_h("LESK - Premium GLOSSY",blok,obsah);
                }
                if(vybrany_fotopapir == "lesk-premium-luster-8"){
                    zmena_h("LESK - Premium LUSTER",blok,obsah);
                }
                if(vybrany_fotopapir == "lesk-smooth-gloss-9"){
                    zmena_h("LESK - Smooth GLOSS",blok,obsah);
                }
                if(vybrany_fotopapir == "pouze-platno-lesk-satin-canvas-10"){
                    zmena_h("POUZE PLÁTNO - LESK SATIN CANVAS",blok,obsah);
                }
                if(vybrany_fotopapir == "pouze-platno-mat-exclusive-bez-ramu-11"){
                    zmena_h("POUZE PLÁTNO - MAT EXCLUSIVE - bez rámu",blok,obsah);
                }
            }

            if(obsah >= 1247.4 && obsah < 2494.8){
                var blok = "1247,4";
                if(vybrany_fotopapir == "mat-enhanced-mate-1"){
                    zmena_h("MAT - Enhanced MATTE",blok,obsah);
                }
                if(vybrany_fotopapir == "mat-matte-real-2"){
                    zmena_h("MAT - Matte REAL",blok,obsah);
                }
                if(vybrany_fotopapir == "mat-velvet-fine-art-3"){
                    zmena_h("MAT - Velvet FINE ART",blok,obsah);
                }
                if(vybrany_fotopapir == "lesk-glacier-4"){
                    zmena_h("LESK - GLACIER",blok,obsah);  
                }
                if(vybrany_fotopapir == "lesk-omnijet-5"){
                    zmena_h("LESK - OMNIJET",blok,obsah);
                }
                if(vybrany_fotopapir == "lesk-photo-baryt-6"){
                    zmena_h("LESK - Photo BARYT",blok,obsah);
                }
                if(vybrany_fotopapir == "lesk-premium-glossy-7"){
                    zmena_h("LESK - Premium GLOSSY",blok,obsah);
                }
                if(vybrany_fotopapir == "lesk-premium-luster-8"){
                    zmena_h("LESK - Premium LUSTER",blok,obsah);
                }
                if(vybrany_fotopapir == "lesk-smooth-gloss-9"){
                    zmena_h("LESK - Smooth GLOSS",blok,obsah);
                }
                if(vybrany_fotopapir == "pouze-platno-lesk-satin-canvas-10"){
                    zmena_h("POUZE PLÁTNO - LESK SATIN CANVAS",blok,obsah);
                }
                if(vybrany_fotopapir == "pouze-platno-mat-exclusive-bez-ramu-11"){
                    zmena_h("POUZE PLÁTNO - MAT EXCLUSIVE - bez rámu",blok,obsah);
                }
            }
            if(obsah >= 2494.8){
                var blok = "2494,8";
                if(vybrany_fotopapir == "mat-enhanced-mate-1"){
                    zmena_h("MAT - Enhanced MATTE",blok,obsah);
                }
                if(vybrany_fotopapir == "mat-matte-real-2"){
                    zmena_h("MAT - Matte REAL",blok,obsah);
                }
                if(vybrany_fotopapir == "mat-velvet-fine-art-3"){
                    zmena_h("MAT - Velvet FINE ART",blok,obsah);
                }
                if(vybrany_fotopapir == "lesk-glacier-4"){
                    zmena_h("LESK - GLACIER",blok,obsah);  
                }
                if(vybrany_fotopapir == "lesk-omnijet-5"){
                    zmena_h("LESK - OMNIJET",blok,obsah);
                }
                if(vybrany_fotopapir == "lesk-photo-baryt-6"){
                    zmena_h("LESK - Photo BARYT",blok,obsah);
                }
                if(vybrany_fotopapir == "lesk-premium-glossy-7"){
                    zmena_h("LESK - Premium GLOSSY",blok,obsah);
                }
                if(vybrany_fotopapir == "lesk-premium-luster-8"){
                    zmena_h("LESK - Premium LUSTER",blok,obsah);
                }
                if(vybrany_fotopapir == "lesk-smooth-gloss-9"){
                    zmena_h("LESK - Smooth GLOSS",blok,obsah);
                }
                if(vybrany_fotopapir == "pouze-platno-lesk-satin-canvas-10"){
                    zmena_h("POUZE PLÁTNO - LESK SATIN CANVAS",blok,obsah);
                }
                if(vybrany_fotopapir == "pouze-platno-mat-exclusive-bez-ramu-11"){
                    zmena_h("POUZE PLÁTNO - MAT EXCLUSIVE - bez rámu",blok,obsah);
                }
            }
            if(obsah >= 623.7){
                var blok = "623,7";
                if(vybrany_fotopapir == "mat-velvet-fine-art-3"){
                    zmena_h("MAT - Velvet FINE ART",blok,obsah);
                }
            }
        });
        
    });
    
</script>

<script>
jQuery( document ).ready(function() {
    
    var zakladni_cena = 0;
    var nova_cena = 0;
    var cena_bez_mnozstvi = 0;
    var cena_s_mnozstvim = 0;
    var celkem = 0.00;
    
    //PŘI ZMĚNĚ SELECTU
    jQuery(".select-fotka-<?php echo $kolotoc; ?>").change(function() {

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
                cena_bez_mnozstvi = nova_cena;
                nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
            }
        });
        
        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
        jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
    });
    
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

    
});
    
    
        
</script>

<script>
jQuery( document ).ready(function() {

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
            jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format").append('<i class="fa fa-times"></i>');
            
            //PO KLIKNUTÍ NA KŘÍŽEK
            jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format .fa").click(function(){
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
        console.log(sirka+"x"+vyska);
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
        
        jQuery( "#cely-produkt-fotka-<?php echo $kolotoc; ?>" ).fadeOut("fast");
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
    
        <?php //foreach($fotky as $kolotoc => $fotka){ ?>
      
	 	<?php 

           /* $_SESSION[$kolotoc]["id_fotky"] = $kolotoc;
            $_SESSION[$kolotoc]["url_fotky"] = $fotka; */
        
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
 <!--  <div class="vysledek-kokos"></div> -->
    <?php //$vsechny_nahrane_fotky = $_SESSION; 
    //    print_r($vsechny_nahrane_fotky);
    ?>
	<?php //do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
