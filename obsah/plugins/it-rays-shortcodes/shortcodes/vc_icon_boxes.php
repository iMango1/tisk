<?php
function it_iconbox_shortcode($atts, $content=null){

    extract(shortcode_atts( array(
        'iconbox_style'         => '1',
        'iconbox_icon'          => '',
        'iconbox_title'         => __( 'Icon Box Title', 'js_composer' ),
        'it_animation'          => '',
        'filter'                => true,
        'delay'                 => '',
        'duration'              => '',
        'iconbox_more'          => '',
        'iconbox_more_text'     => __( 'Read More', 'itrays' )
    ), $atts));
    
    $atts['filter'] = true;
    
    $fx = null;
    $anim = null;
    $data_anim=null;
    $data_dur=null;
    $data_del=null;
    if($it_animation != ''){
        $fx = ' fx';
        $anim = $it_animation;
    }
    if($anim != ''){$data_anim = ' data-animate="'.esc_js($anim).'"';}
    if($duration != ''){$data_dur = ' data-animation-duration="'.esc_js($duration).'"';}
    if($delay != ''){$data_del = ' data-animation-delay="'.esc_js($delay).'"';}
    if($iconbox_style == "1"){
      $output  = '<div class="icon-box icon-box-1'.$fx.'" '.$data_anim.$data_del.$data_dur.'>';
          $output .= '<div class="col-md-3">';
            $output .= '<i class="icon main-bg '.$iconbox_icon.'"></i>';
          $output .= '</div>';
          $output .= '<div class="col-md-9">';
              $output .= '<h3>'.esc_html($iconbox_title).'</h3>';
              $output .= '<p>'.$content;
              if($iconbox_more != ''){
                   $output .= '<a class="more-btn" href="'.esc_url($iconbox_more).'">'.esc_html($iconbox_more_text).'</a>';
              }
              $output .= '</p>';
          $output .= '</div>';
      $output .= '</div>';
   }else if($iconbox_style == "2"){
      $output  = '<div class="icon-box icon-box-2'.$fx.'" '.$data_anim.$data_del.$data_dur.'>';
          $output .= '<div class="col-md-3">';
            $output .= '<i class="icon main-bg '.$iconbox_icon.'"></i>';
          $output .= '</div>';
          $output .= '<div class="col-md-9">';
              $output .= '<h3>'.esc_html($iconbox_title).'</h3>';
              $output .= '<p>'.$content;
              if($iconbox_more != ''){
                   $output .= '<a class="more-btn" href="'.esc_url($iconbox_more).'">'.esc_html($iconbox_more_text).'</a>';
              }
              $output .= '</p>';
          $output .= '</div>';
      $output .= '</div>';
   }else if($iconbox_style == "3"){
      $output  = '<div class="icon-box icon-box-3'.$fx.'" '.$data_anim.$data_del.$data_dur.'>';
          $output .= '<div class="col-md-3">';
            $output .= '<i class="icon outlined '.$iconbox_icon.'"></i>';
          $output .= '</div>';
          $output .= '<div class="col-md-9">';
              $output .= '<h3>'.esc_html($iconbox_title).'</h3>';
              $output .= '<p>'.$content;
              if($iconbox_more != ''){
                   $output .= '<a class="more-btn" href="'.esc_url($iconbox_more).'">'.esc_html($iconbox_more_text).'</a>';
              }
              $output .= '</p>';
          $output .= '</div>';
      $output .= '</div>';
   }else if($iconbox_style == "4"){
      $output  = '<div class="icon-box icon-box-4'.$fx.'" '.$data_anim.$data_del.$data_dur.'>';
          $output .= '<div class="col-md-3">';
            $output .= '<i class="icon outlined '.$iconbox_icon.'"></i>';
          $output .= '</div>';
          $output .= '<div class="col-md-9">';
              $output .= '<h3>'.esc_html($iconbox_title).'</h3>';
              $output .= '<p>'.$content;
              if($iconbox_more != ''){
                   $output .= '<a class="more-btn" href="'.esc_url($iconbox_more).'">'.esc_html($iconbox_more_text).'</a>';
              }
              $output .= '</p>';
          $output .= '</div>';
      $output .= '</div>';
   }else if($iconbox_style == "5"){
      $output  = '<div class="icon-box icon-box-5'.$fx.'" '.$data_anim.$data_del.$data_dur.'>';
          $output .= '<div class="col-md-3">';
            $output .= '<i class="icon main-color '.$iconbox_icon.'"></i>';
          $output .= '</div>';
          $output .= '<div class="col-md-9">';
              $output .= '<h3>'.esc_html($iconbox_title).'</h3>';
              $output .= '<p>'.$content;
              if($iconbox_more != ''){
                   $output .= '<a class="more-btn" href="'.esc_url($iconbox_more).'">'.esc_html($iconbox_more_text).'</a>';
              }
              $output .= '</p>';
          $output .= '</div>';
      $output .= '</div>';
   }else if($iconbox_style == "6"){
      $output  = '<div class="icon-box icon-box-6'.$fx.'" '.$data_anim.$data_del.$data_dur.'>';
      $output .= '<div class="box-top">';
      $output .= '<i class="icon '.$iconbox_icon.'"></i>';
      $output .= '<h3>'.esc_html($iconbox_title).'</h3>';
      $output .= '<p>'.$content.'</p>';
      $output .= '<a class="more-btn" href="'.esc_url($iconbox_more).'">'.esc_html($iconbox_more_text).'</a>';
      $output .= '</div>';
      $output .= '</div>';
   }else if($iconbox_style == "7"){
      $output   = '<div class="icon-box icon-box-7'.$fx.'" '.$data_anim.$data_del.$data_dur.'>';
      $output .= '<div class="box-7-cont">';
      $output .= '<i class="icon '.$iconbox_icon.'"></i>';
      $output .= '<h4>'.esc_html($iconbox_title).'</h4>';
      $output .= '<p class="mediumFont">'.$content.'</p>';
      $output .= '<a class="r-more main-color" href="'.esc_url($iconbox_more).'">'.esc_html($iconbox_more_text).'</a>';
      $output .= '</div>';
      $output .= '</div>'; 
   }else if($iconbox_style == "8"){
      $output  = '<div class="icon-box icon-box-8'.$fx.'" '.$data_anim.$data_del.$data_dur.'>';
      $output .= '<div class="box-head">';
      $output .= '<i class="icon main-bg icon '.$iconbox_icon.'"></i>';
      $output .= '<h4 class="main-color"><span data-hover="'.esc_html($iconbox_title).'">'.esc_html($iconbox_title).'</span></h4>';
      $output .= '</div>';
      $output .= '<div class="clearfix"></div>';
      $output .= '<p class="mediumFont">'.$content.'</p>';
      $output .= '<a class="r-more main-color" href="'.esc_url($iconbox_more).'">'.esc_html($iconbox_more_text).'</a>';
      $output .= '</div>'; 
   }else if($iconbox_style == "9"){
      $output  = '<div class="icon-box icon-box-9'.$fx.'" '.$data_anim.$data_del.$data_dur.'>';
      $output .= '<div class="icon_container main-bg"><i class="icon '.$iconbox_icon.'"></i></div>';
      $output .= '<h3>'.esc_html($iconbox_title).'</h3>';
      $output .= '<p>'.$content.'<a class="r-more main-color" href="'.esc_url($iconbox_more).'">'.esc_html($iconbox_more_text).'</a></p>';
      $output .= '</div>';
   }else if($iconbox_style == "10"){
      $output  = '<div class="icon-box icon-box-10'.$fx.'" '.$data_anim.$data_del.$data_dur.'>';
      $output .= '<div class="box-head">';
      $output .= '<i class="icon main-color '.$iconbox_icon.'"></i>';
      $output .= '<h4><span data-hover="'.esc_html($iconbox_title).'">'.esc_html($iconbox_title).'</span></h4>';
      $output .= '</div>';
      $output .= '<div class="clearfix"></div>';     
      $output .= '<p class="mediumFont">'.$content;
              if($iconbox_more != ''){
                   $output .= '<a class="more-btn" href="'.esc_url($iconbox_more).'">'.esc_html($iconbox_more_text).'</a>';
              }
              $output .= '</p>';
      $output .= '</div>'; 
   }
     
    return $output; 
 
}
add_shortcode('it_iconbox', 'it_iconbox_shortcode');
