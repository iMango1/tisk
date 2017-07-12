<?php

require_once(FRAMEWORK_DIR."/classes/it-meta-boxes.class.php");
 
  /* Page Title Settings
  ============================================= */
  $title_box = array(
    'id'             => 'it_meta_page_title',
    'title'          => 'Page Title Settings',
    'fields'         => array(),
  );
  $page_title_meta =  new ITMetaBoxes($title_box);
  $page_title_meta->it_checkbox(
    'chck_custom_title',
    array(
        'name'=> 'Enable Custom Page Title',
        'desc'=> 'Check this to enable / disable custom page title.',
        'std'=>'0'
    )
  );
  $page_title_meta->it_select(
    'title_style',
    array(
        '0' => 'Choose Custom title style',
        '1' => 'Title 1 Light',
        '2' => 'Title 2 Dark',
        '3' => 'Title 3 Light + Icon',
        '4' => 'Title 4 Dark + Icon',
        '5' => 'Title 5 Light + Centered',
        '6' => 'Title 6 Dark + Centered',
        '7' => 'Title 7 Light + Centered + Icon',
        '8' => 'Title 8 Dark + Centered + Icon',
        '9' => 'Title 9 Light + Skew',
        '10' => 'Title 10 Dark + Skew'
    ),
    array(
        'name'=> 'Page Title Style ', 
        'std'=> array('0'),
        'desc'=> 'Select the page Title style.'
        )
    );
  
  $page_title_meta->it_textbox(
    'custom_title_txt',
    array(
        'name'=> 'Custom Title',
        'desc'=> 'Type here the custom page title that will replace the original one',
        'std'=>''
    )
  );
  $page_title_meta->it_textbox(
    'custom_subtitle',
    array(
        'name'=> 'Custom SubTitle',
        'desc'=> 'Extra subtitle field to represent more details about page.'
    )
  );
  
  $page_title_meta->it_textbox(
    'title_height',
    array(  
        'name'=> 'Page Title Height',
        'std'=>'',
        'desc'=> 'Insert here the new height for the page Title. Ex: 200px'
    )
  );
  
  $page_title_meta->it_color(
    'title_color',
    
    array(
        'name'=> 'Title Color',
        'desc'=> 'Select the page Title color.',
        'std'=>''
    )
  );
  $page_title_meta->it_color(
    'subtitle_color',
    array(
        'name'=> 'SubTitle Color ',
        'desc'=> 'Select the page sub Title color.',
        'std'=> ''
    )
  );
  $page_title_meta->it_icon(
    'title_icon',
    array(
        'name'=> 'Title Icon ',
        'desc'=> 'Select the page Title Icon.',
        'std'=> ''
    )
  );
  $page_title_meta->it_color(
        'title_bg_color',
    array(
        'name'=> 'Title Background Color',
        'desc'=> 'Select the page Title background color.',
        'std'=> ''
    )
  );
  $page_title_meta->it_uploadfile(
        'title_bg_img',
        array(
            'name'=> 'Background image',
            'desc'=> 'upload a background image or type an image URL in the textbox below.',
            'std'=>''
        )
  );
  $page_title_meta->it_select(
      'title_bg_repeat',
      array(
        'no-repeat'=>'No Repeat',
        'repeat-x'=>'Repeat Horizontal',
        'repeat-y'=>'Repeat Vertical',
        'repeat'=>'Repeat'),
        array(
            'name'=> 'Background Repeat',
            'desc'=> 'Choose the way that background image will be repeated.',
            'std'=> array('no-repeat')
        )
  );
  $page_title_meta->it_checkbox(
        'title_full_bg',
        array(
            'name'=> '100% background image ?',
            'desc'=> 'check this if you need the background to be 100% fittind all the title container.',
            'std'=>'0'
        )
  );
  $page_title_meta->it_checkbox(
        'title_fixed_bg',
        array(
            'name'=> 'Fixed Background ?',
            'desc'=> 'Check this if you need the background fixed while scrolling down the page.',
            'std'=>'0'
        )
  );
  $page_title_meta->it_color(
        'title_bg_overlay',
    array(
        'name'=> 'Overlay ?',
        'desc'=> 'An overlay will appear over the title background image or video.',
        'std'=> ''
    )
  );
  $page_title_meta->it_textbox(
        'title_bg_overlay_opacity',
    array(
        'name'=> 'Overlay Opacity',
        'desc'=> 'Numbers between 0 and 1 Ex: 0.5',
        'std'=> '0.5'
    )
  );
  $page_title_meta->it_checkbox(
        'chck_video_bg',
        array(
            'name'=> 'Video Background',
            'desc'=> 'Check this to be able to upload video background for the page title.',
            'std'=>'0'
        )
  );
  $page_title_meta->it_uploadfile(
        'video_mp4',
        array(
            'name'=> 'video/mp4',
            'desc'=> 'upload a background video MP4 or type a video URL in the textbox below.',
            'data-type'=> 'video',
            'std'=>''
        )
  );
  $page_title_meta->it_uploadfile(
        'video_webm',
        array(
            'name'=> 'video/webm',
            'desc'=> 'upload a background video webm or type a video URL in the textbox below.',
            'data-type'=> 'video',
            'std'=>''
        )
  );
  $page_title_meta->it_uploadfile(
        'video_ogv',
        array(
            'name'=> 'video/ogv',
            'desc'=> 'upload a background video ogv or type a video URL in the textbox below.',
            'data-type'=> 'video',
            'std'=>''
        )
  );
  
  
  /* Header Settings
  ============================================= */
  $header_box = array(
    'id'             => 'it_meta_head_options',
    'title'          => 'Header Settings',
    'fields'         => array(),
  );
  $header_meta =  new ITMetaBoxes($header_box);
  $header_meta->it_checkbox(
        'hide_header',
        array(
            'name'=> 'Hide Header',
            'desc'=> 'This will only hide the header in this page.',
            'std'=>'0'
        )
  );
  $header_meta->it_select(
    'meta_header_style',
    array(
        ''=> '-- Choose Header Style --',
        'header-1' => 'Header Style 1',
        'header-2' => 'Header Style 2',
        'header-3' => 'Header Style 3',
        'header-4' => 'Header Style 4',
        'header-5' => 'Header Style 5',
        'header-6' => 'Header Style 6',
        'header-7' => 'Header Style 7'
    ),
    array(
        'name'=> 'Header Style ', 
        'std'=> array('1'),
        'desc'=> 'Select different header style for this page.'
        )
  );
  $header_meta->it_uploadfile(
        'meta_header_banner',
        array(
            'name'=> 'header 7 Banner image',
            'desc'=> 'upload a Banner image or type an image URL in the textbox below.',
            'std'=>'',
            'class'=>'head-7-banner'
        )
  );
  $header_meta->it_textbox(
    'meta_header_banner_link',
    array(  
        'name'=> 'Header 7 Banner Link',
        'std'=>'',
        'desc'=> 'Insert here the LINK for the Banner. Ex: http://www.google.com',
        'class'=>'head-7-banner'
    )
  );
  $header_meta->it_checkbox(
        'hide_top_bar',
        array(
            'name'=> 'Hide Top Bar',
            'desc'=> 'This will only hide the Top Bar in this page.',
            'std'=>'0'
        )
  );
  $header_meta->it_checkbox(
        'hide_menu',
        array(
            'name'=> 'Hide Logo and Menu',
            'desc'=> 'This will only hide the Logo and Menu in this page.',
            'std'=>'0'
        )
  );
  $header_meta->it_checkbox(
        'hide_page_title',
        array(
            'name'=> 'Hide Page Title',
            'desc'=> 'This will only Hide the Page Title in this page.',
            'std'=>'0'
        )
  );
  
  
  
  /* Footer Settings
  ============================================= */
  $footer_box = array(
    'id'             => 'it_meta_foot_options',
    'title'          => 'Footer Settings',
    'fields'         => array(),
  );
  $footer_meta =  new ITMetaBoxes($footer_box);
  $footer_meta->it_checkbox(
        'hide_footer',
        array(
            'name'=> 'Hide Footer',
            'desc'=> 'This will only Hide the Footer in this page.',
            'std'=>'0'
        )
  );
  $footer_meta->it_select(
    'meta_footer_style',
    array(
        ''=> '-- Choose Footer Style --',
        '1' => 'Footer Style 1',
        '2' => 'Footer Style 2',
        '3' => 'Footer Style 3',
        '4' => 'Footer Style 4'
    ),
    array(
        'name'=> 'Footer Style', 
        'std'=> array(''),
        'desc'=> 'Select different header style for this page.'
        )
  );
  $footer_meta->it_checkbox(
        'hide_top_foot_bar',
        array(
            'name'=> 'Hide Top Footer Bar',
            'desc'=> 'This will only Hide the Top Footer Bar in this page.',
            'std'=>'0'
        )
  );
  $footer_meta->it_checkbox(
        'hide_foot_widgets',
        array(
            'name'=> 'Hide Footer Widgets',
            'desc'=> 'This will only Hide the Footer Widgets in this page.',
            'std'=>'0'
        )
  );
  $footer_meta->it_checkbox(
        'hide_bottom_foot_bar',
        array(
            'name'=> 'Hide Bottom Footer Bar',
            'desc'=> 'This will only Hide the Bottom Footer Bar in this page.',
            'std'=>'0'
        )
  ); 
