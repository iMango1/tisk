<?php
function it_posts_category_shortcode($atts, $content=null){
 
    extract(shortcode_atts( array(
        'it_category'           => '',
        ), $atts));
    $cont = '';
    global $post; 
    $it_category;
    $cat_n = '';
    $cat_n = 'Aktuality';
    $args = array(
        'category_name' => $it_category,
        'showposts'     => 3,
    ); 
    $categories = get_categories($args);
    foreach($categories as $category){
        if ($category->category_nicename == $it_category){
         $cat_n = $category->name;
         $cat_id = $category->cat_ID;   
        }
    }
      
    
    $q = new WP_Query( $args ); 
    $cont .= '<h3 class="block-head-News"><span class="icon fa fa-angle-right"></span>'.$cat_n./*'<a href="'.get_category_link($cat_id).'">'.__('View All','itrays').' <span class="fa fa-plus"></span></a>*/'</h3>';
    if($q->have_posts()):
        $cont .= '<div class="news-masnory">';
        while($q->have_posts()): $q->the_post();
            $cont .= '<div class="col-md-4 post fx" data-animate="fadeInLeft">';
                $cont .= '<div class="post-image">';
                    $cont .= '<a href="'.get_the_permalink().'">';
                        $cont .= '<div class="mask"></div>';
                        $cont .= '<div class="post-lft-info">';
                            $cont .= '<div class="main-bg">'.get_the_date().'</div>';
                        $cont .= '</div>';
                        if ( get_the_post_thumbnail() ){
                            $cont .= '<div>'.get_the_post_thumbnail($post->ID, 'large').'</div>';
                         }else {
                            $cont .= '<div><img alt="" src="' . get_stylesheet_directory_uri() .'/assets/images/blog/no-img.jpg" /></div>';
                        }
                    $cont .= '</a>';
                $cont .= '</div>';
                $cont .= '<article class="post-content">';
                    $cont .= '<div class="post-info-container">';
                        $cont .= '<div class="post-info">';
                            $cont .= '<h2><a class="main-color" href="'.get_the_permalink().'">'.get_the_title().'</a></h2>';
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
     
     
}                                               
add_shortcode('it_posts_category', 'it_posts_category_shortcode');