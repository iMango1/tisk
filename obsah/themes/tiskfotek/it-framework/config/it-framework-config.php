<?php 

  /* General Settings
        ===========================================*/         
        
        $goglfonts = array();
        $url = FRAMEWORK_ASSETS_DIR .'/fonts/fonts.json';
        $fonts    =  json_decode( file_get_contents($url ));
        foreach ( $fonts->items as $key => $font ) {
          $goglfonts[$font->family] = $font->family;
        }
     
        $this->settings['import_data'] = array(
            'title'   => __( 'One-Click Install Demo Data','itrays' ),
            'desc'    => __( 'Be Sure, this will overwrite the existing data.','itrays' ),
            'std'     => '',
            'type'    => 'import_data',
            'section' => 'it_general'
        );
        $this->settings['favicon'] = array(
            'section' => 'it_general',
            'title'   => __( 'Favicon','itrays' ),
            'desc'    => __( 'You can upload an ico image that will represent your website identity (16px x 16px)','itrays' ),
            'type'    => 'file',
            'std'     => ''
        );
        $this->settings['page-loader'] = array(
            'section' => 'it_general',
            'title'   => __( 'Show Page Pre-Loader','itrays' ),
            'desc'    => __( 'Check this box to enable / disable page pre loader.','itrays' ),
            'type'    => 'checkbox',
            'std'     => ''
        );
        $this->settings['cont-details-heading'] = array(
            'section' => 'it_general',
            'title'   => '',
            'desc'    => __( 'Contact Details','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['contact_address'] = array(
            'title'   => __( 'Address','itrays' ),
            'desc'    => __( 'Your contact Address.','itrays' ),
            'std'     => '123 Street Name, City, Country',
            'type'    => 'text',
            'multilang' => true,
            'section' => 'it_general'
        );
        $this->settings['contact_address_top_bar'] = array(
            'section' => 'it_general',
            'title'   => __( 'Show Address on top bar info','itrays' ),
            'desc'    => __( 'Check the box to Show/Hide the Address on top bar info.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['contact_phone'] = array(
            'title'   => __( 'Phone Number','itrays' ),
            'desc'    => __( 'Your contact phone number.','itrays' ),
            'std'     => '+1(888)000-0000',
            'type'    => 'text',
            'section' => 'it_general'
        );
        $this->settings['contact_phone_top_bar'] = array(
            'section' => 'it_general',
            'title'   => __( 'Show Phone on top bar info','itrays' ),
            'desc'    => __( 'Check the box to Show/Hide the Phone on top bar info.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['contact_email'] = array(
            'title'   => __( 'Email Address','itrays' ),
            'desc'    => __( 'Your contact email address.','itrays' ),
            'std'     => 'mail@domain.com',
            'type'    => 'text',
            'section' => 'it_general'
        );
        $this->settings['contact_email_top_bar'] = array(
            'section' => 'it_general',
            'title'   => __( 'Show Email on top bar info','itrays' ),
            'desc'    => __( 'Check the box to Show/Hide the Email on top bar info.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['twitter-heading'] = array(
            'section' => 'it_general',
            'title'   => '',
            'desc'    => __( 'Twitter API Config','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['twitteruser'] = array(
            'title'   => __( 'Twitter user name','itrays' ),
            'desc'    => __( 'Your twitter user.','itrays' ),
            'std'     => 'IT_RAYS',
            'type'    => 'text',
            'section' => 'it_general'
        );
        $this->settings['wid_id'] = array(
            'title'   => __( 'Widget ID','itrays' ),
            'desc'    => __( 'Your twitter Widget ID.','itrays' ),
            'std'     => '529778322134167553',
            'type'    => 'text',
            'section' => 'it_general'
        );
        $this->settings['tweets_limit'] = array(
            'title'   => __( 'Tweets Limit','itrays' ),
            'desc'    => __( 'The limit of tweets number that will be retrieved from twitter.','itrays' ),
            'std'     => '10',
            'type'    => 'number',
            'section' => 'it_general'
        );
        $this->settings['author-heading'] = array(
            'section' => 'it_general',
            'title'   => '',
            'desc'    => __( 'Authors Page Settings','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['show_auth_info'] = array(
            'section' => 'it_general',
            'title'   => __( 'Show Author Info','itrays' ),
            'desc'    => __( 'Check the box to Show/Hide the author info.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['show_auth_posts'] = array(
            'section' => 'it_general',
            'title'   => __( 'Show Author Posts','itrays' ),
            'desc'    => __( 'Check the box to Show/Hide the author Posts.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['auth_posts_style'] = array(
            'title'   => __( 'Author Posts Listing Style','itrays' ),
            'desc'    => __( 'Select your prefered Author Posts listing style.','itrays' ),
            'std'     => 'large',
            'type'    => 'select',
            'section' => 'it_general',
            'class'   => '',
            'choices' => array(
            'large' => 'Large Image',
            'small' => 'Small Image',
            'timeline' => 'Timeline',
            'masonry' => 'Masonry',
            'grid' => 'Grid'
            )
        );
        $this->settings['auth_content_before'] = array(
            'section' => 'it_general',
            'title'   => __( 'Content Before','itrays' ),
            'desc'    => __( 'Add Text or HTML at the top of auther page.','itrays' ),
            'multilang' => true,
            'type'    => 'editor',
            'std'     => ''
        );
        $this->settings['auth_content_after'] = array(
            'section' => 'it_general',
            'title'   => __( 'Content After','itrays' ),
            'desc'    => __( 'Add Text or HTML at the end of auther page.','itrays' ),
            'multilang' => true,
            'type'    => 'editor',
            'std'     => ''
        );
        $this->settings['otherss-heading'] = array(
            'section' => 'it_general',
            'title'   => '',
            'desc'    => __( 'Other','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['tags_limit'] = array(
            'title'   => __( 'Tags Limit','itrays' ),
            'desc'    => __( 'enter nymber of tags that will be displayed in widgets.','itrays' ),
            'std'     => '10',
            'type'    => 'number',
            'section' => 'it_general'
        );
        $this->settings['custom_css'] = array(
            'section' => 'it_general',
            'title'   => __( 'Custom CSS','itrays' ),
            'desc'    => __( 'Insert here any custom css code.','itrays' ),
            'type'    => 'textarea',
            'std'     => ''
        );
        $this->settings['custom_js'] = array(
            'section' => 'it_general',
            'title'   => __( 'Custom javascript','itrays' ),
            'desc'    => __( 'Insert here Custom javascript code.','itrays' ),
            'type'    => 'textarea',
            'std'     => ''
        );
        $this->settings['analytics'] = array(
            'section' => 'it_general',
            'title'   => __( 'Google Analytics - Tracking Code','itrays' ),
            'desc'    => __( 'Paste your Google Analytics tracking code here. This will be added into the footer template of your theme.','itrays' ),
            'type'    => 'text',
            'std'     => ''
        );
        
        /* Top Bar Settings
       ==========================================*/ 
        $this->settings['top-bar-heading'] = array(
            'section' => 'it_topbar',
            'title'   => '',
            'desc'    => __( 'Top Bar Settings','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['show_top_bar'] = array(
            'section' => 'it_topbar',
            'title'   => __( 'Show top bar','itrays' ),
            'desc'    => __( 'Check the box to Show/Hide the top bar above header.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['topbarleft'] = array(
            'title'   => __( 'Top bar left content','itrays' ),
            'desc'    => '',
            'std'     => 'contact',
            'type'    => 'select',
            'section' => 'it_topbar',
            'class'   => 'top-bar-left-select',
            'choices' => array(
            'socials' => 'Social Icons',
            'contact' => 'Contact Info',
            'userlinks' => 'Top Bar Menu Links',
            'loginregister' => 'Login / Register Links',
            'text' => 'HTML or text',
            'wpml' => 'Language Switcher (WPML)',
            'empty' => 'Empty ( No Content )'
            )
        );
        $this->settings['top_left_text'] = array(
            'section' => 'it_topbar',
            'title'   => __( 'HTML or text','itrays' ),
            'desc'    => __( 'You can add text to be displayed in the left top bar.','itrays' ),
            'class'   => 'html-txt',
            'multilang' => true,
            'type'    => 'editor',
            'std'     => 'You can add html or text here'
        );
        $this->settings['topbarright'] = array(
            'title'   => __( 'Top bar Right content','itrays' ),
            'desc'    => '',
            'std'     => 'text',
            'type'    => 'select',
            'section' => 'it_topbar',
            'class'   => 'top-bar-right-select',
            'choices' => array(
            'socials' => 'Social Icons',
            'contact' => 'Contact Info',
            'userlinks' => 'Top Bar Menu Links',
            'loginregister' => 'Login / Register Links',
            'text' => 'HTML or text',
            'wpml' => 'Language Switcher (WPML)',
            'empty' => 'Empty ( No Content )'
            )
        );
        $this->settings['top_right_text'] = array(
            'section' => 'it_topbar',
            'title'   => __( 'HTML or text','itrays' ),
            'desc'    => __( 'You can add text to be displayed in the right top bar.','itrays' ),
            'class'   => 'html-txt',
            'multilang' => true,
            'type'    => 'editor',
            'std'     => __('You can add html or text here','itrays')
        );
        $this->settings['login_welcome'] = array(
            'section' => 'it_topbar',
            'title'   => __( 'Hide Login Welcome Message','itrays' ),
            'desc'    => __( 'Select this option to hide the login welcome message in the login bar.','itrays' ),
            'class'   => 'login-sec',
            'group'   => 'login',
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['login_welcome_message'] = array(
            'section' => 'it_topbar',
            'title'   => __( 'Login Welcome Message','itrays' ),
            'desc'    => __( 'You can add text to login welcome message in the login bar.','itrays' ),
            'class'   => 'login-sec',
            'multilang' => true,
            'type'    => 'editor',
            'group'   => 'login'
        );
        if(class_exists('Woocommerce')) {
            $this->settings['topbar_show_cart'] = array(
                'section' => 'it_topbar',
                'title'   => __( 'Show Shopping Cart','itrays' ),
                'desc'    => __( 'Select this option to show the shopping cart in the top bar.','itrays' ),
                'class'   => 'topbar-cart',
                'type'    => 'checkbox',
                'std'     => '1'
            );
            $this->settings['topbar_cart_position'] = array(
            'title'   => __( 'Cart Position','itrays' ),
            'desc'    => '',
            'std'     => 'right',
            'type'    => 'select',
            'section' => 'it_topbar',
            'class'   => '',
            'choices' => array(
            'left' => 'Left',
            'right' => 'Right'
            )
        );
        }
        $this->settings['top-bar-styling'] = array(
            'section' => 'it_topbar',
            'title'   => '',
            'desc'    => __( 'Top Bar Styling','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['barbgcolor'] = array(
            'title'   => __( 'Top Bar background color','itrays' ),
            'desc'    => __( 'Choose a solid color for the top bar background','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_topbar',
            'class'   => '',
            'defcolor' => '#f4f4f4'
        );
        $this->settings['bar_image'] = array(
            'section' => 'it_topbar',
            'title'   => __( 'Background Image','itrays' ),
            'desc'    => __( 'Select an image or insert an image url to use for the top bar background.','itrays' ),
            'type'    => 'file',
            'std'     => ''
        );
        $this->settings['bar_img_full_width'] = array(
            'section' => 'it_topbar',
            'title'   => __( '100% Background Image','itrays' ),
            'desc'    => __( 'Check this box to have the top bar background image display at 100% in width and height and scale according to the browser size.','itrays' ),
            'type'    => 'checkbox',
            'std'     => ''
        );
        $this->settings['bar_img_repeat'] = array(
            'title'   => __( 'Background repeat','itrays' ),
            'desc'    => __( 'Select how the background image repeats.','itrays' ),
            'std'     => '',
            'type'    => 'select',
            'section' => 'it_topbar',
            'class'   => '',
            'choices' => array(
            'no-repeat' => 'no-repeat',
            'repeat' => 'repeat',
            'repeat-x' => 'repeat-x',
            'repeat-y' => 'repeat-y'
            )
        );
        $this->settings['barseparatorcolor'] = array(
            'title'   => __( 'Top Bar Separators color','itrays' ),
            'desc'    => __( 'Choose a solid color for the top bar Separators','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_topbar',
            'class'   => '',
            'defcolor' => '#E9E9E9'
        );
        $this->settings['barcolor'] = array(
            'title'   => __( 'Top Bar color','itrays' ),
            'desc'    => __( 'Choose a color for the top bar elements','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_topbar',
            'class'   => '',
            'defcolor' => '#A2A2A2'
        );
        $this->settings['bariconcolor'] = array(
            'title'   => __( 'Top Bar Icons color','itrays' ),
            'desc'    => __( 'Choose a color for the top bar Icons','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_topbar',
            'class'   => '',
            'defcolor' => '#A2A2A2'
        );
        
 /* Header Settings
       ==========================================*/
       
       $this->settings['header-layouts-heading'] = array(
            'section' => 'it_header',
            'title'   => '',
            'desc'    => __( 'Header Layouts','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
       $this->settings['header_layout'] = array(
            'section' => 'it_header',
            'title'   => __( 'Choose header layout','itrays' ),
            'desc'    => __( 'Choose header layout from the below images','itrays' ),
            'type'    => 'radio',
            'std'     => 'header-1',
            'class'   => 'head-imgs',
            'choices' => array(
                'header-1' => '',
                'header-2' => '',
                'header-3' => '',
                'header-4' => '',
                'header-5' => '',
                'header-6' => '',
                'header-7' => '',
            )
        );       
        $this->settings['header-heading'] = array(
            'section' => 'it_header',
            'title'   => '',
            'desc'    => __( 'Header settings','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['menu_effect'] = array(
            'title'   => __( 'Main Menu Effect','itrays' ),
            'desc'    => __( 'Select how the sub menu will appear.','itrays' ),
            'std'     => '1',
            'type'    => 'select',
            'section' => 'it_header',
            'class'   => '',
            'choices' => array(
            '1' => 'Default Effect',
            '2' => 'Slide Up / Down',
            '3' => 'Fade',
            'fadeInUp' => 'Fade In Up',
            'fadeInDown' => 'Fade In Down',
            'fadeInRight' => 'Fade In Right',
            'fadeInLeft' => 'Fade In Left',
            'flash' => 'flash',
            'pulse' => 'pulse',
            'swing' => 'swing',
            'tada' => 'tada',
            'wobble' => 'wobble',
            'none'  => 'No Effect'
            )
        );
        $this->settings['mega_menu_style'] = array(
            'title'   => __( 'Mega Menu Style','itrays' ),
            'desc'    => __( 'Select how the Mega menu will appear.','itrays' ),
            'std'     => '',
            'type'    => 'select',
            'section' => 'it_header',
            'class'   => '',
            'choices' => array(
            'mega-1' => 'Default Style',
            'mega-2' => 'Style 2',
            'mega-3' => 'Style 3',
            )
        );
        $this->settings['nav_bg_color'] = array(
            'title'   => __( 'Background color','itrays' ),
            'desc'    => __( 'Choose a color for the header background','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_header',
            'class'   => '',
        );
        $this->settings['nav_image'] = array(
            'section' => 'it_header',
            'title'   => __( 'Background Image','itrays' ),
            'desc'    => __( 'Select an image or insert an image url to use for the header background.','itrays' ),
            'type'    => 'file',
            'std'     => ''
        );
        $this->settings['nav_img_full_width'] = array(
            'section' => 'it_header',
            'title'   => __( '100% Background Image','itrays' ),
            'desc'    => __( 'Check this box to have the header background image display at 100% in width and height and scale according to the browser size.','itrays' ),
            'type'    => 'checkbox',
            'std'     => ''
        );
        $this->settings['nav_img_repeat'] = array(
            'title'   => __( 'Background repeat','itrays' ),
            'desc'    => __( 'Select how the background image repeats.','itrays' ),
            'std'     => '',
            'type'    => 'select',
            'section' => 'it_header',
            'class'   => '',
            'choices' => array(
            'no-repeat' => 'no-repeat',
            'repeat' => 'repeat',
            'repeat-x' => 'repeat-x',
            'repeat-y' => 'repeat-y'
            )
        );
        $this->settings['nav_icon_color'] = array(
            'title'   => __( 'Menu Icons color','itrays' ),
            'desc'    => __( 'Choose a color for the main menu icons colors','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_header',
            'class'   => '',
        );
        $this->settings['show_search'] = array(
            'section' => 'it_header',
            'title'   => __( 'Show Search box','itrays' ),
            'desc'    => __( 'Check this box to search box in header beside the top menu.','itrays' ),
            'type'    => 'checkbox',
            'std'     => ''
        );
        $this->settings['header_7_banner'] = array(
            'section' => 'it_header',
            'title'   => __( 'Header 7 Banner Image','itrays' ),
            'desc'    => __( 'Select an image or insert an image url to use for the Header 7 Banner Image.','itrays' ),
            'type'    => 'file',
            'std'     => ''
        );
        $this->settings['header_7_banner_link'] = array(
            'title'   => __( 'Header 7 Banner Link','itrays' ),
            'desc'    => __( 'Insert here the LINK for the Banner. Ex: http://www.google.com','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_header'
        );
        
        $this->settings['logo_inputs'] = array(
            'section' => 'it_header',
            'title'   => '',
            'desc'    => __( 'Logo settings','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['site_title'] = array(
            'section' => 'it_header',
            'title'   => __( 'Site Title','itrays' ),
            'desc'    => __( 'Your logo will be at the top left. ','itrays' ),
            'type'    => 'text',
            'multilang' => true,
            'std'     => get_bloginfo()
        );
        $this->settings['logo_font'] = array(
            'title'   => __( 'Logo Font Family','itrays' ),
            'desc'    => __( 'Choose your favourite Font Family from the list below','itrays' ),
            'std'     => 'Open Sans',
            'type'    => 'select',
            'section' => 'it_header',
            'choices' => $goglfonts
        );
        $this->settings['logo_font_size'] = array(
            'title'   => __( 'Logo Font Size','itrays' ),
            'desc'    => __( 'Choose Font size for logo in px. Ex: 50px','itrays' ),
            'std'     => '',
            'type'    => 'number',
            'section' => 'it_header'
        );
        $this->settings['logo_font_weight'] = array(
            'title'   => __( 'Logo Font Weight','itrays' ),
            'desc'    => __( 'Choose Font weight for Logo','itrays' ),
            'std'     => '900',
            'type'    => 'select',
            'section' => 'it_header',
            'choices' => array(
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
        );
        $this->settings['header_logo_image'] = array(
            'section' => 'it_header',
            'title'   => __( 'Logo image','itrays' ),
            'desc'    => __( 'Select an image or insert an image url to use for the logo image.','itrays' ),
            'type'    => 'file',
            'std'     => ''
        );
        $this->settings['slogan_inputs'] = array(
            'section' => 'it_header',
            'title'   => '',
            'desc'    => __( 'Slogan settings','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['site_slogan'] = array(
            'section' => 'it_header',
            'title'   => __( 'Site Slogan','itrays' ),
            'desc'    => '',
            'multilang' => true,
            'type'    => 'text',
            'std'     => get_bloginfo( 'description' )
        );
        $this->settings['slogan_font'] = array(
            'title'   => __( 'Slogan Font Family','itrays' ),
            'desc'    => __( 'Choose your favourite Font Family from the list below','itrays' ),
            'std'     => 'Open Sans',
            'type'    => 'select',
            'section' => 'it_header',
            'choices' => $goglfonts
        );
        $this->settings['slogan_font_size'] = array(
            'title'   => __( 'Slogan Font Size','itrays' ),
            'desc'    => __( 'Choose Font size for Slogan','itrays' ),
            'std'     => '',
            'type'    => 'number',
            'section' => 'it_header'
        );
        $this->settings['slogan_font_weight'] = array(
            'title'   => __( 'Slogan Font Weight','itrays' ),
            'desc'    => __( 'Choose Font weight for Slogan','itrays' ),
            'std'     => '100',
            'type'    => 'select',
            'section' => 'it_header',
            'choices' => array(
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
        );
        $this->settings['sticky_header'] = array(
            'section' => 'it_header',
            'title'   => '',
            'desc'    => __( 'Sticky Header settings','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['sticky_header_on'] = array(
            'section' => 'it_header',
            'title'   => __( 'Enable Sticky Header','itrays' ),
            'desc'    => __( 'Check this box to Enable Sticky Header.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['sticky_bg_color'] = array(
            'title'   => __( 'Background Color','itrays' ),
            'desc'    => __( 'Choose the background color of sticky header.','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_header',
            'defcolor' => '#ffffff'
        );
        $this->settings['sticky_bg_trans'] = array(
            'title'   => __( 'Background Opacity','itrays' ),
            'desc'    => __( 'type the opacity level you want the background of sticky header. between (0 lowest to 1 Heighest)','itrays' ),
            'std'     => '0.7',
            'type'    => 'text',
            'section' => 'it_header'
        );
               
 /* Footer
        ============================================*/
        $this->settings['footer_style'] = array(
            'title'   => __( 'Footer Style','itrays' ),
            'desc'    => __( 'Select the footer style from the list below','itrays' ),
            'std'     => '1',
            'type'    => 'select',
            'section' => 'it_footer',
            'class'   => '',
            'choices' => array(
            '1' => 'Footer 1',
            '2' => 'Footer 2',
            '3' => 'Footer 3',
            '4' => 'Footer 4'
            )
        );
        $this->settings['footer-style'] = array(
            'section' => 'it_footer',
            'title'   => '',
            'desc'    => __( 'Top Footer Bar Style','itrays' ),
            'type'    => 'heading',
            'std'     => '1',
            'class'   => 'accordion'
        );
        $this->settings['footer_top_show'] = array(
            'section' => 'it_footer',
            'title'   => __( 'Show Top footer bar above Footer','itrays' ),
            'desc'    => __( 'Check this box to Show / Hide Top footer bar above Footer.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['footer3_top_left_txt'] = array(
            'title'   => __( 'Left Text','itrays' ),
            'desc'    => __( 'Select the footer style from the list below','itrays' ),
            'std'     => 'EXCEPTION - Responsive Multipurpose WordPress Theme is Specially For You.',
            'type'    => 'text',
            'multilang' => true,
            'section' => 'it_footer',
        );
        $this->settings['footer3_top_right_button_text'] = array(
            'title'   => __( 'Right Button text','itrays' ),
            'desc'    => __( 'Select the footer style from the list below','itrays' ),
            'std'     => 'Buy Now',
            'type'    => 'text',
            'multilang' => true,
            'section' => 'it_footer',
        );
        $this->settings['footer3_top_right_button_link'] = array(
            'title'   => __( 'Right Button Link','itrays' ),
            'desc'    => __( 'Select the footer style from the list below','itrays' ),
            'std'     => '#',
            'type'    => 'text',
            'multilang' => true,
            'section' => 'it_footer',
        );
        $this->settings['foot_top_bg_color'] = array(
            'title'   => __( 'Background color','itrays' ),
            'desc'    => __( 'Choose a color for the background','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_footer',
            'class'   => '',
        );
        $this->settings['foot_top_image'] = array(
            'section' => 'it_footer',
            'title'   => __( 'Background Image','itrays' ),
            'desc'    => __( 'Select an image or insert an image url to use for the background.','itrays' ),
            'type'    => 'file',
            'std'     => ''
        );
        $this->settings['foot_top_bg_img_full_width'] = array(
            'section' => 'it_footer',
            'title'   => __( '100% Background Image','itrays' ),
            'desc'    => __( 'Check this box to have the background image display at 100% in width and height and scale according to the browser size.','itrays' ),
            'type'    => 'checkbox',
            'std'     => ''
        );
        $this->settings['foot_top_bg_img_repeat'] = array(
            'title'   => __( 'Background repeat','itrays' ),
            'desc'    => __( 'Select how the background image repeats.','itrays' ),
            'std'     => '',
            'type'    => 'select',
            'section' => 'it_footer',
            'class'   => '',
            'choices' => array(
            'no-repeat' => 'no-repeat',
            'repeat' => 'repeat',
            'repeat-x' => 'repeat-x',
            'repeat-y' => 'repeat-y'
            )
        );
        $this->settings['footer-widgets-heading'] = array(
            'section' => 'it_footer',
            'title'   => '',
            'desc'    => __( 'Footer Widgets settings','itrays' ),
            'type'    => 'heading',
            'std'     => '1',
            'class'   => 'accordion'
        );
        $this->settings['enable_footer_widgets'] = array(
            'section' => 'it_footer',
            'title'   => __( 'Footer Widgets','itrays' ),
            'desc'    => __( 'Check the box to display footer widgets.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['footer_columns_number'] = array(
            'title'   => __( 'Number of Footer Columns','itrays' ),
            'desc'    => __( 'Select the number of columns to display in the footer..','itrays' ),
            'std'     => '3',
            'type'    => 'select',
            'section' => 'it_footer',
            'class'   => '3',
            'choices' => array(
            '12' => '1',
            '6' => '2',
            '4' => '3',
            '3' => '4'
            )
        );
        $this->settings['foot_bg_color'] = array(
            'title'   => __( 'Background color','itrays' ),
            'desc'    => __( 'Choose a color for the Footer background','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_footer',
            'class'   => '',
        );
        $this->settings['footer_image'] = array(
            'section' => 'it_footer',
            'title'   => __( 'Background Image','itrays' ),
            'desc'    => __( 'Select an image or insert an image url to use for the footer background.','itrays' ),
            'type'    => 'file',
            'std'     => ''
        );
        $this->settings['footer_bg_img_full_width'] = array(
            'section' => 'it_footer',
            'title'   => __( '100% Background Image','itrays' ),
            'desc'    => __( 'Check this box to have the footer background image display at 100% in width and height and scale according to the browser size.','itrays' ),
            'type'    => 'checkbox',
            'std'     => ''
        );
        $this->settings['footer_bg_img_repeat'] = array(
            'title'   => __( 'Background repeat','itrays' ),
            'desc'    => __( 'Select how the background image repeats.','itrays' ),
            'std'     => '',
            'type'    => 'select',
            'section' => 'it_footer',
            'class'   => '',
            'choices' => array(
            'no-repeat' => 'no-repeat',
            'repeat' => 'repeat',
            'repeat-x' => 'repeat-x',
            'repeat-y' => 'repeat-y'
            )
        );
         $this->settings['footer-copy-heading'] = array(
            'section' => 'it_footer',
            'title'   => '',
            'desc'    => __( 'Bottom Footer Bar Settings','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['show_bottom_footer'] = array(
            'section' => 'it_footer',
            'title'   => __( 'Show Bottom Footer Bar','itrays' ),
            'desc'    => __( 'Check the box to display the Bottom Footer bar that contains copyrights and social icons.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['enable_copyrights'] = array(
            'section' => 'it_footer',
            'title'   => __( 'Enable copyrights','itrays' ),
            'desc'    => __( 'Check the box to display the copyright bar.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['copyright_bg_color'] = array(
            'title'   => __( 'Background color','itrays' ),
            'desc'    => __( 'Choose a color for the copyright background','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_footer',
            'class'   => '',
        );
        $this->settings['copyright_image'] = array(
            'section' => 'it_footer',
            'title'   => __( 'Background Image','itrays' ),
            'desc'    => __( 'Select an image or insert an image url to use for the copyrights bar background.','itrays' ),
            'type'    => 'file',
            'std'     => ''
        );
        $this->settings['copyright_bg_img_full_width'] = array(
            'section' => 'it_footer',
            'title'   => __( '100% Background Image','itrays' ),
            'desc'    => __( 'Check this box to have the copyrights bar background image display at 100% in width and height and scale according to the browser size.','itrays' ),
            'type'    => 'checkbox',
            'std'     => ''
        );
        $this->settings['copyright_bg_img_repeat'] = array(
            'title'   => __( 'Background repeat','itrays' ),
            'desc'    => __( 'Select how the background image repeats.','itrays' ),
            'std'     => '',
            'type'    => 'select',
            'section' => 'it_footer',
            'class'   => '',
            'choices' => array(
            'no-repeat' => 'no-repeat',
            'repeat' => 'repeat',
            'repeat-x' => 'repeat-x',
            'repeat-y' => 'repeat-y'
            )
        );
        $this->settings['copyrights'] = array(
            'section' => 'it_footer',
            'title'   => __( 'Copyrights Text','itrays' ),
            'desc'    => __( 'Enter the text that displays in the copyright bar. HTML markup can be used.','itrays' ),
            'type'    => 'textarea',
            'multilang' => true,
            'std'     => '&copy; Copyrights <b>EXCEPTION</b> 2014. All rights reserved.'
        );
        $this->settings['enable_footer_socials'] = array(
            'section' => 'it_footer',
            'title'   => __( 'Display Social Icons on Footer of the Page','itrays' ),
            'desc'    => __( 'Select the checkbox to show social media icons on the footer of the page.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
              
 /* Appearance
        ===========================================*/
        
        $this->settings['layout-options'] = array(
            'section' => 'it_appearance',
            'title'   => '',
            'desc'    => 'Layout options',
            'type'    => 'heading',
            'class'   => 'accordion'
        );
        $this->settings['layout'] = array(
            'title'   => __( 'Choose layout','itrays' ),
            'desc'    => __( 'Boxed or wide layout?','itrays' ),
            'std'     => '',
            'type'    => 'select',
            'section' => 'it_appearance',
            'class'   => 'layout-select',
            'choices' => array(
            '' => 'Wide',
            'fixedPage' => 'Boxed'
            )
        );
        $this->settings['bodybgcolor'] = array(
            'title'   => __( 'Body background color','itrays' ),
            'desc'    => __( 'Choose a solid color for the body','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_appearance',
            'class'   => ''
        ); 
        $this->settings['bodyfontcolor'] = array(
            'title'   => __( 'Body Font color','itrays' ),
            'desc'    => __( 'Choose a solid color for the body Text','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_appearance',
            'class'   => ''
        );
        $this->settings['usepatterns'] = array(
            'section' => 'it_appearance',
            'title'   => __( 'Use patterns ?','itrays' ),
            'type'    => 'checkbox',
            'std'     => '',
            'class'   => 'use-pat',
            'desc'    => __( 'If yes, select the pattern from below:','itrays' )
        ); 
        $this->settings['patterns-imgs'] = array(
            'title'   => __( 'Pattern Background Image','itrays' ),
            'desc'    => __( 'select pattern background image for body.','itrays' ),
            'std'     => '',
            'type'    => 'arrayItems',
            'section' => 'it_appearance',
            'class'   => 'patterns',
            'items' => array(
            ''.get_template_directory_uri() .'/assets/images/patterns/bg1.jpg' => '1',
            ''.get_template_directory_uri() .'/assets/images/patterns/bg2.jpg' => '2',
            ''.get_template_directory_uri() .'/assets/images/patterns/bg3.jpg' => '3',
            ''.get_template_directory_uri() .'/assets/images/patterns/bg4.jpg' => '4',
            ''.get_template_directory_uri() .'/assets/images/patterns/bg5.jpg' => '5',
            ''.get_template_directory_uri() .'/assets/images/patterns/bg6.jpg' => '6',
            ''.get_template_directory_uri() .'/assets/images/patterns/bg7.jpg' => '7',
            ''.get_template_directory_uri() .'/assets/images/patterns/bg8.jpg' => '8',
            ''.get_template_directory_uri() .'/assets/images/patterns/bg9.jpg' => '9',
            ''.get_template_directory_uri() .'/assets/images/patterns/bg10.jpg' => '10'
            )
        );
        $this->settings['bodybgimage'] = array(
            'title'   => __( 'Upload Background image','itrays' ),
            'desc'    => __( 'Please choose an image or insert an image url to use for the backgroud.','itrays' ),
            'std'     => '',
            'type'    => 'file',
            'section' => 'it_appearance',
            'class'   => ''
        );
        $this->settings['body_bg_img_parallax'] = array(
            'title'   => __( 'Fixed Background','itrays' ),
            'desc'    => __( 'Please choose parallax effect for the backgroud.','itrays' ),
            'std'     => '',
            'type'    => 'checkbox',
            'section' => 'it_appearance',
            'class'   => ''
        );
        $this->settings['body_bg_full_width'] = array(
            'section' => 'it_appearance',
            'title'   => __( '100% Background Image','itrays' ),
            'desc'    => __( 'Check this box to have the body background image display at 100% in width and height and scale according to the browser size.','itrays' ),
            'type'    => 'checkbox',
            'std'     => ''
        );
        $this->settings['body_bg_img_repeat'] = array(
            'title'   => __( 'Background repeat','itrays' ),
            'desc'    => __( 'Select how the background image repeats.','itrays' ),
            'std'     => '',
            'type'    => 'select',
            'section' => 'it_appearance',
            'class'   => '',
            'choices' => array(
            'no-repeat' => 'no-repeat',
            'repeat' => 'repeat',
            'repeat-x' => 'repeat-x',
            'repeat-y' => 'repeat-y'
            )
        );
        $this->settings['general_css_heading'] = array(
            'section' => 'it_appearance',
            'title'   => '',
            'desc'    => 'General options',
            'type'    => 'heading',
            'class'   => 'accordion'
        );
        $this->settings['is_responsive'] = array(
            'section' => 'it_appearance',
            'title'   => __( 'Responsive Layout','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1',
            'class'   => '',
            'desc'    => __( 'Check this box to use the responsive design features. If left unchecked then the fixed layout is used.','itrays' )
        );
        $this->settings['main_width'] = array(
            'title'   => __( 'Content Width','itrays' ),
            'desc'    => __( 'Define the main site width. In px ex: 1170 (Just numbers are allowed)','itrays' ),
            'std'     => '1170',
            'type'    => 'number',
            'section' => 'it_appearance',
            'class'   => ''
        );
        $this->settings['smooth_scroll'] = array(
            'section' => 'it_appearance',
            'title'   => __( 'Enable Smooth Scroll on the page','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1',
            'class'   => '',
            'desc'    => __( 'Check this box to enable / disable the smooth scroll on the page','itrays' )
        );
        
        /* Page title.
        ============================================*/
        $this->settings['page_head_style'] = array(
            'title'   => __( 'Page Title Style','itrays' ),
            'desc'    => __( 'Select the page Title style.','itrays' ),
            'std'     => '1',
            'type'    => 'select',
            'section' => 'it_pagetitles',
            'class'   => '',
            'choices' => array(
            '1' => 'Title 1 Light',
            '2' => 'Title 2 Dark',
            '3' => 'Title 3 Light + Icon',
            '4' => 'Title 4 Dark + Icon',
            '5' => 'Title 5 Light + Centered',
            '6' => 'Title 6 Dark + Centered',
            '7' => 'Title 7 Light + Centered + Icon',
            '8' => 'Title 8 Dark + Centered + Icon',
            '9' => 'Title 9 Light + Skew',
            '10' => 'Title 10 Dark + Skew',
            )
        );
        $this->settings['page_head_height'] = array(
            'title'   => __( 'Custom Height','itrays' ),
            'desc'    => __( 'Insert here the new height (in px) for the page Title. Ex: 200 (Only numbers allowed)','itrays' ),
            'std'     => '',
            'type'    => 'number',
            'section' => 'it_pagetitles',
            'class'   => ''
        );
        $this->settings['page_head_icon'] = array(
            'title'   => __( 'Page Title icon','itrays' ),
            'desc'    => __( 'choose icon that will appear in page Title 3,4,7 and 8 only','itrays' ),
            'std'     => '',
            'type'    => 'icon',
            'section' => 'it_pagetitles',
            'class'   => ''
        );
        $this->settings['page_headers_styles'] = array(
            'section' => 'it_pagetitles',
            'title'   => '',
            'desc'    => 'Custom Page Title Background',
            'type'    => 'heading',
            'class'   => 'accordion'
        );
        $this->settings['use_page_head_bg'] = array(
            'title'   => __( 'Use Custom Page Title Background?','itrays' ),
            'desc'    => __( 'Check this to use custom Page Title Background.','itrays' ),
            'std'     => '',
            'type'    => 'checkbox',
            'section' => 'it_pagetitles',
            'class'   => ''
        );
        $this->settings['page_head_bg'] = array(
            'title'   => __( 'Custom Page Title Background','itrays' ),
            'desc'    => __( 'Please choose an image or insert an image url to use for the backgroud.','itrays' ),
            'std'     => '',
            'type'    => 'file',
            'section' => 'it_pagetitles',
            'class'   => ''
        );
        $this->settings['page_head_parallax'] = array(
            'title'   => __( 'Fixed Background','itrays' ),
            'desc'    => __( 'Please choose parallax effect for the backgroud.','itrays' ),
            'std'     => '',
            'type'    => 'checkbox',
            'section' => 'it_pagetitles',
            'class'   => ''
        );
        $this->settings['page_head_full_width'] = array(
            'section' => 'it_pagetitles',
            'title'   => __( '100% Background Image','itrays' ),
            'desc'    => __( 'Check this box to have the body background image display at 100% in width and height and scale according to the browser size.','itrays' ),
            'type'    => 'checkbox',
            'std'     => ''
        );
        $this->settings['page_head_img_repeat'] = array(
            'title'   => __( 'Background repeat','itrays' ),
            'desc'    => __( 'Select how the background image repeats.','itrays' ),
            'std'     => '',
            'type'    => 'select',
            'section' => 'it_pagetitles',
            'class'   => '',
            'choices' => array(
            'no-repeat' => 'no-repeat',
            'repeat' => 'repeat',
            'repeat-x' => 'repeat-x',
            'repeat-y' => 'repeat-y'
            )
        );
        
        /* Colors.
        ============================================*/
        
        $this->settings['skin_css'] = array(
            'title'   => __( 'Theme Color','itrays' ),
            'desc'    => __( 'Select your skin color Light / Dark.','itrays' ),
            'std'     => 'light',
            'type'    => 'select',
            'section' => 'it_colors',
            'class'   => '',
            'choices' => array(
            'light' => 'Light Theme',
            'dark' => 'Dark Theme'
            )
        );
        $this->settings['colors_css'] = array(
            'title'   => __( 'Predefined Color Schemes','itrays' ),
            'desc'    => __( 'Select your favourite color schemes from the list below or you can select the last item - custom - and choose yours.','itrays' ),
            'std'     => 'default',
            'type'    => 'select',
            'section' => 'it_colors',
            'class'   => 'color-select',
            'choices' => array(
            'default' => 'Default Skin',
            'skin2' => 'skin2',
            'skin3' => 'skin3',
            'skin4' => 'skin4',
            'skin5' => 'skin5',
            'skin6' => 'skin6',
            'skin7' => 'skin7',
            'skin8' => 'skin8',
            'skin9' => 'skin9',
            'skin10' => 'skin10',
            'skin11' => 'skin11',
            'skin12' => 'skin12',
            'custom' => 'Custom Colors...'
            )
        );
        $this->settings['skin_color'] = array(
            'title'   => __( 'Choose Your Custom color','itrays' ),
            'desc'    => __( 'Choose from this color pallet the color suits your needs.','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_colors',
            'class'   => 'custom-colors'
        );
        
        /* Typography.
        ============================================*/
        $this->settings['body_heading'] = array(
            'section' => 'it_typography',
            'title'   => '',
            'desc'    => __( 'Body Typography','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['body_font'] = array(
            'title'   => __( 'Font Family','itrays' ),
            'desc'    => __( 'Choose your favourite Font Family from the list below','itrays' ),
            'std'     => 'Open Sans',
            'type'    => 'select',
            'section' => 'it_typography',
            'choices' => $goglfonts
        );
        $this->settings['body_font_size'] = array(
            'title'   => __( 'Font Size','itrays' ),
            'desc'    => __( 'Choose Font size for all body elemets','itrays' ),
            'std'     => '',
            'type'    => 'number',
            'section' => 'it_typography'
        );
        $this->settings['body_font_weight'] = array(
            'title'   => __( 'Font Weight','itrays' ),
            'desc'    => __( 'Choose Font size for Body font weights','itrays' ),
            'std'     => '',
            'type'    => 'select',
            'section' => 'it_typography',
            'choices' => array(
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
        );
        $this->settings['body_line_height'] = array(
            'title'   => __( 'Line Height','itrays' ),
            'desc'    => __( 'Choose Line Height for all body elemets','itrays' ),
            'std'     => '',
            'type'    => 'number',
            'section' => 'it_typography'
        );
        
        $this->settings['menu_heading'] = array(
            'section' => 'it_typography',
            'title'   => '',
            'desc'    => __( 'Menu Typography','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['menu_font'] = array(
            'title'   => __( 'Font Family','itrays' ),
            'desc'    => __( 'Choose your favourite Font Family from the list below','itrays' ),
            'std'     => 'Open Sans',
            'type'    => 'select',
            'section' => 'it_typography',
            'choices' => $goglfonts
        );
        $this->settings['menu_font_size'] = array(
            'title'   => __( 'Font Size','itrays' ),
            'desc'    => __( 'Choose Font size for menu elemets','itrays' ),
            'std'     => '',
            'type'    => 'number',
            'section' => 'it_typography'
        );
        $this->settings['menu_font_weight'] = array(
            'title'   => __( 'Font Weight','itrays' ),
            'desc'    => __( 'Choose Font weight for menu font weights','itrays' ),
            'std'     => '',
            'type'    => 'select',
            'section' => 'it_typography',
            'choices' => array(
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
        );
        $this->settings['menu_line_height'] = array(
            'title'   => __( 'Line Height','itrays' ),
            'desc'    => __( 'Choose Line Height for Menu elemets','itrays' ),
            'std'     => '',
            'type'    => 'number',
            'section' => 'it_typography'
        );
        
        $this->settings['sub_menu_heading'] = array(
            'section' => 'it_typography',
            'title'   => '',
            'desc'    => __( 'Sub Menu Typography','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['sub_menu_font'] = array(
            'title'   => __( 'Font Family','itrays' ),
            'desc'    => __( 'Choose your favourite Font Family from the list below','itrays' ),
            'std'     => 'Open Sans',
            'type'    => 'select',
            'section' => 'it_typography',
            'choices' => $goglfonts
        );
        $this->settings['sub_menu_font_size'] = array(
            'title'   => __( 'Font Size','itrays' ),
            'desc'    => __( 'Choose Font size for Sub menu elemets','itrays' ),
            'std'     => '',
            'type'    => 'number',
            'section' => 'it_typography'
        );
        $this->settings['sub_menu_font_weight'] = array(
            'title'   => __( 'Font Weight','itrays' ),
            'desc'    => __( 'Choose Font weight for sub menu font weights','itrays' ),
            'std'     => '',
            'type'    => 'select',
            'section' => 'it_typography',
            'choices' => array(
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
        );
        $this->settings['sub_menu_line_height'] = array(
            'title'   => __( 'Line Height','itrays' ),
            'desc'    => __( 'Choose Line Height for Sub Menu elemets','itrays' ),
            'std'     => '',
            'type'    => 'number',
            'section' => 'it_typography'
        );
        
        $this->settings['headings_heading'] = array(
            'section' => 'it_typography',
            'title'   => '',
            'desc'    => __( 'Headings Typography','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['headings_font'] = array(
            'title'   => __( 'Font Family','itrays' ),
            'desc'    => __( 'Choose your favourite Font Family from the list below','itrays' ),
            'std'     => 'Open Sans',
            'type'    => 'select',
            'section' => 'it_typography',
            'choices' => $goglfonts
        );
        $this->settings['headings_font_weight'] = array(
            'title'   => __( 'Font Weight','itrays' ),
            'desc'    => __( 'Choose Font weight for Headings font weights','itrays' ),
            'std'     => '',
            'type'    => 'select',
            'section' => 'it_typography',
            'choices' => array(
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
        );
        
        
        /* Blog options.
        ============================================*/
        $this->settings['blog_listing_heading'] = array(
            'section' => 'it_blogoptions',
            'title'   => '',
            'desc'    => __( 'Blog listing page settings','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['blogstyle'] = array(
            'title'   => __( 'Blog Listing Style','itrays' ),
            'desc'    => __( 'Select your prefered blog posts listing style.','itrays' ),
            'std'     => 'large',
            'type'    => 'select',
            'section' => 'it_blogoptions',
            'class'   => 'blog-style',
            'choices' => array(
            'large' => 'Blog Large Image',
            'small' => 'Blog Small Image',
            'timeline' => 'Blog Timeline',
            'masonry' => 'Blog Masonry',
            'grid' => 'Blog Grid'
            )
        );
        $this->settings['masonry_cols'] = array(
            'title'   => __( 'Masonry Columns Per Row','itrays' ),
            'desc'    => __( 'Select blog masonry columns per row.','itrays' ),
            'std'     => '6',
            'type'    => 'select',
            'section' => 'it_blogoptions',
            'class'   => 'masonry-cols',
            'choices' => array(
            '6' => '2 Columns',
            '3' => '3 Columns',
            '4' => '4 Columns'
            )
        );
        $this->settings['grid_cols'] = array(
            'title'   => __( 'Grid Columns Per Row','itrays' ),
            'desc'    => __( 'Select blog grid columns per row.','itrays' ),
            'std'     => '6',
            'type'    => 'select',
            'section' => 'it_blogoptions',
            'class'   => 'grid-cols',
            'choices' => array(
            '6' => '2 Columns',
            '3' => '3 Columns',
            '4' => '4 Columns'
            )
        );
        $this->settings['blog_sidebar'] = array(
            'title'   => __( 'Blog Sidebar','itrays' ),
            'desc'    => __( 'Full width or with sidebar ?','itrays' ),
            'std'     => 'right',
            'type'    => 'select',
            'section' => 'it_blogoptions',
            'class'   => 'layout-content',
            'choices' => array(
            'right' => 'Right Sidebar',
            'left' => 'Left Sidebar',
            'nobar'  => 'No Sidebar'
            )
        );
        $this->settings['blog_image_size'] = array(
            'title'   => __( 'Blog Featured Image Size','itrays' ),
            'desc'    => __( 'Select your prefered Blog Featured Image Size.','itrays' ),
            'std'     => 'blog-large-image',
            'type'    => 'select',
            'section' => 'it_blogoptions',
            'class'   => '',
            'choices' => array(
            'thumbnail' => 'Thumbnail - 150x150',
            'medium' => 'Medium - 300x300',
            'large' => 'Large - 1024x1024',
            'blog-large-image' => 'Blog Large Image - 1170x470',
            'full' => 'Original Size'
            )
        );
        /*$this->settings['excerpt_length'] = array(
            'section' => 'it_blogoptions',
            'title'   => __( 'Excerpt Length','itrays' ),
            'desc'    => __( 'Insert the number of words you want to show in the post excerpts..','itrays' ),
            'type'    => 'number',
            'std'     => '150'
        );*/
        $this->settings['pager_type'] = array(
            'title'   => __( 'Pager Type','itrays' ),
            'desc'    => __( 'Select your prefered pager style.','itrays' ),
            'std'     => '1',
            'type'    => 'select',
            'section' => 'it_blogoptions',
            'class'   => 'pager-type',
            'choices' => array(
            '1' => 'Numeric + Navigation',
            '2' => 'Older Newer',
            '3' => 'Load More Button'
            )
        );
        $this->settings['pager_style'] = array(
            'title'   => __( 'Numeric + Navigation Pager Style','itrays' ),
            'desc'    => __( 'Select your prefered pager style for only Numeric + Navigation Pager.','itrays' ),
            'std'     => '1',
            'type'    => 'select',
            'section' => 'it_blogoptions',
            'class'   => 'pager-style',
            'choices' => array(
            '1' => 'Skew Links',
            '2' => 'Grey round',
            '3' => 'Diamond',
            '4' => 'White round',
            '5' => 'Bottom Border',
            '6' => 'White Circle'
            )
        );
        $this->settings['pager_position'] = array(
            'title'   => __( 'Numeric + Navigation Pager Position','itrays' ),
            'desc'    => __( 'Select pager position for only Numeric + Navigation Pager.','itrays' ),
            'std'     => 'centered',
            'type'    => 'select',
            'section' => 'it_blogoptions',
            'class'   => 'pager-position',
            'choices' => array(
            'left' => 'Left',
            'centered' => 'Center',
            'right' => 'Right'
            )
        );
        $this->settings['blog_single_heading'] = array(
            'section' => 'it_blogoptions',
            'title'   => '',
            'desc'    => __( 'Single blog post page settings','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['singlepostimg_on'] = array(
            'section' => 'it_blogoptions',
            'title'   => __( 'Show Post Image','itrays' ),
            'desc'    => __( 'check this if you need to Show Post image.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['singlepostimg_size'] = array(
            'title'   => __( 'Blog Single Featured Image Size','itrays' ),
            'desc'    => __( 'Select your prefered Blog Single Featured Image Size.','itrays' ),
            'std'     => 'blog-large-image',
            'type'    => 'select',
            'section' => 'it_blogoptions',
            'class'   => '',
            'choices' => array(
            'thumbnail' => 'Thumbnail - 150x150',
            'medium' => 'Medium - 300x300',
            'large' => 'Large - 1024x1024',
            'blog-large-image' => 'Blog Large Image - 1170x470',
            'full' => 'Original Size'
            )
        );
        $this->settings['singledate_on'] = array(
            'section' => 'it_blogoptions',
            'title'   => __( 'Show Date','itrays' ),
            'desc'    => __( 'check this if you need to Show Date.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['singleauthor_on'] = array(
            'section' => 'it_blogoptions',
            'title'   => __( 'Show By Author','itrays' ),
            'desc'    => __( 'check this if you need to Show Author info.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['singlecategory_on'] = array(
            'section' => 'it_blogoptions',
            'title'   => __( 'Show Category','itrays' ),
            'desc'    => __( 'check this if you need to Show category.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['singlecontent_on'] = array(
            'section' => 'it_blogoptions',
            'title'   => __( 'Show Post Content','itrays' ),
            'desc'    => __( 'check this if you need to Show Post content.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['singletags_on'] = array(
            'section' => 'it_blogoptions',
            'title'   => __( 'Show Tags','itrays' ),
            'desc'    => __( 'check this if you need to Show Tags.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['singlesocial_on'] = array(
            'section' => 'it_blogoptions',
            'title'   => __( 'Show Social Sharing options','itrays' ),
            'desc'    => __( 'check this if you need to Show Social Sharing options.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['singleprevnext_on'] = array(
            'section' => 'it_blogoptions',
            'title'   => __( 'Show Post navigation','itrays' ),
            'desc'    => __( 'check this if you need to show Previous/Next post navigation.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['singlecomment_on'] = array(
            'section' => 'it_blogoptions',
            'title'   => __( 'Show Comments','itrays' ),
            'desc'    => __( 'check this if you need to Show Comments.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        $this->settings['singlerelated_on'] = array(
            'section' => 'it_blogoptions',
            'title'   => __( 'Show Related Posts','itrays' ),
            'desc'    => __( 'check this if you need to Show Related Posts.','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1'
        );
        
        /* SideBars.
        ============================================*/
        $this->settings['sidebars'] = array(
            'section' => 'it_sidebars',
            'title'   => __( 'sidebars','itrays' ),
            'desc'    => __( 'Add unlimited sidebars the go to <a href="widgets.php">Widgets</a> to add widgets for it.','itrays' ),
            'type'    => 'sidebars',
            'std'     => ''
        );

        /* Social icons.
        ============================================*/
        $this->settings['social_facebook'] = array(
            'title'   => __( 'Facebook','itrays' ),
            'desc'    => __( 'Facebook link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_twitter'] = array(
            'title'   => __( 'Twitter','itrays' ),
            'desc'    => __( 'Twitter link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_linkedin'] = array(
            'title'   => __( 'LinkedIn','itrays' ),
            'desc'    => __( 'LinkedIn link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_google-plus'] = array(
            'title'   => __( 'Google+','itrays' ),
            'desc'    => __( 'Google+ link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_skype'] = array(
            'title'   => __( 'Skype','itrays' ),
            'desc'    => __( 'Skype link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_rss'] = array(
            'title'   => __( 'RSS','itrays' ),
            'desc'    => __( 'RSS link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_youtube'] = array(
            'title'   => __( 'Youtube','itrays' ),
            'desc'    => __( 'Youtube link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_vimeo-square'] = array(
            'title'   => __( 'Vimeo','itrays' ),
            'desc'    => __( 'Vimeo link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_yahoo'] = array(
            'title'   => __( 'Yahoo','itrays' ),
            'desc'    => __( 'Yahoo link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_dropbox'] = array(
            'title'   => __( 'Dropbox','itrays' ),
            'desc'    => __( 'Dropbox link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_soundcloud'] = array(
            'title'   => __( 'Soundcloud','itrays' ),
            'desc'    => __( 'Soundcloud link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_dribbble'] = array(
            'title'   => __( 'Dribbble','itrays' ),
            'desc'    => __( 'Dribbble link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_instagram'] = array(
            'title'   => __( 'Instagram','itrays' ),
            'desc'    => __( 'Instagram link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_flickr'] = array(
            'title'   => __( 'Flickr','itrays' ),
            'desc'    => __( 'Flickr link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_github'] = array(
            'title'   => __( 'Github','itrays' ),
            'desc'    => __( 'Github link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_tumblr'] = array(
            'title'   => __( 'Tumblr','itrays' ),
            'desc'    => __( 'Tumblr link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_pinterest'] = array(
            'title'   => __( 'Pinterest','itrays' ),
            'desc'    => __( 'Pinterest link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_paypal'] = array(
            'title'   => __( 'Paypal','itrays' ),
            'desc'    => __( 'Paypal link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_vk'] = array(
            'title'   => __( 'VK','itrays' ),
            'desc'    => __( 'VK link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_behance'] = array(
            'title'   => __( 'behance','itrays' ),
            'desc'    => __( 'behance link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_xing'] = array(
            'title'   => __( 'Xing','itrays' ),
            'desc'    => __( 'Xing link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_whatsapp'] = array(
            'title'   => __( 'whatsApp','itrays' ),
            'desc'    => __( 'whatsApp link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_digg'] = array(
            'title'   => __( 'digg','itrays' ),
            'desc'    => __( 'digg link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        $this->settings['social_deviantart'] = array(
            'title'   => __( 'deviantart','itrays' ),
            'desc'    => __( 'deviantart link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_socialicons'
        );
        
        /* woocommerce
        ===========================================*/
        $this->settings['show_sidebar_woo'] = array(
            'section' => 'it_woocommerce',
            'title'   => __( 'Show Side Bar','itrays' ),
            'type'    => 'checkbox',
            'std'     => '',
            'class'   => '',
            'desc'    => __( 'Check this box to show / hide side bar in the woocommerce page.','itrays' )
        );
        $this->settings['sidebar_position_woo'] = array(
            'title'   => __( 'Sidebar Position','itrays' ),
            'desc'    => __( 'Select the position of the sidebar.','itrays' ),
            'std'     => 'right',
            'type'    => 'select',
            'section' => 'it_woocommerce',
            'class'   => '',
            'choices' => array(
            'right' => 'Right',
            'left' => 'Left'
            )
        );
        $this->settings['columns_woo'] = array(
            'title'   => __( 'Products Columns','itrays' ),
            'desc'    => __( 'Select the number of columns per row.','itrays' ),
            'std'     => '4',
            'type'    => 'select',
            'section' => 'it_woocommerce',
            'class'   => '',
            'choices' => array(
            '6' => '2 Columns',
            '4' => '3 Columns',
            '3' => '4 Columns'
            )
        );
        $this->settings['pager_style_woo'] = array(
            'title'   => __( 'Pager Style','itrays' ),
            'desc'    => __( 'Select your prefered pager style.','itrays' ),
            'std'     => '1',
            'type'    => 'select',
            'section' => 'it_woocommerce',
            'class'   => 'pager-style',
            'choices' => array(
            '1' => 'Skew Links',
            '2' => 'Grey round',
            '3' => 'Diamond',
            '4' => 'White round',
            '5' => 'Bottom Border',
            '6' => 'White Circle'
            )
        );
        $this->settings['pager_position_woo'] = array(
            'title'   => __( 'Pager Position','itrays' ),
            'desc'    => __( 'Select pager position for Pager.','itrays' ),
            'std'     => 'centered',
            'type'    => 'select',
            'section' => 'it_woocommerce',
            'class'   => 'pager-position',
            'choices' => array(
            'left' => 'Left',
            'centered' => 'Center',
            'right' => 'Right'
            )
        );
        
        $this->settings['product_single_heading'] = array(
            'section' => 'it_woocommerce',
            'title'   => '',
            'desc'    => __( 'Single Product page settings','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        
        $this->settings['show_sidebar_single_woo'] = array(
            'section' => 'it_woocommerce',
            'title'   => __( 'Show Side Bar ?','itrays' ),
            'type'    => 'checkbox',
            'std'     => '',
            'class'   => '',
            'desc'    => __( 'Check this box to show / hide side bar in the single product details page.','itrays' )
        );
        
        $this->settings['single_sidebar_position_woo'] = array(
            'title'   => __( 'Sidebar Position','itrays' ),
            'desc'    => __( 'Select the position of the sidebar in single product details page.','itrays' ),
            'std'     => 'right',
            'type'    => 'select',
            'section' => 'it_woocommerce',
            'class'   => '',
            'choices' => array(
            'right' => 'Right',
            'left' => 'Left'
            )
        );
        
        /* bbpress
        ===========================================*/
        $this->settings['show_sidebar_bb'] = array(
            'section' => 'it_bbpress',
            'title'   => __( 'Show Side Bar','itrays' ),
            'type'    => 'checkbox',
            'std'     => '',
            'class'   => '',
            'desc'    => __( 'Check this box to show / hide side bar in the forums page.','itrays' )
        );
        $this->settings['sidebar_position_bb'] = array(
            'title'   => __( 'Sidebar Position','itrays' ),
            'desc'    => __( 'Select the position of the sidebar.','itrays' ),
            'std'     => 'right',
            'type'    => 'select',
            'section' => 'it_bbpress',
            'class'   => '',
            'choices' => array(
            'right' => 'Right',
            'left' => 'Left'
            )
        );
        $this->settings['pager_style_bb'] = array(
            'title'   => __( 'Pager Style','itrays' ),
            'desc'    => __( 'Select your prefered pager style.','itrays' ),
            'std'     => '1',
            'type'    => 'select',
            'section' => 'it_bbpress',
            'class'   => 'pager-style',
            'choices' => array(
            '1' => 'Skew Links',
            '2' => 'Grey round',
            '3' => 'Diamond',
            '4' => 'White round',
            '5' => 'Bottom Border',
            '6' => 'White Circle'
            )
        );
        $this->settings['pager_position_bb'] = array(
            'title'   => __( 'Pager Position','itrays' ),
            'desc'    => __( 'Select pager position for Pager.','itrays' ),
            'std'     => 'centered',
            'type'    => 'select',
            'section' => 'it_bbpress',
            'class'   => 'pager-position',
            'choices' => array(
            'left' => 'Left',
            'centered' => 'Center',
            'right' => 'Right'
            )
        );
        $this->settings['show_welcome_bb'] = array(
            'section' => 'it_bbpress',
            'title'   => __( 'Show Welcome message','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1',
            'class'   => '',
            'desc'    => __( 'Check this box to show / hide the top welcome message in forums page.','itrays' )
        );
        $this->settings['welcome_bb'] = array(
            'section' => 'it_bbpress',
            'title'   => __( 'Welcome Message','itrays' ),
            'desc'    => __( 'Insert here the welcome message that will appear in the top of the forums.','itrays' ),
            'multilang' => true,
            'type'    => 'editor',
            'std'     => 'Welcome to our Forums! We love to have you part of our friendly community, discovering the best in everything. As a member, the system will remember where you left off in threads and with sufficient post count.'
        );
        $this->settings['enable_icon_bb'] = array(
            'section' => 'it_bbpress',
            'title'   => __( 'Enable Forum Icons','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1',
            'class'   => '',
            'desc'    => __( 'Check this box to enable / disable the forum icon that appear on the left of each forum.','itrays' )
        );
        
        /* buddypress
        ===========================================*/
        $this->settings['show_sidebar_bp'] = array(
            'section' => 'it_buddypress',
            'title'   => __( 'Show Side Bar','itrays' ),
            'type'    => 'checkbox',
            'std'     => '',
            'class'   => '',
            'desc'    => __( 'Check this box to show / hide side bar in the buddypress page.','itrays' )
        );
        $this->settings['sidebar_position_bp'] = array(
            'title'   => __( 'Sidebar Position','itrays' ),
            'desc'    => __( 'Select the position of the sidebar.','itrays' ),
            'std'     => 'right',
            'type'    => 'select',
            'section' => 'it_buddypress',
            'class'   => '',
            'choices' => array(
            'right' => 'Right',
            'left' => 'Left'
            )
        );
        
        /* Downloads
        ===========================================*/
        $this->settings['show_sidebar_edd'] = array(
            'section' => 'it_downloads',
            'title'   => __( 'Show Side Bar','itrays' ),
            'type'    => 'checkbox',
            'std'     => '',
            'class'   => '',
            'desc'    => __( 'Check this box to show / hide side bar in the downloads page.','itrays' )
        );
        $this->settings['sidebar_position_edd'] = array(
            'title'   => __( 'Sidebar Position','itrays' ),
            'desc'    => __( 'Select the position of the sidebar.','itrays' ),
            'std'     => 'right',
            'type'    => 'select',
            'section' => 'it_downloads',
            'class'   => '',
            'choices' => array(
            'right' => 'Right',
            'left' => 'Left'
            )
        );
        $this->settings['columns_edd'] = array(
            'title'   => __( 'downloads Columns','itrays' ),
            'desc'    => __( 'Select the number of columns per row.','itrays' ),
            'std'     => '4',
            'type'    => 'select',
            'section' => 'it_downloads',
            'class'   => '',
            'choices' => array(
            '6' => '2 Columns',
            '4' => '3 Columns',
            '3' => '4 Columns'
            )
        );
        $this->settings['pager_style_edd'] = array(
            'title'   => __( 'Pager Style','itrays' ),
            'desc'    => __( 'Select your prefered pager style.','itrays' ),
            'std'     => '1',
            'type'    => 'select',
            'section' => 'it_downloads',
            'class'   => 'pager-style',
            'choices' => array(
            '1' => 'Skew Links',
            '2' => 'Grey round',
            '3' => 'Diamond',
            '4' => 'White round',
            '5' => 'Bottom Border',
            '6' => 'White Circle'
            )
        );
        $this->settings['pager_position_edd'] = array(
            'title'   => __( 'Pager Position','itrays' ),
            'desc'    => __( 'Select pager position for Pager.','itrays' ),
            'std'     => 'centered',
            'type'    => 'select',
            'section' => 'it_downloads',
            'class'   => 'pager-position',
            'choices' => array(
            'left' => 'Left',
            'centered' => 'Center',
            'right' => 'Right'
            )
        );
        
        /* Contact
        ===========================================*/
        $this->settings['contact_style'] = array(
            'title'   => __( 'Contact us style','itrays' ),
            'desc'    => __( 'Select your prefered contact us page style.','itrays' ),
            'std'     => '1',
            'type'    => 'select',
            'section' => 'it_contact',
            'class'   => 'contact-style',
            'choices' => array(
            '1' => 'Contact style 1',
            '2' => 'Contact style 2',
            '3' => 'Contact style 3',
            '4' => 'Contact style 4'
            )
        );
        
        /*$this->settings['latitude'] = array(
            'title'   => __( 'Latitude ','itrays' ),
            'desc'    => __( 'insert your latitude .','itrays' ),
            'std'     => '40.805478',
            'type'    => 'text',
            'section' => 'it_contact'
        );
        $this->settings['longitude'] = array(
            'title'   => __( 'Longitude','itrays' ),
            'desc'    => __( 'insert your longitude.','itrays' ),
            'std'     => '-73.96522499999998',
            'type'    => 'text',
            'section' => 'it_contact'
        ); */
        $this->settings['contact_decription'] = array(
            'section' => 'it_contact',
            'title'   => __( 'Contact description','itrays' ),
            'desc'    => __( 'Insert here the contact description text.','itrays' ),
            'multilang' => true,
            'type'    => 'editor',
            'std'     => 'Lorem ipsum dolor sit amet, co sectetur adipiscing elit. Nullam convallis euismod mollis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nlis euismod mollis. Nullam convallis euismod mollis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nlis euismod mollis.Lorem ipsum dolor sit amet, co sectetur adipiscing elit. Nullam convallis euismod mollis.'
        );
        $this->settings['map_heading'] = array(
            'section' => 'it_contact',
            'title'   => '',
            'desc'    => __( 'Google Map Settings','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['show_googlemap'] = array(
            'section' => 'it_contact',
            'title'   => __( 'Show Google Map','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1',
            'class'   => '',
            'desc'    => __( 'Check this box to show / hide the google map in the contact page.','itrays' )
        );
        $this->settings['map_height'] = array(
            'title'   => __( 'Map Height','itrays' ),
            'desc'    => __( 'enter google map height in pixels (only numbers allowed).','itrays' ),
            'std'     => '450',
            'type'    => 'number',
            'section' => 'it_contact'
        );
        $this->settings['scrollwheel'] = array(
            'section' => 'it_contact',
            'title'   => __( 'scrollwheel','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1',
            'class'   => '',
            'desc'    => __( 'Check this box to enable/disable scrollwheel on the google map.','itrays' )
        );
        $this->settings['contact_details_heading'] = array(
            'section' => 'it_contact',
            'title'   => '',
            'desc'    => __( 'Contact Locations','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        
        $this->settings['locations'] = array(
            'section' => 'it_contact',
            'title'   => __( 'Office','itrays' ),
            'desc'    => __( 'Add unlimited offices.','itrays' ),
            'type'    => 'locations',
            'class'   => 'cont_locs',
            'std'     => '0'
        );
        for($i = 0; $i < get_txt() ; ++$i){
            $g = $i+1;
            $this->settings['office_location'.$g] = array(
                'title'   => __( 'Office '.$g.' Location','itrays' ),
                'desc'    => __( 'Office '.$g.' Location.','itrays' ),
                'std'     => '',
                'type'    => 'text',
                'multilang' => true, 
                'group'     => 'contact_'.$g,
                'section' => 'it_contact'
            );
            $this->settings['office_address'.$g] = array(
                'title'   => __( 'Office '.$g.' Address','itrays' ),
                'desc'    => __( 'Office '.$g.' Address.','itrays' ),
                'std'     => '',
                'type'    => 'text',
                'multilang' => true,     
                'group'     => 'contact_'.$g,
                'section' => 'it_contact'
            );
            $this->settings['office_email'.$g] = array(
                'title'   => __( 'Office '.$g.' Email','itrays' ),
                'desc'    => __( 'Office '.$g.' Email.','itrays' ),
                'std'     => '',
                'type'    => 'text',      
                'group'     => 'contact_'.$g,
                'section' => 'it_contact'
            );
            $this->settings['office_phone'.$g] = array(
                'title'   => __( 'Office '.$g.' Phone','itrays' ),
                'desc'    => __( 'Office '.$g.' Phone.','itrays' ),
                'std'     => '',
                'type'    => 'text',       
                'group'     => 'contact_'.$g,
                'section' => 'it_contact'
            );
            $this->settings['office_fax'.$g] = array(
                'title'   => __( 'Office '.$g.' FAX','itrays' ),
                'desc'    => __( 'Office '.$g.' FAX.','itrays' ),
                'std'     => '',
                'type'    => 'text',       
                'group'     => 'contact_'.$g,
                'section' => 'it_contact'
            );
            $this->settings['office_latitude'.$g] = array(
                'title'   => __( 'Latitude ','itrays' ),
                'desc'    => __( 'insert your latitude .','itrays' ),
                'std'     => '',
                'type'    => 'text',
                'group'     => 'contact_'.$g,
                'section' => 'it_contact'
            );
            $this->settings['office_longitude'.$g] = array(
                'title'   => __( 'Longitude','itrays' ),
                'desc'    => __( 'insert your longitude.','itrays' ),
                'std'     => '',
                'type'    => 'text',
                'group'     => 'contact_'.$g,
                'section' => 'it_contact'
            );
        }
        
        /* Coming Soon
        ===========================================*/
        /*$this->settings['soon_style'] = array(
            'title'   => __( 'Coming Soon style','itrays' ),
            'desc'    => __( 'Select your prefered Coming Soon style.','itrays' ),
            'std'     => '1',
            'type'    => 'select',
            'section' => 'it_soon',
            'class'   => 'soon-style',
            'choices' => array(
            '1' => 'Coming Soon 1',
            '2' => 'Coming Soon 2',
            '3' => 'Coming Soon 3',
            '4' => 'Coming Soon 4'
            )
        ); */
        $this->settings['soon-settings'] = array(
            'section' => 'it_soon',
            'title'   => '',
            'desc'    => __( 'Page Settings','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['show_page_head'] = array(
            'section' => 'it_soon',
            'title'   => __( 'Show Default Page Header','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1',
            'class'   => '',
            'desc'    => __( 'Check this box to show / hide default page header.','itrays' )
        );
        $this->settings['soon_large_heading'] = array(
            'title'   => __( 'Large Heading ','itrays' ),
            'desc'    => __( 'insert large heading at the top of the page .','itrays' ),
            'std'     => 'Hello',
            'type'    => 'text',
            'multilang' => true,
            'section' => 'it_soon'
        );
        $this->settings['soon_lg_head_color'] = array(
            'title'   => __( 'Large Heading color','itrays' ),
            'desc'    => __( 'Choose a solid color for the coming soon Large Heading color','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_soon',
            'class'   => '',
            'defcolor' => '#ffffff'
        );
        $this->settings['soon_decription'] = array(
            'section' => 'it_soon',
            'title'   => __( 'Description','itrays' ),
            'desc'    => __( 'Insert here the description text.','itrays' ),
            'multilang' => true,
            'type'    => 'editor',
            'std'     => '  The Site is Under Construction and we will Reach you very soon,<br>Please stay tuned do not miss the Event.'
        );
        $this->settings['soon_desc_color'] = array(
            'title'   => __( 'Description color','itrays' ),
            'desc'    => __( 'Choose a solid color for the coming soon Description color','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_soon',
            'class'   => '',
            'defcolor' => '#ffffff'
        );
        $this->settings['show_count_down'] = array(
            'section' => 'it_soon',
            'title'   => __( 'Show Counter','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1',
            'class'   => '',
            'desc'    => __( 'Check this box to show / hide count-down timer.','itrays' )
        );
        $this->settings['soon_date'] = array(
            'title'   => __( 'Date','itrays' ),
            'desc'    => __( 'enter date with format: year/month/day. Ex: 2020/10/20','itrays' ),
            'std'     => '2020/10/20',
            'type'    => 'text',
            'class'   => 'date-soon',
            'section' => 'it_soon'
        );
        $this->settings['digits_bg'] = array(
            'section' => 'it_soon',
            'title'   => __( 'Digits Background Image','itrays' ),
            'desc'    => __( 'Select an image or insert an image url to use for the coming soon main digits background.','itrays' ),
            'type'    => 'file',
            'std'     => ''
        );
        $this->settings['digits_color'] = array(
            'section' => 'it_soon',
            'title'   => __( 'Digits color','itrays' ),
            'desc'    => __( 'Choose a solid color for the coming soon Digits color.','itrays' ),
            'type'    => 'color',
            'section' => 'it_soon',
            'class'   => '',
            'defcolor' => '#ffffff'
        );
        $this->settings['soon_count_color'] = array(
            'title'   => __( 'Digits Bottom text color','itrays' ),
            'desc'    => __( 'Choose a solid color for the coming soon Digits Bottom text color','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_soon',
            'class'   => '',
            'defcolor' => '#ffffff'
        );
        $this->settings['soon-socials-styling'] = array(
            'section' => 'it_soon',
            'title'   => '',
            'desc'    => __( 'Social Icons','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['show_social_links'] = array(
            'section' => 'it_soon',
            'title'   => __( 'Show Social Links','itrays' ),
            'type'    => 'checkbox',
            'std'     => '1',
            'class'   => '',
            'desc'    => __( 'Check this box to show / hide the social links.','itrays' )
        );
        $this->settings['soon_facebook'] = array(
            'title'   => __( 'Facebook','itrays' ),
            'desc'    => __( 'Facebook link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_soon'
        );
        $this->settings['soon_twitter'] = array(
            'title'   => __( 'Twitter','itrays' ),
            'desc'    => __( 'Twitter link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_soon'
        );
        $this->settings['soon_linkedin'] = array(
            'title'   => __( 'LinkedIn','itrays' ),
            'desc'    => __( 'LinkedIn link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_soon'
        );
        $this->settings['soon_google-plus'] = array(
            'title'   => __( 'Google+','itrays' ),
            'desc'    => __( 'Google+ link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_soon'
        );
        $this->settings['soon_skype'] = array(
            'title'   => __( 'Skype','itrays' ),
            'desc'    => __( 'Skype link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_soon'
        );
        $this->settings['soon_rss'] = array(
            'title'   => __( 'RSS','itrays' ),
            'desc'    => __( 'RSS link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_soon'
        );
        $this->settings['soon_youtube'] = array(
            'title'   => __( 'Youtube','itrays' ),
            'desc'    => __( 'Youtube link.','itrays' ),
            'std'     => '',
            'type'    => 'text',
            'section' => 'it_soon'
        );
        $this->settings['soon_socials_bgcolor'] = array(
            'title'   => __( 'Social icons Hover Background color','itrays' ),
            'desc'    => __( 'Choose a solid color for the coming soon Social icons Background color','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_soon',
            'class'   => '',
            'defcolor' => '#ffffff'
        );
        $this->settings['soon_socials_hoverbgcolor'] = array(
            'title'   => __( 'Social icons Hover Background color','itrays' ),
            'desc'    => __( 'Choose a solid color for the coming soon Social icons Hover Background color','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_soon',
            'class'   => '',
            'defcolor' => '#ffffff'
        );
        $this->settings['soon_socials_color'] = array(
            'title'   => __( 'Social icons color','itrays' ),
            'desc'    => __( 'Choose a solid color for the coming soon Social icons color','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_soon',
            'class'   => '',
            'defcolor' => '#ffffff'
        );
        $this->settings['soon_socials_border'] = array(
            'title'   => __( 'Social icons Border color','itrays' ),
            'desc'    => __( 'Choose a solid color for the coming soon Social icons Border color','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_soon',
            'class'   => '',
            'defcolor' => '#E4E4E4'
        );
        $this->settings['soon-styling'] = array(
            'section' => 'it_soon',
            'title'   => '',
            'desc'    => __( 'Coming Soon Styling','itrays' ),
            'type'    => 'heading',
            'std'     => '',
            'class'   => 'accordion'
        );
        $this->settings['soon_bgcolor'] = array(
            'title'   => __( 'background color','itrays' ),
            'desc'    => __( 'Choose a solid color for the coming soon main container background','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_soon',
            'class'   => '',
            'defcolor' => '#f4f4f4'
        );
        $this->settings['soon_bg'] = array(
            'section' => 'it_soon',
            'title'   => __( 'Background Image','itrays' ),
            'desc'    => __( 'Select an image or insert an image url to use for the coming soon main container background.','itrays' ),
            'type'    => 'file',
            'std'     => ''
        );
        $this->settings['soon_bg_full_width'] = array(
            'section' => 'it_soon',
            'title'   => __( '100% Background Image','itrays' ),
            'desc'    => __( 'Check this box to have the top bar background image display at 100% in width and height and scale according to the browser size.','itrays' ),
            'type'    => 'checkbox',
            'std'     => ''
        );
        $this->settings['soon_bg_repeat'] = array(
            'title'   => __( 'Background repeat','itrays' ),
            'desc'    => __( 'Select how the background image repeats.','itrays' ),
            'std'     => '',
            'type'    => 'select',
            'section' => 'it_soon',
            'class'   => '',
            'choices' => array(
            'no-repeat' => 'no-repeat',
            'repeat' => 'repeat',
            'repeat-x' => 'repeat-x',
            'repeat-y' => 'repeat-y'
            )
        );
        $this->settings['soon_bg_img_parallax'] = array(
            'title'   => __( 'Fixed Background','itrays' ),
            'desc'    => __( 'Please choose parallax effect for the backgroud.','itrays' ),
            'std'     => '',
            'type'    => 'checkbox',
            'section' => 'it_soon',
            'class'   => ''
        );
        $this->settings['soon_overlay'] = array(
            'title'   => __( 'overlay color','itrays' ),
            'desc'    => __( 'Choose a solid color for the coming soon main container overlay color','itrays' ),
            'std'     => '',
            'type'    => 'color',
            'section' => 'it_soon',
            'class'   => '',
            'defcolor' => ''
        );
        $this->settings['soon_overlay_trans'] = array(
            'title'   => __( 'Background Opacity','itrays' ),
            'desc'    => __( 'type the opacity level you want the background of coming soon main container overlay color. between (0 lowest to 1 Heighest)','itrays' ),
            'std'     => '0.7',
            'type'    => 'text',
            'section' => 'it_soon'
        );
        
         /* Import Export theme Options
        ===========================================*/
        /*$this->settings['import_options'] = array(
            'section' => 'it_options',
            'title'   => __( 'Import Theme Options','itrays' ),
            'type'    => 'import',
            'std'     => '',
            'class'   => '',
            'desc'    => __( 'import data.','itrays' )
        );
        $this->settings['export_options'] = array(
            'section' => 'it_options',
            'title'   => __( 'Export Theme Options','itrays' ),
            'type'    => 'export',
            'std'     => '',
            'class'   => '',
            'desc'    => __( 'Export data.','itrays' )
        );   */
        
        return $this->settings;
        
?>
