<?php
class Walker_Nav_Menu_Edit_Custom extends Walker_Nav_Menu  {
    function start_lvl(&$output, $depth = 0, $args = array() ) {    
    }
    function end_lvl(&$output, $depth = 0, $args = array() ) {
    }
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        global $_wp_nav_menu_max_depth;
       
        $_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;
    
        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
    
        ob_start();
        $item_id = esc_attr( $item->ID );
        $removed_args = array(
            'action',
            'customlink-tab',
            'edit-menu-item',
            'menu-item',
            'page-tab',
            '_wpnonce',
        );
    
        $original_title = '';
        if ( 'taxonomy' == $item->type ) {
            $original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
            if ( is_wp_error( $original_title ) )
                $original_title = false;
        } elseif ( 'post_type' == $item->type ) {
            $original_object = get_post( $item->object_id );
            $original_title = $original_object->post_title;
        }
    
        $classes = array(
            'menu-item menu-item-depth-' . $depth,
            'menu-item-' . esc_attr( $item->object ),
            'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive'),
        );
    
        $title = $item->title;
    
        if ( ! empty( $item->_invalid ) ) {
            $classes[] = 'menu-item-invalid';
            $title = sprintf( __( '%s (Invalid)','itrays' ), $item->title );
        } elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
            $classes[] = 'pending';
            $title = sprintf( __('%s (Pending)','itrays'), $item->title );
        }
    
        $title = empty( $item->label ) ? $title : $item->label;
        
        ?>
        <li id="menu-item-<?php echo $item_id; ?>" class="<?php echo implode(' ', $classes ); ?>">
            <dl class="menu-item-bar">
                <dt class="menu-item-handle">
                    <span class="item-title"><?php echo esc_html( $title ); ?></span>
                    <span class="item-controls">
                        <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                        <span class="item-order hide-if-js">
                            <a href="<?php
                                echo esc_url( wp_nonce_url( add_query_arg(
                                        array(
                                            'action' => 'move-up-menu-item',
                                            'menu-item' => $item_id,
                                        ),
                                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                    ),
                                    'move-menu_item'));
                            ?>" class="item-move-up"><abbr title="<?php esc_attr_e('Move up'); ?>">&#8593;</abbr></a>
                            |
                            <a href="<?php
                                echo esc_url(wp_nonce_url(
                                    add_query_arg(
                                        array(
                                            'action' => 'move-down-menu-item',
                                            'menu-item' => $item_id,
                                        ),
                                        remove_query_arg($removed_args, admin_url( 'nav-menus.php' ) )
                                    ),
                                    'move-menu_item'
                                ));
                            ?>" class="item-move-down"><abbr title="<?php esc_attr_e('Move down'); ?>">&#8595;</abbr></a>
                        </span>
                        <span class="mega-hint">Mega Menu</span>
                        <a class="item-edit" id="edit-<?php echo $item_id; ?>" title="<?php esc_attr_e('Edit Menu Item'); ?>" href="<?php
                            echo esc_url( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ));
                        ?>"><?php _e( 'Edit Menu Item','itrays' ); ?></a>
                    </span>
                </dt>
            </dl>
    
            <div class="menu-item-settings" id="menu-item-settings-<?php echo $item_id; ?>">
                <?php if( 'custom' == $item->type ) : ?>
                <p class="field-url description description-wide">
                    <label for="edit-menu-item-url-<?php echo $item_id; ?>">
                    <?php _e( 'URL','itrays' ); ?><br />
                    <input type="text" id="edit-menu-item-url-<?php echo $item_id; ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->url ); ?>" />
                        </label>
                </p>
                <?php endif; ?>
                <p class="description description-thin">
                    <label for="edit-menu-item-title-<?php echo $item_id; ?>">
                    <?php _e( 'Navigation Label','itrays' ); ?><br />
                    <input type="text" id="edit-menu-item-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->title ); ?>" />
                    </label>
                </p>
                <p class="description description-thin">
                    <label for="edit-menu-item-attr-title-<?php echo $item_id; ?>">
                        <?php _e( 'Title Attribute','itrays' ); ?><br />
                        <input type="text" id="edit-menu-item-attr-title-<?php echo $item_id; ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>" />
                    </label>
                </p>
                <p class="field-link-target description">
                    <label for="edit-menu-item-target-<?php echo $item_id; ?>">
                        <input type="checkbox" id="edit-menu-item-target-<?php echo $item_id; ?>" value="_blank" name="menu-item-target[<?php echo $item_id; ?>]"<?php checked( $item->target, '_blank' ); ?> />
                        <?php _e( 'Open link in a new window/tab','itrays' ); ?>
                    </label>
                </p>
                <p class="field-css-classes description description-thin">
                    <label for="edit-menu-item-classes-<?php echo $item_id; ?>">
                        <?php _e( 'CSS Classes (optional)','itrays' ); ?><br />
                        <input type="text" id="edit-menu-item-classes-<?php echo $item_id; ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo $item_id; ?>]" value="<?php echo esc_attr( implode(' ', $item->classes ) ); ?>" />
                    </label>
                </p>
                <p class="field-xfn description description-thin">
                    <label for="edit-menu-item-xfn-<?php echo $item_id; ?>">
                        <?php _e( 'Link Relationship (XFN)','itrays' ); ?><br />
                        <input type="text" id="edit-menu-item-xfn-<?php echo $item_id; ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->xfn ); ?>" />
                    </label>
                </p>
                <p class="field-description description description-wide">
                    <label for="edit-menu-item-description-<?php echo $item_id; ?>">
                        <?php _e( 'Description','itrays' ); ?><br />
                        <textarea id="edit-menu-item-description-<?php echo $item_id; ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo $item_id; ?>]"><?php echo esc_html( $item->description ); // textarea_escaped ?></textarea>
                        <span class="description"><?php _e('The description will be displayed in the menu if the current theme supports it.','itrays'); ?></span>
                    </label>
                </p>
                <p class="field-hint description description-thin">
                    <span class="block"><?php _e( 'Hint','itrays' ); ?> </span>  
                    <input type="text" id="edit-menu-item-hint-<?php echo $item_id; ?>" class="widefat edit-menu-item-hint" name="menu-item-hint[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->hint ); ?>" />
                </p>
                <p class="field-hint description description-thin">
                    <span class="block"><?php _e( 'Hint Type','itrays' ); ?> </span>  
                    
                    <select name="menu-item-hint_type[<?php echo $item_id; ?>]" class="widefat" id="edit-menu-item-hint_type-<?php echo $item_id; ?>">
                        <option value="default" <?php echo (($item->hint_type == 'default') || !isset($item->hint_type))? 'selected="selected"': ''; ?>>Default</option>
                        <option value="info" <?php echo (($item->hint_type == 'info') || !isset($item->hint_type))? 'selected=""': ''; ?>>Info</option>
                        <option value="success" <?php echo (($item->hint_type == 'success') || !isset($item->hint_type))? 'selected=""': ''; ?>>Success</option>
                        <option value="warning" <?php echo (($item->hint_type == 'warning') || !isset($item->hint_type))? 'selected=""': ''; ?>>Warning</option>
                        <option value="error" <?php echo (($item->hint_type == 'error') || !isset($item->hint_type))? 'selected=""': ''; ?>>Error</option>
                    </select> 
                    
                </p>
                <p class="field-custom description description-wide">
                    <i class="<?php echo esc_attr( $item->icon ); ?> ico"></i>
                    <a class="button button-primary btn_icon" href="#">Add Icon</a>
                    <input type="hidden" name="menu-icon[<?php echo $item_id; ?>]" id="menu-icon-<?php echo $item_id; ?>" class="icon_input" value="<?php echo esc_attr( $item->icon ); ?>" />
                        <a class="button icon-remove">Remove Icon</a>
                </p>
                <?php if($depth == 0): ?>
                <p class="field-custom description mega-choose">
                        <span class="block"><?php _e( 'Mega Menu','itrays' ); ?> </span>                        
                            
                        <span class="custom-checkbox">
                        <input type="radio" id="radio0<?php echo $item_id; ?>" class="off" name="menu-item-megamenu[<?php echo $item_id; ?>]" value="0"  <?php echo (($item->megamenu == 0) || !isset($item->megamenu))? 'checked="checked"': ''; ?> />
                            <input type="radio" id="radio1<?php echo $item_id; ?>" class="on" name="menu-item-megamenu[<?php echo $item_id; ?>]" value="1"  <?php echo ($item->megamenu == 1)? 'checked="checked"': ''; ?> />
                        <i class="switcher"></i>
                        </span>
                            
                </p>
                <p id="column<?php echo $item_id; ?>" class="field-custom description column-choose">
                    <span class="block"><?php _e( 'Megamenu column','itrays' ); ?></span>
                    <select name="menu-item-column[<?php echo $item_id; ?>]" id="column<?php echo $item_id; ?>">
                        <option value="1" <?php echo (($item->column == 1) || !isset($item->column))? 'selected=""': ''; ?>>1 Column</option>
                        <option value="2" <?php echo (($item->column == 2) || !isset($item->column))? 'selected=""': ''; ?>>2 Columns</option>
                        <option value="3" <?php echo (($item->column == 3) || !isset($item->column))? 'selected=""': ''; ?>>3 Columns</option>
                        <option value="4" <?php echo (($item->column == 4) || !isset($item->column))? 'selected="selected"': ''; ?>>4 Columns</option>
                        <option value="6" <?php echo (($item->column == 6) || !isset($item->column))? 'selected=""': ''; ?>>6 Columns</option>
                        <option value="12" <?php echo (($item->column == 12) || !isset($item->column))? 'selected=""': ''; ?>>12 Columns</option>
                    </select>        
            </p>
                <?php endif; ?>
                <p class="field-move hide-if-no-js description description-wide">
                    <label>
                        <span><?php _e( 'Move','itrays' ); ?></span>
                        <a href="#" class="menus-move-up"><?php _e( 'Up one','itrays' ); ?></a>
                        <a href="#" class="menus-move-down"><?php _e( 'Down one','itrays' ); ?></a>
                        <a href="#" class="menus-move-left"></a>
                        <a href="#" class="menus-move-right"></a>
                        <a href="#" class="menus-move-top"><?php _e( 'To the top','itrays' ); ?></a>
                    </label>
                </p>
                <div class="menu-item-actions description-wide submitbox">
                    <?php if( 'custom' != $item->type && $original_title !== false ) : ?>
                        <p class="link-to-original">
                            <?php printf( __('Original: %s','itrays'), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
                        </p>
                    <?php endif; ?>
                    <a class="item-delete submitdelete deletion" id="delete-<?php echo $item_id; ?>" href="<?php
                    echo esc_url(wp_nonce_url(
                        add_query_arg(
                            array(
                                'action' => 'delete-menu-item',
                                'menu-item' => $item_id,
                            ),
                            admin_url( 'nav-menus.php' )
                        ),
                        'delete-menu_item_' . $item_id
                    )); ?>"><?php _e( 'Remove','itrays' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span> <a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo $item_id; ?>" href="<?php echo esc_url( add_query_arg( array( 'edit-menu-item' => $item_id, 'cancel' => time() ), admin_url( 'nav-menus.php' ) ) );
                        ?>#menu-item-settings-<?php echo $item_id; ?>"><?php _e('Cancel','itrays'); ?></a>
                </div>
                
                <input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo $item_id; ?>]" value="<?php echo $item_id; ?>" />
                <input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object_id ); ?>" />
                <input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->object ); ?>" />
                <input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>" />
                <input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>" />
                <input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo $item_id; ?>]" value="<?php echo esc_attr( $item->type ); ?>" />
            </div>
            <ul class="menu-item-transport"></ul>
            
        <?php
        
        $output .= ob_get_clean();

        }
    function wp_get_nav_menu_items( $menu, $args = array() ) {
    $menu = wp_get_nav_menu_object( $menu );

    if ( ! $menu )
        return false;

    static $fetched = array();

    $items = get_objects_in_term( $menu->term_id, 'nav_menu' );

    if ( empty( $items ) )
        return $items;

    $defaults = array( 'order' => 'ASC', 'orderby' => 'menu_order', 'post_type' => 'nav_menu_item',
        'post_status' => 'publish', 'output' => ARRAY_A, 'output_key' => 'menu_order', 'nopaging' => true );
    $args = wp_parse_args( $args, $defaults );
    if ( count( $items ) > 1 )
        $args['include'] = implode( ',', $items );
    else
        $args['include'] = $items[0];

    $items = get_posts( $args );

    if ( is_wp_error( $items ) || ! is_array( $items ) )
        return false;

    // Get all posts and terms at once to prime the caches
    if ( empty( $fetched[$menu->term_id] ) || wp_using_ext_object_cache() ) {
        $fetched[$menu->term_id] = true;
        $posts = array();
        $terms = array();
        foreach ( $items as $item ) {
            $object_id = get_post_meta( $item->ID, '_menu_item_object_id', true );
            $object    = get_post_meta( $item->ID, '_menu_item_object',    true );
            $type      = get_post_meta( $item->ID, '_menu_item_type',      true );

            if ( 'post_type' == $type )
                $posts[$object][] = $object_id;
            elseif ( 'taxonomy' == $type)
                $terms[$object][] = $object_id;
        }

        if ( ! empty( $posts ) ) {
            foreach ( array_keys($posts) as $post_type ) {
                get_posts( array('post__in' => $posts[$post_type], 'post_type' => $post_type, 'nopaging' => true, 'update_post_term_cache' => false) );
            }
        }
        unset($posts);

        if ( ! empty( $terms ) ) {
            foreach ( array_keys($terms) as $taxonomy ) {
                get_terms($taxonomy, array('include' => $terms[$taxonomy]) );
            }
        }
        unset($terms);
    }

    $items = array_map( 'wp_setup_nav_menu_item', $items );

    if ( ! is_admin() )
        $items = array_filter( $items, '_is_valid_nav_menu_item' );

    if ( ARRAY_A == $args['output'] ) {
        $GLOBALS['_menu_item_sort_prop'] = $args['output_key'];
        usort($items, '_sort_nav_menu_items');
        $i = 1;
        foreach( $items as $k => $item ) {
            $items[$k]->$args['output_key'] = $i++;
        }
    }

    return apply_filters( 'wp_get_nav_menu_items',  $items, $menu, $args );
}
}

