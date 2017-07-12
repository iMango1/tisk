<?php

// Post Thumbnail
if ( ! function_exists( 'it_post_thumbnail' ) ) {
  function it_post_thumbnail( $link = '' ) {

    if ( post_password_required() || ! has_post_thumbnail() ) { return; }

    global $it_blog_image_size;

    $size  = ( empty( $it_blog_image_size ) ) ? theme_option( 'blog_image_size' ) : $it_blog_image_size;
    $link  = ( empty( $link ) ) ? get_permalink() : $link;


    if ( is_singular() ) {
      if ( theme_option( 'singlepostimg_on' ) ) {
          echo '<div class="post-image">';
          the_post_thumbnail( theme_option( 'singlepostimg_size' ) );
          echo '</div>';
      }
    } else {
        echo '<div class="post-image">';
        $post_format = get_post_format();
        switch ( $post_format ) {
          case 'gallery':
            echo '<div class="post-icon main-bg" data-title="'.__('Gallery','itrays').'" data-tooltip="true" data-position="top"><i class="fa fa-camera"></i></div>';
          break;
          
          case 'link':
            echo '<div class="post-icon main-bg" data-title="'.__('Link','itrays').'" data-tooltip="true" data-position="top"><i class="fa fa-link"></i></div>';
          break;

          case 'image':
            echo '<div class="post-icon main-bg" data-title="'.__('Image','itrays').'" data-tooltip="true" data-position="top"><i class="fa fa-image"></i></div>'; 
          break;
          
          case 'quote':
            echo '<div class="post-icon main-bg" data-title="'.__('Quote','itrays').'" data-tooltip="true" data-position="top"><i class="fa fa-quote-left"></i></div>'; 
          break;
          
          case 'status':
            echo '<div class="post-icon main-bg" data-title="'.__('Status','itrays').'" data-tooltip="true" data-position="top"><i class="fa fa-refresh"></i></div>'; 
          break;
          
          case 'chat':
            echo '<div class="post-icon main-bg" data-title="'.__('Chat','itrays').'" data-tooltip="true" data-position="top"><i class="fa fa-comments-o"></i></div>'; 
          break;
          
          case 'aside':
            echo '<div class="post-icon main-bg" data-title="'.__('Aside','itrays').'" data-tooltip="true" data-position="top"><i class="fa fa-eyedropper"></i></div>'; 
          break;
          
          default:
            echo '<div class="post-icon main-bg" data-title="'.__('Standard','itrays').'" data-tooltip="true" data-position="top"><i class="fa fa-book"></i></div>';
          break;
        }
        echo '<a href="'. esc_url($link) .'" class="post-thumbnail"><span class="mask"></span>';
        the_post_thumbnail( $size );
        echo '</a>';
        echo '</div>';
    }
  
  }
}

// excerpt more link.
if ( ! function_exists( 'it_excerpt_more_link' ) ) {
    function it_excerpt_more_link( $txt ) {
        global $post;
        return ( is_search() ) ? $txt : $txt .' <a class="more-link" href="'. esc_url(get_permalink($post->ID)) . '">'. __( 'Read more', 'itrays' ) .'</a>';
    }
    add_filter( 'the_excerpt', 'it_excerpt_more_link', 7 );
}

if( ! function_exists( 'it_content_filter' ) ) {
  function it_content_filter( $content ) {
    $post_format = get_post_format();
    if ( $post_format ) {
      $content = apply_filters( 'it-post-format-'. $post_format, $content );
    }
    return $content;
  }
  add_filter( 'the_content', 'it_content_filter', 2 );
}
 
function strip_shortcode_gallery( $content ) {
    preg_match_all( '/'. get_shortcode_regex() .'/s', $content, $matches, PREG_SET_ORDER );
    if ( ! empty( $matches ) ) {
        foreach ( $matches as $shortcode ) {
            if ( 'gallery' === $shortcode[2] ) {
                $pos = strpos( $content, $shortcode[0] );
                if ($pos !== false)
                    return substr_replace( $content, '', $pos, strlen($shortcode[0]) );
            }
        }
    }
    return $content;
}
add_filter( 'it-post-format-gallery', 'strip_shortcode_gallery' );

