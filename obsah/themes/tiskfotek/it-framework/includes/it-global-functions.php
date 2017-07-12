<?php
/**
 *
 * IT-RAYS Framework
 *
 * @author IT-RAYS
 * @license Commercial License
 * @link http://www.it-rays.com
 * @copyright 2015 IT-RAYS Themes
 * @package ITFramework
 * @version 1.0.0
 *
 */

if( ! function_exists( 'after_setup_theme' ) ) {
    function it_after_setup_theme() {
        if ( function_exists( 'add_theme_support' ) ) {
            add_theme_support( 'post-thumbnails' );
        }
        add_theme_support('automatic-feed-links');
        add_image_size( 'blog-large-image', 850, 300, true );
        
        // add theme support for wp 4.1 and higher.
        add_theme_support( "title-tag" );
        
        add_theme_support( 'html5', array(
            'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
        ));
        add_theme_support( 'post-formats', array(
            'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery', 'status', 'chat',
        ));
        
        add_theme_support( 'custom-background', apply_filters( 'it_custom_background_args', array(
            'default-color' => 'f5f5f5',
        ) ) );

        // Add support for featured content.
        add_theme_support( 'featured-content', array(
            'featured_content_filter' => 'it_get_featured_posts',
            'max_posts' => 6,
        ));

        add_theme_support('custom-header');
        add_theme_support( 'bbpress' );
        add_editor_style();
        define( 'HEADER_IMAGE_WIDTH', apply_filters( 'it_header_image_width', 1920 ) );
        define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'it_header_image_height', 320 ) );
        load_theme_textdomain( 'itrays', THEME_DIR . '/languages' );                     
    }
    add_action( 'after_setup_theme', 'it_after_setup_theme' );
}   
    
if ( ! function_exists( 'is_plugin_active' ) ) {
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
} 

// favicon wp hook
if ( theme_option('favicon') != null ) {
    add_action( 'wp_head', 'it_favicon');
    if( ! function_exists( 'it_favicon' ) ){
        function it_favicon(){
          echo "<link rel='shortcut icon' href='".esc_url(theme_option('favicon'))."' />";
        }
    }
    
}

// Remove all wp title filters
remove_all_filters('wp_title');

// vc column hack
if( ! function_exists( 'get_vc_it_column' ) ) {
  function get_vc_it_column( $width = '' ) {
    $width = explode('/', $width);
    $width = ( $width[0] != '1' ) ? $width[0] * floor(12 / $width[1]) : floor(12 / $width[1]);
    return  $width;
  }
}

// create function if vc is active.
if ( ! function_exists( 'vc_active' ) ) {
    function vc_active() {
        if ( class_exists( 'Vc_Manager' ) && defined( 'WPB_VC_VERSION' ) ) { return true; } else { return false; }
    }
}

// create function if woocommerce is active.
if ( ! function_exists( 'is_woocommerce_activated' ) ) {
    function is_woocommerce_activated() {
        if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
    }
} 

// Essential grid category
if ( ! function_exists( 'it_eg_category' ) ){
   function it_eg_category() {
        global $post;
        $terms = get_the_terms( $post->id, 'essential_grid_category' );
        foreach ( $terms as $term ) { $id = $term->term_id; 
             $cats[] = '<a href="../../'.$term->taxonomy. '/' .$term->slug. '">'.$term->name.'</a>';
        }
        echo implode( ' , ', $cats );
    }  
}

// Blog listing Excerpt.
if ( ! function_exists( 'it_excerpt' ) ){
    function it_excerpt(){
        global $post;
        $limit = 100;
        $excerpt = get_the_content();
        $excerpt = strip_shortcodes($excerpt);
        $excerpt = strip_tags($excerpt);
        $the_str = substr($excerpt, 0, $limit);
        if ($excerpt>=$limit) {
            return $the_str .'<a class="read-more" href="'. esc_url(get_permalink($post->ID)) . '"> '.__('Read more','itrays').'</a>';
        }else{
            return $the_str;
        }
    } 
}

// Forums issue with selected menu item
if ( ! function_exists( 'it_custom_menu_classes' ) ){
   function it_custom_menu_classes( $classes , $item ){
        global $post;
        if ((function_exists('is_bbpress') && is_bbpress()) || ('essential_grid' == get_post_type()) ) {
            
            $post_slug=$post->post_name;
            $classes = str_replace( 'current_page_parent', '', $classes );
            $classes = str_replace( $post_slug, 'current_page_parent', $classes );
        }
        return $classes;
    } 
}
add_filter( 'nav_menu_css_class', 'it_custom_menu_classes', 10, 2 );

