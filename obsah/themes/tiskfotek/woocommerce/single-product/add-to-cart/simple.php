<?php
session_start();
global $kolotoc;
global $vsechny_nahrane_fotky;
?>

<script>
jQuery( document ).ready(function() {
    
    var zakladni_cena = 0;
    var nova_cena = 0;
    var cena_bez_mnozstvi = 0;
    var cena_s_mnozstvim = 0;
    
    var cena_celkem = 0;
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
    });
    
    
    jQuery("#formular-<?php echo $kolotoc; ?> .items-num").change(function() {
        nova_cena = cena_bez_mnozstvi * jQuery(this).val();
        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
    });
    
    
    jQuery("#formular-<?php echo $kolotoc;?> .pocet-tlacitka .pridat").click(function(){
       var stara_hodnota = jQuery("#formular-<?php  echo $kolotoc; ?> .items-num").val();
        var nova_hodnota = parseInt(stara_hodnota) + 1;
        jQuery("#formular-<?php  echo $kolotoc; ?> .items-num").val(nova_hodnota);
        
        nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php  echo $kolotoc; ?> .items-num").val();
        jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
    });   
    jQuery("#formular-<?php echo $kolotoc;?> .pocet-tlacitka .odebrat").click(function(){
        var stara_hodnota = jQuery("#formular-<?php  echo $kolotoc; ?> .items-num").val();
        if(stara_hodnota>1){
            var nova_hodnota = parseInt(stara_hodnota) - 1;
            jQuery("#formular-<?php  echo $kolotoc; ?> .items-num").val(nova_hodnota);
            nova_cena = cena_bez_mnozstvi * jQuery("#formular-<?php  echo $kolotoc; ?> .items-num").val();
            jQuery('.cena-fotka-<?php echo $kolotoc; ?> span').html(nova_cena.toFixed(2));
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
        
    });

    
});
    
    
        
</script>

    

<script>
jQuery( document ).ready(function() {
    jQuery(".addon-wrap-3032-format .select-fotka-<?php echo $kolotoc; ?>").change(function() {
        jQuery('.select-fotka-<?php echo $kolotoc; ?> option:selected').each(function(){
            if(jQuery(this).val() == null){
                jQuery(".pokracovat").addClass("disabled");
            }
            else
                jQuery(".pokracovat").removeClass("disabled");
            
            
        });
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
