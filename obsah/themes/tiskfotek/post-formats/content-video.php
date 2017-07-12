<article id="post-<?php the_ID(); ?>" <?php post_class('single'); ?>>
		<?php if ( theme_option('singlepostimg_on') == "1" ) : ?>
            <div class="post-media">
                <?php echo post_media(get_the_content()); ?>
            </div>
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
    
