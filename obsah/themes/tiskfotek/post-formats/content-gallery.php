<?php
    $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
    $gallery = get_post_gallery();
    $content = strip_shortcode_gallery( get_the_content() );                                        
    $content = str_replace( ']]>', ']]&gt;', apply_filters( 'the_content', $content ) );
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('single'); ?>>
		<?php if ( theme_option('singlepostimg_on') == "1" ) : ?>
                <?php 
                global $post;
                ?>
                <?php if ( get_post_gallery() ){
                    echo post_media( get_the_content() );
                }else if ( has_post_thumbnail() ){
                    it_post_thumbnail();
                } ?> 
               

        <?php endif; ?>
        <article class="post-content">
        <?php
            if ( is_single()){
        ?>
        <div class="post-info-container">            
            <div class="post-info">
                    
                    <ul class="post-meta">
                        <?php it_post_meta(); ?>
                    </ul>
                </div>
        </div>
			<?php if ( theme_option('singlecontent_on') == "1" ) : ?>
                <?php if ( has_excerpt() ) : ?>
                    <div class="entry-summary"><?php the_excerpt(); ?></div>
                <?php else : ?>
                    <div class="entry-content">
                        <?php echo the_content( __( 'Read More', 'itrays' ) ); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            <?php
            if ( theme_option('singletags_on') == "1" ) {
            $posttags = get_the_tags();
             if ($posttags){
                 ?>
                 <div class="post-tags"> <i class="fa fa-tags"></i><?php the_tags(); ?> </div>
            <?php 
            
            }
            }
            if ( theme_option('singlesocial_on') == "1" ) {
            if ( is_single()){
            ?>
            <div class="share-post">
                <span class="sh"><?php echo __('Share this post on:','itrays') ?></span>
                <div id="shareme" data-text="Share this post"></div>
            </div>
            <?php
                }
            }
        }
        ?>
        </article>

	</article>
    