// Modefied numbers for recent posts.
function get_comments_popup_link( $zero = false, $one = false, $more = false, $css_class = '', $none = false ) {
    global $wpcommentspopupfile, $wpcommentsjavascript;
 
    $id = get_the_ID();
 
    if ( false === $zero ) $zero = __( 'No Comments','itrays' );
    if ( false === $one ) $one = __( '1 Comment','itrays' );
    if ( false === $more ) $more = __( '% Comments','itrays' );
    if ( false === $none ) $none = __( 'Comments Off','itrays' );
 
    $number = get_comments_number( $id );
 
    $str = '';
 
    if ( 0 == $number && !comments_open() && !pings_open() ) {
        $str = '<span' . ((!empty($css_class)) ? ' class="' . esc_attr( $css_class ) . '"' : '') . '>' . $none . '</span>';
        return $str;
    }
 
    if ( post_password_required() ) {
        $str = __('Enter your password to view comments.','itrays');
        return $str;
    }
 
    $str = '<a href="';
    if ( $wpcommentsjavascript ) {
        if ( empty( $wpcommentspopupfile ) )
            $home = home_url();
        else
            $home = get_option('siteurl');
        $str .= $home . '/' . $wpcommentspopupfile . '?comments_popup=' . $id;
        $str .= '" onclick="wpopen(this.href); return false"';
    } else { // if comments_popup_script() is not in the template, display simple comment link
        if ( 0 == $number )
            $str .= get_permalink() . '#respond';
        else
            $str .= get_comments_link();
        $str .= '"';
    }
 
    if ( !empty( $css_class ) ) {
        $str .= ' class="'.$css_class.'" ';
    }
    $com_title = the_title_attribute( array('echo' => 0 ) );
 
    $str .= apply_filters( 'comments_popup_link_attributes', '' );
 
    $str .= ' title="' . esc_attr( sprintf( __('Comment on %s','itrays'), $com_title ) ) . '">';
    $str .= get_comments_number_str( $zero, $one, $more );
    $str .= '</a>';
     
    return $str;
}
function get_comments_number_str( $zero = false, $one = false, $more = false, $deprecated = '' ) {
    if ( !empty( $deprecated ) )
        _deprecated_argument( __FUNCTION__, '1.3' );
 
    $number = get_comments_number();
 
    if ( $number > 1 )
        $output = str_replace('%', number_format_i18n($number), ( false === $more ) ? __('% Comments','itrays') : $more);
    elseif ( $number == 0 )
        $output = ( false === $zero ) ? __('No Comments','itrays') : $zero;
    else // must be one
        $output = ( false === $one ) ? __('1 Comment','itrays') : $one;
 
    return apply_filters('comments_number', $output, $number);
}

// Pagination.
if ( ! function_exists( 'it_paging_nav' ) ) {
function it_paging_nav() {
    global $wp_query;
    if ( $wp_query->max_num_pages < 2 )
        return;
        $big = 999999999;
        $args = array(
            'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
            'format' => '?paged=%#%',
            'current' => max( 1, get_query_var('paged') ),
            'total' => $wp_query->max_num_pages,
            'type' => 'list',
            'prev_text' => '<i class="fa fa-angle-left"></i>',
            'next_text' => '<i class="fa fa-angle-right"></i>'                    
        );
        $pg_pos = theme_option('pager_position');
    if ( theme_option('pager_type') == "1" ) {
    if ( theme_option('pager_style') == "1" ) { ?>
    <div class="pager pager-style1 skew-25 <?php echo $pg_pos;?>">
        <?php echo paginate_links( $args ); ?>
    </div>
    <?php }else if (theme_option('pager_style') == "2"){ ?>
    <div class="pager-style2 <?php echo $pg_pos;?>">
        <?php echo paginate_links( $args ); ?>
    </div>
    <?php }else if (theme_option('pager_style') == "3"){ ?>
    <div class="pager-style3 <?php echo $pg_pos;?>">
        <?php echo paginate_links( $args ); ?>
    </div>
    <?php }else if (theme_option('pager_style') == "4"){ ?>
    <div class="pager-style4 <?php echo $pg_pos;?>">
        <?php echo paginate_links( $args ); ?>
    </div>
    <?php }else if (theme_option('pager_style') == "5"){ ?>
    <div class="pager-style5 <?php echo $pg_pos;?>">
        <?php echo paginate_links( $args ); ?>
    </div>
    <?php }else if (theme_option('pager_style') == "6"){ ?>
    <div class="pager-style6 <?php echo $pg_pos;?>">
        <?php echo paginate_links( $args ); ?>
    </div>
    <?php } 
        } else if ( theme_option('pager_type') == "2" ) { ?>
    <div class="old-new">
        <div class="left"><?php next_posts_link(__('&laquo; Older','itrays')) ?></div>
        <div class="right"><?php previous_posts_link(__('Newer &raquo; ','itrays')) ?></div>
    </div>
    <?php } else if ( theme_option('pager_type') == "3" ){
         global $wp_query;
         ?>
         <div class="center">
            <a class="load_more" href="#"><?php echo __('Load more','itrays') ?></a>
            <img alt="" class="pager_loading" src="<?php echo THEME_URI; ?>/assets/images/page-loader.gif" />
        </div>
        <?php
    }
}
}

// Infinite scroll pagination
if ( theme_option('pager_type') == "3" ){
    add_action('wp_ajax_infinite_scroll', 'wp_infinitepaginate');
    add_action('wp_ajax_nopriv_infinite_scroll', 'wp_infinitepaginate');
}
function wp_infinitepaginate(){ 
    $loopFile        = $_POST['loop_file'];
    $paged           = $_POST['page_no'];
    $posts_per_page  = theme_option("pagesNo");
    query_posts(array('paged' => $paged, 'post_status' => 'publish')); 
    get_template_part( $loopFile );
    exit;
}

