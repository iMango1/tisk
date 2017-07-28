<?php
/*
Plugin Name: IT-RAYS Shortcodes
Plugin URI: http://www.it-rays.net/
Description: This is a custom Visual Composer addon for making custom shortcodes.
Author: IT-RAYS
Version: 2.0.0
Author URI: http://www.it-rays.net/
*/

if (!defined('ABSPATH')) die('-1');

defined( 'TI_PLUGIN_DIR') or define( 'TI_PLUGIN_DIR', untrailingslashit( dirname( __FILE__ ) ) );

class VCExtendAddonCustomShortCodes {
  
    function __construct() {
        
        add_action( 'vc_before_init', array( $this, 'integrateWithVC' ) );
        add_action( 'vc_before_init', array( $this, 'it_vc_shortcodes' ) );
        add_action( 'vc_load_default_params', array( $this, 'inputs_js' ) );
        
        include_once plugin_dir_path( __FILE__ ) . "shortcodes/it_gallery.php";
        
    }
  	
    function it_vc_shortcodes() {
            vc_set_as_theme();
            
            // remove params from elements.
            vc_remove_param( "vc_message", "css_animation" );  
            vc_remove_param( "vc_column_text", "css_animation" );
            vc_remove_param( "vc_toggle", "css_animation" );
            vc_remove_param( "vc_single_image", "css_animation" );
            vc_remove_param( "vc_cta_button2", "css_animation" );
            vc_remove_param( "vc_row", "full_width" );
            vc_remove_param( "vc_row", "parallax_image" );
            vc_remove_param( "vc_row", "parallax" );
            vc_remove_param( "vc_row", "video_bg" );    
            vc_remove_param( "vc_row", "video_bg_url" );
            vc_remove_param( "vc_row", "video_bg_parallax" );
            vc_remove_param( "vc_row", "video_bg_url" );
            vc_remove_param( "vc_row", "css" ); 
            vc_remove_param( "vc_row", "el_id" ); 
            vc_remove_param( "vc_button2", "style" );
            vc_remove_param( "vc_button2", "color" );
            vc_remove_param( "vc_button2", "size" );
            vc_remove_param( "vc_button2", "el_class" );
            vc_remove_param( "vc_btn", "style" );
            vc_remove_param( "vc_btn", "color" );
            vc_remove_param( "vc_btn", "size" );
            vc_remove_param( "vc_btn", "css_animation" );
            vc_remove_param( "vc_btn", "shape" );
            vc_remove_param( "vc_btn", "add_icon" );
            vc_remove_param( "vc_btn", "i_icon_fontawesome" );
            vc_remove_param( "vc_btn", "i_icon_pixelicons" );
            vc_remove_param( "vc_btn", "i_icon_openiconic" );
            vc_remove_param( "vc_btn", "i_icon_typicons" );
            vc_remove_param( "vc_btn", "i_icon_entypo" );
            vc_remove_param( "vc_btn", "i_icon_linecons" );
            vc_remove_param( "vc_btn", "i_align" );
            vc_remove_param( "vc_btn", "i_type" );
            vc_remove_param( "vc_btn", "el_class" );
            vc_remove_param( "vc_row", "el_class" );
            vc_remove_param( "vc_progress_bar", "bgcolor" );
            vc_remove_param( "vc_progress_bar", "custombgcolor" );  
            vc_remove_param( "vc_progress_bar", "el_class" );
            
            //vc_remove_element( "vc_separator" );
            vc_remove_element( "vc_button" );
            vc_remove_element( "vc_cta_button" );
            //vc_remove_element( "vc_custom_heading" );
            
                $it_animation = array(
                'type' => 'dropdown',
                'heading' => __( 'CSS Animation', 'js_composer' ),
                'param_name' => 'it_animation', 
                'admin_label' => true,
                "base" => "css_animation",
                "as_parent" => array('except' => 'css_animation'),
                'edit_field_class' => 'vc_col-xs-12 vc_column anim-class',
                "content_element" => true,
                "icon" => "css_animation",
                'value' => array(
                    __( 'No Animation', 'js_composer' ) => '',
                    __( 'fadeIn', 'js_composer' ) => 'fadeIn',
                    __( 'fadeInLeft', 'js_composer' ) => 'fadeInLeft',
                    __( 'fadeInRight', 'js_composer' ) => 'fadeInRight',
                    __( 'fadeInUp', 'js_composer' ) => 'fadeInUp',
                    __( 'fadeInDown', 'js_composer' ) => 'fadeInDown',
                    __( 'bounce', 'js_composer' ) => 'bounce',
                    __( 'flash', 'js_composer' ) => 'flash',
                    __( 'pulse', 'js_composer' ) => 'pulse',
                    __( 'shake', 'js_composer' ) => 'shake',
                    __( 'swing', 'js_composer' ) => 'swing',
                    __( 'tada', 'js_composer' ) => 'tada',
                    __( 'wobble', 'js_composer' ) => 'wobble',
                    __( 'bounceIn', 'js_composer' ) => 'bounceIn',
                    __( 'bounceInLeft', 'js_composer' ) => 'bounceInLeft',
                    __( 'bounceInRight', 'js_composer' ) => 'bounceInRight',
                    __( 'bounceInUp', 'js_composer' ) => 'bounceInUp',
                    __( 'bounceInDown', 'js_composer' ) => 'bounceInDown'
                ),
                'description' => __( '', 'js_composer' )
            );

            $it_animation_delay = array(
                "type" => "textfield",
                "heading" => __( "Animation Duration", 'js_composer' ),
                "param_name" => "duration",
                'edit_field_class' => 'vc_col-xs-6 vc_column anim-deldu',
                "value" => '',
                "description" => __( "", 'js_composer' ),
            );

            $it_animation_duration = array(
                "type" => "textfield",
                "heading" => __( "Animation Delay", 'js_composer' ),
                "param_name" => "delay",
                'edit_field_class' => 'vc_col-xs-6 vc_column anim-deldu',
                "value" => '',
                "description" => __( "", 'js_composer' ),
            );
            
           vc_map( array(
            'name' => __( 'Heading 2', 'js_composer' ),
            'base' => 'it_heading',
            'icon' => 'no-bg fa fa-header',
            'show_settings_on_create' => true,
            'category' => __( 'Custom Shortcodes', 'js_composer' ),
            'description' => __( 'other custom heading with many styles', 'js_composer' ),
            'params' => array(
                array(
                    'type' => 'textarea',
                    'heading' => __( 'Text', 'js_composer' ),
                    'param_name' => 'text',
                    'admin_label' => true,
                    'value' => __( 'This is custom heading element', 'js_composer' ),
                    'description' => __( 'Enter your content. If you are using non-latin characters be sure to activate them under Settings/Visual Composer/General Settings.', 'js_composer' ),
                ),
                array(
                    "type" => "dropdown",
                    'edit_field_class'    => 'vc_col-xs-4 vc_column',
                    "class" => "",
                    "heading" => __("Heading Style",'itrays'),
                    "param_name" => "heading_style",
                    "value" => array(
                        'Style 1' =>'',
                        'Style 2' =>'style2',
                        'Style 3' =>'style3',
                        'Style 4' =>'style4',
                        'Style 5' =>'style5',
                        'Style 6' =>'style6',
                        'Style 7' =>'style7',
                        'Style 8' =>'style8',
                    ) 
                ),
                array(
                    "type" => "dropdown",
                    'edit_field_class'    => 'vc_col-xs-4 vc_column',
                    "class" => "",
                    "heading" => __("Heading Tag",'itrays'),
                    "param_name" => "head_tag",
                    'not_empty' => true,
                    "value" => array(
                        '-- Select Tag --' => '',
                        'h1' =>'h1',
                        'h2' =>'h2',
                        'h3' =>'h3',
                        'h4' =>'h4',
                        'h5' =>'h5',
                        'h6' =>'h6',
                    ) 
                ),
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    'edit_field_class'    => 'vc_col-xs-4 vc_column',
                    "class" => "",
                    "heading" => __("Heading Alignment",'itrays'),
                    "param_name" => "head_align",
                    "value" => array(
                        'Left' =>'',
                        'Center' =>'center',
                        'Right' =>'right-head',
                    ) 
                ),array(
                    'type' => 'dropdown',
                    'heading' => __( 'Font Weight', 'js_composer' ),
                    'edit_field_class'    => 'vc_col-xs-4 vc_column',
                    'param_name' => 'extrabold',
                    'value' => array(
                        'normal' => 'normal',
                        'bold' => 'bold',
                        'lighter' => 'lighter',
                        'bolder' => 'bolder',
                        '100' => '100',
                        '200' => '200',
                        '300' => '300',
                        '400' => '400',
                        '500' => '500',
                        '600' => '600',
                        '700' => '700',
                        '800' => '800',
                        '900' => '900',
                        'inherit' => 'inherit'
                    )
                ),array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Custom Color', 'js_composer' ),
                    'param_name' => 'head_color',
                    'edit_field_class'    => 'vc_col-xs-4 vc_column',
                    'description' => __( '', 'js_composer' ),
                 ),
                array(
                    'type' => 'checkbox',
                    'heading' => __( 'Uppercase ?', 'js_composer' ),
                    'edit_field_class'    => 'vc_col-xs-4 vc_column',
                    'param_name' => 'upper',
                    'value' => array(
                        __( 'yes', 'js_composer' ) => '1',
                    )
                ),
                array(
                    "type" => "it_vc_icon",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Icon",'itrays'),
                    "param_name" => "head_icon",
                    'group'       => 'Icon',
                    "description" => __("select the Heading icon.",'itrays'),
                 ),
                $it_animation,
                $it_animation_delay,
                $it_animation_duration,
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Extra class name', 'js_composer' ),
                    'param_name' => 'ex_class',
                    'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' ),
                )
            )
        )); 

        /* IT IconBox Shortcode
        ----------------------------------------------------------- */
        vc_map( array(
              "name" => __("Icon Box", 'js_composer'),
              "base" => "it_iconbox",
              'category' => __( 'Custom Shortcodes', 'js_composer' ),
              'icon' => 'no-bg fa fa-bars',
              'description' => __( 'icon boxes with many styles', 'js_composer' ),
              "params" => array(
                 array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Box Title",'itrays'),
                    "param_name" => "iconbox_title",
                    "value" => '',
                    'edit_field_class'    => 'vc_col-xs-9 vc_column',
                    "description" => __("type the box title.",'itrays')
                 ),
                 array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Box Style",'itrays'),
                    "param_name" => "iconbox_style",
                    "value" => array(
                        'style 1' =>'1',
                        'style 2' =>'2',
                        'style 3' =>'3',
                        'style 4' =>'4',
                        'style 5' =>'5',
                        'style 6' =>'6',
                        'style 7' =>'7',
                        'style 8' =>'8',
                        'style 9' =>'9',
                        'style 10' =>'10',
                    ),
                    'edit_field_class'    => 'vc_col-xs-3 vc_column',
                    "description" => __("Select Box style.",'itrays'),
                 ),
                 array(
                    "type" => "textarea_html",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Box Content",'itrays'),
                    "param_name" => "content",
                    "value" => __("Hello, I'm the box content you can change me to whatever text you want.",'itrays'),
                    "description" => __("type here the description for the icon box content.",'itrays')
                 ),
                 $it_animation,
                 $it_animation_delay,
                 $it_animation_duration,
                 array(
                    "type" => "it_vc_icon",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Box Icon",'itrays'),
                    "param_name" => "iconbox_icon",
                    "description" => __("select the box icon.",'itrays'),
                    'group'       => 'Box Icon'
                 ),
                 array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Read More Text",'itrays'),
                    "param_name" => "iconbox_more_text",
                    "value" => '',
                    "description" => __("type here the read more text.",'itrays'),
                    'group'       => 'Read More'
                 ),
                 array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Read More Link",'itrays'),
                    "param_name" => "iconbox_more",
                    "value" => '',
                    "description" => __("type here the link for this box.",'itrays'),
                    'group'       => 'Read More'
                 ),
                 array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "el_class",
                    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
                )
              )
           ) );
           
        /* IT Testimonials Container
        ----------------------------------------------------------- */
        vc_map( array(
            "name" => __("Testimonials", "js_composer"),
            "base" => "vc_testimonials",
            "as_parent" => array('only' => 'it_testimonial'),
            'icon' => 'no-bg fa fa-comments-o',
            'category' => __( 'Custom Shortcodes', 'js_composer' ),
            "content_element" => true,
            'description' => __( 'Add testimonial parent container', 'js_composer' ),
            "show_settings_on_create" => false,
            "params" => array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Testimonial Style",'itrays'),
                    "param_name" => "block_style",
                    "value" => array(
                        'Carousel style 1' =>'1',
                        'Carousel style 2' =>'2',
                        'Carousel style 3' =>'3',
                        'Carousel style 4' =>'4',
                        'Grid style' =>'5',
                    ),
                    "description" => __("Select Item style.",'itrays')
                 ),array(
                    "type" => "textfield",
                    "heading" => __("Slides to show", "js_composer"),
                    "param_name" => "testo_slides",
                    'value' => '2',
                    'edit_field_class'    => 'vc_col-xs-4 vc_column t_slides',
                    "description" => __("number of visible slides.", "js_composer")
                ),array(
                    "type" => "textfield",
                    "heading" => __("Slides to Scroll", "js_composer"),
                    "param_name" => "testo_scroll",
                    'value' => '2',
                    'edit_field_class'    => 'vc_col-xs-4 vc_column t_slides',
                    "description" => __("number of slides that will scroll.", "js_composer")
                ),array(
                    "type" => "textfield",
                    "heading" => __("Slide Speed", "js_composer"),
                    "param_name" => "testo_speed",
                    'value' => '300',
                    'edit_field_class'    => 'vc_col-xs-4 vc_column t_slides',
                    "description" => __("select the speed that slide will be changed.", "js_composer")
                ),array(
                    "type" => "checkbox",
                    "heading" => __("Fade ?", "js_composer"),
                    "param_name" => "testo_fade",
                    'edit_field_class'    => 'vc_col-xs-3 vc_column t_slides',
                    'value' => array(
                        __( 'yes', 'js_composer' ) => '1',
                    )
                ),array(
                    "type" => "checkbox",
                    "heading" => __("Auto Play ?", "js_composer"),
                    "param_name" => "testo_auto",
                    'edit_field_class'    => 'vc_col-xs-3 vc_column t_slides',
                    'value' => array(
                        __( 'yes', 'js_composer' ) => '1',
                    )
                ),array(
                    "type" => "checkbox",
                    "heading" => __("Hide Arrows ?", "js_composer"),
                    "param_name" => "testo_arrows",
                    'edit_field_class'    => 'vc_col-xs-3 vc_column t_slides',
                    'value' => array(
                        __( 'yes', 'js_composer' ) => '1',
                    )
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __("Hide Bullets ?", "js_composer"),
                    "param_name" => "testo_dots",
                    'edit_field_class'    => 'vc_col-xs-3 vc_column t_slides',
                    'value' => array(
                        __( 'yes', 'js_composer' ) => '1',
                    )
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __("Infinite ?", "js_composer"),
                    "param_name" => "testo_infinite",
                    'edit_field_class'    => 'vc_col-xs-3 vc_column t_slides',
                    'value' => array(
                        __( 'yes', 'js_composer' ) => '1',
                    )
                ),array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "el_class",
                    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
                )
            ),
            "js_view" => 'VcColumnView'
        ) );


        /* IT Testimonials Shortcode
        ----------------------------------------------------------- */
        vc_map( array(
              "name" => __("Testimonial BlockQuote", 'js_composer'),
              "base" => "it_testimonial",
              'category' => __( 'Custom Shortcodes', 'js_composer' ),
              "content_element" => true,
              'icon' => 'no-bg fa fa-comment-o',
              "as_child" => array('only' => 'vc_testimonials'),
              "params" => array(
                 array(
                    "type" => "attach_image",
                    "heading" => __("Image",'itrays'),
                    "param_name" => "image",
                    "value" => '',
                 ),
                 array(
                    "type" => "textfield",
                    "heading" => __("Author",'itrays'),
                    "param_name" => "author",
                    'edit_field_class'    => 'vc_col-xs-6 vc_column',
                 ),
                 array(
                    "type" => "textfield",
                    "heading" => __("Slogan",'itrays'),
                    "param_name" => "slogan",
                    'edit_field_class'    => 'vc_col-xs-6 vc_column',
                    "value" => '',
                 ),
                 array(
                    "type" => "textarea",
                    "heading" => __("Text",'itrays'),
                    "param_name" => "content",
                    "value" => __("Hello, I'm the box content you can change me to whatever text you want.",'itrays'),
                 ),
                 array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "el_class",
                    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
                )
              )
           ) );   

        /* IT Fun Staff Row Container
        ----------------------------------------------------------- */
        vc_map( array(
            "name" => __("Fun Staff Row", "js_composer"),
            "base" => "staff_row",
            "as_parent" => array('only' => 'it_fun_staff'),
            "content_element" => true,
            'category' => __( 'Custom Shortcodes', 'js_composer' ),
            'icon' => 'no-bg fa fa-paper-plane',
            'description' => __( 'adds counter with predefined styles', 'js_composer' ),
            "show_settings_on_create" => false,
            "params" => array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Fun Staff Style",'itrays'),
                    "param_name" => "staff_row_style",
                    "value" => array(
                        'style 1' =>'1',
                        'style 2' =>'2',
                        'style 3' =>'3',
                        'style 4' =>'4'
                    ),
                    "description" => __("Select Item style.",'itrays')
                 ),
                 array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "el_class",
                    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
                )
            ),
            "js_view" => 'VcColumnView'
        ) );

        /* IT Fun Staff Shortcode
        ----------------------------------------------------------- */
        vc_map( array(
              "name" => __("Fun Staff", 'js_composer'),
              "base" => "it_fun_staff",
              'category' => __( 'Custom Shortcodes', 'js_composer' ),
              'icon' => 'no-bg fa fa-paper-plane-o',
              "as_child" => array('only' => 'staff_row'),
              "content_element" => true,
              "class" => "",
              "params" => array(
                 array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Item Title",'itrays'),
                    "param_name" => "item_title",
                    'edit_field_class'    => 'vc_col-xs-6 vc_column',
                    "value" => '',
                    "description" => __("type the item title.",'itrays')
                 ),
                 array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Item Value",'itrays'),
                    "param_name" => "item_value",
                    'edit_field_class'    => 'vc_col-xs-6 vc_column',
                    "value" => '',
                    "description" => __("type here the item value.",'itrays'),
                 ),
                 array(
                    "type" => "it_vc_icon",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Item Icon",'itrays'),
                    "param_name" => "item_icon",
                    "description" => __("select the box icon.",'itrays'),
                 ),
                 array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "el_class",
                    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
                )/*,
                 array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Item Style",'itrays'),
                    "param_name" => "item_style",
                    "value" => array(
                        'style 1' =>'1',
                        'style 2' =>'2',
                        'style 3' =>'3',
                        'style 4' =>'4'
                    ),
                    "description" => __("Select Item style.",'itrays'),
                 )*/
              )
           ) );
           
        /* IT Posts Shortcode 
        ----------------------------------------------------------- */
        /*vc_map( array(
            "name" => __("Posts", "js_composer"),
            "base" => "it_posts",
            'category' => __( 'Custom Shortcodes', 'js_composer' ),
            'icon' => 'no-bg fa fa-pencil-square',
            "show_settings_on_create" => false,
            "params" => array(
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Posts Per Page",'itrays'),
                    "param_name" => "",
                    "value" => '',
                    "description" => __("type the number of posts per page.",'itrays')
                 ),array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Category",'itrays'),
                    "param_name" => "it_cat",
                    "value" => it_dropdown_cats(),
                    "description" => __("select the post category.",'itrays')
                 )  
            )
        ) );
        */
        /* IT Recent Posts Shortcode 
        ----------------------------------------------------------- */
        vc_map( array(
            "name" => __("Recent Posts", "js_composer"),
            "base" => "it_recent_posts",
            'category' => __( 'Custom Shortcodes', 'js_composer' ),
            'icon' => 'no-bg fa fa-pencil-square-o',
            'description' => __( 'adds recent posts in news page', 'js_composer' ),
            "show_settings_on_create" => false,
            "params" => array(
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Item Title",'itrays'),
                    "param_name" => "it_title",
                    "value" => '',
                    "description" => __("type the item title.",'itrays')
                 ),array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Category",'itrays'),
                    "param_name" => "it_cat",
                    "value" => it_dropdown_cats(),
                    "description" => __("type the item category.",'itrays')
                 ),array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "el_class",
                    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
                )  
            )
        ) );

        /* IT Category Posts Shortcode 
        ----------------------------------------------------------- */
        vc_map( array(
            "name" => __("Posts From Category", "js_composer"),
            "base" => "it_posts_category",
            'category' => __( 'Custom Shortcodes', 'js_composer' ),
            'icon' => 'no-bg fa fa-tags',
            'description' => __( 'choose posts from specific category', 'js_composer' ),
            "params" => array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Category",'itrays'),
                    "param_name" => "it_category",
                    "value" => it_dropdown_cats(),
                    "description" => __("type the item category.",'itrays')
                 ),array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "el_class",
                    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
                )
            )
        ) );


        /* IT News In Pictures Shortcode 
        ----------------------------------------------------------- */
        vc_map( array(
            "name" => __("News In Pictures", "js_composer"),
            "base" => "it_new_in_pictures",
            'category' => __( 'Custom Shortcodes', 'js_composer' ),
            'icon' => 'no-bg fa fa-photo',
            'description' => __( 'choose images in news to be shown in news page', 'js_composer' ),
            "params" => array(
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Item Title",'itrays'),
                    "param_name" => "it_title",
                    "value" => '',
                    "description" => __("type the item title.",'itrays')
                 ),array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Category",'itrays'),
                    "param_name" => "it_cat",
                    "value" => it_dropdown_cats(),
                    "description" => __("type the item category.",'itrays')
                 ),array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "el_class",
                    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
                )  
            )
        ) );

        /* IT News In Pictures Shortcode 
        ----------------------------------------------------------- */
        vc_map( array(
            "name" => __("Posts Slider 2", "js_composer"),
            "base" => "it_posts_slider",
            'category' => __( 'Custom Shortcodes', 'js_composer' ),
            'description' => __( 'another posts slider shown in news page', 'js_composer' ),
            'icon' => 'no-bg fa fa-tasks',
            "params" => array(
                array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Item Title",'itrays'),
                    "param_name" => "it_title",
                    "value" => '',
                    "description" => __("type the item title.",'itrays')
                 ),array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Category",'itrays'),
                    "param_name" => "it_cat",
                    "value" => it_dropdown_cats(),
                    "description" => __("type the item category.",'itrays')
                 ),array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "el_class",
                    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
                )  
            )
        ) );

        /* IT Clients Container
        ----------------------------------------------------------- */
        vc_map( array(
            "name" => __("Clients", "js_composer"),
            "base" => "it_clients",   
            'category' => __( 'Custom Shortcodes', 'js_composer' ),
            'icon' => 'no-bg fa fa-users',
            'description' => __( 'container to show list of clients or images', 'js_composer' ),
            "as_parent" => array('only' => 'it_client'),
            "content_element" => true,
            "show_settings_on_create" => false,
            "params" => array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Block Style",'itrays'),
                    "param_name" => "cl_style",
                    "value" => array(
                        'Grid style 1' =>'1',
                        'Grid style 2' =>'2',
                        'Grid style 3' =>'3',
                        'Carousel' =>'4',
                    ),
                    "description" => __("Select Item style.",'itrays')
                 ),array(
                    "type" => "textfield",
                    "heading" => __("Slides to show", "js_composer"),
                    "param_name" => "cl_slides",
                    'value' => '2',
                    'edit_field_class'    => 'vc_col-xs-4 vc_column c_slides',
                    "description" => __("number of visible slides.", "js_composer")
                ),array(
                    "type" => "textfield",
                    "heading" => __("Slides to Scroll", "js_composer"),
                    "param_name" => "cl_scroll",
                    'value' => '2',
                    'edit_field_class'    => 'vc_col-xs-4 vc_column c_slides',
                    "description" => __("number of slides that will scroll.", "js_composer")
                ),array(
                    "type" => "textfield",
                    "heading" => __("Slide Speed", "js_composer"),
                    "param_name" => "cl_speed",
                    'value' => '300',
                    'edit_field_class'    => 'vc_col-xs-4 vc_column c_slides',
                    "description" => __("select the speed that slide will be changed.", "js_composer")
                ),array(
                    "type" => "checkbox",
                    "heading" => __("Fade ?", "js_composer"),
                    "param_name" => "cl_fade",
                    'edit_field_class'    => 'vc_col-xs-3 vc_column c_slides',
                    'value' => array(
                        __( 'yes', 'js_composer' ) => '1',
                    )
                ),array(
                    "type" => "checkbox",
                    "heading" => __("Auto Play ?", "js_composer"),
                    "param_name" => "cl_auto",
                    'edit_field_class'    => 'vc_col-xs-3 vc_column c_slides',
                    'value' => array(
                        __( 'yes', 'js_composer' ) => '1',
                    )
                ),array(
                    "type" => "checkbox",
                    "heading" => __("Hide Arrows ?", "js_composer"),
                    "param_name" => "cl_arrows",
                    'edit_field_class'    => 'vc_col-xs-3 vc_column c_slides',
                    'value' => array(
                        __( 'yes', 'js_composer' ) => '1',
                    )
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __("Hide Bullets ?", "js_composer"),
                    "param_name" => "cl_dots",
                    'edit_field_class'    => 'vc_col-xs-3 vc_column c_slides',
                    'value' => array(
                        __( 'yes', 'js_composer' ) => '1',
                    )
                ),
                array(
                    "type" => "checkbox",
                    "heading" => __("Infinite ?", "js_composer"),
                    "param_name" => "cl_infinite",
                    'edit_field_class'    => 'vc_col-xs-3 vc_column c_slides',
                    'value' => array(
                        __( 'yes', 'js_composer' ) => '1',
                    )
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "el_class",
                    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
                )
            ),
            "js_view" => 'VcColumnView'
        ) ); 
             
        /* IT Clients Shortcode
        ----------------------------------------------------------- */
        vc_map( array(
              "name" => __("Client", 'js_composer'),
              "base" => "it_client",
              'category' => __( 'Custom Shortcodes', 'js_composer' ),
              'icon' => 'no-bg fa fa-user',
              "class" => "",
              "content_element" => true,
              "show_settings_on_create" => true,
              "as_child" => array('only' => 'it_clients'),
              "params" => array(
                 array(
                    "type" => "attach_image",
                    "heading" => __("Image",'itrays'),
                    "param_name" => "image",
                    "value" => '',
                 ),array(
                    "type" => "textfield",
                    "heading" => __("Link",'itrays'),
                    "param_name" => "client_link"
                 ),array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "el_class",
                    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
                )
              )
           ) );      

        /* IT Team Members Shortcode
        ----------------------------------------------------------- */
        vc_map( array(
              "name" => __("Team Member", 'js_composer'),
              "base" => "it_member", 
              'category' => __( 'Custom Shortcodes', 'js_composer' ),
              'description' => __( 'adds team member with details', 'js_composer' ),
              'icon' => 'no-bg fa fa-user',
              "class" => "",
              "content_element" => true,
              "params" => array(
                 array(
                    "type" => "attach_image",
                    "heading" => __("Image",'itrays'),
                    "param_name" => "image",
                    'edit_field_class' => 'vc_col-xs-6 vc_column',
                    "value" => '',
                 ),array(
                    "type" => "dropdown",
                    "heading" => __("Box Style",'itrays'),
                    "param_name" => "member_style",
                    'edit_field_class' => 'vc_col-xs-6 vc_column',
                    "value" => array(
                        'style 1' =>'1',
                        'style 2' =>'2'
                    )
                 ),array(
                    "type" => "textfield",
                    "heading" => __("Name",'itrays'),
                    "param_name" => "member_name"
                 ),array(
                    "type" => "textfield",
                    "heading" => __("Position",'itrays'),
                    "param_name" => "member_position"
                 ),array(
                    "type" => "textarea",
                    "heading" => __("Details",'itrays'),
                    "param_name" => "member_details"
                 ),array(
                    "type" => "textfield",
                    "heading" => __("Facebook",'itrays'),
                    "param_name" => "member_fb",
                    "group"     => "Socials"
                 ),array(
                    "type" => "textfield",
                    "heading" => __("Twitter",'itrays'),
                    "param_name" => "member_tw",
                    "group"     => "Socials"
                 ),array(
                    "type" => "textfield",
                    "heading" => __("LinkedIn",'itrays'),
                    "param_name" => "member_ln",
                    "group"     => "Socials"
                 ),array(
                    "type" => "textfield",
                    "heading" => __("Google Plus",'itrays'),
                    "param_name" => "member_go",
                    "group"     => "Socials"
                 ),array(
                    "type" => "textfield",
                    "heading" => __("Skype",'itrays'),
                    "param_name" => "member_sk",
                    "group"     => "Socials"
                 ),array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "el_class",
                    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
                )
              )
           ) ); 

        /* IT Fun Staff Shortcode
        ----------------------------------------------------------- */
        vc_map( array(
              "name" => __("Counter", 'js_composer'),
              "base" => "it_counter",
              'category' => __( 'Custom Shortcodes', 'js_composer' ),
              'description' => __( 'animated numbers changes in counter style with icons', 'js_composer' ),
              'icon' => 'no-bg fa fa-paper-plane-o',
              "params" => array(
                 array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Item Title",'itrays'),
                    "param_name" => "item_title", 
                    "value" => '',
                    "description" => __("type the item title.",'itrays') ,
                    'group' => 'General'
                 ),
                 array(
                    "type" => "colorpicker",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Title Color",'itrays'),
                    "param_name" => "title_color",
                    'edit_field_class' => 'vc_col-xs-6 vc_column',
                    "description" => __("select title color.",'itrays'),
                    'group' => 'General'
                 ),
                  array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Title Font Size",'itrays'),
                    'edit_field_class' => 'vc_col-xs-6 vc_column',
                    "param_name" => "title_size",
                    "description" => __("type title size in px.",'itrays'),
                    'group' => 'General'
                 ),
                 array(
                    'type' => 'textarea',
                    'heading' => __( 'Description', 'js_composer' ),
                    'param_name' => 'text',
                    'admin_label' => true,
                    'group' => 'General'
                ),
                 array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    'edit_field_class' => 'vc_col-xs-6 vc_column',
                    "heading" => __("From",'itrays'),
                    "param_name" => "init_value",
                    "value" => '0',
                    'group' => 'Counter Values'
                 ),
                 array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    'edit_field_class' => 'vc_col-xs-6 vc_column',
                    "heading" => __("To",'itrays'),
                    "value" => '1000',
                    "param_name" => "item_value",
                    'group' => 'Counter Values'
                 ),
                 array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Start After",'itrays'),
                    "param_name" => "item_timer",
                    "value" => '100',
                    "description" => __("time in ms Ex:(1000).",'itrays'),
                    'group' => 'Counter Values'
                 ),
                 array(
                    "type" => "colorpicker",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Numbers Color",'itrays'),
                    "param_name" => "numbers_color",
                    'edit_field_class' => 'vc_col-xs-6 vc_column',
                    "description" => __("select Number color.",'itrays'),
                    'group' => 'Counter Values'
                 ),
                 array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Numbers Font Size",'itrays'),
                    "param_name" => "numbers_size",
                    'edit_field_class' => 'vc_col-xs-6 vc_column',
                    "description" => __("type numbers size in px.",'itrays'),
                    'group' => 'Counter Values'
                 ), 
                 array(
                    "type" => "it_vc_icon",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Item Icon",'itrays'),
                    "param_name" => "item_icon",
                    "description" => __("select the box icon.",'itrays'),
                    'group' => 'Icon'
                 ),
                 array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Icon Size",'itrays'),
                    "param_name" => "icon_size",
                    'edit_field_class' => 'vc_col-xs-6 vc_column',
                    "description" => __("type icon size in px.",'itrays'),
                    'group' => 'Icon'
                 ),
                 array(
                    "type" => "colorpicker",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Icon Color",'itrays'),
                    "param_name" => "icon_color",
                    'edit_field_class' => 'vc_col-xs-6 vc_column',
                    "description" => __("select icon color.",'itrays'),
                    'group' => 'Icon'
                 ),
                 array(
                    'type' => 'checkbox',
                    'heading' => __( 'Clear after icon ?', 'js_composer' ),
                    'param_name' => 'clear',
                    'description' => __( 'If selected, the icon will fit full width.', 'js_composer' ),
                    'value' => array( __( 'Yes', 'js_composer' ) => '1' ),
                    'class' => 'it_checkbox',
                    'group' => 'Icon'
                ),
                 array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "el_class",
                    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer"),
                    'group' => 'General'
                )
              )
           ) );
           
        /* IT Fun Staff Shortcode
        ----------------------------------------------------------- */
        vc_map( array(
              "name" => __("Counter 2", 'js_composer'),
              "base" => "it_counter2",
              'category' => __( 'Custom Shortcodes', 'js_composer' ),
              'description' => __( 'add another numbers counter style', 'js_composer' ),
              'icon' => 'no-bg fa fa-paper-plane-o',
              "params" => array(
                 array(
                    "type" => "textarea",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Text Before",'itrays'),
                    "param_name" => "title_before",  
                    "value" => '',
                    'group' => 'General'
                 ),
                  array(
                    "type" => "textarea",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Text After",'itrays'),
                    "param_name" => "title_after",
                    'group' => 'General'
                 ),
                 array(
                    "type" => "colorpicker",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Text Color",'itrays'),
                    "param_name" => "text_color",
                    'edit_field_class' => 'vc_col-xs-6 vc_column',
                    "description" => __("select text color.",'itrays'),
                    'group' => 'General'
                 ),
                  array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Text Font Size",'itrays'),
                    "param_name" => "text_size",
                    'edit_field_class' => 'vc_col-xs-6 vc_column',
                    "description" => __("type text size in px.",'itrays'),
                    'group' => 'General'
                 ),
                 array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("From",'itrays'),
                    "param_name" => "init_value",
                    "value" => '0',
                    'edit_field_class' => 'vc_col-xs-6 vc_column',
                    'group' => 'Counter Values'
                 ),
                 array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("To",'itrays'),
                    "value" => '100',
                    'edit_field_class' => 'vc_col-xs-6 vc_column',
                    "param_name" => "item_value",
                    'group' => 'Counter Values'
                 ),
                 array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Start After",'itrays'),
                    "param_name" => "item_timer",
                    "value" => '1000',
                    "description" => __("time in ms Ex:(1000).",'itrays'),
                    'group' => 'Counter Values'
                 ),
                 array(
                    "type" => "colorpicker",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Numbers Color",'itrays'),
                    "param_name" => "numbers_color",
                    'edit_field_class' => 'vc_col-xs-6 vc_column',
                    "description" => __("select Number color.",'itrays'),
                    'group' => 'Counter Values'
                 ),
                 array(
                    "type" => "textfield",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Numbers Font Size",'itrays'),
                    "param_name" => "numbers_size",
                    'edit_field_class' => 'vc_col-xs-6 vc_column',
                    "description" => __("type numbers size in px.",'itrays'),
                    'group' => 'Counter Values'
                 ),
                 array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "el_class",
                    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer"),
                    'group' => 'General'
                )
              )
           ) );   
           
        /* IT Separators
        ----------------------------------------------------------- */
        vc_map( array(
            "name" => __("Dividers", "js_composer"),
            "base" => "it_divider",
            'category' => __( 'Custom Shortcodes', 'js_composer' ),
            'description' => __( 'adds block separators with many styles', 'js_composer' ),
            'icon' => 'no-bg fa fa-arrows-h',
            "show_settings_on_create" => true,
            "params" => array(
                array(
                    "type" => "dropdown",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Divider Style",'itrays'),
                    "param_name" => "divider_class",
                    "value" => array(
                        'Centered Bicycles' =>'1',
                        'Full Width Centerd Icon' =>'2',
                        'Left Right Icons' =>'3',
                        'Left Icon' =>'4',
                        'Right Icon' =>'5',
                        '50% Width Centerd Icon' =>'6',
                        'Left Right Lines' =>'7',
                        'Centered Line' =>'8',
                        'Centered Lines' =>'9',
                        'Back To Top' =>'10'                
                    ),
                    "description" => __("Select Divider style.",'itrays')
                 ),
                 /*array(
                    "type" => "it_vc_icon",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Divider Icon",'itrays'),
                    "param_name" => "divider_icon",
                    "description" => __("select the divider icon.",'itrays'),
                 ), */
                 $it_animation,
                 $it_animation_delay,
                 $it_animation_duration,
                 array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "el_class",
                    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
                )
            )
        ) );

        // add parameter settings.
        $rowAtts = array(
                array(
                    'type' => 'checkbox',
                    'heading' => __( 'Full Width Row', 'js_composer' ),
                    'param_name' => 'fluid',
                    'description' => __( 'If selected, the row will be full width.', 'js_composer' ),
                    'value' => array( __( 'Yes', 'js_composer' ) => '1' ),
                    'class' => 'it_checkbox',
                    'edit_field_class' => 'vc_col-md-6 vc_column',
                ),array(
                    'type' => 'checkbox',
                    'heading' => __( 'Stretch Content', 'js_composer' ),
                    'param_name' => 'full_content',
                    'description' => __( 'If selected, the row content will be stretched.', 'js_composer' ),
                    'value' => array( __( 'Yes', 'js_composer' ) => '1' ),
                    'class' => 'it_checkbox',
                    'edit_field_class' => 'vc_col-md-6 vc_column',
                ),array(
                    'type' => 'checkbox',
                    'heading' => __( 'Parallax Background?', 'js_composer' ),
                    'param_name' => 'parallax_check',
                    'group' => 'Design options',
                    'edit_field_class' => 'vc_col-md-6 vc_column',
                    'value' => array( __( 'Yes', 'js_composer' ) => '1' ),
                    'class' => 'it_checkbox'
                ),array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Background Color', 'js_composer' ),
                    'param_name' => 'section_bg_color',
                    'group' => 'Design options',
                    'description' => __( '', 'js_composer' ),
              ),array(
                    'type' => 'it_up_img',
                    'heading' => __( 'Background Image', 'js_composer' ),
                    'param_name' => 'it_bg_img',
                    'group' => 'Design options',
                    'description' => __( '', 'js_composer' )
              ),array(
                    'type' => 'dropdown',
                    'heading' => __( 'Background Repeat', 'js_composer' ),
                    'param_name' => 'bg_image_repeat',
                    'edit_field_class' => 'vc_col-md-4 vc_column',
                    'group' => 'Design options',
                    'value' => array(
                              __( 'Repeat', 'js_composer' ) => '',
                              __( 'Repeat Horizontally', 'js_composer' ) => 'repeat-x',
                              __('Repeat Vertically', 'js_composer') => 'repeat-y',
                              __('No Repeat', 'js_composer') => 'no-repeat'
                              ),
                    'description' => __( '', 'js_composer' ),
                    'dependency' => array( 'element' => 'it_bg_img', 'not_empty' => true)
              )/*,array(
                    'type' => 'dropdown',
                    'heading' => __( 'Background Position', 'js_composer' ),
                    'param_name' => 'bg_image_position',
                    'edit_field_class' => 'vc_col-md-4 vc_column',
                    'group' => 'Design options',
                    'value' => array(
                              __( 'Left Top', 'js_composer' ) => '',
                              __( 'Left Center', 'js_composer' ) => '0% 50%',
                              __( 'Left Bottom', 'js_composer') => '0% 100%',
                              __( 'Right Top', 'js_composer') => '100% 0%',
                              __( 'Right Center', 'js_composer' ) => '100% 50%',
                              __( 'Right Bottom', 'js_composer' ) => '100% 100%',
                              __( 'Center Top', 'js_composer') => '50% 0%',
                              __( 'Center Center', 'js_composer') => '50% 50%',
                              __( 'Center Bottom', 'js_composer' ) => '50% 100%'
                              ),
                    'description' => __( '', 'js_composer' ),
                    'dependency' => array( 'element' => 'it_bg_img', 'not_empty' => true)
              )*/,array(
                    'type' => 'dropdown',
                    'heading' => __( 'Background Attachment', 'js_composer' ),
                    'param_name' => 'bg_image_attachment',
                    'edit_field_class' => 'vc_col-md-4 vc_column',
                    'group' => 'Design options',
                    'value' => array(
                              __( 'Scroll', 'js_composer' ) => '',
                              __( 'Fixed', 'js_composer' ) => 'fixed',
                              ),
                    'description' => __( '', 'js_composer' ),
                    'dependency' => array( 'element' => 'it_bg_img', 'not_empty' => true)
              ),array(
                    'type' => 'checkbox',
                    'heading' => __( '100% Full Background image ?', 'js_composer' ),
                    'param_name' => 'bg_cover',
                    'group' => 'Design options',
                    'edit_field_class' => 'vc_col-md-6 vc_column',
                    'description' => __( 'If selected, the background image will be 100% full.', 'js_composer' ),
                    'value' => array( __( 'Yes', 'js_composer' ) => '1' ),
                    'class' => 'it_checkbox'
                ),array(
                    'type' => 'checkbox',
                    'heading' => __( 'Overlay ?', 'js_composer' ),
                    'param_name' => 'bg_overlay',
                    'group' => 'Design options',
                    'description' => __( 'If selected, there will be an overlay layer over the background image.', 'js_composer' ),
                    'value' => array( __( 'Yes', 'js_composer' ) => '1' ),
                    'class' => 'it_checkbox'
                ),array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Overlay Color', 'js_composer' ),
                    'param_name' => 'overlay_color',
                    'group' => 'Design options',
                    'description' => __( '', 'js_composer' ),
                ),array(
                    'type' => 'textfield',
                    'heading' => __( 'Overlay Opacity', 'js_composer' ),
                    'param_name' => 'overlay_opacity',
                    'group' => 'Design options',
                    'description' => __( 'this will set the transparency of the overlay, value should be between 0 and 1.', 'js_composer' ),
                    'value' => '0.5'
                ),array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Font Color', 'js_composer' ),
                    'param_name' => 'font_color',
                    'group' => 'Design options',
                    'description' => __( '', 'js_composer' ),
                ),array(
                    'type' => 'dropdown',
                    'heading' => __( 'Padding', 'js_composer' ),
                    'param_name' => 'row_padd',
                    'edit_field_class' => 'vc_col-md-12 vc_column',
                    'description' => __( '', 'js_composer' ),
                    'value' => array(
                        __( 'Normal Padding', 'js_composer' ) => 'md-padding',
                        __( 'Exrta Small Padding', 'js_composer' ) => 'xs-padding',
                        __( 'Small Padding', 'js_composer' ) => 'sm-padding',
                        __( 'Large Padding', 'js_composer' ) => 'lg-padding',
                        __( 'Exrta Large Padding', 'js_composer' ) => "xl-padding",
                        __( 'No Padding', 'js_composer' ) => 'no-padding',
                    )
              ),array(
                    'type' => 'textfield',
                    'heading' => __( 'ID', 'js_composer' ),
                    'param_name' => 'extra_id',
                    'description' => __( '', 'js_composer' ),
              ),array(
                    'type' => 'it_video_bg',
                    'heading' => __( 'video/mp4', 'js_composer' ),
                    'param_name' => 'video_mp4',
                    'group' => 'Video Background',
                    'description' => __( '', 'js_composer' )
              ),array(
                    'type' => 'it_video_bg',
                    'heading' => __( 'video/webm', 'js_composer' ),
                    'param_name' => 'video_webm',
                    'group' => 'Video Background',
                    'description' => __( '', 'js_composer' )
              ),array(
                    'type' => 'it_video_bg',
                    'heading' => __( 'video/ogv', 'js_composer' ),
                    'param_name' => 'video_ogv',
                    'group' => 'Video Background',
                    'description' => __( '', 'js_composer' )
              ),array(
                    "type" => "textfield",
                    "heading" => __("Extra class name", "js_composer"),
                    "param_name" => "el_class",
                    "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
                ),
                array(
                    'type' => 'checkbox',
                    'heading' => __( 'Use video background?', 'js_composer' ),
                    'param_name' => 'video_bg',
                    'group' => 'Video Background',
                    'description' => __( 'If checked, video will be used as row background.', 'js_composer' ),
                    'value' => array( __( 'Yes', 'js_composer' ) => 'yes' )
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'YouTube link', 'js_composer' ),
                    'param_name' => 'video_bg_url',
                    'group' => 'Video Background',
                    'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k', // default video url
                    'description' => __( 'Add YouTube link.', 'js_composer' ),
                    'dependency' => array(
                        'element' => 'video_bg',
                        'not_empty' => true,
                    ),
                )
            );

        $tabsAtts = array(
                    'type' => 'dropdown',
                    'heading' => __( 'tab style', 'js_composer' ),
                    'param_name' => 'tab_style',
                    'value' => array(
                        'Default' => '',
                        'Skew' => 'skew'
                    ),
                    'std' => 0,
                    'description' => __( 'Auto rotate tabs each X seconds.', 'js_composer' )
                );
        $tourAtts = array(
                    'type' => 'dropdown',
                    'heading' => __( 'tab style', 'js_composer' ),
                    'param_name' => 'tab_style',
                    'value' => array(
                        'Default' => '',
                        'Skew' => 'skew'
                    ),
                    'std' => 0,
                    'description' => __( 'Auto rotate tabs each X seconds.', 'js_composer' )
                );  
        $accAtts = array(
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Accordion style', 'js_composer' ),
                    'param_name' => 'acc_style',
                    'value' => array(
                        'Default' => '',
                        'Skew' => 'skew'
                    ),
                )
        ); 
        $acctabAtts = array(
                    "type" => "it_vc_icon",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Icon",'itrays'),
                    "param_name" => "the_icon",
                    "description" => __("select the tab icon.",'itrays'),
                 );

        $anim = array(
           $it_animation,
           $it_animation_delay,
           $it_animation_duration 
        ); 

        $btnAtts = array(
                array(
                   'type' => 'dropdown',
                    'heading' => __( 'Size', 'js_composer' ),
                    'param_name' => 'size',
                    'value' => array(
                        'Mini' => 'xs',
                        'Small' => 'sm',
                        'Normal' => 'md',
                        'Large' => 'lg',
                        'X-Large' => 'xl'
                    ) 
                ),
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Color', 'js_composer' ),
                    'param_name' => 'color',
                    'value' => array(
                        'Default' => 'default',
                        'Main Color' => 'main-bg',
                        'Blue' => 'blue', // Why __( 'Blue', 'js_composer' ) doesn't work?
                        'Turquoise' => 'turquoise',
                        'Pink' => 'pink',
                        'Violet' => 'violet',
                        'Peacoc' => 'peacoc',
                        'Chino' => 'chino',
                        'Mulled Wine' => 'mulled_wine',
                        'Vista Blue' => 'vista_blue',
                        'Black' => 'black',
                        'Grey' => 'grey',
                        'Orange' => 'orange',
                        'Sky' => 'sky',
                        'Green' => 'green',
                        'Juicy pink' => 'juicy_pink',
                        'Sandy brown' => 'sandy_brown',
                        'Purple' => 'purple',
                        'White' => 'white',
                        'Custom Colors' => 'custom'
                    ),
                    'description' => __( 'Button color.', 'js_composer' ),
                    'edit_field_class' => 'vc_col-md-12 col-class',
                ),array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Background color', 'js_composer' ),
                    'param_name' => 'btn_bg_color',
                    'value' => '',
                    'description' => __( '', 'js_composer' ),
                    'edit_field_class' => 'vc_col-md-6 vc_column them-color',
                ),array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Border color', 'js_composer' ),
                    'param_name' => 'btn_border_color',
                    'value' => '',
                    'description' => __( '', 'js_composer' ),
                    'edit_field_class' => 'vc_col-md-6 vc_column them-color',
                ),array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Text color', 'js_composer' ),
                    'param_name' => 'btn_color',
                    'value' => '',
                    'description' => __( '', 'js_composer' ),
                    'edit_field_class' => 'vc_col-md-6 vc_column them-color',
                ),array(
                    "type" => "it_vc_icon",
                    "holder" => "div",
                    "class" => "",
                    "heading" => __("Icon",'itrays'),
                    "param_name" => "button_icon",
                    "description" => __("select the Button icon.",'itrays'),
                 ),array(
                      'type' => 'dropdown',
                    'heading' => __( 'Button style', 'js_composer' ),
                    'param_name' => 'style',
                    'value' => array(
                        'Rounded' => 'rounded',
                        'Square' => 'square',
                        'Round' => 'round',
                        'Outlined' => 'outlined',
                        'Skewed without Animation' => 'skew',
                        '3D' => '3d',
                        'Square Outlined' => 'square_outlined'
                    ),
                    'description' => __( 'Auto rotate tabs each X seconds.', 'js_composer' )
                    ),
                    $it_animation,
                    $it_animation_delay,
                    $it_animation_duration,
                    array(
                        'type' => 'textfield',
                        'heading' => __( 'Extra class name', 'js_composer' ),
                        'param_name' => 'el_class',
                        'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
                    )
                    
        );

        $progressAtts = array(
                array(
                    'type' => 'dropdown',
                    'heading' => __( 'Bar color', 'js_composer' ),
                    'param_name' => 'bgcolor',
                    'value' => array(
                        __( 'Grey', 'js_composer' ) => 'bar_grey',
                        __( 'Blue', 'js_composer' ) => 'bar_blue',
                        __( 'Turquoise', 'js_composer' ) => 'bar_turquoise',
                        __( 'Green', 'js_composer' ) => 'bar_green',
                        __( 'Orange', 'js_composer' ) => 'bar_orange',
                        __( 'Red', 'js_composer' ) => 'bar_red',
                        __( 'Black', 'js_composer' ) => 'bar_black',
                        __( 'Theme Color', 'js_composer' ) => 'main-bg-import',
                        __( 'Custom Color', 'js_composer' ) => 'custom'
                    ),
                    'description' => __( 'Select bar background color.', 'js_composer' ),
                    'admin_label' => true
                ),
                array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Bar custom color', 'js_composer' ),
                    'param_name' => 'custombgcolor',
                    'description' => __( 'Select custom background color for bars.', 'js_composer' ),
                    'dependency' => array( 'element' => 'bgcolor', 'value' => array( 'custom' ) )
                ),array(
                    'type' => 'dropdown',
                    'heading' => __( 'Style', 'js_composer' ),
                    'param_name' => 'barsstyle',
                    'value' => array(
                        __( 'Default Style', 'js_composer' ) => '',
                        __( 'Style 2', 'js_composer' ) => 'bar-style-2',
                        __( 'Style 3', 'js_composer' ) => 'bar-style-3',
                        __( 'Style 4', 'js_composer' ) => 'bar-style-4',
                        __( 'Style 5', 'js_composer' ) => 'bar-style-5',
                        __( 'Style 6', 'js_composer' ) => 'bar-style-6',
                    ),
                    'description' => __( 'Select bar background color.', 'js_composer' ),
                    'admin_label' => true
                ),
                array(
                    'type' => 'textfield',
                    'heading' => __( 'Extra class name', 'js_composer' ),
                    'param_name' => 'el_class',
                    'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'js_composer' )
                )
        );

        $it_colors = array(
                array(
                    'type' => 'colorpicker',
                    'heading' => __( 'Custom color', 'js_composer' ),
                    'param_name' => 'it_color',
                    'description' => __( 'Select custom color.', 'js_composer' ),
                ), 
        );

        //add params to elements.    
        vc_add_params( "vc_message", $anim );
        vc_add_params( "vc_column_text", $it_colors );
        vc_add_params( "vc_column_text", $anim );
        vc_add_params( "vc_toggle", $anim );
        vc_add_params( "vc_single_image", $anim );
        vc_add_params( "vc_column", $anim );
        vc_add_params( "vc_cta_button2", $anim );
        vc_add_params( "vc_btn", $anim );
        vc_add_params( "vc_column_inner", $anim );
        vc_add_params( 'vc_row', $rowAtts );
        vc_add_params( 'vc_accordion', $accAtts );
        vc_add_params( 'vc_button2', $btnAtts );
        vc_add_params( 'vc_btn', $btnAtts );
        vc_add_params( 'vc_progress_bar', $progressAtts );
        vc_add_param( 'vc_tabs', $tabsAtts );
        vc_add_param( 'vc_tab', $acctabAtts );
        vc_add_param( 'vc_tour', $tourAtts );
        vc_add_param( 'vc_accordion_tab', $acctabAtts );

    }
    
    function inputs_js(){    
        echo '<script type="text/javascript" src="'.plugins_url( 'assets/js/edit.js', __FILE__ ).'"></script>';        
    }
    
    public function integrateWithVC() {
        if ( ! defined( 'WPB_VC_VERSION' ) ) {
            add_action('admin_notices', array( $this, 'showVcVersionNotice' ));
            return;
        }
        foreach ( glob( plugin_dir_path( __FILE__ ) . "shortcodes/vc_*.php" ) as $file ) {
            include_once $file;
        }
        
        global $vc_manager;
        $vc_manager->setIsAsTheme();
        $vc_manager->disableUpdater();
        //$vc_manager->frontendEditor()->disableInline();
        
        include_once( TI_PLUGIN_DIR . '/inc/extends.php' ); 
        add_action('admin_print_styles', 'it_scripts_styles');
        
        if ( ! function_exists( 'it_scripts_styles' ) ) {
            function it_scripts_styles(){
            wp_enqueue_style( 'superfine-css', plugins_url( '/assets/css/edit.css', __FILE__ ) );
        }
        }
        if ( ! function_exists( 'it_vc_icon' ) ) {
            function it_vc_icon( $settings, $value ) {
          $output = '<div>';
          $output  .= '<i class="cust-icon ico '.$value.'"></i><a class="button button-primary btn_icon" href="#">Add Icon</a><input type="hidden" name="'.$settings['param_name'].'" class="wpb_vc_param_value it_vc_icon icon-value icon_cust '. $settings['param_name'] .' '. $settings['type'] .'" value="'. $value .'" /><a class="button icon-remove">Remove Icon</a>';
          $output   .= '</div>';
          return $output;
        }
        }
        add_shortcode_param('it_vc_icon', 'it_vc_icon');
        add_action( 'wp-head', 'inputs_js' );
        
        // upload image parameter
        if ( ! function_exists( 'it_upload_img' ) ) {
            function it_upload_img( $settings, $value ) {
          return '<input class="regular-text wpb_vc_param_value wpb-textinput ' .
                     esc_attr( $settings['param_name'] ) . ' ' .
                     esc_attr( $settings['type'] ) . '_field" name="' . esc_attr( $settings['param_name'] ) . '" type="text" value="' . esc_attr( $value ) . '" /><input class="upload_image_button" type="button" value="Upload Image" /><div class="no-margin clear-img"><img class="logo-im" alt="" src="'. esc_attr( $value ) .'" /> <a class="remove-img" href="#">remove</a></div>';
        }
        }
        add_shortcode_param('it_up_img', 'it_upload_img');

        // section video background parameter
        if ( ! function_exists( 'it_upload_video_bg' ) ) {
            function it_upload_video_bg( $settings, $value ) {
          return '<input class="regular-text wpb_vc_param_value wpb-textinput ' .
                     esc_attr( $settings['param_name'] ) . ' ' .
                     esc_attr( $settings['type'] ) . '_field" name="' . esc_attr( $settings['param_name'] ) . '" type="text" value="' . esc_attr( $value ) . '" /><input class="upload_video_button" type="button" value="Browse" />';
        }
        }
        add_shortcode_param('it_video_bg', 'it_upload_video_bg');
        if ( ! function_exists( 'it_dropdown_cats' ) ) {
            function it_dropdown_cats( ) {
          
            $categories_obj = get_categories('hide_empty=0');
            $categories = array();
            foreach ($categories_obj as $pn_cat){
                $categories[$pn_cat->cat_name] = $pn_cat->category_nicename;
            }  
            $categories=array("All Categories"=>"") + $categories;
            return $categories;
            
        }
        }
        if ( ! function_exists( 'colorCreator' ) ) {
            function colorCreator($colour, $per) {  
        $colour = substr( $colour, 1 ); // Removes first character of hex string (#) 
        $rgb = ''; // Empty variable 
        $per = $per/100*255; // Creates a percentage to work with. Change the middle figure to control colour temperature
         
        if  ($per < 0 ) // Check to see if the percentage is a negative number 
        { 
            // DARKER 
            $per =  abs($per); // Turns Neg Number to Pos Number 
            for ($x=0;$x<3;$x++) 
            { 
                $c = hexdec(substr($colour,(2*$x),2)) - $per; 
                $c = ($c < 0) ? 0 : dechex($c); 
                $rgb .= (strlen($c) < 2) ? '0'.$c : $c; 
            }   
        }  
        else 
        { 
            // LIGHTER         
            for ($x=0;$x<3;$x++) 
            {             
                $c = hexdec(substr($colour,(2*$x),2)) + $per; 
                $c = ($c > 255) ? 'ff' : dechex($c); 
                $rgb .= (strlen($c) < 2) ? '0'.$c : $c; 
            }    
        } 
        return '#'.$rgb; 
    } 
        }
    }
    
}

new VCExtendAddonCustomShortCodes();

