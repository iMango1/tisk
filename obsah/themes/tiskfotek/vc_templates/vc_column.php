<?php
/**
 * @var $this WPBakeryShortCode_VC_Column
 */
$output = $font_color = $el_class = $width = $offset = '';
extract( shortcode_atts( array(
	'font_color' => '',
	'el_class' => '',
	'width' => '1/1',
	'css' => '',
	'offset' => '',
    'it_animation'        => '',
    'delay'               => '',
    'duration'            => '',
), $atts ) );

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

$el_class = $this->getExtraClass( $el_class );
$style = $this->buildStyle( $font_color );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $width . $el_class, $this->settings['base'], $atts );
$output .= "\n\t" . '<div class="col-md-'. get_vc_it_column( $width ).$fx.' ' . vc_shortcode_custom_css_class( $css, ' ' ) . ' '.$el_class.'"' . $style . ''.$data_anim.$data_del.$data_dur.'>';
$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
$output .= "\n\t" . '</div> ' . $this->endBlockComment( $el_class ) . "\n";
echo $output;