<?php 

function product_smart_meta_box( $object, $box ) {
  global $post;
  $smart_cislo = get_post_meta($post->ID,'smart-cislo', true);
  ?>
  <p><?php _e('Zadejte číslo seznamu','woo-smart-emailing'); ?></p>
  <p><input type="text" name="smart-cislo" value="<?php if(!empty($smart_cislo)){echo $smart_cislo;} ?>" style="width:100%;" /></p>
  
<?php 

}