// WOO Pagination.
if ( ! function_exists( 'woo_paging' ) ) {
    function woo_paging() {
        global $wp_query;
        if ( $wp_query->max_num_pages < 2 )
            return;
            $big = 999999999;
            $args = array(
                'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $wp_query->max_num_pages,
                'type' => 'list',
                'prev_text' => '<i class="fa fa-angle-left"></i>',
                'next_text' => '<i class="fa fa-angle-right"></i>'                    
            );
            
            $pg_pos_woo = theme_option('pager_position_woo');
                if ( theme_option('pager_style_woo') == "1" ) { ?>
    <div class="pager pager-style1 skew-25 <?php echo $pg_pos_woo;?>">
        <?php echo paginate_links( $args ); ?>
    </div>
    <?php }else if (theme_option('pager_style_woo') == "2"){ ?>
    <div class="pager-style2 <?php echo $pg_pos_woo;?>">
        <?php echo paginate_links( $args ); ?>
    </div>
    <?php }else if (theme_option('pager_style_woo') == "3"){ ?>
    <div class="pager-style3 <?php echo $pg_pos_woo;?>">
        <?php echo paginate_links( $args ); ?>
    </div>
    <?php }else if (theme_option('pager_style_woo') == "4"){ ?>
    <div class="pager-style4 <?php echo $pg_pos_woo;?>">
        <?php echo paginate_links( $args ); ?>
    </div>
    <?php }else if (theme_option('pager_style_woo') == "5"){ ?>
    <div class="pager-style5 <?php echo $pg_pos_woo;?>">
        <?php echo paginate_links( $args ); ?>
    </div>
    <?php }else if (theme_option('pager_style_woo') == "6"){ ?>
    <div class="pager-style6 <?php echo $pg_pos_woo;?>">
        <?php echo paginate_links( $args ); ?>
    </div>
    <?php } 
    }
}

// EDD Pagination.
if ( ! function_exists( 'edd_paging' ) ) {
    function edd_paging() {
        global $wp_query;
        if ( $wp_query->max_num_pages < 2 )
            return;
            $big = 999999999;
            $args = array(
                'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $wp_query->max_num_pages,
                'type' => 'list',
                'prev_text' => '<i class="fa fa-angle-left"></i>',
                'next_text' => '<i class="fa fa-angle-right"></i>'                    
            );
            $pg_pos_edd = theme_option('pager_position_edd');
                if ( theme_option('pager_style_edd') == "1" ) { ?>
    <div class="pager pager-style1 skew-25 <?php echo $pg_pos_edd;?>">
                    <?php echo paginate_links( $args ); ?>
                </div>
    <?php }else if (theme_option('pager_style_edd') == "2"){ ?>
    <div class="pager-style2 <?php echo $pg_pos_edd;?>">
                    <?php echo paginate_links( $args ); ?>
                </div>
    <?php }else if (theme_option('pager_style_edd') == "3"){ ?>
    <div class="pager-style3 <?php echo $pg_pos_edd;?>">
                    <?php echo paginate_links( $args ); ?>
                </div>
    <?php }else if (theme_option('pager_style_edd') == "4"){ ?>
    <div class="pager-style4 <?php echo $pg_pos_edd;?>">
                    <?php echo paginate_links( $args ); ?>
                </div>
    <?php }else if (theme_option('pager_style_edd') == "5"){ ?>
    <div class="pager-style5 <?php echo $pg_pos_edd;?>">
                    <?php echo paginate_links( $args ); ?>
                </div>
    <?php }else if (theme_option('pager_style_edd') == "6"){ ?>
    <div class="pager-style6 <?php echo $pg_pos_edd;?>">
                    <?php echo paginate_links( $args ); ?>
                </div>
    <?php } 
    }
}

// BBP Pagination.
if ( ! function_exists( 'bbp_paging' ) ) {
    function bbp_paging() {
        global $wp_query;
        if ( $wp_query->max_num_pages < 2 )
            return;
            $big = 999999999;
            $args = array(
                'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
                'format' => '?paged=%#%',
                'current' => max( 1, get_query_var('paged') ),
                'total' => $wp_query->max_num_pages,
                'type' => 'list',
                'prev_text' => '<i class="fa fa-angle-left"></i>',
                'next_text' => '<i class="fa fa-angle-right"></i>'                    
        );
        $pg_pos_bbp = theme_option('pager_position_bbp');
        if ( theme_option('pager_style_bbp') == "1" ) { ?>
    <div class="pager pager-style1 skew-25 <?php echo $pg_pos_bbp;?>">
                <?php echo paginate_links( $args ); ?>
            </div>
    <?php }else if (theme_option('pager_style_bbp') == "2"){ ?>
    <div class="pager-style2 <?php echo $pg_pos_bbp;?>">
                <?php echo paginate_links( $args ); ?>
            </div>
    <?php }else if (theme_option('pager_style_bbp') == "3"){ ?>
    <div class="pager-style3 <?php echo $pg_pos_bbp;?>">
                <?php echo paginate_links( $args ); ?>
            </div>
    <?php }else if (theme_option('pager_style_bbp') == "4"){ ?>
    <div class="pager-style4 <?php echo $pg_pos_bbp;?>">
                <?php echo paginate_links( $args ); ?>
            </div>
    <?php }else if (theme_option('pager_style_bbp') == "5"){ ?>
    <div class="pager-style5 <?php echo $pg_pos_bbp;?>">
                <?php echo paginate_links( $args ); ?>
            </div>
    <?php }else if (theme_option('pager_style_bbp') == "6"){ ?>
    <div class="pager-style6 <?php echo $pg_pos_bbp;?>">
                <?php echo paginate_links( $args ); ?>
            </div>
    <?php } 
    }
}

// if wpml is activated
if ( ! function_exists( 'if_wpml_activated' ) ) {
  function if_wpml_activated() {
    if ( class_exists( 'SitePress' ) ) { return true; } else { return false; }
  }
}

