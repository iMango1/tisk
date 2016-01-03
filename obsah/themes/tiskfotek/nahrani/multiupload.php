<?php
/*
 * Template Name: Multiupload
 * Description: Stránka pro nahrání fotografií
 */

get_header();
/*
$url = $_SERVER["SERVER_NAME"];
$url_roz = explode(".", $url);

$_NAZEV_WEBU = $url_roz[1];
*/
$_NAZEV_WEBU = "skakaciatrakce";
?>

<div id="sticky-anchor-kroky"></div>
<div class="section sm-padding" id="nahrani-fotek">
	<div class="container">
         
        <div class="kroky_blok">
		    <div class="krok jedna_upload aktivni"><a><span class="cislo">1</span> Upload fotografií</a></div>
            <div class="krok dva_upload nepristupne"><a><span class="cislo">2</span> Nastavení parametrů tisku</a></div>
            <div class="krok dva_upload nepristupne"><a><span class="cislo">3</span> Košík</a></div>
            <div class="krok dva_upload nepristupne"><a><span class="cislo">4</span> Fakturační údaje</a></div>
            <div class="krok dva_upload nepristupne"><a><span class="cislo">5</span> Dokončení objednávky</a></div>
        </div>
        
        <div class="napoveda">
             <div class="col-md-6 sloupec levy">
                <div class="col-md-4 col-xs-12 ikony">
                    <div class="leva jpg"></div>
                    <div class="prava tif"></div>
                </div>
                <div class="col-md-8">
                    <h2>Podpora fotografických formátů</h2>
                    <p>
                        Můžete nahrávat soubory fotografií 
                        ve formátech JPG a TIF.
                        V tomto případě parametry tisku nastavujete
                        v dalším kroku objednávky pro každou fotografi zvlášť.
                    </p>
                </div>
                 
            <div class="modal-tlacitka">
                <main class="cd-main-content">
		          <section class="center">
			         <a href="#0" class="cd-btn" id="modal-trigger-formaty" data-type="cd-modal-trigger">Nápověda</a>
		          </section>
	            </main> <!-- .cd-main-content -->
            </div>   
	
        <div class="cd-modal" data-modal="modal-trigger-formaty">
		<div class="cd-svg-bg" 
		data-step1="M-59.9,540.5l-0.9-1.4c-0.1-0.1,0-0.3,0.1-0.3L864.8-41c0.1-0.1,0.3,0,0.3,0.1l0.9,1.4c0.1,0.1,0,0.3-0.1,0.3L-59.5,540.6 C-59.6,540.7-59.8,540.7-59.9,540.5z" 
		data-step2="M33.8,690l-188.2-300.3c-0.1-0.1,0-0.3,0.1-0.3l925.4-579.8c0.1-0.1,0.3,0,0.3,0.1L959.6,110c0.1,0.1,0,0.3-0.1,0.3 L34.1,690.1C34,690.2,33.9,690.1,33.8,690z" 
		data-step3="M-465.1,287.5l-0.9-1.4c-0.1-0.1,0-0.3,0.1-0.3L459.5-294c0.1-0.1,0.3,0,0.3,0.1l0.9,1.4c0.1,0.1,0,0.3-0.1,0.3 l-925.4,579.8C-464.9,287.7-465,287.7-465.1,287.5z" 
		data-step4="M-329.3,504.3l-272.5-435c-0.1-0.1,0-0.3,0.1-0.3l925.4-579.8c0.1-0.1,0.3,0,0.3,0.1l272.5,435c0.1,0.1,0,0.3-0.1,0.3 l-925.4,579.8C-329,504.5-329.2,504.5-329.3,504.3z" 
		data-step5="M341.1,797.5l-0.9-1.4c-0.1-0.1,0-0.3,0.1-0.3L1265.8,216c0.1-0.1,0.3,0,0.3,0.1l0.9,1.4c0.1,0.1,0,0.3-0.1,0.3L341.5,797.6 C341.4,797.7,341.2,797.7,341.1,797.5z" 
		data-step6="M476.4,1013.4L205,580.3c-0.1-0.1,0-0.3,0.1-0.3L1130.5,0.2c0.1-0.1,0.3,0,0.3,0.1l271.4,433.1c0.1,0.1,0,0.3-0.1,0.3 l-925.4,579.8C476.6,1013.6,476.5,1013.5,476.4,1013.4z">
			<svg height="100%" width="100%" preserveAspectRatio="none" viewBox="0 0 800 500">
				<title>SVG Modal background</title>
				<path id="cd-changing-path-formaty-1" d="M-59.9,540.5l-0.9-1.4c-0.1-0.1,0-0.3,0.1-0.3L864.8-41c0.1-0.1,0.3,0,0.3,0.1l0.9,1.4c0.1,0.1,0,0.3-0.1,0.3L-59.5,540.6 C-59.6,540.7-59.8,540.7-59.9,540.5z"/>
				<path id="cd-changing-path-formaty-2" d="M-465.1,287.5l-0.9-1.4c-0.1-0.1,0-0.3,0.1-0.3L459.5-294c0.1-0.1,0.3,0,0.3,0.1l0.9,1.4c0.1,0.1,0,0.3-0.1,0.3 l-925.4,579.8C-464.9,287.7-465,287.7-465.1,287.5z"/>
				<path id="cd-changing-path-formaty-3" d="M341.1,797.5l-0.9-1.4c-0.1-0.1,0-0.3,0.1-0.3L1265.8,216c0.1-0.1,0.3,0,0.3,0.1l0.9,1.4c0.1,0.1,0,0.3-0.1,0.3L341.5,797.6 C341.4,797.7,341.2,797.7,341.1,797.5z"/>
			</svg>
		</div>

		<div class="cd-modal-content">
			<p>PODPORA FOTOGRAFICKÝCH FORMÁTŮ
