<?php 
get_header();
$blogstyle = theme_option('blogstyle');
$wid;
if ( theme_option('show_sidebar_bp') == "1" ){
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
            <?php if ( theme_option('show_sidebar_bp') == "1" ) : ?>
                <?php if ( theme_option('sidebar_position_bp') == "left" ) : ?>
                    <?php it_sidebar(); ?>
                <?php endif; ?>    
            <?php endif; ?>
            <div class="col-md-<?php echo $wid; ?>">
                <?php
                    while ( have_posts() ) : the_post();
                      the_content();
                    endwhile;
                ?>
            </div>
            <?php if ( theme_option('show_sidebar_bp') == "1" ) : ?>
                <?php if ( theme_option('sidebar_position_bp') == "right" ) : ?>
                    <?php it_sidebar(); ?>
                <?php endif; ?>    
            <?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>