// theme options add theme options in wp footer hook
add_action( 'wp_footer', 'it_wp_footer');
if ( ! function_exists( 'it_wp_footer' ) ){
    function it_wp_footer(){
        
        $custom_js = theme_option( 'custom_js' );
        if( $custom_js ) {
          echo '<script type="text/javascript">'. $custom_js .'</script>';
        }
       
        if ( theme_option('analytics')){
            $analytics = theme_option('analytics');
            if( $analytics ){

              ob_start();
              ?>
        <script type="text/javascript">
          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', '<?php echo esc_attr($analytics); ?>']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();
        </script>
              <?php

              echo ob_get_clean();

            }
       } 
        
        if ( theme_option('smooth_scroll') == "1" ) {
            ?>
            <script type="text/javascript">
                jQuery(window).load(function() {            
                    jQuery(".page-loader").fadeOut();
                    jQuery(".loader-in").delay(350).fadeOut("slow");
                    jQuery('body').delay(350).removeAttr("style");
                });
            </script>
            <?php
        }
        
        if ( theme_option('smooth_scroll') == "1" ) {
            ?>
        <script type="text/javascript">
                jQuery(document).ready(function(){
                     jQuery('.no-touch body').niceScroll({
                        cursorborderradius: '0px', // Scroll cursor radius
                        background: '#E5E9E7',     // The scrollbar rail color
                        cursorwidth: '10px',       // Scroll cursor width
                        cursorcolor: '#999999'     // Scroll cursor color
                    });
                    jQuery('body').removeAttr("style");
                }); 
                    
          </script>
        <?php
         }
         
         if ( theme_option('pager_type') == "3" ){
             global $wp_query;
             ?>
        <script type="text/javascript">
            (function($) { 
                var count = 2;
                var total = <?php echo $wp_query->max_num_pages; ?>;
                if($('a.load_more').length > 0){
                    if (count <= total){
                        $('a.load_more').css('display','table');
                    }
                    $('a.load_more').click(function(e){
                        e.preventDefault();
                        if (count > total){
                            $('a.load_more').hide();
                            return false;
                        }else{
                            $('.pager_loading').show();
                            $('a.load_more').css('display','table');
                            loadArticle(count);
                        }
                        count++;
                        if (count > total){
                            $('a.load_more').hide();
                        }
                    });
                }
                    
              function loadArticle(pageNumber){    
                      $.ajax({
                          url: "<?php echo esc_attr(site_url()); ?>/wp-admin/admin-ajax.php",
                          type:'POST',
                          data: "action=infinite_scroll&page_no="+ pageNumber + '&loop_file=loop', 
                          success: function(html){
                              $('.pager_loading').hide();
                              var c = $(html).children().unwrap();

                              if($('.masonry').length){
                                $("#content .masonry").append(c);  
                              } else{
                                $("#content").append(c);  
                              }                          
                                 
                              $('.post-password-form input[type="submit"]').addClass('btn main-bg');
                              if($('.masonry').length){
                                    docReady( function() {
                                      var container = document.querySelector('.masonry');
                                      var msnry = new Masonry( container, {
                                      });
                                    });
                                }
                              if($('.portfolio-img-slick').length > 0){
                                  var rt = '';
                                  if ($('html').css('direction') == 'rtl'){
                                      rt = true;
                                  }else{
                                      rt = false;
                                  }  
                                  $('.portfolio-img-slick').slick({
                                        dots: true,
                                        infinite: true,
                                        speed: 300,
                                        slidesToShow: 1,
                                        touchMove: false,
                                        rtl: rt,
                                        slidesToScroll: 1,
                                        autoplay:true
                                    });
                                }
                              $('.no-touch .fx').waypoint(function() {
                                var anim = $(this).attr('data-animate'),
                                    del = $(this).attr('data-animation-delay');
                                    $(this).addClass('animated '+anim).css({animationDelay: del + 'ms'});
                            },{offset: '90%',triggerOnce: true});

                          }
                      });
                  return false;
              }
        })(jQuery);
        </script> 
        <?php
        }
        $soon_date = theme_option('soon_date');
        ?>
        <script type="text/javascript">
            (function($) {
                if($(".digits").length > 0){
                    $('.digits').countdown('<?php echo esc_attr($soon_date); ?>').on('update.countdown', function(event) {
                      var $this = $(this).html(event.strftime('<ul>'
                         + '<li><span>%-w</span><p> week%!w </p> </li>'
                         + '<li><span>%-d</span><p> day%!d </p></li>'
                         + '<li><span>%H</span><p>Hours </p></li>'
                         + '<li><span>%M</span><p> Minutes </p></li>'
                         + '<li><span>%S</span><p> Seconds </p></li>'
                         +'</ul>'));
                     });
                }
            })(jQuery);
        </script>
        <?php

    }
}

// get current page ID
if ( ! function_exists( 'c_page_ID' ) ){
    function c_page_ID(){
        global $post;

        $pageID = '';

        if( ( get_option( 'show_on_front' ) && get_option( 'page_for_posts' ) && is_home() )) {
            $pageID = get_option('page_for_posts');
        } else {
            if(isset($post)) {
                $pageID = $post->ID;
            }

            if(class_exists('Woocommerce')) {
                if(is_shop() || is_tax('product_cat') || is_tax('product_tag')) {
                    $pageID = get_option('woocommerce_shop_page_id');
                }
            }
        }
        return $pageID;
    }
}