Můžete nahrávat soubory fotografií ve formátech JPG a TIF. V tomto případě parametry tisku nastavujete v dalším kroku objednávky pro každou fotografi zvlášť.
			</p>

			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad modi repellendus, optio eveniet eligendi molestiae? Fugiat, temporibus! A rerum pariatur neque laborum earum, illum voluptatibus eum voluptatem fugiat, porro animi tempora? Sit harum nulla, nesciunt molestias, iusto aliquam aperiam est qui possimus reprehenderit ipsam ea aut assumenda inventore iste! Animi quaerat facere repudiandae earum quisquam accusamus tempora, delectus nesciunt, provident quae aliquam, voluptatum beatae quis similique in maiores repellat eligendi voluptas veniam optio illum vero! Eius, dignissimos esse eligendi veniam.
			</p>
		</div> <!-- cd-modal-content -->

		<a href="#0" class="modal-close">Close</a>
	   </div> <!-- cd-modal -->

            </div> <!-- col-md-6 -->
            
            <div class="col-md-6 sloupec pravy">
                <div class="col-md-4 col-xs-12 ikony">
                    <div class="leva rar"></div>
                    <div class="prava zip"></div>
                </div>
                <div class="col-md-8">
                    <h2>Podpora komprimovaných formátů</h2>
                    <p>
                        Můžete nahrávat komprimované soubory 
                        ve formátech ZIP a RAR.
                        Vhodná a rychlá volba pro případ, že u všech
                        fotografií požadujete stejné parametry tisku.
                    </p>
                </div>
                
                
                
                <div class="modal-tlacitka">
                    <main class="cd-main-content">
		              <section class="center">
			             <a href="#0" class="cd-btn" id="modal-trigger" data-type="cd-modal-trigger">Nápověda</a>
		              </section>
	               </main> <!-- .cd-main-content -->
                </div>   
	<div class="cd-modal" data-modal="modal-trigger">
		<div class="cd-svg-bg" 
		data-step1="M-59.9,540.5l-0.9-1.4c-0.1-0.1,0-0.3,0.1-0.3L864.8-41c0.1-0.1,0.3,0,0.3,0.1l0.9,1.4c0.1,0.1,0,0.3-0.1,0.3L-59.5,540.6 C-59.6,540.7-59.8,540.7-59.9,540.5z" 
		data-step2="M33.8,690l-188.2-300.3c-0.1-0.1,0-0.3,0.1-0.3l925.4-579.8c0.1-0.1,0.3,0,0.3,0.1L959.6,110c0.1,0.1,0,0.3-0.1,0.3 L34.1,690.1C34,690.2,33.9,690.1,33.8,690z" 
		data-step3="M-465.1,287.5l-0.9-1.4c-0.1-0.1,0-0.3,0.1-0.3L459.5-294c0.1-0.1,0.3,0,0.3,0.1l0.9,1.4c0.1,0.1,0,0.3-0.1,0.3 l-925.4,579.8C-464.9,287.7-465,287.7-465.1,287.5z" 
		data-step4="M-329.3,504.3l-272.5-435c-0.1-0.1,0-0.3,0.1-0.3l925.4-579.8c0.1-0.1,0.3,0,0.3,0.1l272.5,435c0.1,0.1,0,0.3-0.1,0.3 l-925.4,579.8C-329,504.5-329.2,504.5-329.3,504.3z" 
		data-step5="M341.1,797.5l-0.9-1.4c-0.1-0.1,0-0.3,0.1-0.3L1265.8,216c0.1-0.1,0.3,0,0.3,0.1l0.9,1.4c0.1,0.1,0,0.3-0.1,0.3L341.5,797.6 C341.4,797.7,341.2,797.7,341.1,797.5z" 
		data-step6="M476.4,1013.4L205,580.3c-0.1-0.1,0-0.3,0.1-0.3L1130.5,0.2c0.1-0.1,0.3,0,0.3,0.1l271.4,433.1c0.1,0.1,0,0.3-0.1,0.3 l-925.4,579.8C476.6,1013.6,476.5,1013.5,476.4,1013.4z">
			<svg height="100%" width="100%" preserveAspectRatio="none" viewBox="0 0 800 500">
				<title>SVG Modal background</title>
				<path id="cd-changing-path-1" d="M-59.9,540.5l-0.9-1.4c-0.1-0.1,0-0.3,0.1-0.3L864.8-41c0.1-0.1,0.3,0,0.3,0.1l0.9,1.4c0.1,0.1,0,0.3-0.1,0.3L-59.5,540.6 C-59.6,540.7-59.8,540.7-59.9,540.5z"/>
				<path id="cd-changing-path-2" d="M-465.1,287.5l-0.9-1.4c-0.1-0.1,0-0.3,0.1-0.3L459.5-294c0.1-0.1,0.3,0,0.3,0.1l0.9,1.4c0.1,0.1,0,0.3-0.1,0.3 l-925.4,579.8C-464.9,287.7-465,287.7-465.1,287.5z"/>
				<path id="cd-changing-path-3" d="M341.1,797.5l-0.9-1.4c-0.1-0.1,0-0.3,0.1-0.3L1265.8,216c0.1-0.1,0.3,0,0.3,0.1l0.9,1.4c0.1,0.1,0,0.3-0.1,0.3L341.5,797.6 C341.4,797.7,341.2,797.7,341.1,797.5z"/>
			</svg>
		</div>

		<div class="cd-modal-content">
			<p>PODPORA KOMPRIMOVANÝCH FORMÁTŮ
