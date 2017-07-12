<?php
add_action('widgets_init', 'flickr_widget_reg');

function flickr_widget_reg() {
    register_widget('flickr_widget');
}

class flickr_widget extends WP_Widget {
    
    function __construct() {
        parent::__construct('it_widget_flickr',__('* Flickr Feed', 'itrays'), array( 'description' => __( 'Flickr feed widget.', 'itrays' )));
    }
    
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Flickr feed','itrays' ) : $instance['title'], $instance, $this->id_base );
        $flicker_id = $instance['flicker_id'];
        $limit = (int) $instance['limit'];
        $widget_id = $args['widget_id'];
         
        echo $args['before_widget'];
        if ( ! empty( $title ) ){echo $args['before_title'] . $title . $args['after_title'];}
        echo '<ul id="'.$widget_id.'"></ul>';
        ?>
            <script type="text/javascript" src="<?php echo esc_url(THEME_URI); ?>/assets/js/jflickrfeed.min.js"></script>
            <script type="text/javascript">
                (function($) {
                    $('#<?php echo esc_js($widget_id); ?>').jflickrfeed({
                        limit: '<?php echo esc_js( $limit ); ?>',
                        qstrings: {
                            id: '<?php echo esc_js( $flicker_id ); ?>'
                        },
                        itemTemplate: '<li><a href="{{image_b}}" class="zoom"><img src="{{image_s}}" alt="{{title}}" /><span class="img-overlay"></span></a></li>'
                    });
                })(jQuery);
            </script>
        <?php
                    
        echo $args['after_widget'];
    }
            
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
            $flicker_id = $instance['flicker_id'];
            $limit = (int) $instance['limit'];
        }
        else {
            $title = __( 'Flickr Feed', 'itrays' );
            $flicker_id = '';
            $limit = '';
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','itrays' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'flicker_id' )); ?>"><?php _e( 'Flickr ID:','itrays' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'flicker_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'flicker_id' )); ?>" type="text" value="<?php echo esc_attr( $flicker_id ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'limit' )); ?>"><?php _e( 'Limit:','itrays' ); ?></label> 
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'limit' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'limit' )); ?>" type="text" value="<?php echo esc_attr( $limit ); ?>" />
        </p>

        <?php 
    }
        
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['flicker_id'] = ( ! empty( $new_instance['flicker_id'] ) ) ? strip_tags( $new_instance['flicker_id'] ) : '';
        $instance['limit'] = ( ! empty( $new_instance['limit'] ) ) ? strip_tags( $new_instance['limit'] ) : '';
        return $new_instance;
    } 
             
}