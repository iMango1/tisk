<?php

class it_custom_menu {
	function __construct() {
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'it_add_custom_nav_fields' ) );
		add_action( 'wp_update_nav_menu_item', array( $this, 'it_update_custom_nav_fields'), 10, 3 );
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'it_edit_walker'), 10, 2 );
	}
	
	function it_add_custom_nav_fields( $menu_item ) {
	    $menu_item->icon = get_post_meta( $menu_item->ID, '_menu_icon', true );
        $menu_item->megamenu = get_post_meta( $menu_item->ID, '_menu_item_megamenu', true );
        $menu_item->column = get_post_meta( $menu_item->ID, '_menu_item_column', true );
        $menu_item->nav_label = get_post_meta( $menu_item->ID, '_menu_item_nav_label', true );
        $menu_item->hint = get_post_meta( $menu_item->ID, '_menu_item_hint', true );
        $menu_item->hint_type = get_post_meta( $menu_item->ID, '_menu_item_hint_type', true );
	    return $menu_item;
	}
	
	function it_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
	    if ( isset( $_REQUEST['menu-icon']) && is_array( $_REQUEST['menu-icon']) ) {
	        $icon_value = $_REQUEST['menu-icon'][$menu_item_db_id];
	        update_post_meta( $menu_item_db_id, '_menu_icon', $icon_value );
	    }
        if ( isset( $_REQUEST['menu-item-megamenu']) && is_array( $_REQUEST['menu-item-megamenu']) ) {
            $megamenu_value = isset($_REQUEST['menu-item-megamenu'][$menu_item_db_id])? $_REQUEST['menu-item-megamenu'][$menu_item_db_id] : 0;
            update_post_meta( $menu_item_db_id, '_menu_item_megamenu', $megamenu_value );
        }
        if ( isset( $_REQUEST['menu-item-column']) && is_array( $_REQUEST['menu-item-column']) ) {
            $megamenu_value = isset($_REQUEST['menu-item-column'][$menu_item_db_id])? $_REQUEST['menu-item-column'][$menu_item_db_id] : 0;
            update_post_meta( $menu_item_db_id, '_menu_item_column', $megamenu_value );
        }
        if ( isset( $_REQUEST['menu-item-hint']) && is_array( $_REQUEST['menu-item-hint']) ) {
            $megamenu_value = isset($_REQUEST['menu-item-hint'][$menu_item_db_id])? $_REQUEST['menu-item-hint'][$menu_item_db_id] : 0;
            update_post_meta( $menu_item_db_id, '_menu_item_hint', $megamenu_value );
        }
        if ( isset( $_REQUEST['menu-item-hint_type']) && is_array( $_REQUEST['menu-item-hint_type']) ) {
            $megamenu_value = isset($_REQUEST['menu-item-hint_type'][$menu_item_db_id])? $_REQUEST['menu-item-hint_type'][$menu_item_db_id] : 0;
            update_post_meta( $menu_item_db_id, '_menu_item_hint_type', $megamenu_value );
        }
	}
	
	function it_edit_walker($walker,$menu_id) {
	    return 'Walker_Nav_Menu_Edit_Custom';
	}
}
$GLOBALS['it_custom_menu'] = new it_custom_menu();

include_once( 'it-edit-form.php' );
include_once( 'it-front-end.php' );

$popup_css = THEME_URI. '/assets/css/font-awesome.min.css';

if (!file_exists($popup_css)) {
    function it_add_popup_style() {
        wp_enqueue_style('it_font-awesome', THEME_URI. '/assets/css/font-awesome.min.css');
    }
    add_action( 'admin_enqueue_scripts', 'it_add_popup_style' );
}
          
