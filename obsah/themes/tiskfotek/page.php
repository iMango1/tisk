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

<?php if ($layout == "wide") { ?>
    <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?> 
<?php } else if ($layout == "full_width") { ?>
    <div class="sm-padding">
        <div class="container">
            <div class="row">
                <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>
            </div>
        </div>
    </div>    
<?php } else { ?>
    <div class="md-padding">
        <div class="container">
            <div class="row"> 
                <?php if ($layout == "sidebar-left") { ?>
                    <?php it_sidebar(); ?>
                <?php } ?>
                <div class="col-md-<?php echo $col; ?>">
                    <?php while ( have_posts() ) : the_post(); the_content(); endwhile; ?>  
                </div>
                <?php if($layout == "sidebar-right") { ?>
                    <?php it_sidebar(); ?>
                <?php } ?>
            </div>
        </div>
    </div> 
<?php } ?>

<?php get_footer(); ?>