Můžete nahrávat komprimované soubory ve formátech ZIP a RAR. Vhodná a rychlá volba pro případ, že u všech fotografií požadujete stejné parametry tisku.
			</p>

			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad modi repellendus, optio eveniet eligendi molestiae? Fugiat, temporibus! A rerum pariatur neque laborum earum, illum voluptatibus eum voluptatem fugiat, porro animi tempora? Sit harum nulla, nesciunt molestias, iusto aliquam aperiam est qui possimus reprehenderit ipsam ea aut assumenda inventore iste! Animi quaerat facere repudiandae earum quisquam accusamus tempora, delectus nesciunt, provident quae aliquam, voluptatum beatae quis similique in maiores repellat eligendi voluptas veniam optio illum vero! Eius, dignissimos esse eligendi veniam.
			</p>
		</div> <!-- cd-modal-content -->

		<a href="#0" class="modal-close">Close</a>
	</div> <!-- cd-modal -->   
                
            </div> <!-- col-md-6 -->
        </div> <!-- Napoveda -->        
    <div class="pokud_registrovany">Pokud jste registrovaný zákazník, přihlaste se prosím v horní části stránky nebo klikněte <i class="fa fa-arrow-right"></i><a class="btn tlacitko-reg pull-right" href="prihlaseni/">Přihlášení/Registrace</a></div>
    <div id="sticky-anchor-tlacitka"></div>    		
	<!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="http://www.<?php echo $_NAZEV_WEBU; ?>.cz/nastaveni-fotografii/" method="POST" enctype="multipart/form-data">
        <!-- Redirect browsers with JavaScript disabled to the origin page
        <noscript><input type="hidden" name="redirect" value="https://blueimp.github.io/jQuery-File-Upload/"></noscript> -->
        <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
        <div class="row fileupload-buttonbar">
            <div class="col-lg-12">
                <!-- The fileinput-button span is used to style the file input field as button -->
                <span class="btn btn-success fileinput-button">
                    <i class="fa fa-plus-circle"></i>
                    <span>Vybrat soubory</span>
                    <input type="file" name="files[]" multiple>
                </span>
                <button type="submit" class="btn btn-primary start">
                    <i class="fa fa-arrow-circle-up"></i>
                    <span>Nahrát všechny soubory</span>
                </button>
                <button type="reset" class="btn btn-warning cancel">
                    <i class="fa fa-ban"></i>
                    <span>Zrušit nahrávání</span>
                </button>
                <button type="button" class="btn btn-danger delete">
                    <i class="fa fa-trash"></i>
                    <span>Vymazat vybrané</span>
                </button>
                <input type="checkbox" class="toggle">
                <!-- The global file processing state -->
                <span class="fileupload-process"></span>
            </div>

            <!-- The global progress state
            <div class="col-lg-5 fileupload-progress fade">
                <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="progress-bar progress-bar-success" style="width:0%;"></div>
                </div>
                <div class="progress-extended">&nbsp;</div>
            </div>-->
        </div>
            
        
        
        <table role="presentation" class="table table-striped">
           
           <tbody class="files">
    
    
            
            <?php
             //VELIKOSTI SOUBORŮ
                function velikost($bytes, $decimals = 2) {
                    $sz = 'BKMGTP';
                    $factor = floor((strlen($bytes) - 1) / 3);
                    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) ." ". @$sz[$factor];
                }   
               
            if(isset($_SESSION["nazev_slozky"])){
            //ZRUŠENÍ DISABLED U TLAČÍTKA - protože existují fotografie
            ?>
                <script>
                    jQuery( document ).ready(function() {
                        jQuery(".pokracovat").removeClass("disabled");
                    });
                </script>
            <?php
            //echo "<pre>",print_r($_SESSION),"</pre>";       
            $slozka = $_SESSION["nazev_slozky"];
            $soubory_v_slozce = glob("/home/web/$_NAZEV_WEBU.cz/objednavky/$slozka/*.*"); 
            
            for ($i=0; $i<count($soubory_v_slozce); $i++) {
                
                $foto = $soubory_v_slozce[$i];
                $foto_roz = explode("objednavky/", $foto);
                $id_a_fotka = $foto_roz[1];
                $jen_foto = explode("/",$id_a_fotka);
                $url = "/home/web/$_NAZEV_WEBU.cz/objednavky/".$foto_roz[1];
                
                if($_SESSION["status"]==1){
            ?>
                    <tr class="template-download">
                          <td>
                            <span class="preview">
                               
                                <img src="http://objednavky.<?php echo $_NAZEV_WEBU; ?>.cz/<?php echo $foto_roz[1]; ?>" style="max-width:100px; max-heihgt:100px">

                            </span>
                        </td>
                        <td>
                            <p class="name">
                                <?php echo $jen_foto[1];?>
                            </p>
                            <input type="hidden" name="fotky[]" value="http://www.<?php echo $_NAZEV_WEBU; ?>.cz/obsah/themes/tiskfotek/nahrani/server/php/files|/<?php echo $jen_foto[1];?>">
                            <input type="hidden" name="fotky_miniatury[]" value="http://www.<?php echo $_NAZEV_WEBU; ?>.cz/obsah/themes/tiskfotek/nahrani/server/php/files|/thumbnail/<?php echo $jen_foto[1];?>">
                        </td>
                        <td>
                            <?php echo velikost(filesize($url))."B"; ?>
                        </td>
                        <td>
                            <button class="btn btn-danger delete" data-type="DELETE" data-url="http://www.<?php echo $_NAZEV_WEBU; ?>.cz/obsah/themes/tiskfotek/nahrani/server/php/index.php?file=<?php echo $jen_foto[1];?>">
                                <i class="glyphicon glyphicon-trash"></i>
                                <span>Vymazat</span>
                            </button>
                            <input type="checkbox" name="delete" value="1" class="toggle">
            
                        </td>
                    </tr>
                       

            <?php
                }
            }
            
        }
         ?>   
           </tbody>
            </table>
       
        <button class="pokracovat btn btn-large main-bg pull-right disabled">Pokračovat k objednávce</button>
        
        <div class="footer-uploader" style="position: relative; margin-top: 90px;">
            <div class="col-md-6">
                <p>Digitální fotosběrna</p>
            </div>   
            <div class="col-md-6">
                <p class="pull-right">Multiuploader 1.0.3</p>
            </div>    
        </div>   
    </form>


    <?php
            //SCRIPT PRO MAZÁNÍ SOUBORŮ VE SLOŽCE NAHRÁNÍ. ODKOMENTÁŘOVAT POUZE TEHDY KDYŽ SE NĚCO POSERE A FOTOGRAFIE SE NESMAŽOU!!!
            /*
            $normal = glob("/home/web/$_NAZEV_WEBU.cz/www/obsah/themes/tiskfotek/nahrani/server/php/files|/*.*"); 
            
            for ($i=0; $i<count($normal); $i++) {
                
                $foto = $normal[$i];
                unlink($foto);
            }
            
            $mini = glob("/home/web/$_NAZEV_WEBU.cz/www/obsah/themes/tiskfotek/nahrani/server/php/files|/thumbnail/*.*"); 
            
            for ($i=0; $i<count($mini); $i++) {
                
                $foto = $mini[$i];
                unlink($foto);
            }
            
            */
        