if( ! function_exists('get_shortcode_regex') ) {
  function get_shortcode_regex() {
      global $shortcode_tags;
      $tagnames = array_keys($shortcode_tags);
      $tagregexp = join( '|', array_map('preg_quote', $tagnames) );

      // WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcode_tag()
      // Also, see shortcode_unautop() and shortcode.js.
      return
          '\\['                              // Opening bracket
        . '(\\[?)'                           // 1: Optional second opening bracket for escaping shortcodes: [[tag]]
        . "($tagregexp)"                     // 2: Shortcode name
        . '(?![\\w-])'                       // Not followed by word character or hyphen
        . '('                                // 3: Unroll the loop: Inside the opening shortcode tag
        .     '[^\\]\\/]*'                   // Not a closing bracket or forward slash
        .     '(?:'
        .         '\\/(?!\\])'               // A forward slash not followed by a closing bracket
        .         '[^\\]\\/]*'               // Not a closing bracket or forward slash
        .     ')*?'
        . ')'
        . '(?:'
        .     '(\\/)'                        // 4: Self closing tag ...
        .     '\\]'                          // ... and closing bracket
        . '|'
        .     '\\]'                          // Closing bracket
        .     '(?:'
        .         '('                        // 5: Unroll the loop: Optionally, anything between the opening and closing shortcode tags
        .             '[^\\[]*+'             // Not an opening bracket
        .             '(?:'
        .                 '\\[(?!\\/\\2\\])' // An opening bracket not followed by the closing shortcode tag
        .                 '[^\\[]*+'         // Not an opening bracket
        .             ')*+'
        .         ')'
        .         '\\[\\/\\2\\]'             // Closing shortcode tag
        .     ')?'
        . ')'
        . '(\\]?)';                          // 6: Optional second closing brocket for escaping shortcodes: [[tag]]
    }
}

if( ! function_exists( 'wp_tagregexp' ) ) {
  function wp_tagregexp() {
    return apply_filters( 'wp_custom_tagregexp', 'video|media|audio|playlist|video-playlist|embed' );
  }
}

if( ! function_exists( 'getUrl' ) ) {
  function getUrl( $html ) {
    $regex  = "/^\b(?:(?:https?|ftp):\/\/)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i";
    preg_match( $regex, $html, $matches );
    return ( !empty( $matches[0] ) ) ? $matches[0] : false;
  }
}

if( ! function_exists( 'post_media' ) ) {
  function post_media( $content ) {
    $media    = getUrl( $content );
    if( ! empty( $media ) ) {
      global $wp_embed;
      $content  = do_shortcode( $wp_embed->run_shortcode( '[embed]'. $media .'[/embed]' ) );
    } else {
      $pattern = get_shortcode_regex( wp_tagregexp() );
      preg_match( '/'.$pattern.'/s', $content, $media );
      if ( ! empty( $media[2] ) ) {
        if( $media[2] == 'embed' ) {
          global $wp_embed;
          $content = do_shortcode( $wp_embed->run_shortcode( $media[0] ) );
        } else {
          $content = do_shortcode( $media[0] );
        }
      }
    }
    if( ! empty( $media ) ) {
      if(get_post_format() == 'gallery'){
          $output  = '<div class="post-gallery">';
      }else{
          $output  = '<div class="post-media">';
      }
        
      $output .= $content;
      $output .= '</div>';
      return $output;
    }
    return false;
  }
}

if( ! function_exists( 'link_href' ) ) {
  function link_href( $string ) {
    preg_match( '/<a href="(.*?)">/i', $string, $atts );
    return ( ! empty( $atts[1] ) ) ? $atts[1] : '';
  }
}

