<?php
get_header(); 
$layout=''; 
$options = get_post_custom(get_the_ID());
if(isset($options['page_layout'])){
    $layout = $options['page_layout'][0];
}
$col = '12';
if ($layout == "sidebar-left" || $layout == "sidebar-right" ) {
    $col = '9';
}
// page title function.
it_title_style();
?>

<div class="md-padding">
    <div class="container">
        <div class="row"> 
            <?php if ($layout == "sidebar-left") { ?>
                <?php it_sidebar(); ?>
            <?php } ?>
            <div class="col-md-<?php echo $col; ?>">
                <div class="blog-posts">
                    <?php if ( have_posts() ) : ?>
                        <h3 class="block-head">
                            <?php echo $wp_query->found_posts; ?> <?php printf( __( 'Search Results for: %s', 'locale' ), get_search_query() ); ?>
                        </h3>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <div id="post-<?php the_ID(); ?>" <?php post_class('post-item srch-item fx'); ?> data-animate="fadeInLeft">
                                
                                <article class="post-content">
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
                                </article>
                                
                                <?php wp_link_pages( array(
                                    'before'      => '<div class="sub-pager"><span class="page-links-title">' . __( 'Pages:', 'itrays' ) . '</span>',
                                    'after'       => '</div>',
                                    'link_before' => '<span>',
                                    'link_after'  => '</span>',
                                    ) );
                                ?>
                            </div><!-- .post-->
                        <?php endwhile; ?>
                            <div class="clearfix margin-top-40"></div>
                            <?php it_paging_nav(); ?>
                        <?php else : ?>
                        
                        <div class="no-results not-found">
                            <p class="hint extraLarge"><?php echo __('Sorry but no results can not Be Found.','itrays') ?></p>
                            <hr class="hr-style3">
                            <div class="err-noresults"><i class="fa fa-frown-o"></i></div>
                            <div class="padd-vertical-30"><?php echo __('You can use the form below to search for what you need.','itrays'); ?>
                            <div class="srch-box-page"><?php get_search_form(); ?></div>
                            </div>
                        </div>

                        <?php endif; ?>
                </div> 
            </div>
            <?php if($layout == "sidebar-right") { ?>
                <?php it_sidebar(); ?>
            <?php } ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>
