<?php 

class ITMetaBoxes {
      
    public $it_meta_box;
    public $fields;        
    public $field_types = array();

    public function __construct ( $meta_box ) {
          
        $this->it_meta_box = $meta_box;
        $this->fields = $this->it_meta_box['fields'];

        add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
        add_action( 'save_post', array( $this, 'save_meta_boxes' ) );
        add_action( 'admin_print_styles', array( $this, 'it_register_styles' ) );

    }

    public function add_meta_boxes( ) {
        
        $post_types = array('post','page','product','essential_grid','forum','topic');
        
        foreach ( $post_types as $post_type ) {
            add_meta_box( $this->it_meta_box["id"], $this->it_meta_box["title"], array( $this, 'show_meta_boxes' ),$post_type, 'normal', 'high' );
        }
        
    }

    public function show_meta_boxes() {
    
        global $post;

        echo '<span class="hidden page_settings_title">'.__('Custom Page Settings','itrays').'</span>';

        wp_nonce_field( basename(__FILE__), 'it_meta_box_nonce' );

        foreach ( $this->fields as $field ) {
            
            $meta = get_post_meta( $post->ID, $field['id'], true );
            $meta = ( $meta !== '' ) ? $meta : $field['std'];

            call_user_func ( array( $this, 'type_' . $field['type'] ), $field, $meta );

        }
  }
  
    public function wrapper_start( $field, $meta) {
        echo "<div class='section'>";
        if ( isset($field['name']) && $field['name'] != '' ) {
          echo "<div class='lbl'>";
            echo "<label for='{$field['id']}'>{$field['name']}</label>";
            if ( isset($field['desc']) && $field['desc'] != '' )
                echo "<div class='desc-field'>{$field['desc']}</div>";
          echo "</div>";
        }
    }

    public function wrapper_end( $field, $meta) {
        echo "</div>";
    }

    
    // Fields types functions.
    public function type_text( $field, $meta) {  
        $this->wrapper_start( $field, $meta );
            echo "<div class='inputs'><input type='text' id='".$field["id"]."' class='regular-text".( isset($field['class'])? ' ' . $field['class'] : '' )."' name='".$field['id']."' value='".$meta."' /></div>"; 
        $this->wrapper_end( $field, $meta );
    }

    public function type_select( $field, $meta ) {

        if ( ! is_array( $meta ) ) 
          $meta = (array) $meta;
          
        $this->wrapper_start( $field, $meta );
          echo "<div class='inputs'><select id='".$field["id"]."' class='select".( isset($field['class'])? ' ' . $field['class'] : '' )."' name='".$field['id']."'>";
            foreach ( $field['options'] as $key => $value ) {
            echo "<option value='".$key."'" . selected( in_array( $key, $meta ), true, false ) . ">".$value."</option>";
          }
          echo "</select></div>";
        $this->wrapper_end( $field, $meta );

    }

    public function type_radio( $field, $meta ) {

        if ( ! is_array( $meta ) )
          $meta = (array) $meta;
          
        $this->wrapper_start( $field, $meta );
          echo "<div class='inputs'>";
            foreach ( $field['options'] as $key => $value ) {
            echo "<input type='radio' id='".$field["id"]."' class='radio".( isset($field['class'])? ' ' . $field['class'] : '' )."' name='".$field['id']."' value='".$key."'" . checked( in_array( $key, $meta ), true, false ) . " /> <span class='at-radio-label'>{$value}</span>";
          }
          echo "</div>";
        $this->wrapper_end( $field, $meta );
    }

    public function type_checkbox( $field, $meta ) {

        $this->wrapper_start($field, $meta);
        echo "<div class='inputs'><input type='checkbox' id='".$field["id"]."' class='it_checkbox".( isset($field['class'])? ' ' . $field['class'] : '' )."' value='".$meta."' name='".$field['id']."'" . checked(!empty($meta), true, false) . " /></div>";
        $this->wrapper_end( $field, $meta );
      
    }

    public function type_file( $field, $meta ) {
        $this->wrapper_start( $field, $meta );

        $data_type = isset($field["data-type"]) ? ( $field['data-type'] ) : '';
        
        if ( $data_type == 'video'){
            
            echo "<div class='inputs upload_video'><input type='text' id='".$field["id"]."' class='regular-text".( isset($field['class'])? ' ' . $field['class'] : '' )."'  name='".$field['id']."' value='".$meta."' />
            <input type='button' class='upload_video_button' value='".__('Upload','itrays'). " " .$field["name"]."' /></div>";
            
        }else{
            
            echo "<div class='inputs'><input type='text' id='".$field["id"]."' class='regular-text".( isset($field['class'])? ' ' . $field['class'] : '' )."'  name='".$field['id']."' value='".$meta."' />
            <input type='button' class='upload_image_button' value='".__('Browse','itrays')."' />
            <div class='clear-img'><img class='logo-im alt='' src='".$meta."' /><a class='remove-img' href='#'></a></div></div>";
             
        }
        
        $this->wrapper_end( $field, $meta );
    }