?>
	</div>
</div>
<?php
  
        global $woocommerce;
        $kosik = $woocommerce->cart; 
        reset($kosik->cart_contents);
        $prvni = key($kosik->cart_contents);
        $k_vymazani = explode("kosik/",$kosik->get_remove_url($prvni));
        $vymaz = $k_vymazani[1];

?>



<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>    
   
    jQuery(function () {
        <?php if (!isset($_COOKIE["woocommerce_cart_hash"])){ ?>
            addToCart(3032);
            return false;
        <?php } ?>
    });    

   function addToCart(p_id){
      $.get('/wp/?post_type=product&add-to-cart=' + p_id, function() {
          console.log("VYTVOŘENA TMP FOTKA");
      });
   }
</script>
<?php 
    if (!isset($_COOKIE["woocommerce_cart_hash"])){
        $_SESSION["pridano"] = 1;
    }
    else{
        $_SESSION["pridano"] = 0; 
    }
?>
<!--
SESSION<br>
<?php echo "<pre>",print_r($_SESSION),"</pre>"; ?>
COOKIES<br>
<?php echo "<pre>",print_r($_COOKIE),"</pre>"; ?>
-->
<script type="text/javascript">
$('#fileupload').fileupload({
    dropZone: $('#dropzone')
});
</script>
<script>
    function sticky_relocate() {
        var window_top = jQuery(window).scrollTop();
        var div_top_tlacitka = jQuery('#sticky-anchor-tlacitka').offset().top;
        if (window_top > div_top_tlacitka) {
            jQuery('.fileupload-buttonbar').addClass('stick');
        } else {
            jQuery('.fileupload-buttonbar').removeClass('stick');
        }
        
        
        var div_top_kroky = jQuery('#sticky-anchor-kroky').offset().top;
        if (window_top > div_top_kroky) {
            jQuery('.kroky_blok').addClass('stick');
        } else {
            jQuery('.kroky_blok').removeClass('stick');
        }
    }


