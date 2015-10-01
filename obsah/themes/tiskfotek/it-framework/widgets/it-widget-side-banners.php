<?php
add_action('widgets_init', 'banners_ads_widget_reg');

function banners_ads_widget_reg(){
    register_widget('banners_ads_widget');
}
class banners_ads_widget extends WP_Widget {
    
    function __construct() {
        parent::__construct('it_widget_side_banners',__('* Side Banners', 'itrays'), array( 'description' => __( 'Add Banners on the sidebars.', 'itrays' )));
    }
    
    public function widget( $args, $instance ) {
        
        $title = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Banners','itrays' ) : $instance['title'], $instance, $this->id_base );
        $image = $instance['image'];
        $im_link = $instance['im_link'];
         
        //echo $args['before_widget'];
        //if ( ! empty( $title ) ){echo $args['before_title'] . $title . $args['after_title'];}
        echo '<li><div class="banner_img">';
        echo '<a href="'.esc_url($im_link).'"><img alt="" src="'.esc_url($image).'" /></a>';
        echo '</div></li>';
        //echo $args['after_widget'];
    }
            
    public function form( $instance ) {
        $title = $instance[ 'title' ];
        $image = $instance['image'];
        $im_link = $instance['im_link'];
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:','itrays' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'image' ); ?>"><?php _e( 'Image:','itrays' ); ?></label> 
            <input class="" id="<?php echo $this->get_field_id( 'image' ); ?>" name="<?php echo $this->get_field_name( 'image' ); ?>" type="text" value="<?php echo esc_attr( $image ); ?>" />
        <input class="upload_image_button button" type="button" value="Upload Image" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'im_link' ); ?>"><?php _e( 'Banner Link:','itrays' ); ?></label> 
            <input class="widefat" id="<?php echo $this->get_field_id( 'im_link' ); ?>" name="<?php echo $this->get_field_name( 'im_link' ); ?>" type="text" value="<?php echo esc_attr( $im_link ); ?>" />
        </p>
        <?php 
    }
        
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['image'] = ( ! empty( $new_instance['image'] ) ) ? strip_tags( $new_instance['image'] ) : '';
        $instance['im_link'] = ( ! empty( $new_instance['im_link'] ) ) ? strip_tags( $new_instance['im_link'] ) : '';
        return $new_instance;
    } 
}