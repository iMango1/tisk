<?php
function it_images_shortcode($atts, $content=null){
 
     extract(shortcode_atts( array(), $atts));
    
    $args = array(
   'post_type' => 'attachment',
   'numberposts' => -1,
   'post_status' => null
  );

  $attachments = get_posts( $args );
     if ( $attachments ) {
        foreach ( $attachments as $attachment ) {
           echo '<li>';
           echo wp_get_attachment_image( $attachment->ID, 'thumbnail' );
           echo '<p>';
           echo apply_filters( 'the_title', $attachment->post_title );
           echo '</p></li>';
          }
     }
}                                               
add_shortcode('it_images', 'it_images_shortcode');