<?php

class it_walker extends Walker_Nav_Menu{
      function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0){
           global $wp_query;
           $megamenu = 0;
           $column = 1;
           if($depth == 1){            
                $column = get_post_meta( $item->menu_item_parent, '_menu_item_column', true );
                $megamenu = get_post_meta( $item->menu_item_parent, '_menu_item_megamenu', true );
           }
           
           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';

           $classes = empty( $item->classes ) ? array() : (array) $item->classes;
           $labelclass = (isset($item->nav_label) && ($item->nav_label == 1));
           $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );          
           $class_megamenu = ( $item->megamenu == 1 )? ' '.theme_option('mega_menu_style').' megamenu': '';
           
           if($megamenu == 1 ){
            $class_megamenu .= ' col-md-'.(12/$column);
           }
           $class_names = ' class="'. esc_attr( $class_names ) .$class_megamenu. ' ' .$labelclass.'"';

           $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names.'>';
           
           $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
           $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
           $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
           $attributes .= ! empty( $item->url )        ? ' href="'   . esc_url( $item->url        ) .'"' : '';
           
           $prepend = '';
           $append = '';
           $description  = ! empty( $item->description ) ? '<span class="description">'.esc_attr( $item->description ).'</span>' : '';

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            if($item->icon != ''){
               $item_output .= '<i class="'.$item->icon.'"></i>'; 
            }
            $item_output .= '<span>';
            $item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
            $item_output .= $description.$args->link_after;
            if(! empty ($item->hint)){
                $item_output .= '<b class="menu-hint '. $item->hint_type .'">'. $item->hint .'</b>';
            }
            $item_output .= '</span>';
            $item_output .= '</a>';
            $item_output .= $args->after;

            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
      }
}