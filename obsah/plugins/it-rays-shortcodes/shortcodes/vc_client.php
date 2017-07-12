<?php 
function it_client_shortcode($atts, $content=null){
    global $cl_style;
    extract(shortcode_atts( array(
    'client_link'        => '',
    'image'         => '',
    'img_size'      => 'large', 
    ), $atts));
    
    $img_id = preg_replace( '/[^\d]/', '', $image );
    $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => $img_size ) );
    $img_output = $img['thumbnail'];
          $output = '';
          if($cl_style == '1'){
              $output .= '<div class="col-md-2">';
                  $output .= '<a class="white-bg" href="'.esc_url($client_link).'">';
                  $output .= $img_output;
              $output .= '</a></div>';
          } else if($cl_style == '2'){
              $output .= '<div class="col-md-3">';
                  $output .= '<a class="white-bg" href="'.esc_url($client_link).'">';
                  $output .= $img_output;
              $output .= '</a></div>';
          } else if($cl_style == '3'){
              $output .= '<div class="col-md-4">';
                  $output .= '<a class="white-bg" href="'.esc_url($client_link).'">';
                  $output .= $img_output;
              $output .= '</a></div>';
          }else if($cl_style == '4'){
              $output .= '<div>';
                  $output .= '<a class="white-bg" href="'.esc_url($client_link).'">';
                  $output .= $img_output;
              $output .= '</a></div>'; 
          }
          
          
    return $output; 
 
}
add_shortcode('it_client', 'it_client_shortcode');