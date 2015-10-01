<?php 
get_header();
//global $post; 
//$post = $wp_query->post;

$a_id=$post->post_author;
$gallery = get_post_gallery();
$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
$utvideo = get_post_meta(c_page_ID(),'eg_sources_youtube',true);
$vimeovideo = get_post_meta(c_page_ID(),'eg_sources_vimeo',true);
$html5videomp4 = get_post_meta(c_page_ID(),'eg_sources_html5_mp4',true);
$html5videoogv = get_post_meta(c_page_ID(),'eg_sources_html5_ogv',true);
$html5videowebm = get_post_meta(c_page_ID(),'eg_sources_html5_webm',true);
$soundcloud = get_post_meta(c_page_ID(),'eg_sources_soundcloud',true);

function eg_content (){
    while ( have_posts() ) : the_post();
        $content = strip_shortcode_gallery( get_the_content() );                                        
        $content = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $content ) );
        echo $content;
    endwhile;  
}
 
// page title function.
it_title_style();
?>  
<div id="post-<?php the_ID(); ?>" <?php post_class('md-padding'); ?>>
    <div class="container">
        <div class="row">
            <div class="col-md-5 fx" data-animate="fadeInLeft">
                <div class="full-img portfolio-img-slick">
                    <?php if ( theme_option('singlepostimg_on') == "1" ) : ?>
                            <?php 
                            if ( get_post_gallery() ) {
                                    $galleries = get_post_galleries_images( $post  );
                                    foreach( $galleries as $galleri ) {
                                        foreach( $galleri as $image ) {
                                            echo '<div><a class="zoom" href="' . esc_url(str_replace('-150x150','',$image)) . '" title=""><img src="' . esc_url(str_replace('-150x150','',$image)) . '" /></a></div>';
                                        }
                                    }
                            }else if($html5videomp4 && $html5videoogv && $html5videowebm){
                                ?>
                                <div class="esg-entry-media">
                                    <div class="esg-media-video" data-mp4="<?php echo esc_url($html5videomp4); ?>" data-webm="<?php echo esc_url($html5videowebm); ?>" data-ogv="<?php echo esc_url($html5videoogv); ?>" width="100%" height="300" data-poster=""></div>
                                    <video class="esg-video-frame readytoplay haslistener esg-htmlvideo" controls="" width="100%" height="300" data-origw="100%" data-origh="300">
                                        <source src="<?php echo esc_url($html5videomp4); ?>" type="video/mp4">
                                        <source src="<?php echo esc_url($html5videowebm); ?>" type="video/webm">
                                        <source src="<?php echo esc_url($html5videoogv); ?>" type="video/ogg">
                                    </video>
                                </div>
                                <?php
                            }else if($vimeovideo){
                                  ?>
                                  <iframe class="esg-vimeo-frame haslistener esg-vimeovideo readytoplay" frameborder="0" webkitallowfullscreen="" mozallowfullscreen="" allowfullscreen="" width="100%" height="300" src="http://player.vimeo.com/video/<?php echo esc_html($vimeovideo); ?>?title=0&amp;byline=0&amp;html5=1&amp;portrait=0&amp;api=1&amp;player_id=vimeoiframe65115&amp;api=1" data-src="about:blank"></iframe>
                                  <?php
                            }else if($utvideo){
                                 ?>
                                 <iframe class="esg-youtube-frame haslistener esg-youtubevideo" frameborder="0" wmode="Opaque" width="100%" height="300" src="https://www.youtube.com/embed/<?php echo esc_html($utvideo); ?>?version=3&amp;enablejsapi=1&amp;html5=1&amp;controls=1&amp;autohide=1&amp;rel=0&amp;showinfo=0" data-src="about:blank" id="ytiframe28709"></iframe>
                                 <?php
                            }else if($soundcloud){
                                ?>
                                <iframe width="100%" height="300" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/<?php echo esc_html($soundcloud); ?>&amp;auto_play=false&amp;hide_related=false&amp;show_comments=true&amp;show_user=true&amp;show_reposts=false&amp;visual=true"></iframe>
                                <?php
                            }else if ( has_post_thumbnail() ){
                                if ( function_exists( 'add_theme_support' ) ){ ?> 
                                 
                                 <a class="zoom" href="<?php echo esc_url($url); ?>">
                                    <?php the_post_thumbnail('full'); ?>
                                 </a>
                                
                                <?php }
                            
                            } ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-md-7 fx" data-animate="fadeInRight">
                <h3 class="block-head"><?php echo __('Project Info','itrays') ?></h3>
                <ul class="list-details">
                    <li>
                        <i class="fa fa-tag"></i> <span class="main-color"><?php echo __('Category:','itrays') ?></span> <?php it_eg_category(); ?>
                    </li>
                    <li>
                        <i class="fa fa-user"></i> <span class="main-color"><?php echo __('Added By:','itrays') ?></span> <?php echo the_author_meta( 'user_nicename', $a_id ); ?>
                    </li>
                    <li>
                        <i class="fa fa-calendar"></i> <span class="main-color"><?php echo __('Date Added:','itrays') ?></span> <?php echo get_the_date('j M Y'); ?>
                    </li>
                    <li>
                        
                        <?php $posttags = get_the_tags();
                         if ($posttags){
                            ?>
                            <i class="fa fa-tags"></i>
                            <?php
                             the_tags(); 
                         }
                         
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="md-padding gry-bg">
    <div class="container">
        <div class="row">
            <div class="fx" data-animate="fadeInUp">
                <h3 class="block-head"><?php echo __('Project Details','itrays') ?></h3>
                <?php eg_content(); ?>
            </div>
        </div>
    </div>
</div>
<?php locate_template( 'layout/blog/related-projects.php','related'); ?> 
<?php get_footer(); ?>