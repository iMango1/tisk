<?php 
get_header();
$wid;
if ( theme_option('show_sidebar_edd') == "1" ){
    $wid = 9;
}else{
    $wid = 12;
} 
// page title function.
it_title_style();
?>  
<div class="md-padding">
    <div class="container">
        <div class="row">
            <?php if ( theme_option('show_sidebar_edd') == "1" ) : ?>
                <?php if ( theme_option('sidebar_position_edd') == "left" ) : ?>
                    <aside class="sidebar col-md-3">
                        <ul class="sidebar_widgets">
                            <?php dynamic_sidebar( 'sidebar-edd' ); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            <?php endif; ?>
            <div class="col-md-<?php echo $wid; ?>">
                <div class="fx" data-animate="fadeInLeft">
                    <?php while ( have_posts() ) : the_post(); ?>
				        <?php get_template_part( 'post-formats/content-download' ); ?>
                        <?php comments_template( '', true ); ?>
			        <?php endwhile; ?>
                </div>
            </div>
            <?php if ( theme_option('show_sidebar_edd') == "1" ) : ?>
                <?php if ( theme_option('sidebar_position_edd') == "right" ) : ?>
                    <aside class="sidebar col-md-3">
                        <ul class="sidebar_widgets">
                            <?php dynamic_sidebar( 'sidebar-edd' ); ?>
                        </ul>
                    </aside>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
if ( theme_option('singlerelated_on') == "1" ){
    locate_template( 'layout/blog/related-posts.php','related');
}
?>
<?php get_footer(); ?>
