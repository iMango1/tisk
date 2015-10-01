
<div class="blog-small">
    <?php while ( have_posts() ) : the_post(); ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class('post-item fx'); ?> data-animate="fadeInLeft">
        <div class="row">
            <div class="col-md-4">
               <?php 
                if ( get_post_format() == 'gallery' || get_post_format() == 'video' || get_post_format() == 'audio' ) {
                    
                    echo post_media( get_the_content() );
                    
                } else if ( get_post_format() == 'image' ) {
                    if( has_post_thumbnail()){
                        it_post_thumbnail();  
                    }else{
                        echo post_image(get_the_content());
                    }        
                } else {
                    
                    it_post_thumbnail();
                    
                } 
                ?>
            </div>
            <article class="post-content col-md-8">
            <div class="post-info-container">
                <div class="post-info">
                    
                        <?php if( get_post_format() == 'link' ){ ?>
                            <?php
                             $title_format  = post_format_link( get_the_content(), get_the_title() );
                              $it_title   = $title_format['title'];
                              $it_link = getUrl( $it_title );
                              echo $it_title;
                            ?>
                        <?php }else{ ?>
                            <h2><a class="main-color" href="<?php esc_url(the_permalink()); ?>" rel="bookmark" title="<?php echo __('Permanent Link to','itrays') ?> <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                        <?php } ?>
                    
                    <ul class="post-meta">
                        <?php it_post_meta(); ?>
                    </ul>
                </div>
            </div>
                <?php if ( has_excerpt() ) : ?>
            <div class="entry-summary"><?php the_excerpt(); ?></div>
        <?php else : ?>
            <div class="entry-content">
                <?php echo the_content( __( 'Read More', 'itrays' ) ); ?>
            </div>
        <?php endif; ?>
        <?php wp_link_pages( array(
            'before'      => '<div class="sub-pager"><span class="page-links-title">' . __( 'Pages:', 'itrays' ) . '</span>',
            'after'       => '</div>',
            'link_before' => '<span>',
            'link_after'  => '</span>',
            ) );
        ?>        
        </article>
        
      </div>  
    </div>
    <div class="clearfix"></div>
    <?php endwhile; ?>
</div>