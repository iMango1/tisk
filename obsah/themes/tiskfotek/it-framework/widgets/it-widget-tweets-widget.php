<?php
add_action('widgets_init', 'tweets_widget_reg');

function tweets_widget_reg() {
    register_widget('tweets_widget');
}
class tweets_widget extends WP_Widget {
    
    function __construct() {
        parent::__construct('it_widget_tweets',__('* Latest Tweets', 'itrays'), array( 'description' => __( 'Latest tweets widget.', 'itrays' )));
    }
    
    public function widget( $args, $instance ) {
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Latest Tweets','itrays' ) : $instance['title'], $instance, $this->id_base );
        $widget_id = $args['widget_id'];
         
        echo $args['before_widget'];
        if ( ! empty( $title ) ){echo $args['before_title'] . $title . $args['after_title'];}
        echo '<div id="'.esc_attr($widget_id).'" class="tweet"></div>';
        ?>                                                        
        <a class="twitter-timeline" href="https://twitter.com/<?php echo esc_js(theme_option('twitteruser')); ?>" data-widget-id="<?php echo esc_js(theme_option('wid_id')); ?>"></a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        <?php
                    
        echo $args['after_widget'];
    }
            
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Latest Tweets', 'tweets_widget_domain' );
        }
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','itrays' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>

        <?php 
    }
        
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $new_instance;
    }  
             
}