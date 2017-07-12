<?php 
header("Content-type: text/css");
define('WP_USE_THEMES', false);

$file = dirname(__FILE__);
$file = substr($file, 0, stripos($file, "wp-content") );
require( $file . "/wp-load.php");

function hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}
$hexStr = theme_option("skin_color");
$rgb = hex2RGB($hexStr, true, ',');

/************* Lighten - Darken the Hexa color FUNCTION *******************/
$originalColour = theme_option("skin_color");  
$darkestPercent = -8; 
$darkPercent = -5; 
$lightPercent = 5; 
$lightestPercent = 8; 

function colourCreator($colour, $per) {  
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

$darkestColour = colourCreator($originalColour, $darkestPercent);  
$darkColour = colourCreator($originalColour, $darkPercent); 
$lightColour = colourCreator($originalColour, $lightPercent);  
$lightestColour = colourCreator($originalColour, $lightestPercent);

?>


a,a:focus,a:hover,aside.sidebar .current-menu-item a, .top-search a, .main-color,.block-head.style2 span,.gform_title,.vc_custom_heading h3, .widget-head, footer a:hover, .title-2 .breadcrumbs a, .title-3 .breadcrumbs a, .title-4 .breadcrumbs a, .nav-3 .top-nav > ul > li.current-menu-parent > a, .nav-3 .top-nav > ul > li.current-menu-ancestor > a, .nav-3 .top-nav > ul > li.current-menu-item > a, .nav-3 .top-nav > ul > li.current_page_parent > a i,.nav-3 .top-nav > ul > li.current-menu-parent > a i,.nav-3 .top-nav > ul > li.current-menu-ancestor > a i, .nav-3 .top-nav > ul > li.current-menu-item > a i,.nav-3 .top-nav > ul > li.selected > a i,.nav-3 .top-nav > ul > li > a:hover i, .nav-3 .top-nav > ul > li > a:hover, .nav-3 .top-nav > ul > li.selected > a, .nav-3 .top-nav > ul > li.selected > a i, .footer-top a:hover:before, .list.prim li:before, #filters li a, .team-box-2 .t-position, .team-box-2 .team-socials a, .head-style3 .top-bar li a, .author-name, .add-items i.fa, .copyrights b, .dark-bg .btn-large:before, .box-top .more-btn, .icon-box-6:hover a, .box-top i.fa, .item-box:hover .item-tools i, .item-cart a:hover, .main-border, .fun-title, .staff-1 .fun-icon, .top-bar ul.social-list li a:hover span, .nav-2 .top-nav > ul > li > a:hover i, .nav-2 .top-nav > ul > li.current > a i, .nav-2 .top-nav > ul > li.selected > a i, .nav-2 .top-nav > ul > li.selected > a i, .project-name, .slick-dots li.slick-active button:before,.breadcrumbs.full a,.widget_display_replies ul li a.bbp-author-name,.widget-content a.btn, .widget-content a.button,
.order-info:before,.list.alt li:before,.product-price,.main-title, .wpb_accordion_wrapper .ui-state-active a, .wpb_accordion_wrapper .ui-state-active .ui-icon:before, .post-info h2 a:hover, .siteMap-nav ul ul li a:hover, .head2-lft-links li i, .head-style3 .top-bar li i, .item-tools i, .product-specs a.btn.selected,.widget-content a:hover,.block-head-News:hover,.block-head-News a span,.pager-style5 li span,
.activity-meta .unfav:before,.user-nicename ,.tp-caption.main-color *,.icon-box-7 h4,.head-7 .one-page .top-nav > ul > li.current-menu-parent > a,.head-7 .one-page .top-nav > ul > li.current-menu-ancestor > a, .head-7 .one-page .top-nav > ul > li.current-menu-item > a,.head-7 .one-page .top-nav > ul > li a:hover i,.head-7 .one-page .top-nav > ul > li.current-menu-parent > a i,.head-7 .one-page .top-nav > ul > li.current-menu-ancestor > a i, .head-7 .one-page .top-nav > ul > li.current-menu-item > a i{
    color: <?php echo esc_attr(theme_option('skin_color')); ?>;
}
.stickyHeader .top-nav > ul > li > a:hover,.gw-go-current .gw-go-earth1 .gw-go-coinf div,.gw-go-current .gw-go-earth1 .gw-go-coinb div,.one-page .current a span,
.gw-go-current .gw-go-earth2 .gw-go-coinf div,.gw-go-current .gw-go-earth2 .gw-go-header h3,.edd-cart-quantity,.edd_form fieldset legend,.main-col,.stickyHeader .top-nav > ul > li.current-menu-parent > a,
.stickyHeader .top-nav > ul > li.current-menu-ancestor > a,.stickyHeader .top-nav > ul > li.current-menu-item > a{
    color: <?php echo esc_attr(theme_option('skin_color')); ?> !important;
}
.main-bg, .top-nav > ul li a:hover, .top-nav > ul > li.selected > a, .top-search.selected a, .top-nav li.current-menu-item > a,.top-nav li.current_page_parent > a, .top-nav li.current-menu-parent > a, .top-nav li.current-menu-ancestor > a, .plan-year:after, .team-box-2:hover, .head-style3 .top-search a, .icon-box-6:hover .box-top, .top-nav-style3,.stickyHeader .top-search.selected > a, .item-box:hover .item-title, .tp-bullets.simplebullets.round .bullet, .top-nav li li a, .fixedHead .top-nav > ul > li > a:hover, .fixedHead .top-nav > ul > li.selected > a, .fixedHead .top-nav > ul > li.current > a, .top-search a:hover, .icon-box-7:hover a.r-more, .icon-box-8:hover a.r-more, .pager ul li.selected, .slick-prev:hover, .slick-next:hover, .social-list li a:hover, .footer-top .tagcloud a:hover, .divider-7:before, .divider-7:after, .tp-arr-allwrapper:hover, .level-in, .tabs-vertical .wpb_tour_tabs_wrapper .wpb_tab:before, .table-style2 th, .menuBtn, .icon-box-6:hover:after, .portfolio-item:hover:after, #filters li:hover, #filters li.active, .head-style2 .top-search a, .team-box .team-details, .tabs > ul li:hover, .tabs > ul li.active, .tabs > ul li.selected, .steps li.selected span, .icon-cont, .view-all-projects a:hover,.wpb_toggle_title_active a u,
.accordion-horizontal > li.active a, .list-grid a.selected, .testimonials-2 .slick-prev:hover, .testimonials-2 .slick-next:hover, .comment-reply:hover, .icon-box-7:hover .fa, .icon-box-8:hover .icon, .share-post ul li a:hover, .item-price, .accordion li.active h3 u, .pager ul li:hover, .tp-bullets.simplebullets.round .bullet:hover, .tp-bullets.simplebullets.round .bullet.selected, footer .NL .NL-btn:hover,.add-new,.bbp-reply-author .bbp-author-role,#bbpress-forums h3:after,#bbpress-forums h3:before,
.search-w .btn,.cart-icon,.on-sale,.widget_product_search #searchsubmit,.fixedPage:after,.edd_downloads_list .edd_download .edd_download_inner:after,.Newsslider .post-content a.read-more,.woocommerce .widget_price_filter .ui-slider-range,.btn-main-bg,
.wpb_content_element .wpb_tabs_nav li.ui-tabs-active, .wpb_content_element .wpb_tabs_nav li:hover,.block-head-News:hover .icon,
.stickyHeader .top-nav > ul > li.current-menu-parent > a:before,.stickyHeader .top-nav > ul > li.current-menu-ancestor > a:before,.stickyHeader .top-nav > ul > li.current-menu-item > a:before{
    background-color: <?php echo esc_attr(theme_option('skin_color')); ?>;
    color: #fff;
}
.flat-dark .esg-filterbutton:hover,#buddypress div.item-list-tabs ul li.current, #buddypress div.item-list-tabs ul li.selected, .flat-dark .esg-navigationbutton:hover, .flat-dark .esg-sortbutton:hover, .flat-dark .esg-cartbutton:hover,
.bbp-forum-info ul.bbp-forums-list li:hover,.page-numbers li.main-bg,.main-bg-import,.gw-go-current .gw-go-earth1 .gw-go-btn,.gw-go-current .gw-go-earth2 .gw-go-btn,.gw-go-current .gw-go-earth2 .gw-go-coinb div,.esg-filterbutton.selected,.pagination-links span,
.edd_downloads_list .edd_download .edd_download_inner .edd_purchase_submit_wrapper .edd-add-to-cart,.edd_downloads_list .edd_download:hover .edd_download_title a,.edd-cart-quantity {
    background-color: <?php echo esc_attr(theme_option('skin_color')); ?> !important;
    color: #fff !important;
}
.btn-outlined,
.btn-square_outlined {
  color: <?php echo esc_attr(theme_option('skin_color')); ?>;
  border-color:<?php echo esc_attr(theme_option('skin_color')); ?>
}
.pager-style4 li span {
  border-color:<?php echo esc_attr(theme_option('skin_color')); ?>
}
#buddypress #item-nav,.item-list-tabs,.Newsslider{
    border-bottom: 5px <?php echo esc_attr(theme_option('skin_color')); ?> solid;
}
li.bbp-body .type-topic,.head-7 .one-page .top-nav > ul > li > ul,.pager-style5 li span{
    border-bottom-width: 3px;
    border-bottom-color:<?php echo esc_attr(theme_option('skin_color')); ?>;
}
.on-sale:before{
    border-color: transparent <?php echo esc_attr(theme_option('skin_color')); ?> transparent transparent;
}
.item-box:hover:after, .item-box:hover .item-price, .team-box:hover:after, .team-box-2:hover:after, .responsive-nav, .search-box:before, .block-head:before, .block-head:after,.gform_title:before,.gform_title:after, .widget-head:before, .widget-head:after, .details-img:after, .post-image:after,.details-img:before,.post-image:before,
.team-box:after, .team-box-2:after, .item-box:after, .team-box .team-socials li a:hover, .icon-box-6:after, .portfolio-item:after,.wpb_heading:after,.wpb_heading:before,.vc_custom_heading h3:after,.vc_custom_heading h3:before,.edd_form fieldset legend:after,.edd_form fieldset legend:before {
    background-color: <?php echo esc_attr(theme_option('skin_color')); ?>;
}
.main-border,#buddypress div.activity-comments form textarea:focus,#buddypress #whats-new:focus,.wpb_accordion_wrapper .ui-state-active a,
.gw-go-current .gw-go-earth2,.wpb_toggle_title_active a,.vc_toggle_active .vc_toggle_title {
    border: 1px <?php echo esc_attr(theme_option('skin_color')); ?> solid !important;
}
.head-style3 .login-btn .tri,.one-page ul li.current:before,.head-7 .one-page .top-nav > ul > li > ul:after{
    border-color: <?php echo esc_attr(theme_option('skin_color')); ?> transparent transparent transparent;
}
.nav-3 .top-nav > ul > li.hasChildren > a:after,.stickyHeader .top-nav > ul > li > ul:after {
    border-color: transparent transparent <?php echo esc_attr(theme_option('skin_color')); ?> transparent !important;
}
.alter-border {
    border: 1px #e1e1e1 solid !important;
    color: #777;
}
.nav-3 .top-nav > ul > li.current-menu-parent > a,.nav-3 .top-nav > ul > li.current-menu-ancestor > a, .nav-3 .top-nav > ul > li.current-menu-item > a, .nav-3 .top-nav > ul > li.current_page_parent > a, .nav-3 .top-nav > ul > li > a:hover, .nav-3 .top-nav > ul > li > a:hover, .nav-3 .top-nav > ul > li.selected > a,.fixedPage,.top-bar .search-top .search-box {
    border-top-color: <?php echo esc_attr(theme_option('skin_color')); ?>;
}
.chosen-container .chosen-results li.highlighted{
    background:<?php echo esc_attr(theme_option('skin_color')); ?> !important
}
.item-box:hover .item-title,.edd_downloads_list .edd_download:hover .edd_download_title a {
    border-top: 1px <?php echo esc_attr(theme_option('skin_color')); ?> solid;
}
.tabs-pane,.wpb_content_element.wpb_tabs .wpb_tour_tabs_wrapper .wpb_tab  {
    border-top: 2px <?php echo esc_attr(theme_option('skin_color')); ?> solid;
}
blockquote {
    border-color: <?php echo esc_attr(theme_option('skin_color')); ?>;
}
.level-out .tr {
    border-right: 6px solid transparent;
    border-top: 6px solid transparent;
    border-left: 6px solid <?php echo esc_attr(theme_option('skin_color')); ?>;
    border-bottom: 6px solid <?php echo esc_attr(theme_option('skin_color')); ?>;
}
.icon-box-6:hover h3, .clients > div a:hover {
    border-bottom-color: <?php echo esc_attr(theme_option('skin_color')); ?>;
}
.one-page ul li.current {
    border-bottom: 2px <?php echo esc_attr(theme_option('skin_color')); ?> solid !important;
}
.icon-middle, .product-img li a.active img {
    border: 2px <?php echo esc_attr(theme_option('skin_color')); ?> solid;
}
.tri-col, .icon-cont:after {
    border-color: <?php echo esc_attr(theme_option('skin_color')); ?> transparent transparent transparent;
}
.head-style3 .top-bar,.footer-top-2,.mega-menu .mega-2 .div-mega {
    border-top: 5px <?php echo esc_attr(theme_option('skin_color')); ?> solid;
}
.steps li.selected span:after {
    border-left: 16px solid <?php echo esc_attr(theme_option('skin_color')); ?>;
}
.item-title {
    border-top: 1px #777 solid;
}
.product-specs a.btn.selected {
    border: 1px #777 solid !important;
}
.accordion li.active h3 u,.accordion li.active h3 a,.post-item.sticky .post-image a,.block-head.style7 {
    border-color: <?php echo esc_attr(theme_option('skin_color')); ?>;
}
.post-image a .mask {
    background: rgba(<?php echo $rgb; ?>,0.5);
}
.pricing-table.selected,.cart-popup {
    border-color: <?php echo esc_attr(theme_option('skin_color')); ?>;
}
.list-grid a.selected:after {
    border-color: <?php echo esc_attr(theme_option('skin_color')); ?> transparent transparent transparent;
}
.continue-btn .btn.right:after {
    border-left: 15px solid <?php echo esc_attr(theme_option('skin_color')); ?>;
}
.continue-btn .btn.right:hover:after {
    border-left: 15px solid <?php echo $darkestColour ?>;
}
.continue-btn .btn.left:after {
    border-right: 15px solid #777;
}
.continue-btn .btn.left:hover:after {
    border-right: 15px solid #666;
}
.accordion-horizontal li.active > h3 i.fa, .item-box:hover .item-title a, .breadcrumbs .line-separate {
    color: #fff;
}
.top-nav li li {
    border-bottom: 1px <?php echo $darkestColour ?> solid;
}
.mega-menu .mega-3 .div-mega{
    border: 10px <?php echo esc_attr(theme_option('skin_color')); ?> solid;
    padding:0px !important
}
.top-nav li li a:hover, .top-nav li li.selected > a, .top-nav li li.current_page_item > a, .responsive-nav ul li a:hover, .head-style1 .top-nav > ul > li > a:hover::after, .head-style1 .top-nav > ul > li.selected a:after,.head-style1 .top-nav > ul > li.current-menu-parent a:after, .head-style1 .top-nav > ul > li.current-menu-ancestor a:after, .head-style1 .top-nav > ul > li.current_page_parent a:after,.head-style1 .top-nav > ul > li.current-menu-item a:after,.widget_product_search #searchsubmit:hover {
    background-color: <?php echo $darkestColour ?> !important;
    color: #fff;
}
.btn-main-bg.btn-3d {
  -webkit-box-shadow: 0 5px 0 <?php echo $darkestColour ?>;
  box-shadow: 0 5px 0 <?php echo $darkestColour ?>;
  margin-bottom: 5px;
}
.btn.main-bg:hover,.btn-main-bg:hover, .team-box .team-socials li a,.share-post ul li a.main-bg:hover,.mega-menu div.div-mega > ul > li h4 a {
    background-color: <?php echo $darkestColour ?> !important;
    color: #fff;
}
.widget_it_widget_flickr .img-overlay {
    background: rgba(<?php echo $rgb; ?>,.7);
}
.esg-entry-cover .esg-overlay {
    background-color: rgba(<?php echo $rgb; ?>,0.85) !important;
}
.icon-box-6:hover p, .icon-box-6:hover i.fa {
    color: #fff;
}
.contact-form input[type=text]:focus, .contact-form input[type=password]:focus, .contact-form input[type=email]:focus, .contact-form textarea:focus,#bbpress-forums #bbp-your-profile fieldset input:focus, #bbpress-forums #bbp-your-profile fieldset textarea:focus, .contact-form input[type=url]:focus,
.wpcf7-form input[type=text]:focus, .wpcf7-form input[type=password]:focus, .wpcf7-form input[type=email]:focus, .wpcf7-form textarea:focus, .wpcf7-form input[type=url]:focus,.textArea:focus,
.gform_wrapper input[type=text]:focus, .gform_wrapper input[type=url]:focus, .gform_wrapper input[type=email]:focus, .gform_wrapper input[type=tel]:focus, .gform_wrapper input[type=number]:focus, .gform_wrapper input[type=password]:focus,.gform_wrapper textarea:focus{
    border: 1px <?php echo esc_attr(theme_option('skin_color')); ?> solid !important;
}
.img-over a.link, .block-bg-1:before, .block-bg-2:before, .block-bg-3:before, .block-bg-4:before, .block-bg-5:before {
    background-color: rgba(<?php echo $rgb; ?>,0.7);
}
.img-over a.zoom {
    background-color: rgba(119,119,119,0.7);
}
.level-in:before {
    border-color: transparent transparent transparent <?php echo esc_attr(theme_option('skin_color')); ?>;
}