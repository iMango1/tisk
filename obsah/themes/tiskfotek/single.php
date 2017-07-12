<?php 
get_header();
$col = '';
$lay = theme_option('blog_sidebar');

$options = get_post_custom(get_the_ID());
if(isset($options['page_layout'])){
    $layout = $options['page_layout'][0];
}
else{
    $layout = "full_width";
}

if (($layout == 'sidebar-left' || $layout == 'sidebar-right' || $lay == 'right' || $lay == 'left') && $layout != 'full_width' ){
    $col = '9';
}else{
    $col = 'full';
}

// page title function.
it_title_style();
?>

<?php if($layout == 'wide') { ?>
          
    <div class="padd-full">
        <div class="blog-posts">
            
            <div class="fx" data-animate="fadeInLeft">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'post-formats/content', get_post_format() ); ?>
                <nav class="nav-single">
                    <h3 class="assistive-text"><?php _e( 'Post navigation', 'itrays' ); ?></h3>
                    <span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'itrays' ) . '</span> %title' ); ?></span>
                    <span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'itrays' ) . '</span>' ); ?></span>
                </nav>

                <?php comments_template( '', true ); ?>
            <?php endwhile; ?>
            
            </div>
            
        </div>
    </div>

<?php } else { ?> 
<div class="md-padding">
    <div class="container">
        <?php if ($col == '9'){ ?>
        <div class="row">
        <?php } ?>
            <?php if ( $layout == 'sidebar-left' || ( $lay == 'left' && $layout == 'sidebar' ) || ( $lay == 'left' && $layout == 'theme' ) ) { ?>
                <?php get_sidebar(); ?>
            <?php } ?>            
            <div class="col-md-<?php echo $col; ?>">
                <div class="blog-posts">
			        
                    <div class="fx" data-animate="fadeInLeft">
                    <?php while ( have_posts() ) : the_post(); ?>
				        <?php get_template_part( 'post-formats/content', get_post_format() ); ?>
				        <?php
                        if ( theme_option('singlerelated_on') == "1" ){
                            locate_template( 'layout/blog/related-posts.php','related');
                        }
                        ?>
                        <nav class="nav-single">
					        <h3 class="assistive-text"><?php _e( 'Post navigation', 'itrays' ); ?></h3>
					        <span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'itrays' ) . '</span> %title' ); ?></span>
					        <span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'itrays' ) . '</span>' ); ?></span>
				        </nav>

                        <?php comments_template( '', true ); ?>
			        <?php endwhile; ?>
                    
                    </div>
                    
                </div>
            </div>
            <?php if ( $layout == 'sidebar-right' || ( $lay == 'right' && $layout == 'sidebar' ) || ( $lay == 'right' && $layout == 'theme' ) ) { ?>
                <?php get_sidebar(); ?>
            <?php } ?>
        <?php if ($col == '9'){ ?>
        </div>
        <?php } ?>
    </div>
</div>
<?php } ?>
<?php get_footer(); ?>
