<?php
function it_news_in_pictures_shortcode($atts, $content=null){
 
    extract(shortcode_atts( array(
        'it_cat'           => '',
        'it_title'           => '',
        ), $atts));
    $output = '';
    global $post;
    
    //$n = $cat_n->name;
    $args = array(
        'category_name' => $it_cat,
        'showposts'     => 24,
    ); 
    
    $output .= '<h3 class="block-head-News"><span class="icon fa fa-angle-right"></span>'.esc_html($it_title).'<a href="#">'.__('View All','itrays').' <span class="fa fa-plus"></span></a></h3>';
    
    $quer = new WP_Query( $args ); 
    
    if($quer->have_posts()):
        
        $output .= '<div class="news-masnory news-in-pics"><ul class="gallery">';
        while($quer->have_posts()): $quer->the_post();
                $feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
                $output .= '<li>';
                    $output .= '<a class="" data-gal="prettyPhoto[pp_gal]" href="'.esc_url($feat_image).'">'.get_the_post_thumbnail($post->ID, 'thumbnail').'<span class="img-overlay"></span></a>';
            $output .= '</li>';
        endwhile;
        $output .= '</ul></div>';        
    endif;
    wp_reset_postdata(); 
    return $output;
     
     
}                                               
add_shortcode('it_new_in_pictures', 'it_news_in_pictures_shortcode');