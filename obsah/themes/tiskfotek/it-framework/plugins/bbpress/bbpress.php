<?php

add_action( 'bbp_theme_before_forum_sub_forums', 'before_sub_forum_list' );
function before_sub_forum_list() {
     //echo '<hr>';
}

if (theme_option('enable_icon_bb') == "1"){
    add_post_type_support('forum', array('thumbnail'));
}       

function it_modify_breadcrumb_args() {
    
    $args['home_text'] = __('Home','itrays');
    $args['root_text'] = 'Forums';
    $args['sep'] = ' / ';
    $args['before'] = '<div class="bbp-breadcrumb"><p><span class="bold">'.__('You Are In:','itrays').'</span>';

    return $args;
}

add_filter( 'bbp_before_get_breadcrumb_parse_args', 'it_modify_breadcrumb_args' );

