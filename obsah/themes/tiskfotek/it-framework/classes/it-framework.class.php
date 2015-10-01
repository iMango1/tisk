<?php
/**
 * Master theme class
 * 
 * @package IT-RAYS
 * @since 1.0
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
} 

class ITFramework {
    
    public $sections;
    public $checkboxes;
    public $settings;
    
    public function __construct() {
        
        $this->checkboxes = array();
        $this->settings = array();
        $this->get_option();
        $this->sections['it_general']              = '<i class="fa fa-gears"></i>General Settings';
        $this->sections['it_topbar']               = '<i class="fa fa-bars"></i>Top Bar Settings';
        $this->sections['it_header']               = '<i class="fa fa-leaf"></i>Header Settings';
        $this->sections['it_footer']               = '<i class="fa fa-sliders"></i>Footer Settings';
        $this->sections['it_appearance']           = '<i class="fa fa-tachometer"></i>Appearance';
        $this->sections['it_pagetitles']           = '<i class="fa fa-cog"></i>Page Titles';
        $this->sections['it_colors']               = '<i class="fa fa-paint-brush"></i>Colors';
        $this->sections['it_typography']           = '<i class="fa fa-edit"></i>Typography';
        $this->sections['it_blogoptions']          = '<i class="fa fa-book"></i>Blog options';
        $this->sections['it_sidebars']             = '<i class="fa fa-tags"></i>Sidebars';
        $this->sections['it_socialicons']          = '<i class="fa fa-share-alt"></i>Social icons';
        $this->sections['it_woocommerce']          = '<i class="fa fa-shopping-cart"></i>WooCommerce';
        $this->sections['it_bbpress']              = '<i class="fa fa-comments"></i>BBPress (Forums)';
        $this->sections['it_buddypress']           = '<i class="fa fa-group"></i>BuddyPress';
        $this->sections['it_downloads']            = '<i class="fa fa-download"></i>Downloads';
        $this->sections['it_contact']              = '<i class="fa fa-phone-square"></i>Contact';
        $this->sections['it_soon']                 = '<i class="fa fa-sign-in"></i>Coming Soon Settings';
        //$this->sections['it_options']                 = '<i class="fa fa-cogs"></i>Import/ Export Options';
        
        add_action( 'admin_menu', array( &$this, 'add_pages' ) );
        
        add_action( 'admin_init', array( &$this, 'register_settings' ) );
                
        register_setting( 'theme_options', 'theme_options', array ( &$this, 'validate_settings' ) );
                
        if ( ! get_option( 'theme_options' ) ) $this->initialize_settings();       
        
    }
    
    public function add_pages() {
        
        $admin_page = add_theme_page('Theme settings', 'EXCEPTION', 'manage_options', 'theme-options', array( &$this, 'display_page' ) );
        
        add_action( 'admin_print_scripts-' . $admin_page, array( &$this, 'scripts' ) );
        
        add_action( 'admin_print_styles-' . $admin_page, array( &$this, 'styles' ) );
    }

    public function create_setting( $args = array() ) {
        
        $defaults = array(
            'id'                    => 'default_field',
            'title'                 => __( 'Default Field','itrays' ),
            'desc'                  => __( 'This is a default description.','itrays' ),
            'std'                   => '',
            'type'                  => 'text',
            'src'                   => '',
            'link'                  => '',
            'group'                 => '',
            'section'               => 'it_general',
            'choices'               => array(),
            'class'                 => '',
            'defcolor'              => '',
            'items'                 => array(),
            'sidebar'               => array(),
            'slides'                => array()
        );
            
        extract( wp_parse_args( $args, $defaults ) );
        
        $field_args = array(
            'type'                  => $type,
            'id'                    => $id,
            'desc'                  => $desc,
            'std'                   => $std,
            'src'                   => $src,
            'link'                  => $link,
            'group'                 => $group,
            'choices'               => $choices,
            'items'                 => $items,
            'sidebar'               => $sidebar,
            'label_for'             => $id,
            'class'                 => $class,
            'defcolor'              => $defcolor,
            'slides'                => $slides
        );
        
        if ( $type == 'checkbox' )
            $this->checkboxes[] = $id;
        
        add_settings_field( $id, $title, array( $this, 'display_setting' ), 'theme-options', $section, $field_args );
        
    }
    
    public function initialize_settings() {
        $default_settings = array();
        
        foreach ( $this->settings as $id => $setting ) {
            if ( $setting['type'] != 'heading' )
                $default_settings[$id] = $setting['std'];
        }
        
        update_option( 'theme_options', $default_settings );        
        
        add_action( 'optionsframework_after_validate', array( $this, 'save_options_notice' ) );
    }
    
    public function register_settings() {
        
        foreach ( $this->sections as $slug => $title ) {
                add_settings_section( $slug, $title, array( &$this, 'display_section' ), 'theme-options' );
        }
        
        $this->get_option();
        
        foreach ( $this->settings as $id => $setting ) {
            $setting['id'] = $id;
            $this->create_setting( $setting );
        }
    }
    
    public function display_page() {
        
        echo '<div class="theme-options">';
        echo '<span class="hidden spconfirm">'.__("Click OK to reset. Any theme settings will be lost!","itrays").'</span>';
        echo '<span class="hidden themeURI">'.THEME_URI.'</span>';
        echo '<div class="wrap form-wrapper theme_opts_form">';
                echo '<span class="hidden adm">'.esc_attr(admin_url()).'</span>';
                if ( isset( $_GET['settings-updated'] ) && $_GET['settings-updated'] == true ){
                    echo '<div class="updated fade"><p>' . __( 'Theme options updated.','itrays' ) . '</p></div>';
                    settings_errors( 'theme_options' );
                }
                
                echo '<form action="options.php" method="post" class="top-reset"><input type="submit" class="reset-button no-rad button-secondary btn-reset-theme" name="reset" value="' . __( 'Restore Defaults','itrays' ) . '" />';
                settings_fields( 'theme_options' );
                echo '</form>';
                
                echo '<form action="options.php" method="post" class="main-options-form">';
                settings_fields( 'theme_options' );
                echo '<h1 class="block-head">' . __( '<b>EXCEPTION</b> - Theme options','itrays' ) . '<p class="submit"><input name="Submit" type="submit" class="button btnb button-primary sub-btn" value="' . __( 'Save Changes','itrays' ) . '" /></p></h1>';
                echo '<div class="ui-tabs"><ul class="ui-tabs-nav">';
                        foreach ( $this->sections as $section_slug => $section )
                            echo '<li><a href="#' . $section_slug . '">' . $section . '</a></li>';
                        echo '</ul><div class="tabs_wrap">';
                $this->it_settings_sections( $_GET['page'] );
                echo '</div></div></div>';
                echo '<h2 class="block-head bot-foot"><span class="copyrights">IT-RAYS Framework. v 1.4.2 - All Rights reserved.</span><p class="submit"><input name="Submit" type="submit" class="button btnb no-rad mar-rit button-primary" value="' . __( 'Save Changes','itrays' ) . '" /></p></h2>';
                echo '</form>';
                
                echo '<form action="options.php" method="post" class="abs-reset"><input type="submit" class="reset-button no-rad button-secondary btn-reset-theme" name="reset" value="' . __( 'Restore Defaults','itrays' ) . '" />';
                settings_fields( 'theme_options' );
                echo '</form>';
                
                echo '</div>';
            
            echo '<script type="text/javascript">
                jQuery(document).ready(function($) {
                    var sections = [];';
                    foreach ( $this->sections as $section_slug => $section )
                        echo "sections['$section'] = '$section_slug';";
                    
                    echo 'var wrapped = $(".wrap h3").wrap("<div class=\"ui-tabs-panel\">");
                    wrapped.each(function() {
                        $(this).parent().append($(this).parent().nextUntil("div.ui-tabs-panel"));
                    });
                    $(".ui-tabs-panel").each(function(index) {
                        $(this).attr("id", sections[$(this).children("h3").html()]);
                        if (index > 0)
                            $(this).addClass("ui-tabs-hide");
                    });
                    $(".ui-tabs").tabs({
                        fx: { opacity: "toggle", duration: "fast" }
                    });
                    $(".ui-tabs").append("<div class=lft-bg></div>");
                    $(".wrap h3, .wrap table").show();
                });
            </script>
        </div>';
        
    }
    
    public function display_section() {
        
    }
    
    public function display_setting( $args = array() ) {
        
        extract( $args );
        $options = get_option( 'theme_options' );
        $arri = array();
        if ( ! isset( $options[$id] ) && $type != 'checkbox' )
            $options[$id] = $std;
        elseif ( ! isset( $options[$id] ) )
            $options[$id] = 0;
        
        $field_class = '';
        if ( $class != '' )
            $field_class = ' ' . $class;
        
        switch ( $type ) {
            
            case 'heading':
                echo '<div class="sec-heading' . $field_class . '"><h4>' . $desc . '</h4></div>';
                break;
            
            case 'checkbox':
                echo '<input class="it_checkbox' . $field_class . '" type="checkbox" id="' . $id . '" name="theme_options[' . $id . ']" value="'. esc_attr($options[$id]) .'" ' . checked( $options[$id], 1, false ) . ' />';
                break;
            
            case 'select':
                echo '<select class="select' . $field_class . '" name="theme_options[' . $id . ']">';
                
                foreach ( $choices as $value => $label )
                    echo '<option value="' . esc_attr( $value ) . '"' . selected( $options[$id], $value, false ) . '>' . $label . '</option>';
                
                echo '</select>';
                
                break;
            
            case 'radio':
                $i = 0;
                echo '<div class="rit-inputs">';
                foreach ( $choices as $value => $label ) {
                echo '<div class="radio-select"><img class="head-img" src="'.FRAMEWORK_ASSETS_URI . '/images/" ><input class="radio' . $field_class . '" type="radio" name="theme_options[' . $id . ']" id="' . $id . $i . '" value="' . esc_attr( $value ) . '" ' . checked( $options[$id], $value, false ) . '> <label for="' . $id . $i . '">' . $label . '</label></div>';
                    if ( $i < count( $options ) - 1 )
                    $i++;
                }
                echo '</div>';
                break;
            
            case 'textarea':
                 if ( class_exists( 'SitePress' ) && isset($this->settings[$id]['multilang']) ) {
                     $languages2  = icl_get_languages();
                     $current2    = ICL_LANGUAGE_CODE;
                     $lang2       = ICL_LANGUAGE_NAME;
                     foreach ( $languages2 as $key2 => $value2 ) {
                        $class2      = ( $key2 == $current2 ) ? '' : 'hidden';
                        $value_key2  = ( ! empty( $options[$key2] ) ) ? $options[$key2] : '';
                        $value2 = $id.'-'.$key2;
                        if ( ! isset( $options[$value2] ) && $type != 'checkbox' )
                        $options[$value2] = $std;
                        echo '<textarea class="regular-text' . $field_class . ' '. $class2 . '" placeholder="' . $std . '" name="'. ('theme_options['. $id.'-'.$key2 .']') .'" rows="5" cols="30">' . wp_htmledit_pre( $options[$value2] ) . '</textarea>';
                     }
                     echo '<div class="langg">'.__('You Are Editing in ( <strong>'.$lang2.'</strong> ) Language.','itrays').'</div>';
                 } else {
                    echo '<textarea class="regular-text' . $field_class . '" id="' . $id . '" name="theme_options[' . $id . ']" placeholder="' . $std . '" rows="5" cols="30">' . wp_htmledit_pre( $options[$id] ) . '</textarea>'; 
                 }
                break;
            
            case 'editor':
                
                echo '<div class="wp-ed">';
                if ( class_exists( 'SitePress' ) && isset($this->settings[$id]['multilang']) ) {
                    $languages  = icl_get_languages();
                     $current    = ICL_LANGUAGE_CODE;
                     $lang       = ICL_LANGUAGE_NAME;
                     foreach ( $languages as $key => $value ) {
                        $class      = ( $key == $current ) ? '' : 'hidden';
                        $value_key  = ( ! empty( $options[$key] ) ) ? $options[$key] : '';
                        $value = $id.'-'.$key;
                        if ( ! isset( $options[$value] ) && $type != 'checkbox' )
                        $options[$value] = $std;
                        
                        $content = $options[$value];
                        $editor_id = $id.'-'.$key;
                        $editor_settings = array(
                            'textarea_name' => 'theme_options[' . $id.'-'.$key . ']',
                            'textarea_rows'=>20,
                            'tinymce' => FALSE
                        );
                        echo '<div class="'.$class.'">';
                        echo wp_editor( $content, $editor_id, $editor_settings );
                        echo '</div>';
                     }
                     echo '<div class="langg">'.__('You Are Editing in ( <strong>'.$lang.'</strong> ) Language.','itrays').'</div>';
                }else {
                    $content = $options[$id];
                    $editor_id = $id;
                    $editor_settings = array(
                        'textarea_name' => 'theme_options[' . $id . ']',
                        'textarea_rows'=>20,
                        'tinymce' => FALSE
                    ); 
                    echo wp_editor( $content, $editor_id, $editor_settings );
                }
                
                echo '</div>';
                break;
                
            case 'export':
                echo '<textarea class="lg-txt regular-text' . $field_class . '" id="' . $id . '" name="theme_options[' . $id . ']" rows="5" cols="30" readOnly="readOnly">' . $this->export_settings() . '</textarea>';
                break;
                
            case 'password':
                echo '<input class="regular-text' . $field_class . '" type="password" id="' . $id . '" name="theme_options[' . $id . ']" value="' . esc_attr( $options[$id] ) . '" />';
                break;
            
            case 'text':
            default:
                 echo '<div class="group">';
                 if ( class_exists( 'SitePress' ) && isset($this->settings[$id]['multilang']) ) {
                     $languages  = icl_get_languages();
                     $current    = ICL_LANGUAGE_CODE;
                     $lang       = ICL_LANGUAGE_NAME;
                     foreach ( $languages as $key => $value ) {
                        $type       = ( $key == $current ) ? 'text' : 'hidden';
                        $value_key  = ( ! empty( $options[$key] ) ) ? $options[$key] : '';
                        $value = $id.'-'.$key;
                        if ( ! isset( $options[$value] ) && $type != 'checkbox' )
                        $options[$value] = $std;
                        echo '<input class="regular-text' . esc_attr( $field_class ) . '" type="'. $type .'" placeholder="' . $std . '" name="'. ('theme_options['. $id.'-'.$key .']') .'" value="'. esc_attr__( $options[$value] ) .'" />';
                     }
                     echo '<div class="langg">'.__('You Are Editing in ( <strong>'.$lang.'</strong> ) Language.','itrays').'</div>';
                 }else{
                    echo '<input class="regular-text' . esc_attr( $field_class ) . '" type="text" id="' . esc_attr( $id ) . '" name="theme_options[' . $id . ']" placeholder="' . esc_attr( $std ) . '" value="' . esc_attr( $options[$id] ) . '" />'; 
                 }
                 echo '</div>';
                 break;
            
            case 'number':
            default:
                 echo '<div class="group"><input class="regular-text' . $field_class . '" type="number" id="' . $id . '" name="theme_options[' . $id . ']" placeholder="' . $std . '" value="' . esc_attr( $options[$id] ) . '" /> </div>';
                 break;
            
            case 'email':
            default:
                 echo '<div class="group"><input class="regular-text' . $field_class . '" type="email" id="' . $id . '" name="theme_options[' . $id . ']" placeholder="' . $std . '" value="' . esc_attr( $options[$id] ) . '" /> </div>';
                 break;
            
            case 'url':
            default:
                 echo '<div class="group"><input class="regular-text' . $field_class . '" type="url" id="' . $id . '" name="theme_options[' . $id . ']" placeholder="' . $std . '" value="' . esc_attr( $options[$id] ) . '" /> </div>';
                 break;
                 
             case 'color':
            default:
                 echo '<input class="color-chooser' . $field_class . '" type="text" id="' . $id . '" name="theme_options[' . $id . ']" placeholder="' . $std . '" value="' . esc_attr( $options[$id] ) . '"  data-default-color="' . $defcolor . '" />';
                 break;    
            
            case 'image':
            default:
                 echo '<img class="img-choose' . $field_class . '" id="' . $id . '" name="theme_options[' . $id . ']" placeholder="' . $std . '"  />';
                 break;
                 
                 case 'file':
            default:
                 echo '
                    <div class="inputs"><input class="regular-text' . $field_class . '" id="' . $id . '" type="text" name="theme_options[' . $id . ']" placeholder="' . $std . '" value="' . esc_attr( $options[$id] ) . '" />
                    <button class="upload_image_button" type="button">Upload Image</button><div class="clear-img"><img class="logo-im" alt="" src="' . esc_attr( $options[$id] ) . '" /> <a class="remove-img" href="#" title="Remove Image"></a></div></div>';
                 break;
            
            case 'arrayItems':
                echo '<div class="patterns-div' . $field_class . '"><input class="hidden' . $field_class . '" id="' . $id . '" type="text" name="theme_options[' . $id . ']" placeholder="' . $std . '" value="' . esc_attr( $options[$id] ) . '" />';
                    foreach ( $items as $value => $label )
                    echo '<img src="' . esc_attr( $value ) . '" class="pattern-img" />';
                echo '</div>';
                break;
                
            case 'sidebars':
                echo '<a class="button button-primary add_bar" href="#">Add sidebar</a><div class="app_div"></div>';
                        echo '<div><input class="bar_txt ' . $field_class . '" type="hidden" name="theme_options[' . $id . ']" value="' . esc_attr( $options[$id] ) . '" /></div>'; 
                break;
            
            case 'locations':
                global $vllu;
                $vllu = $options[$id];
                echo '<a class="button button-primary add_location" href="#">Add Office</a>';
                        echo '<div><input class="loc_txt ' . $field_class . '" type="hidden" id="'.$id.'" name="theme_options[' . $id . ']" value="' . esc_attr( $vllu ) . '" /></div>';
                break;
                
            case 'icon':
            default:
            echo '<i class="cust-icon ico"></i><a class="button button-primary btn_icon" href="#">Add Icon</a><input type="hidden" name="theme_options[' . $id . ']" id="' . $id . '" class="'.$field_class.' icon_input" value="' . esc_attr( $options[$id] ) . '" /><a class="button icon-remove">Remove Icon</a>';
            break;
            
            case 'import_data':
            default:
            echo '<a class="button button-primary import_btn" href="#">Import Demo Data</a><span class="loader"></span><div class="import_message"></div><div class="noticeImp">This can take several minutes, please wait and do not worry!</div>
            <div class="attachments"><input type="checkbox" name="' . $id . '" id="' . $id . '" value="1"' . checked( $options[$id], 1, false ) .'/>  Download and import file attachments!</div>';
            break; 
               
            case 'link':
                 default:
                 echo '<a href="' . $link . '">'. $desc .'</a>';
            break; 

        }
    }
    
    public function get_option() {
        require_once(  FRAMEWORK_DIR . '/config/it-framework-config.php' );
    }        
    
    public function it_settings_sections( $page ) {
        global $wp_settings_sections, $wp_settings_fields;

        if ( ! isset( $wp_settings_sections[$page] ) )
            return;

        foreach ( (array) $wp_settings_sections[$page] as $section ) {
            if ( $section['title'] )
                echo "<h3>{$section['title']}</h3>\n";

            if ( $section['callback'] )
                call_user_func( $section['callback'], $section );

            if ( ! isset( $wp_settings_fields ) || !isset( $wp_settings_fields[$page] ) || !isset( $wp_settings_fields[$page][$section['id']] ) )
                continue;
            echo '<div class="form-div"><div class="opts-ul '.$section["id"].'">';
            $this->it_settings_fields( $page, $section['id'] );
            echo '</div></div>';
        }
        
    }

    public function it_settings_fields($page, $section) {
        global $wp_settings_fields;
        
        if ( ! isset( $wp_settings_fields[$page][$section] ) )
            return;

        foreach ( (array) $wp_settings_fields[$page][$section] as $field ) {
            $gro='';
            if($field['args']['group']){
                $gro = ' group_'.$field['args']['group'];
            }
            echo '<div class="section'.$gro.'">';
            if ( !empty($field['args']['label_for']) )
                echo '<div class="lbl"><label class="opt-lbl" for="' . esc_attr( $field['args']['label_for'] ) . '">' . $field['title'] . '</label><span class="description">' . $field['args']['desc'] . '</span></div>';
            else
                echo $field['title'];
            call_user_func($field['callback'], $field['args']);
            echo '</div>';
        }
    }
    
    public function validate_settings( $input ) { 
        $options = get_option( 'theme_options' );
        
        if ( isset( $_POST['reset'] ) ) {
            return $this->get_default_values();
        }else{
            return $input;
        }
        
        $clean = array();
        
        
        foreach ( $options as $option ) {

            if ( ! isset( $option['id'] ) ) {
                continue;
            }

            if ( ! isset( $option['type'] ) ) {
                continue;
            }

            $id = preg_replace( '/[^a-zA-Z0-9._\-]/', '', strtolower( $option['id'] ) );

            // Set checkbox to false if it wasn't sent in the $_POST
            if ( 'checkbox' == $option['type'] && ! isset( $input[$id] ) ) {
                $input[$id] = false;
            }

            // Set each item in the multicheck to false if it wasn't sent in the $_POST
            if ( 'multicheck' == $option['type'] && ! isset( $input[$id] ) ) {
                foreach ( $option['options'] as $key => $value ) {
                    $input[$id][$key] = false;
                }
            }

            // For a value to be submitted to database it must pass through a sanitization filter
            if ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
                $clean[$id] = apply_filters( 'of_sanitize_' . $option['type'], $input[$id], $option );
            }
        }

        // Hook to run after validation
        do_action( 'optionsframework_after_validate', $clean );

        return $clean; 
    }
    
    public function get_default_values() {
        $output = array();
        foreach ( (array) $this->settings as $option ) {
            if ( ! isset( $option['id'] ) ) {
                continue;
            }
            if ( ! isset( $option['std'] ) ) {
                continue;
            }
            if ( ! isset( $option['type'] ) ) {
                continue;
            }
            if ( has_filter( 'of_sanitize_' . $option['type'] ) ) {
                $output[$option['id']] = apply_filters( 'of_sanitize_' . $option['type'], $option['std'], $option );
            }
        }
        return $output;
    }
         
    public function export_settings() {
        
        if( ! current_user_can( 'manage_options' ) )
        return;
        
        $settings = get_option( 'theme_options' );

        ignore_user_abort( true );

        nocache_headers();
        header( 'Content-Type: application/json; charset=utf-8' );
        header( 'Content-Disposition: attachment; filename=theme_options.txt' );
        header( "Expires: 0" );
        $encoded_options = serialize($settings);
        echo $encoded_options;
        exit;
    }
    
    public function scripts() {
        wp_enqueue_style( 'it_font-awesome', THEME_URI. '/assets/css/font-awesome.min.css');
        wp_print_scripts( 'jquery-ui-tabs' );
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_enqueue_script( 'wp-color-picker');
        wp_register_script('upload-js', FRAMEWORK_ASSETS_URI . '/js/upload.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('upload-js');
        wp_register_script('select-js', FRAMEWORK_ASSETS_URI . '/js/jquery.dd.min.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('select-js');
        wp_enqueue_script('popup-js', FRAMEWORK_ASSETS_URI.'/js/popup.js' ,array('jquery'), '1.0.0', true);
        wp_register_script('framework-js', FRAMEWORK_ASSETS_URI . '/js/framework.js', array('jquery'), '1.0.0', true);
        wp_enqueue_script('framework-js');
        wp_enqueue_script('jquery-ui-datepicker');  
    }
    
    public function styles() {
        wp_enqueue_style( 'framework-css', FRAMEWORK_ASSETS_URI . '/css/framework.css' );
        wp_enqueue_style('popup-css', FRAMEWORK_ASSETS_URI.'/css/popup.css');
        wp_enqueue_style('font-awesome', THEME_URI. '/assets/css/font-awesome.min.css');
        wp_enqueue_style('thickbox');
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style('datepicker-style', FRAMEWORK_ASSETS_URI.'/css/datepicker.css');
        wp_enqueue_style('dd-css', FRAMEWORK_ASSETS_URI.'/css/dd.css');
    }
    
}
$theme_options = new ITFramework();