function it_nav_menu( $args = array() ) {
    static $menu_id_slugs = array();
    $walker = new it_walker();
    $defaults = array( 'menu' => '', 'container' => '', 'container_class' => '', 'container_id' => '', 'menu_class' => '', 'menu_id' => '',
    'echo' => true, 'fallback_cb' => 'wp_page_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    'depth' => 0, 'walker' => $walker, 'theme_location' => 'primary' );

    $args = wp_parse_args( $args, $defaults );
    $args = apply_filters( 'wp_nav_menu_args', $args );
    $args = (object) $args;

    $menu = wp_get_nav_menu_object( $args->menu );

    if ( ! $menu && $args->theme_location && ( $locations = get_nav_menu_locations() ) && isset( $locations[ $args->theme_location ] ) )
        $menu = wp_get_nav_menu_object( $locations[ $args->theme_location ] );

    if ( ! $menu && !$args->theme_location ) {
        $menus = wp_get_nav_menus();
        foreach ( $menus as $menu_maybe ) {
            if ( $menu_items = wp_get_nav_menu_items( $menu_maybe->term_id, array( 'update_post_term_cache' => false ) ) ) {
                $menu = $menu_maybe;
                break;
            }
        }
    }

    if ( $menu && ! is_wp_error($menu) && !isset($menu_items) ) $menu_items = wp_get_nav_menu_items( $menu->term_id, array( 'update_post_term_cache' => false ) );
    if ( ( !$menu || is_wp_error($menu) || ( isset($menu_items) && empty($menu_items) && !$args->theme_location ) )
        && $args->fallback_cb && is_callable( $args->fallback_cb ) )
            return call_user_func( $args->fallback_cb, (array) $args );
    if ( ! $menu || is_wp_error( $menu ) ) return false;

    $nav_menu = $items = '';
    $nav_menu .= '<nav class="top-nav">';
    $show_container = false;
    if ( $args->container ) {
        $allowed_tags = apply_filters( 'wp_nav_menu_container_allowedtags', array( 'div', 'nav' ) );
        if ( in_array( $args->container, $allowed_tags ) ) {
            $show_container = true;
            $class = $args->container_class ? ' class="' . esc_attr( $args->container_class ) . '"' : ' class="menu-'. $menu->slug .'-container"';
            $id = $args->container_id ? ' id="' . esc_attr( $args->container_id ) . '"' : '';
            $nav_menu .= '<'. $args->container . $id . $class . '>';
        }
    }

    _wp_menu_item_classes_by_context( $menu_items );

    $sorted_menu_items = $menu_items_with_children = array();
    foreach ( (array) $menu_items as $menu_item ) {
        $sorted_menu_items[ $menu_item->menu_order ] = $menu_item;
        if ( $menu_item->menu_item_parent ) $menu_items_with_children[ $menu_item->menu_item_parent ] = true;
    }

    if ( $menu_items_with_children ) {
        foreach ( $sorted_menu_items as &$menu_item ) {
            if ( isset( $menu_items_with_children[ $menu_item->ID ] ) )
                $menu_item->classes[] = 'menu-item-has-children';
        }
    }

    unset( $menu_items, $menu_item );
    $sorted_menu_items = apply_filters( 'wp_nav_menu_objects', $sorted_menu_items, $args );
    $items .= walk_nav_menu_tree( $sorted_menu_items, $args->depth, $args );
    unset($sorted_menu_items);
    if ( ! empty( $args->menu_id ) ) {
        $wrap_id = $args->menu_id;
    } else {
        $wrap_id = 'menu-' . $menu->slug;
        while ( in_array( $wrap_id, $menu_id_slugs ) ) {
            if ( preg_match( '#-(\d+)$#', $wrap_id, $matches ) )
                $wrap_id = preg_replace('#-(\d+)$#', '-' . ++$matches[1], $wrap_id );
            else
                $wrap_id = $wrap_id . '-1';
        }
    }
    $menu_id_slugs[] = $wrap_id;
    $wrap_class = $args->menu_class ? $args->menu_class.' it-menu' : '';
    $items = apply_filters( 'wp_nav_menu_items', $items, $args );
    $items = apply_filters( "wp_nav_menu_{$menu->slug}_items", $items, $args );
    if ( empty( $items ) ) return false;
    $nav_menu .= sprintf( $args->items_wrap, esc_attr( $wrap_id ), esc_attr( $wrap_class ), $items );
    unset( $items );
    if ( $show_container ) $nav_menu .= '</' . $args->container . '>';
    $nav_menu .= '</nav>';
    $nav_menu = apply_filters( 'wp_nav_menu', $nav_menu, $args );
    if ( $args->echo ) echo $nav_menu;
    else
        return $nav_menu;
}

