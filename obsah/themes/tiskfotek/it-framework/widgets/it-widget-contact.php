<?php
add_action('widgets_init', 'contact_widget_reg');
function contact_widget_reg(){
    register_widget('contact_widget');
}
class contact_widget extends WP_Widget {

    function __construct() {
        parent::__construct('it_widget_contact',__('* Contact info', 'itrays'), array( 'description' => __( 'Contact us widget.', 'itrays' )));
    }
    
    public function widget( $args, $instance ) {
    $title = apply_filters( 'widget_title', $instance['title'] );
    $langcode = '';
    if ( class_exists( 'SitePress' ) ) {
        $langcode = '-'.ICL_LANGUAGE_CODE;
    }
    echo $args['before_widget'];
    if ( ! empty( $title ) )
    echo $args['before_title'] . $title . $args['after_title'];
    
    echo __( "<ul><li class='footer-contact'><i class='fa fa-home'></i><span>".esc_html(theme_option('contact_address'.$langcode))."</span></li>
        <li class='footer-contact'><i class='fa fa-globe'></i><span><a href='mailto:".esc_html(theme_option('contact_email'))."'>".esc_html(theme_option('contact_email'))."</a></span></li>
        <li class='footer-contact'><i class='fa fa-phone'></i><span>".esc_html(theme_option('contact_phone'))."</span></li></ul>",'cont_widget_domain' );
                
    echo $args['after_widget'];
    }
            
    public function form( $instance ) {
        if ( isset( $instance[ 'title' ] ) ) {
            $title = $instance[ 'title' ];
        }
        else {
            $title = __( 'Keep In Touch', 'itrays' );
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
    return $instance;
    }
}