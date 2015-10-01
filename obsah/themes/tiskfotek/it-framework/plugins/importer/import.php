<?php
class it_import extends WP_Import {
  
    // get ID by slug
    function get_ID_by_slug($page_slug) {
        $page = get_page_by_path($page_slug);
        if ($page) {
            return $page->ID;
        } else {
            return null;
        }
    }
    
    function check(){
        /* setting menu
        ----------------------------------------------------------------------- */
        $top_menu = get_term_by('name', 'Top bar menu', 'nav_menu');
        $main_menu = get_term_by('name', 'Global menu', 'nav_menu');
        $one_page = get_term_by('name', 'One Page', 'nav_menu');
        $footer_menu = get_term_by('name', 'Footer Menu', 'nav_menu');

        set_theme_mod( 'nav_menu_locations', array(
                'top-menu' => $top_menu->term_id,
                'global-menu' => $main_menu->term_id,
                'one-page' => $one_page->term_id,
                'bottom-footer-menu' => $footer_menu->term_id
            )
        );

        /* setting custom menu fields
        ----------------------------------------------------------------------- */
        $menu_items = wp_get_nav_menu_items('global-menu');

        if ( ! empty( $menu_items ) ) {
          if ( ! empty( $menu_fields ) ) {
            foreach ( $menu_items as $menu_key => $menu_item ) {
              foreach ( $menu_fields as $field_key => $field_data ) {
                if ( $field_key == $menu_item->title ) {
                  foreach ( $field_data as $key => $value ) {
                    update_post_meta( $menu_item->ID, '_menu_item_' . $key, $value );
                  }
                }
              }
            }
          }
        }

        /* setting home-page
        ----------------------------------------------------------------------- */
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', get_ID_by_slug( 'home1' ) );
        update_option( 'page_for_posts', get_ID_by_slug( 'blog' ) );
        
        
        
        
        
        
        
    }
    
    
    
}