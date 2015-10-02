<?php
/*
 * Template Name: Multiupload
 * Description: Stránka pro nahrání fotografií
 */

get_header();


/*
session_start();

global $vsechny_nahrane_fotky;
print_r($vsechny_nahrane_fotky);
*/
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
            </div>
            
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
            </div>
        </div>
    <div id="sticky-anchor-tlacitka"></div>    		
	<!-- The file upload form used as target for the file upload widget -->
    <form id="fileupload" action="http://www.skakaciatrakce.cz/nastaveni-fotografii/" method="POST" enctype="multipart/form-data">
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
            
        
        
        <table role="presentation" class="table table-striped"><tbody class="files"></tbody></table>
       
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
	$args = array(
		'post_type' => 'product',
		'posts_per_page' => 12
		);
	$loop = new WP_Query( $args );
  
  //  echo "<pre>",print_r(end($loop->posts)),"</pre>";
    ?> <!--
<select>

    <?php
 /*   foreach($loop->posts as $jeden_produkt)
        echo "<option value='".$jeden_produkt->ID."'> $jeden_produkt->post_title </option>";
*/
    
    ?>
</select>

    <ul class="products">
	<?php
/*
		if ( $loop->have_posts() ) {
			while ( $loop->have_posts() ) : $loop->the_post();
				wc_get_template_part( 'content', 'product' );
			endwhile;
		} else {
			echo __( 'No products found' );
		}
		wp_reset_postdata();
	*/?>
</ul> -->
   <?php
//    echo "<pre>",print_r($loop),"</pre>";
    
?>
	</div>
</div>



<?php
    

  /*  $i = count($_FILES);
    echo "Počet: $i";
    for ($i=0; $i < 50; $i++) { 
        $soubor[$i] = $_FILES["files"]["name"];
    }
*/
?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
            <input type="hidden" name="fotky[]" value="{%=file.url%}">
            <input type="hidden" name="fotky_miniatury[]" value="{%=file.thumbnailUrl%}">
            
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
<!-- The main application script -->
<script src="<?php echo get_template_directory_uri(); ?>/nahrani/js/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
<script src="js/cors/jquery.xdr-transport.js"></script>
<![endif]-->




<?php get_footer(); ?>