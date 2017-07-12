<?php
$output = $el_class = $css_animation = '';

extract(shortcode_atts(array(
    'el_class' => '',
    'it_animation'        => '',
    'delay'               => '',
    'duration'            => '',
    'css' => '',
    'it_color' => ''
), $atts));

    $fx = null;
    $anim = null;
    $data_anim=null;
    $data_dur=null;
    $data_del=null;
    $style=null;
    if($it_animation != ''){
        $fx = ' fx';
        $anim = $it_animation;
    }
    if($it_color != ''){
        $style = ' style="color:'.$it_color.'"';
    }
    if($anim != ''){$data_anim = ' data-animate="'.esc_js($anim).'"';}
    if($duration != ''){$data_dur = ' data-animation-duration="'.esc_js($duration).'"';}
    if($delay != ''){$data_del = ' data-animation-delay="'.esc_js($delay).'"';}

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, '' . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );
$output .= "\n\t".'<div class="'.$css_class.''.$fx.'"'.$data_anim.$data_del.$data_dur.'>';
$output .= "\n\t\t".'<div class="wpb_wrapper"'.$style.'>';
$output .= "\n\t\t\t".wpb_js_remove_wpautop($content, true);
$output .= "\n\t\t".'</div> ' . $this->endBlockComment('.wpb_wrapper');
$output .= "\n\t".'</div> ' . $this->endBlockComment('.wpb_text_column');

echo $output;
