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

$fotky_pred_kop = $_POST["fotky"]; 
$fotky_miniatury = $_POST["fotky_miniatury"];


date_default_timezone_set('Europe/Prague');

    
if(get_current_user_id() == "0"){
    $rand_id_uzivatele = rand(1000,99999);

    
    $slozky = scandir("/home/web/skakaciatrakce.cz/objednavky");
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

mkdir("/home/web/skakaciatrakce.cz/objednavky/$objednavka_id", 0777);

    foreach ($fotky_pred_kop as $i => $fotka_pred_kop) {
        $fotka_kousek_url[$i] = explode("|/", $fotka_pred_kop);
        $fotky_nazev_pred_kop[$i] = $fotka_kousek_url[$i][1];
    }
$fotky = array();

    foreach($fotky_nazev_pred_kop as $kolotoc => $fotka_nazev_pred_kop){
        $co = "http://www.skakaciatrakce.cz/obsah/themes/tiskfotek/nahrani/server/php/files|/$fotka_nazev_pred_kop";
        $kam = "/home/web/skakaciatrakce.cz/objednavky/$objednavka_id/$fotka_nazev_pred_kop";
        copy($co,$kam);  
        
      //  $prejmenovany_soubor = str_replace("%20"," ", $fotka_nazev_pred_kop);
        
      //  $kam = "/home/web/skakaciatrakce.cz/objednavky/$objednavka_id/$prejmenovany_soubor";
        
        $fotky[$kolotoc] = $kam;
        $_SESSION[$kolotoc]["id_fotky"] = $kolotoc;
        $_SESSION[$kolotoc]["nazev_slozky"] = $objednavka_id;
        $_SESSION[$kolotoc]["nazev_fotky"] = $fotka_nazev_pred_kop;
        $_SESSION[$kolotoc]["nazev_bez_formatu"] = preg_replace('/\\.[^.\\s]{3,4}$/', '', $fotka_nazev_pred_kop);
        $_SESSION[$kolotoc]["typ_souboru"] = pathinfo($fotka_nazev_pred_kop, PATHINFO_EXTENSION);
        $_SESSION[$kolotoc]["url_fotky"] = $fotky[$kolotoc]; 
        $_SESSION[$kolotoc]["url_fotky_upload"] = $co;
        
    //    rename("/home/web/skakaciatrakce.cz/objednavky/$objednavka_id/$fotka_nazev_pred_kop", "/home/web/skakaciatrakce.cz/objednavky/$objednavka_id/$prejmenovany_soubor");
        
    }



        
        foreach($fotky_miniatury as $kolotoc => $fotka_miniatura){
            $_SESSION[$kolotoc]["url_miniatura"] = $fotka_miniatura;
        }

        $vsechny_nahrane_fotky = $_SESSION;

// echo "<pre>",print_r($_SESSION),"</pre>";

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
            		            			<option data-price="549" value="fotoobraz-8">Fotoobraz (549.00&nbsp;Kč)</option>
                                    </optgroup>
<optgroup label="Velké formáty">
            		            			<option data-price="" value="30x40-10">30×40</option>
                                		            			<option data-price="" value="40x50-11">40×50</option>
                                		            			<option data-price="" value="50x70-12">50×70</option>
                                		            			<option data-price="" value="60x40-13">60×40</option>
                                		            			<option data-price="" value="60x80-14">60×80</option>
                                		            			<option data-price="" value="70x100-15">70×100</option>
                                		            			<option data-price="" value="80x120-16">80×120</option>
                                		            			<option data-price="80" value="a4-17">A4</option>
                                		            			<option data-price="150" value="a3-18">A3</option>
                                		            			<option data-price="" value="a2-19">A2</option>
                                    </optgroup>
                    		
	</select>
                </div>
                               <div class="col-md-2 vyber-fotopapiru">
                               <select class="addon addon-select chosen-select addon-3032-vyber-fotopapiru" name="addon-3032-vyber-fotopapiru" style="display: none;">

					<option value="">Výběr fotopapíru</option>
		        
		            			<option data-price="145" value="lesk-glacier-1">LESK – Glacier (145.00&nbsp;Kč)</option>
                                		            			<option data-price="116" value="lesk-omnijet-2">LESK – Omnijet </option>
                                		            			<option data-price="168" value="lesk-photo-baryt-3">LESK – Photo Baryt </option>
                                		            			<option data-price="125" value="lesk-premium-glossy-4">LESK – Premium Glossy</option>
                                		            			<option data-price="135" value="lesk-premium-luseter-5">LESK – Premium Luseter</option>
                                		            			<option data-price="154" value="lesk-smooth-gloss-6">LESK – Smooth Gloss</option>
                                		            			<option data-price="116" value="mat-enhanced-mate-7">MAT – Enhanced Mate</option>
                                		            			<option data-price="145" value="mat-matte-real-8">MAT – Matte Real</option>
                                		            			<option data-price="207" value="mat-velvet-fine-art-9">MAT – Velvet Fine Art</option>
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
                    <select class="addon addon-select chosen-select addon-3032-nalepit-na-desku" name="addon-3032-nalepit-na-desku" style="display: none;">

					<option value="">Nalepit na desku?</option>
		        
		            			<option data-price="27.17" value="deska-rayboard-5mm-1">Deska Rayboard 5mm</option>
                                		            			<option data-price="39.2" value="deska-rayboard-10mm-2">Deska Rayboard 10mm</option>
                                		
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
    <button id="potvrzeni" class="pokracovat btn main-bg pull-right disabled">Pokračovat k objednávce</button>
    <div id="nahravani" class="pull-right"></div>
</div>

 <div class="footer-uploader">
     <div class="col-md-6">
         <p>Digitální fotosběrna</p>
     </div>   
     <div class="col-md-6">
         <p class="pull-right">Multiuploader 1.0.3</p>
     </div>    
</div>
        
  <script src="http://malsup.github.io/min/jquery.form.min.js"></script>
   <script>

    jQuery('#potvrzeni').click(function(){
        var i = 0;
        <?php $pomoc_celkovy_pocet = $celkovy_pocet - 1;  ?>
        <?php for($i=0;$i<$celkovy_pocet;$i++) {?>
        var myform = document.getElementById("formular-<?php echo $i; ?>");
        var fd = new FormData(myform);
        $.ajax({
            url: "kosik",
            data: fd,
            cache: false,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function (dataofconfirm) {

                if(<?php echo $i; ?> == <?php echo $pomoc_celkovy_pocet; ?>)
                    location.href = 'http://www.skakaciatrakce.cz/kosik'; 
            }
        });
        
        <?php } ?>
          
    });
       
    jQuery(function() {    
        jQuery("#nahravani").hide();
        jQuery("#potvrzeni").click(function() {
            jQuery("#potvrzeni").hide();    
            jQuery("#nahravani").fadeIn("slow");
        });
    }); 

    jQuery(function() {
        jQuery(".product-addon-format .chosen-container .chosen-single span").replaceWith( "<span>Výber formátu</span>" );
    });

    jQuery(function() {
        jQuery(".format .chosen-container .chosen-single span").replaceWith( "<span>Výber formátu</span>" );
    });
    jQuery(function() { 
        /*
        var zakladni_cena = 0;
        var nova_cena = 0;
        var cena_bez_mnozstvi = 0;
        var cena_s_mnozstvim = 0;
        var celkem = 0.00;
        var jedna_fotka = Array();
        var pocet_fotek = <?php echo $celkovy_pocet; ?>;
        var i;
        for (i=0;i<pocet_fotek;i++){    
            //PŘI ZMĚNĚ SELECTU
            jQuery(".select-fotka-"+i).change(function() {
                
                 jQuery('.select-fotka-'+i+' option:selected').each(function() {
                     if( jQuery(this).data('price') == null ){
                         nova_cena = nova_cena;
                     }
                     else if (!(jQuery(this).data('price'))){
                         nova_cena = nova_cena;
                     }
                     else{
                         nova_cena += jQuery(this).data('price');
                         cena_bez_mnozstvi = nova_cena;
                         jedna_fotka[i] = cena_bez_mnozstvi * jQuery("#formular-<?php echo $kolotoc; ?> .items-num").val();
                     }
                 });
                
            });
        
            //PŘI ZMĚNĚ POČTU NAPSÁNÍM
            jQuery("#formular-"+i+" .items-num").change(function() {
                jedna_fotka[i] = cena_bez_mnozstvi * jQuery(this).val(); 
            });
        
            //PŘI ZMĚNĚ KLIKNUTÍM NA PLUSKO
            jQuery("#formular-"+i+" .pocet-tlacitka .pridat").click(function(){
                var stara_hodnota = jQuery("#formular-"+i+" .items-num").val();
                var nova_hodnota = parseInt(stara_hodnota) + 1;
                jQuery("#formular-"+i+" .items-num").val(nova_hodnota);
                jedna_fotka[i] = cena_bez_mnozstvi * jQuery("#formular-"+i+" .items-num").val();
            });   
       
            //PŘI ZMĚNĚ KLIKNUTÍM NA MINUS
           jQuery("#formular-"+i+" .pocet-tlacitka .odebrat").click(function(){
               var stara_hodnota = jQuery("#formular-"+i+" .items-num").val();
               if(stara_hodnota>1){
                   var nova_hodnota = parseInt(stara_hodnota) - 1;
                   jQuery("#formular-"+i+" .items-num").val(nova_hodnota);
                   jedna_fotka[i] = cena_bez_mnozstvi * jQuery("#formular-<?php  echo $kolotoc; ?> .items-num").val();
               }
            });
    }
    
    
        
        for(i=0;i<pocet_fotek;i++){
            jQuery(".select-fotka-"+i).change(function() {
                jQuery('.select-fotka-'+i+' option:selected').each(function() {
                    celkem = jedna_fotka[i];
                    jQuery(".celkova-cena span").html(celkem.toFixed(2));
                    alert(jedna_fotka[i]);
                });
            });
        }
        */
        var i=0;
        var pocet_fotek = <?php echo $celkovy_pocet; ?>;
        
            jQuery('.cena-fotka-'+i).bind("DOMSubtreeModified",function(){
                
                var cenovka = jQuery(".cena-fotka-"+i+" span").text();                
                jQuery(".celkova-cena span").html(cenovka);
            });
    
    });
    </script>
	</div>
</div>


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/js/chosen.jquery.min.js"></script>


<?php get_footer(); ?>