<?php
function it_recent_posts_shortcode($atts, $content=null){
 
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
    
    $cont = '<h3 class="block-head-News"><span class="icon fa fa-angle-right"></span>'.$it_title.'</h3>';
    
    
    $q = new WP_Query( $args );
    $recent_posts = wp_get_recent_posts( $args );
    if($q->have_posts()):
        $cont .= '<div class="news-masnory blog-posts recent-items">';
        $post = $posts[0]; $c=0;
        while($q->have_posts()): $q->the_post();
           $c++; 
           if ($c == 1){
               
              $cont .= '<div class="post-item large-recent fx" data-animate="fadeInLeft">';
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
                            $cont .= '<ul class="post-meta">
                                        <li class="meta-user"><i class="fa fa-user"></i>'.__('By:','itrays').' <a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author_meta( 'display_name' ).'</a></li>
                                        <li><i class="fa fa-folder-open"></i>'.__('Category:','itrays').' '.get_the_category_list(', ').'</li>
                                        <li class="meta-comments"><i class="fa fa-comments"></i>'.get_comments_popup_link( __( 'Leave a comment', 'itrays' ), __( '1 Comment', 'itrays' ), __( '% Comments', 'itrays' ) ).'</li>
                                    </ul>';
                        $cont .= '</div>';
                    $cont .= '</div>';
                    $cont .= '<p>'.it_excerpt().'</p>';
                $cont .= '</article>';
            $cont .= '</div>';
            $cont .= '<div class="small_news"><div class="small_items">'; 
           }else{
                 
              $cont .= '<div class="col-md-6">';
                $cont .= '<div class="post-item fx" data-animate="fadeInLeft">';
                    $cont .= '<div class="col-md-3"><div class="row sm-img">';
                        $cont .= '<a href="'.get_the_permalink().'">';
                            if ( get_the_post_thumbnail() ){
                                $cont .= '<div>'.get_the_post_thumbnail($post->ID, 'thumbnail').'</div>';
                             }else {
                                $cont .= '<div><img alt="" src="' . get_stylesheet_directory_uri() .'/assets/images/blog/no-img.jpg" /></div>';
                            }
                        $cont .= '</a>';
                    $cont .= '</div></div>';
                    $cont .= '<div class="col-md-9">'; 
                        $cont .= '<h2><a class="main-color" href="'.get_the_permalink().'">'.get_the_title().'</a></h2>';
                        $cont .= '<ul class="post-meta">
                                    <li class="meta-user"><i class="fa fa-user"></i>'.__('By:','itrays').' <a href="'.get_author_posts_url( get_the_author_meta( 'ID' ) ).'">'.get_the_author_meta( 'display_name' ).'</a></li>
                                    <li><i class="fa fa-folder-open"></i>'.__('Category:','itrays').' '.get_the_category_list(', ').'</li>
                                    <li class="meta-comments"><i class="fa fa-comments"></i>'.get_comments_popup_link( __( 'Leave a comment', 'itrays' ), __( '1 Comment', 'itrays' ), __( '% Comments', 'itrays' ) ).'</li>
                                </ul>';
                    $cont .= '</div>';
                $cont .= '</div>';    
            $cont .= '</div>';
             
           }    
           
        endwhile;
        $cont .= '</div></div>'; 
        $cont .= '</div>';        
    endif;
    wp_reset_postdata(); 
    return $cont; 
     
     return $cont;
     
     
}                                               
add_shortcode('it_recent_posts', 'it_recent_posts_shortcode');