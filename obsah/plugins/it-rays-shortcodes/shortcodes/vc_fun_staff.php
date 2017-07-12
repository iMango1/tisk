<?php
function it_fun_staff_shortcode($atts, $content=null){
    global $staff_row_style;
    extract(shortcode_atts( array(
    'item_title'    => '',
    'item_value'    => '',
    'item_icon'     => '',
    ), $atts));
    $output = '';
    if($staff_row_style == "1"){
      $output .='<div class="fun-cell">';
          $output .= '<div class="fun-number">'.esc_js($item_value).'</div>';
          $output .= '<div class="fun-text main-bg">'.esc_html($item_title).'</div>';
          $output .= '<div class="fun-icon"><i class="fa '.$item_icon.'"></i></div>';
      $output .= '</div>';
    }else if($staff_row_style == "2"){
       $output .='<div class="fun-cell">';
           $output .='<div class="main-bg">';
               $output .= '<div class="fun-number">'.esc_js($item_value).'</div>';
               $output .= '<div class="fun-text main-bg">'.esc_html($item_title).'</div>';
           $output .= '</div>';
       $output .= '</div>';
    }else if($staff_row_style == "3"){
        $output .='<div class="fun-cell">';
            $output .= '<div class="fun-icon"><i class="fa '.$item_icon.' witTxt"></i></div>';
            $output .= '<div class="fun-text witTxt">'.esc_html($item_title).'</div>';
            $output .= '<div class="fun-number witTxt">'.esc_js($item_value).'</div>';
        $output .= '</div>';
    }else if($staff_row_style == "4"){
       $output .='<div class="fun-cell gry-bg">';
           $output .= '<div class="fun-number">'.esc_js($item_value).'</div>';
           $output .= '<div class="fun-text">'.esc_html($item_title).'</div>';
       $output .= '</div>';
    }else{
        $output .='<div class="fun-cell">';
          $output .= '<div class="fun-number">'.esc_js($item_value).'</div>';
          $output .= '<div class="fun-text main-bg">'.esc_html($item_title).'</div>';
          $output .= '<div class="fun-icon"><i class="fa '.$item_icon.'"></i></div>';
      $output .= '</div>';
    }
    return $output; 
 
}
add_shortcode('it_fun_staff', 'it_fun_staff_shortcode');