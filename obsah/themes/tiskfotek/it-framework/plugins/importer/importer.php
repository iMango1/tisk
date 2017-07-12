<?php

// Import demo data
if( ! function_exists( 'it_import_data' ) ) {
  function it_import_data() {
    
    global $wpdb; 
    if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);
    require_once ABSPATH . 'wp-admin/includes/import.php';
      
    if ( ! class_exists( 'WP_Importer' ) ) {
        $class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
        if ( file_exists( $class_wp_importer ) ){
            require $class_wp_importer;
        }
    }
    if ( ! class_exists( 'WP_Import' ) ) {
        $class_wp_importer = FRAMEWORK_PLUGIN_DIR ."/importer/wordpress-importer.php";
        if ( file_exists( $class_wp_importer ) )
            require $class_wp_importer;
    }
    
    if ( class_exists( 'WP_Import' ) ) {
        $import_filepath = FRAMEWORK_PLUGIN_DIR . '/importer/content/content.xml';
        include_once(FRAMEWORK_PLUGIN_DIR .'/importer/import.php');
        
        $attachment = ( ! empty( $_POST['attachment'] ) ) ? true : false;
        $wp_import = new it_import();
        $wp_import->fetch_attachments = $attachment;
        $wp_import->import($import_filepath);
        $wp_import->check();
        
        // Add sidebar widget areas
        /****************** Main sidebar *************************/
        register_sidebar(array(
            'name' => 'Primary SideBar',
            'id' => 'sidebar-1',
            'before_widget' => '<li class="widget fx %2$s" data-animate="fadeInRight">',
            'after_widget' => '</div></li>',
            'before_title' => '<h4 class="widget-head">',
            'after_title' => '</h4><div class="widget-content">',
        ));
        
        /****************** Main sidebar *************************/
        register_sidebar(array(
            'name' => 'Secondary SideBar',
            'id' => 'sidebar-2',
            'before_widget' => '<li class="widget fx %2$s" data-animate="fadeInRight">',
            'after_widget' => '</div></li>',
            'before_title' => '<h4 class="widget-head">',
            'after_title' => '</h4><div class="widget-content">',
        ));
        
        /****************** Shop sidebar *************************/
        register_sidebar(array(
            'name' => 'Shop SideBar',
            'id' => 'sidebar-shop',
            'before_widget' => '<li class="widget fx %2$s" data-animate="fadeInRight">',
            'after_widget' => '</div></li>',
            'before_title' => '<h4 class="widget-head">',
            'after_title' => '</h4><div class="widget-content">',
        ));
        
        /****************** bbpress sidebar *************************/
        register_sidebar(array(
            'name' => 'BBPress SideBar',
            'id' => 'sidebar-bbpress',
            'before_widget' => '<li class="widget fx %2$s" data-animate="fadeInRight">',
            'after_widget' => '</div></li>',
            'before_title' => '<h4 class="widget-head">',
            'after_title' => '</h4><div class="widget-content">',
        ));
        
        /****************** buddypress sidebar *************************/
        register_sidebar(array(
            'name' => 'BuddyPress SideBar',
            'id' => 'sidebar-buddypress',
            'before_widget' => '<li class="widget fx %2$s" data-animate="fadeInRight">',
            'after_widget' => '</div></li>',
            'before_title' => '<h4 class="widget-head">',
            'after_title' => '</h4><div class="widget-content">',
        ));
        
        /****************** Downloads sidebar *************************/
        register_sidebar(array(
            'name' => 'Downloads SideBar',
            'id' => 'sidebar-edd',
            'before_widget' => '<li class="widget fx %2$s" data-animate="fadeInRight">',
            'after_widget' => '</div></li>',
            'before_title' => '<h4 class="widget-head">',
            'after_title' => '</h4><div class="widget-content">',
        ));
        
        /****************** Footer Widgets *************************/
        register_sidebar( array(
            'name' => 'Footer Widgets',
            'id' => 'footer-widgets',
            'before_widget' => '<div class="widget %2$s col-md-'.theme_option('footer_columns_number').'">',
            'after_widget' => '</div>',
            'description' => 'Appears in the footer area',
            'before_title' => '<h4 class="block-head">',
            'after_title' => '</h4>'
        ));

        // Add data to widgets
        $widgets_json = FRAMEWORK_PLUGIN_URI . '/importer/content/widgets.json';
        $widgets_json = wp_remote_get( $widgets_json );
        $widget_data = $widgets_json['body'];
        
        $import_widgets = it_import_widget_data( $widget_data );
        die();  
        
    }
    
    
    
    
  }
  function it_import_widget_data( $widget_data ) {
        $json_data = $widget_data;
        $json_data = json_decode( $json_data, true );
        
        $sidebar_data = $json_data[0];
        $widget_data = $json_data[1];
        
        foreach ( $widget_data as $widget_data_title => $widget_data_value ) {
            $widgets[ $widget_data_title ] = '';
            foreach( $widget_data_value as $widget_data_key => $widget_data_array ) {
                if( is_int( $widget_data_key ) ) {
                    $widgets[$widget_data_title][$widget_data_key] = 'on';
                }
            }
        }
        unset($widgets[""]);

        foreach ( $sidebar_data as $title => $sidebar ) {
            $count = count( $sidebar );
            for ( $i = 0; $i < $count; $i++ ) {
                $widget = array( );
                $widget['type'] = trim( substr( $sidebar[$i], 0, strrpos( $sidebar[$i], '-' ) ) );
                $widget['type-index'] = trim( substr( $sidebar[$i], strrpos( $sidebar[$i], '-' ) + 1 ) );
                if ( !isset( $widgets[$widget['type']][$widget['type-index']] ) ) {
                    unset( $sidebar_data[$title][$i] );
                }
            }
            $sidebar_data[$title] = array_values( $sidebar_data[$title] );
        }

        foreach ( $widgets as $widget_title => $widget_value ) {
            foreach ( $widget_value as $widget_key => $widget_value ) {
                $widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
            }
        }

        $sidebar_data = array( array_filter( $sidebar_data ), $widgets );

        it_parse_import_data( $sidebar_data );
    }

  function it_parse_import_data( $import_array ) {
        global $wp_registered_sidebars;
        $sidebars_data = $import_array[0];
        $widget_data = $import_array[1];
        $current_sidebars = get_option( 'sidebars_widgets' );
        $new_widgets = array( );

        foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :

            foreach ( $import_widgets as $import_widget ) :
                //if the sidebar exists
                if ( isset( $wp_registered_sidebars[$import_sidebar] ) ) :
                    $title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
                    $index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
                    $current_widget_data = get_option( 'widget_' . $title );
                    $new_widget_name = it_get_new_widget_name( $title, $index );
                    $new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

                    if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
                        while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
                            $new_index++;
                        }
                    }
                    $current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
                    if ( array_key_exists( $title, $new_widgets ) ) {
                        $new_widgets[$title][$new_index] = $widget_data[$title][$index];
                        $multiwidget = $new_widgets[$title]['_multiwidget'];
                        unset( $new_widgets[$title]['_multiwidget'] );
                        $new_widgets[$title]['_multiwidget'] = $multiwidget;
                    } else {
                        $current_widget_data[$new_index] = $widget_data[$title][$index];
                        $current_multiwidget = isset($current_widget_data['_multiwidget']) ? $current_widget_data['_multiwidget'] : false;
                        $new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
                        $multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
                        unset( $current_widget_data['_multiwidget'] );
                        $current_widget_data['_multiwidget'] = $multiwidget;
                        $new_widgets[$title] = $current_widget_data;
                    }

                endif;
            endforeach;
        endforeach;

        if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
            update_option( 'sidebars_widgets', $current_sidebars );

            foreach ( $new_widgets as $title => $content )
                update_option( 'widget_' . $title, $content );

            return true;
        }

        return false;
    }

  function it_get_new_widget_name( $widget_name, $widget_index ) {
        $current_sidebars = get_option( 'sidebars_widgets' );
        $all_widget_array = array( );
        foreach ( $current_sidebars as $sidebar => $widgets ) {
            if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
                foreach ( $widgets as $widget ) {
                    $all_widget_array[] = $widget;
                }
            }
        }
        while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
            $widget_index++;
        }
        $new_widget_name = $widget_name . '-' . $widget_index;
        return $new_widget_name;
    }

  add_action( 'wp_ajax_my_action', 'it_import_data' );
}


