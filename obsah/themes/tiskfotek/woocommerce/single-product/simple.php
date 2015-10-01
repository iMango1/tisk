<script>/*
jQuery( document ).ready(function() {
    jQuery(".chosen-select").chosen({"disable_search": true});
});*/
</script>
<script>
function displayVals() {
  var singleValues = jQuery( ".addon-wrap-3032-format select" ).val();
  jQuery( "#product-addons-total" ).html( "<b>Cena:</b> " + singleValues);
}
 
jQuery( "select" ).change( displayVals );
displayVals();
</script>
<script>
function removeElement(parentDiv, childDiv){
     if (childDiv == parentDiv) {
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

session_start();
global $kolotoc;
global $vsechny_nahrane_fotky;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

?>

<?php
	// Availability
	$availability      = $product->get_availability();
	$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';

	echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
?>

<?php if ( $product->is_in_stock() ) : ?>

	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

    <?php $fotky = $_POST["fotky"]; ?>
    
    <form class="cart product-block" id="tabulka-fotek" method="post" enctype='multipart/form-data'>
    
        <?php //foreach($fotky as $kolotoc => $fotka){ ?>
      
	 	<?php 

            $_SESSION[$kolotoc]["id_fotky"] = $kolotoc;
            $_SESSION[$kolotoc]["url_fotky"] = $fotka; 
        
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
        <a  href="<?php echo $url; ?>" class="predchozi btn btn-large main-bg pull-left">Předchozí krok</a>
        
        <button type="submit" class="single_add_to_cart_button btn btn-large add-cart main-bg pull-right"><?php echo $product->single_add_to_cart_text(); ?></button>
      
	</form>
 <!--  <div class="vysledek-kokos"></div> -->
    <?php //$vsechny_nahrane_fotky = $_SESSION; 
    //    print_r($vsechny_nahrane_fotky);
    ?>
	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