if( ! function_exists( 'post_format_link' ) ) {
  function post_format_link( $content = null, $title = null, $post = null ) {

    if ( ! $content ) {
      $post     = get_post( $post );
      $title    = $post->post_title;
      $content  = $post->post_content;
    }
    
    $link   = getUrl( $content );
    
    if( ! empty( $link ) ) {

      $title    = '<a class="main-color" href="'. esc_url( $link ) .'" rel="bookmark">'. $title .'</a>';
      $content  = str_replace( $link, '', $content );

    } else {

      $pattern    = '/^\<a[^>](.*?)>(.*?)<\/a>/i';
      preg_match( $pattern, $content, $link );

      if( ! empty( $link[0] ) && ! empty( $link[2] ) ) {

        $title    = $link[0];
        $content  = str_replace( $link[0], '', $content );

      } elseif( ! empty( $link[0] ) && ! empty( $link[1] ) ) {

        $atts     = shortcode_parse_atts( $link[1] );
        $target = ( ! empty( $atts['target'] ) ) ? $atts['target'] : '_self';
        $title  = ( ! empty( $atts['title'] ) )  ? $atts['title']  : $title;
        $title    = '<a class="main-color" href="'. esc_url( $atts['href'] ) .'" rel="bookmark" target="'. esc_attr($target) .'">'. $title .'</a>';
        $content  = str_replace( $link[0], '', $content );

      } else {
        $title  = '<a class="main-color" href="'. esc_url( get_permalink() ) .'" rel="bookmark">'. $title .'</a>';
      }

    }

    $output['title']   = '<h2>'. $title . '</h2>';
    $output['content'] = $content;

    return $output;

  }
}

if( ! function_exists( 'post_image' ) ) {
    function post_image( $content ) {
        
        global $post, $posts;
        $first_img = '';
        ob_start();
        ob_end_clean();
        $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
        $first_img = $matches [1] [0];
        if(!empty($first_img)){
            ?>
            <div class="post-image">
                <div class="post-icon main-bg" data-title="<?php echo __('Image','itrays') ?>" data-tooltip="true" data-position="top"><i class="fa fa-image"></i></div>
                <a href="<?php the_permalink(); ?>">
                    <span class="mask"></span>
                    <img alt="" src="<?php echo esc_url($first_img); ?>" />
                </a>
            </div>
            <?php            
        }else{
            it_post_thumbnail();
        }
    }
}

if( ! function_exists( 'it_post_chat' ) ) {
  function it_post_chat( $content ) {

    $output = '<ul class="post-chat">';
    $rows   = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );
    $i      = 0;

    foreach ( $rows as $row ) {

      if ( strpos( $row, ':' ) ) {

        $row_split  = explode( ':', trim( $row ), 2 );
        $author     = strip_tags( trim( $row_split[0] ) );
        $text       = trim( $row_split[1] );

        $output .= '<li class="chat-row row-'. ($i%2 ? 'odd':'even') .'">';
        $output .= '<span class="chat-author '. sanitize_html_class( strtolower( "chat-author-{$author}" ) ) . '"><i class="fa fa-comment"></i> <cite class="auth-name">' . $author . '</cite>' . ':' . '</span>'.$text;
        $output .= '</li>';

        $i++;
      } else {
        $output .= $row;
      }

    }

    $output .= '</ul>';
    return $output;

  }
  add_filter( 'it-post-format-chat', 'it_post_chat' );
}

// Audio and Video Post formats content
if( ! function_exists( 'it_media_content' ) ) {
  function it_media_content( $content ) {

    $media = getUrl( $content );

    if( ! empty( $media ) ){

      $content  = str_replace( $media, '', $content );

    } else {

      $pattern = get_shortcode_regex( wp_tagregexp() );
      preg_match( '/'.$pattern.'/s', $content, $media );
      if ( ! empty( $media[2] ) ) {
        $content = str_replace( $media[0], '', $content );
      }

    }

    return $content;
  }
  add_filter( 'it-post-format-video', 'it_media_content' );
  add_filter( 'it-post-format-audio', 'it_media_content' );
}

// Link Post format content
if( ! function_exists( 'it_post_link' ) ) {
  function it_post_link( $content ){
    $parse_content = post_format_link( $content );
    return $parse_content['content'];
  }
  add_filter( 'it-post-format-link', 'it_post_link' );
}

