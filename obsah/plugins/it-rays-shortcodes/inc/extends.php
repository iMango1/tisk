<?php 

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_vc_testimonials extends WPBakeryShortCodesContainer {
        protected function content($atts, $content = null) {
            global $block_style;
            extract(shortcode_atts(array(
                'el_class' => '',
                'block_style'   => '1',
                'testo_slides' => '2',
                'testo_scroll' => '2',
                'testo_fade' => '',
                'testo_speed' => '',
                'testo_arrows' => '',
                'testo_dots' => '',
                'testo_infinite' => '1',
                'testo_auto' => '1',
                
            ), $atts));
            
            $output = '';
            $t_slides = $t_scrolls = $t_fade = $t_speed = $t_arrows = $t_dots = $t_auto = $t_infinite = '';
            if($testo_slides != ''){
                $t_slides = " data-slidesnum='$testo_slides'";
                $t_scrolls = " data-scamount='$testo_scroll'";
                if($testo_fade == '1'){
                    $t_fade = " data-tfade='$testo_fade'";
                }
                
                if($testo_speed != ''){
                    $t_speed = " data-tspeed='$testo_speed'";
                }
                
                if($testo_arrows != ''){
                    $t_arrows = " data-tarrows='$testo_arrows'";
                }
                
                if($testo_dots != ''){
                    $t_dots = " data-tdots='$testo_dots'";
                }
                
                if($testo_auto != ''){
                    $t_auto = " data-tauto='$testo_auto'";
                }
                
                if($testo_infinite != ''){
                    $t_infinite = " data-tinfinite='$testo_infinite'";
                }
            }
            
            $attrs = $t_slides.$t_scrolls.$t_fade.$t_speed.$t_arrows.$t_infinite.$t_dots.$t_auto;
            
            if($block_style == '5'){
                $output .= '<div class="testimonials-5">';
                    $output .= do_shortcode( $content );
                $output .= '</div>';
            }else {
                $output .= '<div class="testo_slider testimonials-'.$block_style.'"'.$attrs.'>';
                    $output .= do_shortcode( $content );
                $output .= '</div>';
            }
            
            
            return $output;
        }
    }
    class WPBakeryShortCode_staff_row extends WPBakeryShortCodesContainer {
        protected function content($atts, $content = null) {
            global $staff_row_style;
            extract(shortcode_atts(array(
                'el_class'          => '',
                'staff_row_style'   => '1'
            ), $atts));
            $output = '';
            if($staff_row_style == "1"){
                $output .= '<div class="fun-staff staff-1 '.$el_class.'">';
                $output .= do_shortcode( $content );
                $output .= '</div>';
            }else if($staff_row_style == "2"){
              $output .= '<div class="fun-staff staff-2 '.$el_class.'">';
              $output .= do_shortcode( $content );
              $output .= '</div>';  
            }
            else if($staff_row_style == "3"){
              $output .= '<div class="fun-staff staff-3 '.$el_class.'">';
              $output .= do_shortcode( $content );
              $output .= '</div>';  
            }else if($staff_row_style == "4"){
              $output .= '<div class="fun-staff staff-4 '.$el_class.'">';
              $output .= do_shortcode( $content );
              $output .= '</div>';  
            }
            
            return $output;
        }
    }
    class WPBakeryShortCode_it_clients extends WPBakeryShortCodesContainer {
        protected function content($atts, $content = null) {
            global $cl_style;
            extract(shortcode_atts(array(
                'el_class'          => '',
                'cl_style'          => '1',
                'cl_slides' => '2',
                'cl_scroll' => '2',
                'cl_fade' => '',
                'cl_speed' => '',
                'cl_arrows' => '',
                'cl_dots' => '',
                'cl_infinite' => '1',
                'cl_auto' => '1',
            ), $atts));
            
            $output = '';
            
            $t_slides = $t_scrolls = $t_fade = $t_speed = $t_arrows = $t_dots = $t_auto = $t_infinite = '';
            if($cl_slides != ''){
                $t_slides = " data-slidesnum='$cl_slides'";
                $t_scrolls = " data-scamount='$cl_scroll'";
                if($cl_fade == '1'){
                    $t_fade = " data-tfade='$cl_fade'";
                }
                
                if($cl_speed != ''){
                    $t_speed = " data-tspeed='$cl_speed'";
                }
                
                if($cl_arrows != ''){
                    $t_arrows = " data-tarrows='$cl_arrows'";
                }
                
                if($cl_dots != ''){
                    $t_dots = " data-tdots='$cl_dots'";
                }
                
                if($cl_auto != ''){
                    $t_auto = " data-tauto='$cl_auto'";
                }
                
                if($cl_infinite != ''){
                    $t_infinite = " data-tinfinite='$cl_infinite'";
                }
            }
            
            $attrs = $t_slides.$t_scrolls.$t_fade.$t_speed.$t_arrows.$t_infinite.$t_dots.$t_auto;
            
            if($cl_style == '1'){
                $output .= '<div class="clients-grid1'.$el_class.'">';
                    $output .= do_shortcode( $content );
                $output .= '</div>';
            }else if($cl_style == '2'){
                $output .= '<div class="clients-grid2'.$el_class.'">';
                    $output .= do_shortcode( $content );
                $output .= '</div>';
            }else if($cl_style == '3'){
                $output .= '<div class="clients-grid3'.$el_class.'">';
                    $output .= do_shortcode( $content );
                $output .= '</div>';
            }else if($cl_style == '4'){
                $output .= '<div class="clients'.$el_class.'" '.$attrs.'>';
                    $output .= do_shortcode( $content );
                $output .= '</div>';
            }
            
            return $output;
        }
    }
} 
   

