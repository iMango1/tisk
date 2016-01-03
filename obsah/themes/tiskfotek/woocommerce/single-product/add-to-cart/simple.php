<?php
session_start();
global $kolotoc;
global $vsechny_nahrane_fotky;
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
            

            
            if(pro_vymazani_id[0]=="a4")
                obsah = 623.7;
            if(pro_vymazani_id[0]=="a3")
                obsah = 1247.4;
            if(pro_vymazani_id[0]=="a2")
                obsah = 2494.8;
            
            if(obsah > 600){
                if(obsah >= 623.7 && obsah <= 1247.3){
                    if(obsah == 623.7){
                    //GLACIER
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-glacier-1"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",80);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                            cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                            nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                            jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
                            jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                        }
                        //OMNIJET
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-omnijet-2"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",65);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                            cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                            nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                            jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
                            jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                        }
                        //PHOTO BARYT    
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-photo-baryt-3"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",90);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                            cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                            nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                            jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                        }
                        //PREMIUM GLOSSY
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-glossy-4"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",70);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                            cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                            nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                            jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                        }
                        //PREMIUM LUSTER
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-luseter-5"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",75);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                            cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                            nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                            jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                        }
                        //SMOOTH GLOSS
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-smooth-gloss-6"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",85);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                            cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                            nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                            jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                        }
                        //ENHANCED MATE
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-enhanced-mate-7"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",65);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                            cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                            nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                            jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                        }
                        //MATTE REAL
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-matte-real-8"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",80);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                            cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                            nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                            jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                        }
                        //MAT - VELVET FINE ART
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-velvet-fine-art-9"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",110);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                            cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                            nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                            jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                        }
                        //POUZE PLÁTNO LESK. SATIN CANVAS
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-lesk-satin-canvas-10"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",135);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                            cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                            nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                            jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                        }
                        //POUZE PLÁTNO MAT. EXCLUSIVE BEZ RÁMU
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-mat-exclusive-bez-ramu-11"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",135);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                            cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                            nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                            jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                        } 
                    }
                    else{
                    
                    //GLACIER
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-glacier-1"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1205);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //OMNIJET
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-omnijet-2"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.0964);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //PHOTO BARYT    
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-photo-baryt-3"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.140);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //PREMIUM GLOSSY
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-glossy-4"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1044);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //PREMIUM LUSTER
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-luseter-5"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1124);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //SMOOTH GLOSS
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-smooth-gloss-6"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1283);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //ENHANCED MATE
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-enhanced-mate-7"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.0964);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //MATTE REAL
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-matte-real-8"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1205);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //MAT - VELVET FINE ART
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-velvet-fine-art-9"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1726);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //POUZE PLÁTNO LESK. SATIN CANVAS
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-lesk-satin-canvas-10"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.2086);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //POUZE PLÁTNO MAT. EXCLUSIVE BEZ RÁMU
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-mat-exclusive-bez-ramu-11"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.2086);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    
                    }
                }
                
                
                if(obsah >= 1247.4 && obsah < 2494.8){

                    
                    if(obsah == 1247.4){
                    //GLACIER
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-glacier-1"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",150);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //OMNIJET
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-omnijet-2"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",120);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //PHOTO BARYT    
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-photo-baryt-3"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",175);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //PREMIUM GLOSSY
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-glossy-4"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",130);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //PREMIUM LUSTER
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-luseter-5"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",140);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //SMOOTH GLOSS
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-smooth-gloss-6"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",160);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //ENHANCED MATE
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-enhanced-mate-7"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",120);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //MATTE REAL
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-matte-real-8"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",150);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //MAT - VELVET FINE ART
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-velvet-fine-art-9"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",215);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //POUZE PLÁTNO LESK. SATIN CANVAS
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-lesk-satin-canvas-10"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",260);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //POUZE PLÁTNO MAT. EXCLUSIVE BEZ RÁMU
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-mat-exclusive-bez-ramu-11"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",260);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        } 
                    }
                    else{
                    
                    
                    //GLACIER
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-glacier-1"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1163);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //OMNIJET
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-omnijet-2"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.0922);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //PHOTO BARYT    
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-photo-baryt-3"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1344);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //PREMIUM GLOSSY
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-glossy-4"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1003);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //PREMIUM LUSTER
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-luseter-5"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1083);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //SMOOTH GLOSS
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-smooth-gloss-6"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1203);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //ENHANCED MATE
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-enhanced-mate-7"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.0922);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //MATTE REAL
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-matte-real-8"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1143);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //MAT - VELVET FINE ART
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-velvet-fine-art-9"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1726);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //POUZE PLÁTNO LESK. SATIN CANVAS
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-lesk-satin-canvas-10"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1965);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    //POUZE PLÁTNO MAT. EXCLUSIVE BEZ RÁMU
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-mat-exclusive-bez-ramu-11"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1965);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        cena_bez_mnozstvi = jQuery(".addon-wrap-3032-vyber-fotopapiru .select-fotka<?php echo $kolotoc; ?>").data('price');
                        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
jQuery('.cena-fotka-<?php echo $kolotoc; ?>').attr("data-soucasna-cena",nova_cena.toFixed(2));
                    }
                    }
                }
                
                
                if(obsah >= 2494.8){

                    
                    if(obsah == 2494.8){
                    //GLACIER
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-glacier-1"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",290);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //OMNIJET
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-omnijet-2"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",230);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //PHOTO BARYT    
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-photo-baryt-3"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",335);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //PREMIUM GLOSSY
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-glossy-4"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",250);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //PREMIUM LUSTER
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-luseter-5"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",270);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //SMOOTH GLOSS
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-smooth-gloss-6"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",300);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //ENHANCED MATE
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-enhanced-mate-7"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",230);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //MATTE REAL
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-matte-real-8"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",285);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //MAT - VELVET FINE ART
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-velvet-fine-art-9"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",285);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //POUZE PLÁTNO LESK. SATIN CANVAS
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-lesk-satin-canvas-10"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",490);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        }
                        //POUZE PLÁTNO MAT. EXCLUSIVE BEZ RÁMU
                        if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-mat-exclusive-bez-ramu-11"){
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",490);
                            jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                        } 
                    }
                    else{
                        
                    //GLACIER
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-glacier-1"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1122);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                    }
                    //OMNIJET
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-omnijet-2"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.0901);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                    }
                    //PHOTO BARYT    
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-photo-baryt-3"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1302);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                    }
                    //PREMIUM GLOSSY
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-glossy-4"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.0961);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                    }
                    //PREMIUM LUSTER
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-premium-luseter-5"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1061);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                    }
                    //SMOOTH GLOSS
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "lesk-smooth-gloss-6"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1161);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                    }
                    //ENHANCED MATE
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-enhanced-mate-7"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.09013);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                    }
                    //MATTE REAL
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-matte-real-8"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1101);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                    }
                    //MAT - VELVET FINE ART
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "mat-velvet-fine-art-9"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1726);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                    }
                    //POUZE PLÁTNO LESK. SATIN CANVAS
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-lesk-satin-canvas-10"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1922);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                    }
                    //POUZE PLÁTNO MAT. EXCLUSIVE BEZ RÁMU
                    if(jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').val() == "pouze-platno-mat-exclusive-bez-ramu-11"){
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?> option:selected').attr("data-price",obsah*0.1922);
                        jQuery('.addon-wrap-3032-vyber-fotopapiru .select-fotka-<?php echo $kolotoc; ?>').trigger("chosen:updated");
                    }
                    }
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
            //ZOBRAZENÍ INPUTU
            jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-format").hide();
            jQuery("#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format input").attr("placeholder", "Vlastní formát v cm (10x20)");
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
        jQuery('#fotka-<?php echo $kolotoc; ?> .product-addon-vlastni-format input').val(sirka+"x"+vyska);
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