// Custom Page Title
if ( ! function_exists( 'it_custom_page_title' ) ){
    function it_custom_page_title() {
        global $post;
        $page_title = get_the_title();    
        
        if(is_front_page()){
            $page_title = get_bloginfo( 'name' );
        } else if( is_home() ) {
            $page_title = get_the_title(get_option('page_for_posts', true));
        }else if( is_search() ) {
            $page_title = __('Search results for: ', 'itrays') . get_search_query();
        }else if( is_404() ) {
            $page_title = __('Page Not Found', 'itrays');
        }else if( is_archive()) {
            if ( is_day() ) {
                $page_title = __( 'Daily Archives:', 'itrays' ) . '<span> ' . get_the_date() . '</span>';
            } else if ( is_month() ) {
                $page_title = __( 'Monthly Archives:', 'itrays' ) . '<span> ' . get_the_date( _x( 'F Y', 'monthly archives date format', 'itrays' ) ) . '</span>';
            } elseif ( is_year() ) {
                $page_title = __( 'Yearly Archives:', 'itrays' ) . '<span> ' . get_the_date( _x( 'Y', 'yearly archives date format', 'itrays' ) ) . '</span>';
            } elseif ( is_author() ) {
                $curauth = get_user_by( 'id', get_query_var( 'author' ) );
                $auth = '';
                if($curauth->first_name || $curauth->last_name){
                    $auth = $curauth->first_name. ' ' .$curauth->last_name;
                } else{
                    $auth = $curauth->nickname;
                }
                $page_title = $auth;
            } else if( $post->post_type == 'download'){
                if(! is_post_type_archive()){
                    $page_title = single_cat_title( '', false );
                } else {
                    $page_title = post_type_archive_title( '', false );
                }
            }else if( class_exists( 'Woocommerce' ) && is_woocommerce() && ( is_product() || is_shop() ) && ! is_search() ) {
                $page_title = woocommerce_page_title( false );
            } else if(class_exists( 'Woocommerce' ) && is_product_category()){
                $page_title = single_cat_title('', false);
            } else {
                $page_title = get_the_title();
            }
        }else if( class_exists( 'Woocommerce' ) && is_woocommerce() && ( is_product() || is_shop() ) && ! is_search() ) {
            if( ! is_product() ) {
                $page_title = woocommerce_page_title( false );
            }
        }else{
            $page_title = get_the_title();
        }

        return $page_title;
    }
}

// Custom Page Title Icon
if ( ! function_exists( 'it_page_title_icon' ) ){
    function it_page_title_icon(){
        $page_icon = '';
        $meta_icon = get_post_meta( c_page_ID() , 'title_icon' , true);
        $theme_page_icon = theme_option('page_head_icon');
        if($meta_icon != ''){
           $page_icon = $meta_icon; 
        }else{
           $page_icon = $theme_page_icon; 
        }
        echo $page_icon;
    }
}

// Theme Header
if ( ! function_exists( 'it_theme_header' ) ){
    function it_theme_header(){
        $hide_header = get_post_meta( c_page_ID() , 'hide_header' , true);
        $meta_header = get_post_meta( c_page_ID() , 'meta_header_style' , true);
        
        $hd_style = '';
        
        if ($meta_header == '' ){
            $hd_style = theme_option("header_layout");
        }else {
            $hd_style = $meta_header;
        }
        
        if (!$hide_header == '1' ){
            get_template_part( 'layout/headers/'.$hd_style);
        }
    }
}

// Theme Footer
if ( ! function_exists( 'it_theme_footer' ) ){
    function it_theme_footer(){
        
        $hide_footer = get_post_meta(c_page_ID(),'hide_footer',true);
        $meta_footer = get_post_meta( c_page_ID() , 'meta_footer_style' , true);
        
        $ft_style = '';
        
        if ($meta_footer == '' ){
            $ft_style = theme_option("footer_style");
        }else {
            $ft_style = $meta_footer;
        }
        
        if (!$hide_footer == '1' ){
            get_template_part( 'layout/footers/footer-'.$ft_style);
        }
    }
}

// Theme page title style
if ( ! function_exists( 'it_title_style' ) ){
    function it_title_style(){
        if( is_search() ) {
            get_template_part( 'layout/page-titles/title-search');
        } else {
            $hide_title = get_post_meta(c_page_ID(),'hide_page_title',true);
            $cust_title = get_post_meta(c_page_ID(),'chck_custom_title',true);
            if($cust_title == '1' && get_post_meta(c_page_ID(),'title_style',true) != '0'){
                $titl_styl = get_post_meta(c_page_ID(),'title_style',true);
            }else{
               $titl_styl = theme_option("page_head_style");
            }
            if (!$hide_title == '1' ){ 
                get_template_part( 'layout/page-titles/title-'.$titl_styl);
            }
        }
    }
}

// page title meta.
if ( ! function_exists( 'it_page_title_meta' ) ){
    function it_page_title_meta(){
        
        $cust_title = get_post_meta(c_page_ID(),'chck_custom_title',true);
        if($cust_title == '1'){
           $titl_text = get_post_meta(c_page_ID(),'custom_title_txt',true);
           $subtitl_text = get_post_meta(c_page_ID(),'custom_subtitle',true); 
        }
    }
}

