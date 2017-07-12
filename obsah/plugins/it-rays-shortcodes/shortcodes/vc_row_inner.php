<?php
function cs_row_inner( $atts, $content = '', $key = '' ){
  $defaults = array(
    'id'                 => '',
    'el_class'           => '',
    'in_style'           => '',
    'top'                => '',
    'css'             => '',
    'css_class'         => '',
    'style'             => '',
    'fluid'              => 'no',
  );
  wp_enqueue_script( 'wpb_composer_front_js' );
  extract( shortcode_atts( $defaults, $atts ) );
  
  $css_class = $el_class . vc_shortcode_custom_css_class( $css, ' ' );

  $output = '<div class="container '.$el_class.' ' . $css_class .'"><div class="row">'; 
  $output .= do_shortcode( $content );
  $output .= '</div></div>';

  return $output;
}
add_shortcode( 'vc_row_inner', 'cs_row_inner' );