    public function type_color( $field, $meta ) {
          
        $this->wrapper_start( $field, $meta );
        
            echo "<div class='inputs'><input type='text' id='".$field['id']."' class='color-field".(isset($field['class'])? " {$field['class']}": "")."' name='".$field['id']."' size='8' value='".$meta."' /></div>";  

        $this->wrapper_end($field, $meta);

    }
    
    public function type_icon( $field, $meta ) {
        $this->wrapper_start( $field, $meta );
            
            echo "<i class='cust-icon ico'></i><a class='button button-primary btn_icon' href='#'>Add Icon</a><input type='hidden' name='".$field['id']."' id='".$field['id']."' class='icon_input".( isset($field['class'])? ' ' . $field['class'] : '' )."' value='".$meta."' /><a class='button icon-remove'>Remove Icon</a>";

        $this->wrapper_end( $field, $meta );
    } 

    
    // Add Fields functions.
    public function it_textbox( $id, $args ){
        $new_field = array('type' => 'text','id'=> $id,'std' => '','desc' => '','name' => '');
        $new_field = array_merge($new_field, $args);
        $this->fields[] = $new_field;
    }
    
    public function it_checkbox( $id, $args ){
        $new_field = array('type' => 'checkbox','id'=> $id,'std' => '','desc' => '','name' => '');
        $new_field = array_merge($new_field, $args);
        $this->fields[] = $new_field;
    }

    public function it_select( $id, $options, $args ){
        $new_field = array('type' => 'select','id'=> $id,'std' => array(),'desc' => '','name' => '','options' => $options);
        $new_field = array_merge($new_field, $args);
        $this->fields[] = $new_field;
    }

    public function it_radio( $id, $options, $args ){
        $new_field = array('type' => 'radio','id'=> $id,'std' => array(),'desc' => '','name' => '','options' => $options);
        $new_field = array_merge($new_field, $args);
        $this->fields[] = $new_field;
    }

    public function it_color( $id, $args ){
        $new_field = array('type' => 'color','id'=> $id,'std' => '','desc' => '','name' => '');
        $new_field = array_merge($new_field, $args);
        $this->fields[] = $new_field;
    }

    public function it_uploadfile( $id, $args ){
        $new_field = array('type' => 'file','id'=> $id,'std' => '','desc' => '','name' => '');
        $new_field = array_merge($new_field, $args);
        $this->fields[] = $new_field;
    }
    
    public function it_icon( $id, $args ){
        $new_field = array('type' => 'icon','id'=> $id,'std' => '','desc' => '','name' => '');
        $new_field = array_merge($new_field, $args);
        $this->fields[] = $new_field;
    }
    
    
    
    public function save_meta_boxes( $post_id ) {
        
        if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] ) || ( !current_user_can( 'edit_post', $post_id ) ) ) {
            return $post_id;
        }
        
        if ( empty($_POST['it_meta_box_nonce']) || ! wp_verify_nonce( $_POST['it_meta_box_nonce'], basename(__FILE__) ) ) return;
        
        foreach ( $this->fields as $field ) {
            $name = $field['id'];
            $type = $field['type'];
            $current_val = get_post_meta( $post_id, $name, true );
            $new_val = ( isset( $_POST[$name] ) ) ? $_POST[$name] : ( ( $field['std'] ) ? array() : '' );
            $save_func = 'save_field_' . $type;
            $this->save_field( $post_id, $field, $current_val, $new_val );
        }
    }
     
    public function save_field( $post_id, $field, $current_val, $new_val ) {
        $name = $field['id'];
        delete_post_meta( $post_id, $name );
        if ( $new_val === '' || $new_val === array() ) return;
        update_post_meta( $post_id, $name, $new_val );
    }
    
    public function it_register_styles() {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script( 'wp-color-picker');
        wp_enqueue_script('tabs-js', FRAMEWORK_ASSETS_URI . '/js/tabs.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('upload-js', FRAMEWORK_ASSETS_URI . '/js/upload.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('popup-js', FRAMEWORK_ASSETS_URI . '/js/popup.js', array('jquery'), '1.0.0', true);
        wp_enqueue_style('popup-css', FRAMEWORK_ASSETS_URI . '/css/popup.css');
        wp_enqueue_style('tabs-css', FRAMEWORK_ASSETS_URI . '/css/tabs.css');
    } 

}