<?php
function it_divider_shortcode($atts, $content=null){

    extract(shortcode_atts( array(
    'divider_class'  => '1',
    'el_class'   => '',
    'it_animation'        => '',
    'delay'               => '',
    'duration'            => '',
    ), $atts));
    
    $fx = null;
    $anim = null;
    $data_anim=null;
    $data_dur=null;
    $data_del=null;
    if($it_animation != ''){
        $fx = ' fx';
        $anim = $it_animation;
    }
    if($anim != ''){$data_anim = ' data-animate="'.$anim.'"';}
    if($duration != ''){$data_dur = ' data-animation-duration="'.$duration.'"';}
    if($delay != ''){$data_del = ' data-animation-delay="'.$delay.'"';}
    
    if($divider_class == '1'){
         $output = '<div class="divider divider-1 '.$el_class.'"><i class="divid_before fa fa-bicycle fx" data-animate="slideInLeft"></i><span class="fx" data-animate="slideInRight"><i class="divid_after fa fa-bicycle"></i></span></div>';
    }else if($divider_class == '2'){
         $output = '<div class="divider divider-2 '.$el_class.''.$fx.'" '.$data_anim.$data_del.$data_dur.'><i class="divid_center fa fa-cloud"></i></div>';
    }else if($divider_class == '3'){
         $output = '<div class="divider divider-3 '.$el_class.''.$fx.'" '.$data_anim.$data_del.$data_dur.'><i class="divid_left fa fa-crosshairs"></i><i class="divid_right fa fa-crosshairs"></i></div>';
    }else if($divider_class == '4'){
         $output = '<div class="divider divider-4 '.$el_class.''.$fx.'" '.$data_anim.$data_del.$data_dur.'><i class="divid_left fa fa-recycle"></i></div>';
    }else if($divider_class == '5'){
         $output = '<div class="divider divider-5 '.$el_class.''.$fx.'" '.$data_anim.$data_del.$data_dur.'><i class="divid_right fa fa-recycle"></i></div>';
    }else if($divider_class == '6'){
         $output = '<div class="divider divider-6 '.$el_class.''.$fx.'" '.$data_anim.$data_del.$data_dur.'><i class="divid_center fa fa-cloud"></i></div>';
    }else if($divider_class == '7'){
         $output = '<div class="divider divider-7 '.$el_class.''.$fx.'" '.$data_anim.$data_del.$data_dur.'></div>';
    }else if($divider_class == '8'){
         $output = '<div class="divider divider-8 '.$el_class.''.$fx.'" '.$data_anim.$data_del.$data_dur.'><span class="main-bg"></span></div>';
    }else if($divider_class == '9'){
         $output = '<div class="divider divider-9 '.$el_class.''.$fx.'" '.$data_anim.$data_del.$data_dur.'><span></span></div>';
    }else if($divider_class == '10'){
         $output = '<div class="divider divider-10 '.$el_class.''.$fx.'" '.$data_anim.$data_del.$data_dur.'><a href="#" class="to-tp"><i class="divid_center fa fa-chevron-up"></i></a></div>';
    }
    
    
    return $output; 
 
}
add_shortcode('it_divider', 'it_divider_shortcode');