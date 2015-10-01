<?php
function it_testimonials_shortcode($atts, $content=null){

    extract(shortcode_atts( array(
    'author'        => '',
    'slogan'        => '',
    'image'         => '',
    'img_size'      => 'thumbnail',
    ), $atts));
    global $block_style;
    $img_id = preg_replace( '/[^\d]/', '', $image );
    $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => $img_size ) );
    $img_output = $img['thumbnail'];
      $output = '';
      if($block_style == "1"){
          $output .= '<div>';
              $output .= '<div class="testimonials-bg">';
                  $output .= '<div class="testimonials-img">'.$img_output.'</div>';
                  $output .= '<span>'.esc_html($content).'</span>';
              $output .= '</div>';
              
              $output .= '<div class="testimonials-name">';
                $output .= '<strong>'.esc_html($author).'</strong>: '.esc_html($slogan);
              $output .= '</div>';
          $output .= '</div>';
      }else if($block_style == "2"){
          $output .= '<div>';
          $output .= '<p class="gryTxt">'.esc_html($content).'</p>';
              
              $output .= '<div class="testimonials-name main-bg">';
                $output .= '<strong>'.esc_html($author).'</strong>: '.esc_html($slogan);
              $output .= '</div>';
          $output .= '</div>';
      }else if($block_style == "3"){
          $output .= '<div>';
              $output .= '<div class="testo-3">';
                  $output .= '<div class="testimonials-bg">';
                      $output .= '<div class="testimonials-img tbl-cell">'.$img_output.'</div>';
                      $output .= '<div class="testo-cell"><span>'.$content.'</span>';
                      $output .= '<div><strong>'.esc_html($author).'</strong>: '.esc_html($slogan).'</div>';
                  $output .= '</div></div>';
              $output .= '</div>';
          $output .= '</div>';
      }else if($block_style == "4"){
          $output .= '<div>';
              $output .= '<div class="testo-4">';
                  $output .= '<div class="testimonials-bg">';
                      $output .= '<div class="testimonials-img">'.$img_output.'</div>';
                      $output .= '<span>'.esc_html($content).'</span>';
                  $output .= '</div>';
                  
                  $output .= '<div class="testimonials-name">';
                    $output .= '<strong>'.esc_html($author).'</strong>: '.esc_html($slogan);
                  $output .= '</div>';
              $output .= '</div>';
          $output .= '</div>';
      }else if($block_style == "5"){
          $output .= '<div class="col-md-4">';
                $output .= '<div class="testimonials-img">'.$img_output.'</div>';
                $output .= '<div>&quot; '.esc_html($content).' &quot;';
                    $output .= '<div class="testo-name"> <strong>'.esc_html($author).'</strong>: '.esc_html($slogan).'</div>';
                $output .= '</div>';
          $output .= '</div>';
      }
    return $output; 
 
}
add_shortcode('it_testimonial', 'it_testimonials_shortcode');