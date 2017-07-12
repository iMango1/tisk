<?php
$tags = wp_get_post_tags($post->ID);
if ($tags) {
    $tag_ids = array();
    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
    $args=array(
    'tag__in' => $tag_ids,
    'post__not_in' => array($post->ID),
    'showposts'=>10,
    'ignore_sticky_posts'=>1,
    'post_type' => 'essential_grid'
    );
    $my_query = new wp_query($args);
    if( $my_query->have_posts() ) {
        echo '<div class="md-padding similar-products"><div class="container"><div class="row"><h3 class="block-head">'.__('Related Projects','itrays').'</h3><div class="portfolioGallery portfolio">';
        while ($my_query->have_posts()) {
            $my_query->the_post();
            $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

    ?>
    <div>
        <div id="post-<?php the_ID(); ?>" <?php post_class('portfolio-item'); ?>>
        <div class="img-holder">
            <div class="img-over">
                <a href="<?php the_permalink(); ?>" class="fx link"><b class="fa fa-link"></b></a>
                <a href="<?php echo esc_url($url); ?>" class="fx zoom" title=""><b class="fa fa-search-plus"></b></a>
            </div>
            <?php if ( has_post_thumbnail() ){
                if ( function_exists( 'add_theme_support' ) ) the_post_thumbnail('large');
                 }else {
                    echo '<img alt="" src="' . esc_url(get_stylesheet_directory_uri()) .'/assets/images/blog/no-img.jpg" />';
                }
            ?>
        </div>
        <div class="name-holder">
            <a class="project-name" href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a>
            <span class="project-options"><?php it_eg_category(); ?></span>
        </div>
        
        </div>
    </div>
    <?php

}
echo '</div></div></div>';
    }
}