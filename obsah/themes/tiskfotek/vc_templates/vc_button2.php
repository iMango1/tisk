<?php
$btn_bg_color = '';
extract( shortcode_atts( array(
    'link' => '',
	'title' => __( 'Text on the button', "js_composer" ),
	'btn_bg_color' => '',
    'btn_color' => '',
    'btn_border_color' => '',
    'color' => '',
    'rnd_id' => '',
	'size' => '',
	'style' => '',
	'el_class' => '',
    'button_icon' => '',
    'target' => '_self',
    'href' => '',
    'it_animation'          => '',
    'delay'                 => '',
    'duration'              => '',
    'align' => ''
), $atts ) );

// Create random ID for the shortcode.
$random_id_length = 10; 
$rnd_id = crypt(uniqid(rand(),1)); 
$rnd_id = strip_tags(stripslashes($rnd_id)); 
$rnd_id = str_replace(".","",$rnd_id); 
$rnd_id = strrev(str_replace("/","",$rnd_id)); 
$rnd_id = 'it_'.substr($rnd_id,0,$random_id_length); 

$fx = null;
$anim = null;
$data_anim=null;
$data_dur=null;
$data_del=null;
$sty=null;
$col=null;
$ico=null;
$threeD=null;
$trgt = null;
if($style != 'skew'){    
    if($it_animation != ''){
       $fx = ' fx'; 
    }
    $anim = $it_animation;
    if($anim != ''){$data_anim = ' data-animate="'.esc_js($anim).'"';}
    if($duration != ''){$data_dur = ' data-animation-duration="'.esc_js($duration).'"';}
    if($delay != ''){$data_del = ' data-animation-delay="'.esc_js($delay).'"';} 
}

//parse link
$link = ( $link == '||' ) ? '' : $link;
$link = vc_build_link( $link );
$a_href = $link['url'];
$a_title = $link['title'];
$a_target = $link['target'];

$class = 'btn';
$class .= ( $size != '' ) ? ( ' btn-' . $size ) : '';
$class .= ( $style != '' ) ? ' btn-' . $style : '';


if($color == 'custom'){
    if($btn_bg_color != ''){
        $originalColour = $atts['btn_bg_color'];  
        $darkestPercent = -8; 
        $darkPercent = -5; 
        $lightPercent = 5; 
        $lightestPercent = 8; 
        $darkestColour = colorCreator($originalColour, $darkestPercent);  
        $darkColour = colorCreator($originalColour, $darkPercent); 
        $lightColour = colorCreator($originalColour, $lightPercent);  
        $lightestColour = colorCreator($originalColour, $lightestPercent);
        if($style == '3d'){
            $threeD = '-webkit-box-shadow: 0 5px 0 '.$darkestColour.';box-shadow: 0 5px 0 '.$darkestColour;
        }
        echo '<style type="text/css">#'.$rnd_id.'{background:'.$btn_bg_color.';color:'.$btn_color.';'.$threeD.'}#'.$rnd_id.':hover{background: '.$darkColour.' !important;}</style>'; 
    }

    
    if($style == 'outlined' || $style == 'square_outlined'){
        $threeD = 'border-color: '.$btn_border_color;
    }
}else{
    $col = ' btn-'.$color;
}
if($button_icon != ''){
    $ico = '<i class="'.esc_attr($button_icon).'"></i>';
} 
$el_class = $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ' ' . $class . $col . $fx . $el_class, $this->settings['base'], $atts );
if ( $align ) {
    $css_class .= ' vc_button-2-align-'.$align;
}
if ($a_target != ''){
   $trgt = ' target="'.esc_attr($a_target).'"'; 
}
?> 

<a id="<?php echo esc_attr($rnd_id); ?>" class="<?php echo esc_attr( trim( $css_class ) ); ?>" href="<?php echo esc_url($a_href); ?>"
   title="<?php echo esc_attr( $a_title ); ?>"<?php echo $trgt; ?> <?php echo esc_attr($sty); ?> <?php echo $data_anim.$data_del.$data_dur ?>>
	<span><?php echo $ico; ?><?php echo esc_html($title); ?></span>
</a>
<?php echo $this->endBlockComment( 'vc_button' ) . "\n";

