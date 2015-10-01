<?php

function it_recent_posts($postsNo = 5, $postsThumb = true){
    global $post;
    $args = array( 'numberposts' => '5', 'tax_query' => array(
            array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => 'post-format-aside',
                'operator' => 'NOT IN'
            ), 
            array(
                'taxonomy' => 'post_format',
                'field' => 'slug',
                'terms' => 'post-format-image',
                 'operator' => 'NOT IN'
            )
    ) );
    $recent_posts = wp_get_recent_posts( $args );
    foreach( $recent_posts as $recent ){
        echo '<li><a href="' . esc_url(get_permalink($recent["ID"])) . '">' .   ( $recent["post_title"]).'</a> </li> ';
    }
}