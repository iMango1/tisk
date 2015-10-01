<?php

$tags = wp_get_post_tags($post->ID);
if ($tags) {
    $tag_ids = array();
    foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
    $args=array(
    'tag__in' => $tag_ids,
    'post__not_in' => array($post->ID),
    'showposts'=>8,
    'ignore_sticky_posts'=>1
    );
$my_query = new wp_query($args);
    if( $my_query->have_posts() ) {
        echo '<div class="related-posts sm-padding"><h4 class="block-head style7">'.__('Related Posts','itrays').'</h4><ul>';
        while ($my_query->have_posts()) {
            $my_query->the_post();
    ?>
        <li>
            <h5><i class="fa fa-book"></i><a href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php echo __('Permanent Link to','itrays') ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
            <div class="related-meta"><?php echo __('By:','itrays') ?> <a href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>"><?php the_author_meta( 'display_name' ); ?></a>, <?php echo __('Posted on:','itrays') ?> <?php echo get_the_date(); ?></div>
        </li>
    <?php

}
echo '</ul></div>';
    }
}