// Custom Pahe title css that will be put in header css
if ( ! function_exists( 'it_title_css' ) ){
    function it_title_css(){
    
        $cust_title = get_post_meta(c_page_ID(),'chck_custom_title',true);
        $title_bg_col = get_post_meta(c_page_ID(),'title_bg_color',true);
        $title_bg_img = get_post_meta(c_page_ID(),'title_bg_img',true);
        $title_full_bg = get_post_meta(c_page_ID(),'title_full_bg',true);
        $title_fixed_bg = get_post_meta(c_page_ID(),'title_fixed_bg',true);
        $cust_title_overlay = get_post_meta(c_page_ID(),'title_bg_overlay',true);
        ?>
        <style type="text/css">
            <?php if($cust_title == '1'){ ?>
            
            
               <?php if($title_bg_col != ''){ ?>
               .page-title{
                   background-color: <?php echo esc_attr($title_bg_col); ?>;
                   background-image: none;
               }
               <?php } ?>
               
               <?php if($title_bg_img != ''){ ?>
               .page-title{
                   background-image: url('<?php echo esc_url($title_bg_img); ?>') !important;
                   background-repeat: <?php echo get_post_meta(c_page_ID(),'title_bg_repeat',true); ?> !important;
                   <?php if($title_full_bg == '1'){ ?>
                   background-size: 100% 100%;
                   <?php }else{ ?>
                   background-size: initial !important;    
                   <?php } ?>
                   <?php if($title_fixed_bg == '1'){ ?>
                   background-attachment: fixed;
                   <?php }else{ ?>
                   background-attachment: scroll !important;    
                   <?php } ?>
               }
               <?php } ?>
               
               .page-title h1 {
                  color: <?php echo esc_attr(get_post_meta(c_page_ID(),'title_color',true)); ?>; 
               }
               .page-title h3.sub-title {
                  color: <?php echo esc_attr(get_post_meta(c_page_ID(),'subtitle_color',true)); ?>; 
               }
               <?php if(get_post_meta(c_page_ID(),'title_height',true) != ''){ ?>
               .page-title > .container{
                    height: <?php echo esc_attr(get_post_meta(c_page_ID(),'title_height',true)); ?> !important;
                }
                <?php } ?>
                <?php if(isset($cust_title_overlay)){ ?>
                .title-overlay{
                    background-color: <?php echo esc_attr(get_post_meta(c_page_ID(),'title_bg_overlay',true)); ?>;
                    opacity: <?php echo esc_attr(get_post_meta(c_page_ID(),'title_bg_overlay_opacity',true)); ?>;
                }
                <?php } ?>
                
                
            <?php } ?>
        </style>
        <?php
    }
}

// Header 7 banner
if ( ! function_exists( 'header_banner' ) ){
    function header_banner(){
        $banner_img = get_post_meta(c_page_ID(),'meta_header_banner',true);
        $banner_link = get_post_meta(c_page_ID(),'meta_header_banner_link',true);
        $theme_banner_img = theme_option('header_7_banner');
        $theme_banner_link = theme_option('header_7_banner_link');
        
        if($banner_img != '') {
            if($banner_link !='') {
                echo '<a href="'.esc_url($banner_link).'"><img alt="" src="'.esc_url($banner_img).'" /></a>';
            }else{
                echo '<img alt="" src="'.esc_url($banner_img).'" />';
            }
        }else if ($theme_banner_img !=''){
            if($theme_banner_link !='') {
                echo '<a href="'.esc_url($theme_banner_link).'"><img alt="" src="'.esc_url($theme_banner_img).'" /></a>';
            }else{
                echo '<img alt="" src="'.esc_url($theme_banner_img).'" />';
            } 
        }
        
    }
}

// Display Social Icons
if ( ! function_exists( 'display_social_icons' ) ){
    function display_social_icons() {
        $socio_list = '';
        $siciocount = 0;
        $services = array ('facebook','twitter','linkedin','google-plus','skype','rss','youtube','vimeo-square','yahoo','dropbox','soundcloud','dribbble','instagram','flickr','github','tumblr','pinterest','paypal','vk','xing','behance','whatsapp','digg','deviantart');
        $socio_list .='<ul class="social-list hover_links_effect">';
        foreach ( $services as $service ) :
            $active[$service] = esc_url( theme_option( 'social_'.$service ) );
            if ($active[$service]) {  
                $socio_list .= '<li><a href="'.$active[$service].'" data-title="'.$service.'" data-tooltip="true" target="_blank"><span class="fa fa-'.$service.'"></span></a></li>';
                $siciocount++;
            }
        endforeach;
        $socio_list .='</ul>';
        if($siciocount>0){    
            echo $socio_list;
        } else{
            return;
        }
    }
}

// woo shopping cart in header.
if ( ! function_exists( 'it_wo_cart' ) ){
   function it_wo_cart(){
        if(class_exists('Woocommerce')) {
            if(is_shop() || is_tax('product_cat') || is_tax('product_tag') || is_singular('product') || is_checkout()) {
                global $woocommerce;
                ?>
        <div class="cart-icon fx" data-animate="fadeInRight">
                        <div class="cart-heading">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="cart-count">
                               2
                                <?php echo sprintf(_n('%d fotka', '%d fotek', $woocommerce->cart->cart_contents_count, 'woocommerce'), $woocommerce->cart->cart_contents_count);?> - 
                                <?php echo $woocommerce->cart->get_cart_total(); ?>
                            </span>
                        </div>
                        <div class="cart-popup">
                            <div class="mini-cart">
                                <ul class="cart_list mini-cart-list product_list_widget">

                                    <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

                                        <?php
                                            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                                $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                                $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

                                                    $product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                                                    $thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                                    $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

                                                    ?>
                                                    <li>
                                                    <?php if ( ! $_product->is_visible() ) { ?>
                                                    <?php } else { ?>
                                                      
                                                    <?php } ?>
                                                        <div class="cart-body"><?php echo WC()->cart->get_item_data( $cart_item ); ?>
                                                        <a href="<?php echo esc_url(get_permalink( $product_id )); ?>"><?php echo $product_name ?></a>
                                                        <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="price">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?></div>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                        ?>

                                    <?php else : ?>

                                        <li class="empty"><?php _e( 'Your Shopping cart is empty.', 'itrays' ); ?></li>

                                    <?php endif; ?>

                                </ul>

                                <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
                                    <div class="mini-cart-total"><div class="left"><?php _e( 'Subtotal', 'woocommerce' ); ?>:</div><div class="right"> <?php echo WC()->cart->get_cart_subtotal(); ?></div></div>
                                    <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
                                    <div class="checkout">
                                        <a href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" class="btn btn-default"><?php _e( 'View Cart', 'woocommerce' ); ?></a>
                                        <a href="<?php echo esc_url(WC()->cart->get_checkout_url()); ?>" class="btn btn-default"><?php _e( 'Checkout', 'woocommerce' ); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>                                  
                    </div>
        <?php
            }
        }
    } 
}

