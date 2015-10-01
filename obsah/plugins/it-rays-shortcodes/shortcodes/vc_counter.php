<?php
function it_counter_shortcode($atts, $content=null){

    extract(shortcode_atts( array(
    'item_title'      => '',
    'item_value'      => '',
    'item_icon'       => '',
    'init_value'      => '1000',
    'item_timer'      => '',
    'el_class'        => '',
    'numbers_color'   => '',
    'numbers_size'    => '',
    'title_color'   => '',
    'title_size'    => '',
    'icon_color'   => '',
    'icon_size'    => '',
    'text'         => '',
    'clear'        => ''
    ), $atts));
    
    $col = $size = $num_col = $num_size = $icon_clear  = $icon_col = $ic_size = '';
    
    if($title_color != ''){
       $col = 'color:'.$title_color; 
    }
    if($title_size != ''){
       $size = ';font-size:'.$title_size; 
    }
    if(!$title_color && !$title_size){
        $style = '';
    }else{
        $style = ' style="'.$col.$size.'"';    
    }
    
    if($numbers_color != ''){
       $num_col = 'color:'.$numbers_color; 
    }
    if($numbers_size != ''){
       $num_size = ';font-size:'.$numbers_size; 
    }
    if(!$numbers_color && !$numbers_size){
        $style2 = '';
    }else{
        $style2 = ' style="'.$num_col.$num_size.'"';    
    }
    
    if($icon_color != ''){
       $icon_col = 'color:'.$icon_color; 
    }
    if($icon_size != ''){
       $ic_size = ';font-size:'.$icon_size; 
    }
    if($clear == '1'){
       $icon_clear = ' block'; 
    }
    if(!$icon_color && !$icon_size){
        $style3 = '';
    }else{
        $style3 = ' style="'.$icon_col.$ic_size.'"';    
    }
    
    
      $output = '<div class="counter '.$el_class.'">';
        $output .= '<i class="counter-icon '.$item_icon.$icon_clear.'"'.$style3.'></i>';
        $output .= '<span class="odometer counter-num" data-value="'.esc_js($item_value).'" data-timer="'.esc_js($item_timer).'"'.$style2.'>';
            $output .= $init_value;
        $output .= '</span>';
        if($item_title != ''){
            $output .= '<h3 class="counter-title"'.$style.'>';
                $output .= esc_html($item_title);
            $output .= '</h3>';
        }
        if($text != ''){
            $output .= '<p>'.esc_html($text).'</p>';
        }  
      $output .= '</div>';
          
    return $output; 
 
}
add_shortcode('it_counter', 'it_counter_shortcode');





