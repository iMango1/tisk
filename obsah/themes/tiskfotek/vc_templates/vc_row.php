<?php
$output = $el_class = $it_bg_img = $section_bg_color = $bg_image_repeat = $bg_image_position = $bg_image_attachment = $bg_overlay = $overlay_opacity = $video_mp4 = $video_webm = $video_ogv = $overlay_color = $bg_cover = $font_color = $row_padd = $css = '';
extract(shortcode_atts(array(
    'el_class'                      => '',
    'it_bg_img'                     => '',
    'section_bg_color'              => '',
    'bg_image_repeat'               => '',
    'bg_image_position'             => '',
    'bg_image_attachment'           => '',
    'bg_cover'                      => '',
    'font_color'                    => '',
    'css'                           => '',
    'fluid'                         => '',
    'full_content'                  => '',
    'css'                           => '',
    'extra_id'                      => '',
    'row_padd'                      => 'md-padding',
    'bg_overlay'                    => '',
    'overlay_color'                 => '',
    'overlay_opacity'               => '',
    'video_mp4'                     => '',
    'video_webm'                    => '',
    'video_ogv'                     => '',
    'parallax'                      => ''
    
), $atts));

// wp_enqueue_style( 'js_composer_front' );
wp_enqueue_script( 'wpb_composer_front_js' );
// wp_enqueue_style('js_composer_custom_css');

$cl = $wraper = $bgCov = $bg = $color = $bg_col = $para = $style = $id = ''; 

if($full_content == '1'){
    $cl = '-fluid'; 
}


if($it_bg_img != ''){
    $bg = 'background: url('.$it_bg_img.')'.' '.$bg_image_repeat.' ' .$bg_image_position.' '. $bg_image_attachment;
}

if($section_bg_color != ''){
    $bg_col = 'background-color: '.$section_bg_color.';';
} 

if($bg_cover == '1'){
    $bgCov = ';background-size:100% 100%';
}
if($parallax == '1'){
    $para = ' parallax';
}
if($font_color != ''){
    $color = ';color:'.$font_color;
}

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ''. ( $this->settings('base')==='' ? ' ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

 
if(!$section_bg_color && !$it_bg_img && !$font_color){
    $style = '';
}else{
    $style = ' style="'.$bg_col.$bg . $bgCov.$color.'"';    
}

if($extra_id != ''){
    $id = 'id="'.$extra_id.'"';    
}
$zind = '';
if($bg_overlay == '1'){
    $zind = ' top-zindex';
}                 
                 
$output .= '<div '.$id.' class="section '.$row_padd.$el_class.$para.'"'.$style.'>';
    $output .= '<div class="container'.$cl.''.$zind.'">';
        $output .= '<div class="row">';
            $output .= wpb_js_remove_wpautop($content);
        $output .= '</div>';
    $output .= '</div>';
    if($bg_overlay == '1'){
        $output .= '<div class="sec-overlay" style="background-color:'.esc_attr($overlay_color).';opacity:'.esc_attr($overlay_opacity).'"></div>';
    }
    if($video_mp4 != '' && $video_webm != '' && $video_ogv != ''){
        $output .= '<div id="sec_video" class="sec_video_bg"></div>';
        ?>
        <script type="text/javascript">
            jQuery(document).ready(function() {
                jQuery('#sec_video').videoBG({
                    mp4:'<?php echo esc_url($video_mp4); ?>',
                    ogv:'<?php echo esc_url($video_ogv); ?>',
                    webm:'<?php echo esc_url($video_webm); ?>',
                    scale:false,
                    zIndex:1
                });
            });
        </script>
        <?php  
    }
$output .= '</div>'.$this->endBlockComment('row');

echo $output;