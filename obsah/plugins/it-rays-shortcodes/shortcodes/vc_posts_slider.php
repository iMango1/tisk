<?php
function it_posts_slider_shortcode($atts, $content=null){
 
    extract(shortcode_atts( array(
        'it_cat'           => '',
        'it_title'           => '',
        ), $atts));
    global $post;
    $posts = null;
    $args = array(
        'category_name' => $it_cat,
        'showposts'     => 5,
        'ignore_sticky_posts' => 1,
    );     
    
    $q = new WP_Query( $args );
    $recent_posts = wp_get_recent_posts( $args );
    if($q->have_posts()):
        $cont = '<div class="Newsslider">';
        $post = $posts[0]; $c=0;
        while($q->have_posts()): $q->the_post();
                       
              $cont .= '<div>';
                $cont .= '<a href="'.get_the_permalink().'" class="col-md-9" title="">';
                        if ( get_the_post_thumbnail() ){
                            $cont .= '<div>'.get_the_post_thumbnail($post->ID, 'large').'</div>';
                         }else {
                            $cont .= '<div><img alt="" src="' . get_stylesheet_directory_uri() .'/assets/images/blog/large-default.jpg" /></div>';
                        }
                    $cont .= '</a>';
                $cont .= '<article class="post-content col-md-3">';
                    $cont .= '<div class="post-info-container">';
                        $cont .= '<div class="post-info">';
                            $cont .= '<h2><a class="main-color" href="'.get_the_permalink().'">'.get_the_title().'</a></h2>';
                            $cont .= '<ul class="post-meta">
                                        <li class="meta-user"><i class="fa fa-user"></i>'.__('By:','itrays').' <a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author_meta( 'display_name' ).'</a></li>
                                        <li><i class="fa fa-folder-open"></i>'.__('Category:','itrays').' '.get_the_category_list(', ').'</li>
                                    </ul>';
                        $cont .= '</div>';
                    $cont .= '</div>';
                    $cont .= '<p>'.it_excerpt().'</p>';
                $cont .= '</article>';
            $cont .= '</div>';
           
        endwhile;
        $cont .= '</div>';        
    endif;
    wp_reset_postdata(); 
    return $cont; 
     
     return $cont;
     
     
}                                               
add_shortcode('it_posts_slider', 'it_posts_slider_shortcode');