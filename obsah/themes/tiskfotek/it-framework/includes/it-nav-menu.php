<?php

// Add menus to the site
function it_menus() {
    register_nav_menus(
        array(
        'global-menu' => __( 'Global Menu','itrays' ),
        'top-menu' => __( 'Top Bar Links','itrays' ),
        'one-page' => __( 'One Page Menu','itrays' ),
        'bottom-footer-menu' => __( 'Bottom Footer Menu Links','itrays' ),
        )
    );
}
add_action( 'init', 'it_menus' );