// woo shopping cart in header.
if ( ! function_exists( 'it_topbar_wo_cart' ) ){
   function it_topbar_wo_cart(){
        if(class_exists('Woocommerce')) {
                global $woocommerce;
                ?>
        <div class="cart-icon fx" data-animate="fadeInRight">
                        <div class="cart-heading">
                            <i class="fa fa-shopping-cart"></i>
                            <span class="cart-count">
                            
                                <?php echo sprintf(_n('%d fotka', '%d fotek', $woocommerce->cart->cart_contents_count, 'woocommerce'), $woocommerce->cart->cart_contents_count);?> - 
                                <?php echo $woocommerce->cart->get_cart_total(); ?>
                            </span>
                        </div>
                        <div class="cart-popup">
                            <div class="mini-cart">
                                <ul class="cart_list mini-cart-list product_list_widget">

                                    <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>

                                        <?php
                                            foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
                                                $_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
                                                $product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

                                                if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

                                                    $product_name  = apply_filters( 'woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key );
                                                    $thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
                                                    $product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );

                                                    ?>
                                                    <li>
                                                    
                                                        <div class="cart-body"><?php echo WC()->cart->get_item_data( $cart_item ); ?>
                                                        <?php echo "<pre>",print_r($cart_item),"</pre>"; ?>
                                                        <a href="<?php echo esc_url(get_permalink( $product_id )); ?>"><?php echo $product_name ?></a>
                                                        <?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="price">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?></div>
                                                    </li>
                                                    <?php
                                                }
                                            }
                                        ?>

                                    <?php else : ?>

                                        <li class="empty"><?php _e( 'Your Shopping cart is empty.', 'itrays' ); ?></li>

                                    <?php endif; ?>

                                </ul>

                                <?php if ( sizeof( WC()->cart->get_cart() ) > 0 ) : ?>
                                    <div class="mini-cart-total"><div class="left"><?php _e( 'Subtotal', 'woocommerce' ); ?>:</div><div class="right"> <?php echo WC()->cart->get_cart_subtotal(); ?></div></div>
                                    <?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>
                                    <div class="checkout">
                                        <a href="<?php echo esc_url(WC()->cart->get_cart_url()); ?>" class="btn btn-default"><?php _e( 'View Cart', 'woocommerce' ); ?></a>
                                        <a href="<?php echo esc_url(WC()->cart->get_checkout_url()); ?>" class="btn btn-default"><?php _e( 'Checkout', 'woocommerce' ); ?></a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>                                  
                    </div>
        <?php
        }
    } 
}

//Limit number of tags inside widget
if ( ! function_exists( 'tag_widget_limit' ) ){
    function tag_widget_limit($args){
        $tagsNo = theme_option('tags_limit');
         //Check if taxonomy option inside widget is set to tags
         if(isset($args['taxonomy']) && $args['taxonomy'] == 'post_tag'){
          $args['number'] = esc_attr($tagsNo); //Limit number of tags
         }

         return $args;
    }
}
add_filter('widget_tag_cloud_args', 'tag_widget_limit');

// get ID by slug
if(! function_exists('get_ID_by_slug')) {
    function get_ID_by_slug($page_slug) {
        $page = get_page_by_path($page_slug);
        if ($page) {
            return $page->ID;
        } else {
            return null;
        }
    }
}

// buddypress activity for public
add_filter( 'bbp_is_site_public', 'it_enable_bbp_activity', 10, 2);
function it_enable_bbp_activity( $public, $site_id ) {
    return true;
} 

// unlimited contact offices
if ( ! function_exists( 'it_contact_offices' ) ) {
    function it_contact_offices(){
        $langcode = '';
        if ( class_exists( 'SitePress' ) ) {
            $langcode = '-'.ICL_LANGUAGE_CODE;
        }
        for($i = 0; $i < get_txt() ; ++$i){
            $g = $i+1;
            ?>
            <div class="col-md-5 fx contact-office" data-animate="fadeInRight">
                <?php if(theme_option("office_location".$g.$langcode)){ ?><h4 class="bold"><?php echo __('Office','itrays') ?>: <span class="main-color"><?php echo esc_html(theme_option("office_location".$g.$langcode)); ?></span></h4><?php } ?>
                <?php if(theme_option("office_address".$g.$langcode)){ ?><div><i class="fa fa-location-arrow"></i><b><?php echo __('Address','itrays') ?>:</b> <p><?php echo esc_html(theme_option("office_address".$g.$langcode)); ?></p></div><?php } ?>
                <?php if(theme_option("office_email".$g)){ ?><div><i class="fa fa-envelope"></i><b><?php echo __('Email','itrays') ?>:</b> <p><?php echo esc_html(theme_option("office_email".$g)); ?></p></div><?php } ?>
                <?php if(theme_option("office_phone".$g)){ ?><div><i class="fa fa-phone"></i><b><?php echo __('Phone','itrays') ?>:</b> <p><?php echo esc_html(theme_option("office_phone".$g)); ?> </p></div><?php } ?>
                <?php if(theme_option("office_fax".$g)){ ?><div><i class="fa fa-fax"></i><b><?php echo __('FAX','itrays') ?>:</b> <p><?php echo esc_html(theme_option("office_fax".$g)); ?></p></div><?php } ?>
            </div>
            <div class="col-md-2"><br></div>
            <?php
        }        
    }    
}

