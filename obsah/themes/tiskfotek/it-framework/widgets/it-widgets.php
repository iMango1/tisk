<?php

// Fix Widget Title if Empty
function fix_widget_title($title) {
    $title = $title;
    if($title ==""){
        $title=" ";
    }
    return $title;
}
add_filter('widget_title', 'fix_widget_title');

foreach ( glob( FRAMEWORK_DIR.'/widgets/it-widget-*.php' ) as $widget) {
    locate_template( 'it-framework/widgets/'. basename( $widget ), true );
}