jQuery(function () {
    jQuery(window).scroll(sticky_relocate);
    sticky_relocate();
});

</script>
<script type="text/javascript">
$(document).bind('dragover', function (e) {
    var dropZone = $('#dropzone'),
        timeout = window.dropZoneTimeout;
    if (!timeout) {
        dropZone.addClass('in');
    } else {
        clearTimeout(timeout);
    }
    var found = false,
        node = e.target;
    do {
        if (node === dropZone[0]) {
            found = true;
            break;
        }
        node = node.parentNode;
    } while (node != null);
    if (found) {
        dropZone.addClass('hover');
    } else {
        dropZone.removeClass('hover');
    }
    window.dropZoneTimeout = setTimeout(function () {
        window.dropZoneTimeout = null;
        dropZone.removeClass('in hover');
    }, 100);
});
</script>
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td>
            <span class="preview"></span>
        </td>
        <td>
            <p class="name">{%=file.name%}</p>
            <strong class="error text-danger"></strong>
        </td>
        <td>
            <p class="size">Nahrávání...</p>
            <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
        </td>
        <td class="tlacitka-nahrani">
            {% if (!i && !o.options.autoUpload) { %}
                <button class="btn btn-primary start" disabled>
                    <i class="fa fa-arrow-circle-up"></i>
                    <span>Nahrát</span>
                </button>
            {% } %}
            {% if (!i) { %}
                <button class="btn btn-warning cancel">
                    <i class="fa fa-ban"></i>
                    <span>Zrušit</span>
                </button>
            {% } %}
        </td>
    </tr>
{% } %}
</script>
<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">

