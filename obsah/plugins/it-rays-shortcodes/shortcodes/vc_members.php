<?php
function it_member_shortcode($atts, $content=null){

    extract(shortcode_atts( array(
    'member_name'       => '',
    'member_position'   => '',
    'member_details'    => '',
    'member_style'      => '1',
    'member_fb'         => '',
    'member_tw'         => '',
    'member_ln'         => '',
    'member_go'         => '',
    'member_sk'         => '',
    'image'             => '',
    'img_size'          => 'large',
    ), $atts));
    
    $img_id = preg_replace( '/[^\d]/', '', $image );
    $img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => $img_size ) );
    $img_output = $img['thumbnail'];
          if($member_style == "1"){
              $output = '<div class="team-box">';
                  $output .='<div class="team-img">';
                      $output .= $img_output;
                      $output .= '<h3>'.esc_html($member_name).'</h3>';
                  $output .= '</div>';
                  $output .= '<div class="team-details">';
                    $output .= '<h3 class="gry-bg">'.esc_html($member_name).'</h3>';
                    $output .= '<div class="t-position">'.esc_html($member_position).'</div>';
                    $output .= '<p>'.esc_html($member_details).'</p>';
                    $output .= '<div class="team-socials"><ul>';
                    if($member_fb !='')$output .='<li><a href="'.esc_url($member_fb).'" title="facebook"><span class="fa fa-facebook"></span></a></li>';
                    if($member_tw !='')$output .='<li><a href="'.esc_url($member_tw).'" title="linkedin"><span class="fa fa-linkedin"></span></a></li>';
                    if($member_ln !='')$output .='<li><a href="'.esc_url($member_ln).'" title="skype"><span class="fa fa-skype"></span></a></li>';
                    if($member_go !='')$output .='<li><a href="'.esc_url($member_go).'" title="twitter"><span class="fa fa-twitter"></span></a></li>';
                    if($member_sk !='')$output .='<li><a href="'.esc_url($member_sk).'" title="vimeo"><span class="fa fa-google-plus"></span></a></li>';
                    $output .= '</ul></div>';
                  $output .= '</div>';
              $output .= '</div>';
          }else if($member_style == "2"){
              $output = '<div class="team-box-2">';
                  $output .='<div class="team-img">';
                      $output .= $img_output;
                  $output .= '</div>';
                  $output .= '<div class="team-details">';
                    $output .= '<h3>'.esc_html($member_name).'</h3>';
                    $output .= '<div class="t-position">'.esc_html($member_position).'</div>';
                    $output .= '<p>'.esc_html($member_details).'</p>';
                    $output .= '<div class="team-socials"><ul>';
                    if($member_fb !=""){$output .='<li><a href="'.esc_url($member_fb).'" title="facebook"><span class="fa fa-facebook"></span></a></li>';}
                    if($member_tw !=""){$output .='<li><a href="'.esc_url($member_tw).'" title="linkedin"><span class="fa fa-linkedin"></span></a></li>';}
                    if($member_ln !=""){$output .='<li><a href="'.esc_url($member_ln).'" title="skype"><span class="fa fa-skype"></span></a></li>';}
                    if($member_go !=""){$output .='<li><a href="'.esc_url($member_go).'" title="twitter"><span class="fa fa-twitter"></span></a></li>';}
                    if($member_sk !=""){$output .='<li><a href="'.esc_url($member_sk).'" title="vimeo"><span class="fa fa-google-plus"></span></a></li>';}
                    $output .= '</ul></div>';
                  $output .= '</div>';
              $output .= '</div>';
          }
          
    return $output; 
 
}
add_shortcode('it_member', 'it_member_shortcode');