// get locations function
if ( ! function_exists('get_txt')){
   function get_txt(){
        $options = get_option( 'theme_options' );
        $vllu = $options['locations'];
        return $vllu;
    } 
}

// google map function
if ( ! function_exists( 'it_google_map' ) ) {
    function it_google_map(){
        $langcode = '';
        if ( class_exists( 'SitePress' ) ) {
            $langcode = '-'.ICL_LANGUAGE_CODE;
        }
        $map_hit = theme_option("map_height");
        $scrollw = theme_option("scrollwheel");
        if($scrollw == '1'){
            $scrollwheel = 'true';
        }else{
            $scrollwheel = 'false';
        }
        ?>
        <script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false"></script>
        <script type="text/javascript" src="<?php echo THEME_URI . '/assets/js/gmaps.js' ?>"></script>

                <div class="google-map-wrap" itemscope itemprop="hasMap" itemtype="http://schema.org/Map" style="height: <?php echo esc_attr($map_hit); ?>px;">
                    <div id="google-map" class="google-map"></div>
                </div>

                <?php
                $locations = array();
                for($i = 0; $i < get_txt() ; ++$i){
                    $g = $i+1;
                    $locations[] = array(
                        'google_map' => array(
                            'lat' => esc_attr(theme_option("office_latitude".$g)),
                            'lng' => esc_attr(theme_option("office_longitude".$g)),
                        ),
                        'location_address' => esc_attr(theme_option("office_address".$g.$langcode)),
                        'location_name'    => esc_attr(theme_option("office_location".$g.$langcode)),
                    );
                }
                ?>
                
                <?php
                /* Set Default Map Area Using First Location */
                $map_area_lat = isset( $locations[0]['google_map']['lat'] ) ? $locations[0]['google_map']['lat'] : '';
                $map_area_lng = isset( $locations[0]['google_map']['lng'] ) ? $locations[0]['google_map']['lng'] : '';
                ?>

                <script type="text/javascript">
                jQuery(document).ready( function($) {

                    /* Do not drag on mobile. */
                    var is_touch_device = 'ontouchstart' in document.documentElement;
                    
                    var map = new GMaps({
                        el: '#google-map',
                        lat: '<?php echo $map_area_lat; ?>',
                        //zoom: 15,
                        lng: '<?php echo $map_area_lng; ?>',
                        scrollwheel: <?php echo $scrollwheel; ?>,
                        draggable: ! is_touch_device
                    });
                    
                    /* Map Bound */
                    var bounds = [];

                    <?php /* For Each Location Create a Marker. */
                    foreach( $locations as $location ){
                        $name = $location['location_name'];
                        $addr = $location['location_address'];
                        $map_lat = $location['google_map']['lat'];
                        $map_lng = $location['google_map']['lng'];
                        ?>
                        /* Set Bound Marker */
                        var latlng = new google.maps.LatLng(<?php echo $map_lat; ?>, <?php echo $map_lng; ?>);
                        bounds.push(latlng);
                        /* Add Marker */
                        map.addMarker({
                            lat: <?php echo $map_lat; ?>,
                            lng: <?php echo $map_lng; ?>,
                            title: '<?php echo $name; ?>',   
                            infoWindow: {
                                content: '<div class="noScroll"><b><?php echo $name; ?></b><br/><?php echo $addr; ?></div>'
                            }
                        });
                    <?php } //end foreach locations ?>

                    /* Fit All Marker to map */
                    map.fitLatLngBounds(bounds);

                    /* Make Map Responsive */
                    var $window = $(window);
                    function mapWidth() {
                        var size = $('.google-map-wrap').width();
                        $('.google-map').css({width: size + 'px', height: <?php echo esc_attr($map_hit); ?> + 'px'});
                    }
                    mapWidth();
                    $(window).resize(mapWidth);

                });
                </script>
        <?php       
    }    
}

// number of tags allowed
if ( ! function_exists('it_allowed_tags')){
    function it_allowed_tags(){
        global $allowedtags;
        $attrs = array('class'=>array(),'style'=>array(),'id'=>array(),'src'=>array(),'alt'=>array(),'title'=>array(),'href'=>array());
        
        $allowedtags['span'] = $attrs;
        $allowedtags['div'] = $attrs;
        $allowedtags['p'] = $attrs;
        $allowedtags['img'] = $attrs;
        $allowedtags['b'] = $attrs;
        $allowedtags['i'] = $attrs;
        $allowedtags['strong'] = $attrs;
        $allowedtags['a'] = $attrs;
        
        return $allowedtags;
    }
}

// fix tags issue in custom post type ess. grid
if(! function_exists('post_type_tags_fix')){
    function post_type_tags_fix($request) {
        if ( isset($request['tag']) && !isset($request['post_type']) )
        $request['post_type'] = 'essential_grid';
        return $request;
    }
    add_filter('request', 'post_type_tags_fix');
}