<?php
function it_heading_shortcode($atts, $content=null){

    extract(shortcode_atts( array(
    'text'              => '',
    'head_align'        => '',
    'it_animation'      => '',
    'ex_class'          => '',
    'delay'             => '',
    'head_tag'          => 'h3',
    'duration'          => '',
    'upper'             => '0',
    'head_color'        => '',
    'head_icon'         => '',
    'heading_style'     => '',
    'extrabold'         => ''
    ), $atts));
    
    $fx = null;
    $anim = null;
    $data_anim=null;
    $data_dur=null;
    $data_del=null;
    $sty=null;
    $up=null;
    $hcol=null;
    $style=null;
    $icon=null;
    $hbold=null;
    if($it_animation != ''){
        $fx = ' fx';
        $anim = $it_animation;
    }
    if($upper == '1'){
        $up = 'text-transform:uppercase';
    }
    if($head_color != ''){
        $hcol = ";color:$head_color";
    }
    if($extrabold != ''){
        $hbold = ";font-weight:$extrabold";
    }
    if($head_icon != ''){
        $icon = '<i class="'.$head_icon.'"></i>';
    }
    
    if($upper == '1' || $head_color != ''){
        $style = ' style="'.$up.$hcol.$hbold.'"';
    }

    if($anim != ''){$data_anim = ' data-animate="'.esc_js($anim).'"';}
    if($duration != ''){$data_dur = ' data-animation-duration="'.esc_js($duration).'"';}
    if($delay != ''){$data_del = ' data-animation-delay="'.esc_js($delay).'"';}
    
    $output = '<'.$head_tag.' class="block-head '.$head_align.' '.$ex_class.''.$fx.' '.$heading_style.'" '.$data_anim.$data_del.$data_dur.'><span'.$style.'>'.$icon.esc_html($text).'</span></'.$head_tag.'>';
    return $output; 
 
}
add_shortcode('it_heading', 'it_heading_shortcode');