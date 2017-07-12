<?php
// extract(shortcode_atts(array(
//     'color' => 'wpb_button',
//     'icon' => 'none',
//     'size' => '',
//     'target' => '',
//     'href' => '',
//     'title' => __('Text on the button', "js_composer"),
//     'call_text' => '',
//     'position' => 'cta_align_right',
//     'el_class' => ''
// ), $atts));
extract(shortcode_atts(array(
    'h2' => '',
    'h4' => '',
    'position' => '',
    'el_width' => '',
    'style' => '',
    'txt_align' => '',
    'accent_color' => '',
    'link' => '',
    'title' => __('Text on the button', "js_composer"),
    'color' => '',
    'icon' => '',
    'size' => '',
    'btn_style' => '',
    'el_class' => '',
    'it_animation' => '',
    'delay'         => '',
    'duration'      => '',
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
if($anim != ''){$data_anim = ' data-animate="'.esc_js($anim).'"';}
if($duration != ''){$data_dur = ' data-animation-duration="'.esc_js($duration).'"';}
if($delay != ''){$data_del = ' data-animation-delay="'.esc_js($delay).'"';}
$class = "vc_call_to_action wpb_content_element";
// $position = 'left';
// $width = '90';
// $style = '';
// $txt_align = 'right';
$link = ($link=='||') ? '' : $link;

$class .= ($position!='') ? ' vc_cta_btn_pos_'.$position : '';
$class .= ($el_width!='') ? ' vc_el_width_'.$el_width : '';
$class .= ($color!='') ? ' vc_cta_'.$color : '';
$class .= ($style!='') ? ' vc_cta_'.$style : '';
$class .= ($txt_align!='') ? ' vc_txt_align_'.$txt_align : '';

$inline_css = ($accent_color!='') ? ' style="'.vc_get_css_color('background-color', $accent_color).vc_get_css_color('border-color', $accent_color).'"' : '';

$class .= $this->getExtraClass($el_class);
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class, $this->settings['base'], $atts );
$css_class .= $fx;
?>
<div<?php echo $inline_css; ?> class="<?php echo esc_attr(trim($css_class)); ?>" <?php echo $data_anim.$data_del.$data_dur; ?>>
    <?php if ($link!='' && $position!='bottom') echo do_shortcode('[vc_button2 link="'.$link.'" title="'.$title.'" color="'.$color.'" icon="'.$icon.'" size="'.$size.'" style="'.$btn_style.'" el_class="vc_cta_btn"]'); ?>
<?php if ($h2!='' || $h4!=''): ?>
<?php if ($h2!=''): ?><h2 class="cta_heading"><?php echo $h2; ?></h2><?php endif; ?>
<?php if ($h4!=''): ?><h4 class="cta_heading"><?php echo $h4; ?></h4><?php endif; ?>
<?php endif; ?>
    <?php echo wpb_js_remove_wpautop($content, true); ?>
    <?php if ($link!='' && $position=='bottom') echo do_shortcode('[vc_button2 link="'.$link.'" title="'.$title.'" color="'.$color.'" icon="'.$icon.'" size="'.$size.'" style="'.$btn_style.'" el_class="vc_cta_btn"]'); ?>
</div>
<?php $this->endBlockComment('.vc_call_to_action') . "\n";