// Blog Post Meta
if ( ! function_exists( 'it_post_meta' ) ) {
  function it_post_meta() {

    global $post;

    if ( is_sticky() && is_home() && ! is_paged() ) {
      echo '<li class="post-sticky"><i class="fa fa-magic"></i>' . __( 'Sticky', 'itrays' ) . '</li>';
    }

    $post_format = get_post_format();
    if( $post_format ) {
      echo '<li class="post-format-'. $post_format .'">';
      echo '<i class="fa"></i><a href="'. esc_url( get_post_format_link( $post_format ) ) .'">'. get_post_format_string( $post_format ) .'</a>';
      echo '</li>';
    }else{
      echo '<li class="post-format-standard">';
      echo '<i class="fa fa-book"></i><span>'. get_post_format_string('standard') .'</span>';
      echo '</li>';  
    }
    
    if ( !is_singular() || ( is_singular() &&  theme_option('singledate_on') == "1" )){
        echo '<li class="meta-date"><i class="fa fa-clock-o"></i>'.get_the_date().'</li>';
    }
    
    if ( !is_singular() || ( is_singular() &&  theme_option('singleauthor_on') == "1" )){    
        echo '<li class="meta-user"><i class="fa fa-user"></i><a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'">'.get_the_author().'</a></li>';
    }
    
    if ( !is_singular() || ( is_singular() &&  theme_option('singlecategory_on') == "1" )){
        if ( in_array( 'category', get_object_taxonomies( get_post_type() ) ) ) {
          echo '<li class="meta-cat"><i class="fa fa-folder-open"></i>'. get_the_category_list( ', ' ) .'</li>';
        }
    }
    if ( ! is_search() ) {

      if ( ! post_password_required() && ( comments_open() || get_comments_number() ) )  {
          if ( !is_singular() || ( is_singular() &&  theme_option('singlecomment_on') == "1" )){
              echo '<li class="meta-comments"><i class="fa fa-comments"></i>';
              comments_popup_link( __( 'Leave a comment', 'itrays' ), __( '1 Comment', 'itrays' ), __( '% Comments', 'itrays' ) );
              echo '</li>'; 
          }
      }

    }

    edit_post_link( __( 'Edit', 'itrays' ), '<li class="entry-edit-link"><i class="fa fa-edit"></i>', '</li>' );
  }
}                 
                    
add_action('print_media_templates', 'add_it_media');
function add_it_media(){

  // define your backbone template;
  // the "tmpl-" prefix is required,
  // and your input field should have a data-setting attribute
  // matching the shortcode name
  ?>
  <script type="text/html" id="tmpl-slideshow-gallery">
    <label class="setting">
      <span><?php _e('SlideShow ?','itrays'); ?></span>
      <select data-setting="it_slideshow">
        <option value="no"> No </option>
        <option value="yes"> Yes </option>
      </select>
    </label>
  </script>

  <script>

    jQuery(document).ready(function(){

      // add your shortcode attribute and its default value to the
      // gallery settings list; $.extend should work as well...
      _.extend(wp.media.gallery.defaults, {
        my_custom_attr: 'no'
      });

      // merge default gallery settings template with yours
      wp.media.view.Settings.Gallery = wp.media.view.Settings.Gallery.extend({
        template: function(view){
          return wp.media.template('gallery-settings')(view)
               + wp.media.template('slideshow-gallery')(view);
        }
      });

    });

  </script>
  <?php

}

//remove styles: I'll use mine
add_filter('use_default_gallery_style','__return_false');

function move_pagination( $content ) {
    if ( is_single() ) {
        $pagination = wp_link_pages( array(
                    'before'      => '<div class="sub-pager"><span class="page-links-title">' . __( 'Pages:', 'itrays' ) . '</span>',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                    'echo'        => 0,
                ) );
        $content .= $pagination;
        return $content;
    }
    return $content;
}

add_filter( 'the_content', 'move_pagination', 1 );