{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">    

        <td>
            <span class="preview">
                {% if (file.thumbnailUrl) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" data-gallery><img src="{%=file.thumbnailUrl%}"></a>
                {% } %}
            </span>
        </td>
       
        <td>
        
            <p class="name">
                {% if (file.url) { %}
                    <a href="{%=file.url%}" title="{%=file.name%}" download="{%=file.name%}" {%=file.thumbnailUrl?'data-gallery':''%}>{%=file.name%}</a>

                {% } else { %}
                    <span>{%=file.name%}</span>
                {% } %}
            </p>
            <input type="hidden" name="fotky[]" value="http://www.<?php echo $_NAZEV_WEBU; ?>.cz/obsah/themes/tiskfotek/nahrani/server/php/files|/{%=file.name%}">
            <input type="hidden" name="fotky_miniatury[]" value="http://www.<?php echo $_NAZEV_WEBU; ?>.cz/obsah/themes/tiskfotek/nahrani/server/php/files|/thumbnail/{%=file.name%}">
            
            {% if (file.error) { %}
                <div><span class="label label-danger">Chyba</span> {%=file.error%}</div>
            {% } %}
        </td>
        <td>
            <span class="size">{%=o.formatFileSize(file.size)%}</span>
        </td>
        <td>
            {% if (file.deleteUrl) { %}
                <button class="btn btn-danger delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields='{"withCredentials":true}'{% } %}>
                    <i class="glyphicon glyphicon-trash"></i>
                    <span>Vymazat</span>
                </button>
                <input type="checkbox" name="delete" value="1" class="toggle">
            {% } else { %}
                <button class="btn btn-warning cancel">
                    <i class="glyphicon glyphicon-ban-circle"></i>
                    <span>Zrušit</span>
                </button>
            {% } %}
        </td>
    </tr>
    
{% } %}


</script>



<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?php echo get_template_directory_uri(); ?>/nahrani/js/vendor/jquery.ui.widget.js"></script>
<!-- The Templates plugin is included to render the upload/download listings -->
<script src="http://blueimp.github.io/JavaScript-Templates/js/tmpl.min.js"></script>
<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
<!-- The Canvas to Blob plugin is included for image resizing functionality -->
<script src="http://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
<!-- Bootstrap JS is not required, but included for the responsive demo navigation -->
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- blueimp Gallery script -->
<script src="http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo get_template_directory_uri(); ?>/nahrani/js/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo get_template_directory_uri(); ?>/nahrani/js/jquery.fileupload.js"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo get_template_directory_uri(); ?>/nahrani/js/jquery.fileupload-process.js"></script>
<!-- The File Upload image preview & resize plugin -->
<script src="<?php echo get_template_directory_uri(); ?>/nahrani/js/jquery.fileupload-image.js"></script>
<!-- The File Upload audio preview plugin -->
<script src="<?php echo get_template_directory_uri(); ?>/nahrani/js/jquery.fileupload-audio.js"></script>
<!-- The File Upload video preview plugin -->
<script src="<?php echo get_template_directory_uri(); ?>/nahrani/js/jquery.fileupload-video.js"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo get_template_directory_uri(); ?>/nahrani/js/jquery.fileupload-validate.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?php echo get_template_directory_uri(); ?>/nahrani/js/jquery.fileupload-ui.js"></script>
<!-- SNAP SVG -->
<script src="<?php echo get_template_directory_uri(); ?>/nahrani/js/snap.svg-min.js"></script>
<!-- The main application script -->
<script src="<?php echo get_template_directory_uri(); ?>/nahrani/js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->


<?php get_footer(); ?>